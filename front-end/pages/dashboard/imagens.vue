<template>
  <v-container class="white--text">
    <v-layout>
      <v-flex>
        <span class="font-weight-thin display-2">IMAGENS</span>
      </v-flex>
    </v-layout>
    <v-divider color="grey" />
    <v-card-title>
      <v-btn class="mt-10" color="#43A047" light @click.stop="dialog = !dialog">
        NOVA IMAGEM
      </v-btn>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Pesquisar"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-dialog v-model="dialog" max-width="800px" no-click-animation persistent>
      <!--Inicio modal de editar-->
      <v-card class="bacano">
        <v-card-title>
          <span class="headline">{{ formTitle }}</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap column>
              <v-flex xs12 sm6 md4>
                <v-form ref="form" v-model="validation">
                  <v-text-field
                    v-model="editedItem.titulo"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Titulo"
                  />
                  <v-text-field
                    v-model="editedItem.descricao"
                    color="cyan darken-2"
                    label="Descrição"
                  />
                  <v-text-field
                    v-model="imagemNome"
                    label="Imagem para o serviço"
                    solo
                    readonly
                    @click="$refs.imginput.click()"
                  />
                  <input
                    id="imgcard"
                    ref="imginput"
                    type="file"
                    accept="image/*"
                    style="display: none;"
                    @change="imagemEscolhida"
                  />
                </v-form>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-btn color="#fff" text @click="close">
            Cancelar
          </v-btn>
          <v-btn color="#fff" text @click="reset">
            Reiniciar
          </v-btn>
          <v-btn color="#fff" text @click="onSubmit">
            Salvar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-layout class="mt-4">
      <v-flex>
        <v-data-table
          :search="search"
          :headers="headers"
          :items="imagensInfo"
          class="elevation-3 bacano"
        >
          <template v-slot:item.action="{ item }">
            <v-icon
              medium
              class="mr-2"
              color="primary"
              @click="dialogEdit(item)"
            >
              mdi-circle-edit-outline
            </v-icon>
            <v-icon medium color="error" @click="deletarImagem(item)">
              mdi-delete
            </v-icon>
          </template>
        </v-data-table>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  layout: 'dashboard',
  data() {
    return {
      dialog: false,
      headers: [
        {
          text: 'Imagem',
          align: 'left',
          sortable: false,
          value: 'titulo'
        },
        { text: 'Descrição', align: 'left', value: 'descricao' },
        { text: '', value: 'action', sortable: false }
      ],
      imagens: [],
      editedIndex: -1,
      editedItem: {
        titulo: '',
        descricao: '',
        imagem: ''
      },
      imagemNome: '',
      defaultItem: {
        titulo: '',
        descricao: '',
        imagem: ''
      }
    }
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? 'NOVA IMAGEM' : 'EDITAR IMAGEM'
    },

    // funcao MAP JS, serve para pegar elementos específicos da API
    imagensInfo() {
      return this.imagens.map((c) => ({
        id: c.id,
        titulo: c.titulo,
        descricao: c.descricao,
        imagem: c.imagem,
        imagemNome: c.imagem
      }))
    },

    onSignup() {
      return this.editedIndex === -1
    }
  },
  asyncData(context) {
    return context.app.$axios
      .get('/imagens')
      .then((res) => ({ imagens: res.data.dados }))
  },
  methods: {
    onSubmit() {
      if (this.onSignup) {
        this.criarImagem()
      } else {
        this.editarImagem()
      }
    },

    reset() {
      this.$refs.form.reset()
    },

    dialogEdit(item) {
      this.dialog = true
      this.editedIndex = item.id
      this.editedItem = Object.assign({}, item)
    },

    editarImagem() {
      const editableLocalData = new FormData()
      editableLocalData.append('id', this.editedItem.id)
      editableLocalData.append('titulo', this.editedItem.titulo)
      editableLocalData.append('descricao', this.editedItem.descricao)
      if (this.editedItem.imagem) {
        editableLocalData.append('imagem', this.editedItem.imagem)
      }
      this.$axios
        .post('atualizarImagem', editableLocalData)
        .then((res) => {
          window.alert(res.data.mensagem, { duration: 5000 })
          this.imagens = this.imagens.map((e) => {
            if (e.id === this.editedItem.id) {
              return Object.assign(e, editableLocalData)
            }
            this.refresh()
            return e
          })
        })
        .catch(({ response }) => {
          const { mensagem, errosSecundarios: erros } = response.data
          const listaErros = erros
            ? `\n ${Object.values(erros).join('\n')}`
            : ''
          window.alert(`${mensagem}${listaErros}`, { duration: 5000 })
        })
      this.close()
    },

    deletarImagem(item) {
      const ok = window.confirm(
        'Você tem certeza de que deseja excluir essa imagem?'
      )
      if (ok) {
        this.$axios
          .post('deletarImagem', {
            id: item.id
          })
          .then(() => {
            this.imagens = this.imagens.filter((e) => e.id !== item.id)
          })
      }
    },

    close() {
      this.dialog = false
      this.editedIndex = -1
      this.editedItem = this.defaultItem
    },

    refresh() {
      this.$axios
        .get('/imagens')
        .then((res) => {
          this.imagens = res.data.dados
        })
        .catch(() => ({}))
    },

    criarImagem() {
      const localData = new FormData()
      localData.append('titulo', this.editedItem.titulo)
      localData.append('descricao', this.editedItem.descricao)
      if (this.editedItem.imagem) {
        localData.append('imagem', this.editedItem.imagem)
      }
      this.$axios
        .post('/novoImagem', localData)
        .then((res) => {
          window.alert('Imagem criada com sucesso', { duration: 5000 })
          console.log(res)
          this.refresh()
        })
        .catch(({ response }) => {
          const { mensagem, errosSecundarios: erros } = response.data
          const listaErros = erros
            ? `\n ${Object.values(erros).join('\n')}`
            : ''
          window.alert(`${mensagem}${listaErros}`, { duration: 5000 })
        })
      this.close()
    },
    imagemEscolhida(e) {
      const imagem = e.target.files
      if (imagem[0] !== undefined) {
        // exibe nome da imagem selecionada
        this.imagemNome = imagem[0].name
        if (this.imagemNome.lastIndexOf('.') <= 0) {
          return
        }
        ;[this.editedItem.imagem] = imagem
      } else {
        // this.imagemNome = '';
        this.editedItem.imagem = ''
      }
    }
  }
}
</script>

<style lang="stylus" scoped>
.bacano {
  background-color: #00695C;
}
</style>
