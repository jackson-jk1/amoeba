<template>
  <v-container class="white--text">
    <v-layout>
      <v-flex>
        <span class="font-weight-thin display-2">SERVIÇOS</span>
      </v-flex>
    </v-layout>
    <v-divider color="grey" />
    <v-card-title>
      <v-btn
        class="mt-10"
        color="#43A047"
        light
        @click.stop="modalLocal = !modalLocal"
      >
        NOVO SERVIÇO
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
    <v-dialog
      v-model="modalLocal"
      max-width="800px"
      no-click-animation
      persistent
    >
      <!--Inicio modal de editar-->
      <v-card class="bacano">
        <v-card-title>
          <span class="headline">{{ formTitle() }}</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap column>
              <v-flex xs12 sm6 md4>
                <v-form ref="form" v-model="validation">
                  <v-text-field
                    v-model="editedItem.servico"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Serviço"
                  />
                  <v-text-field
                    v-model="editedItem.descricao"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Descrição"
                  />
                  <v-select
                    v-model="editedItem.imagem_id"
                    :items="imagensInfo"
                    item-text="titulo"
                    item-value="id"
                    label="Imagem"
                  >
                  </v-select>
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
          :headers="headers"
          :items="servicosInfo"
          :search="search"
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
            <v-icon medium color="error" @click="deletaServico(item)">
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
      search: '',
      modalLocal: false,
      validation: true,
      editedIndex: -1,
      headers: [
        {
          text: 'Serviço',
          align: 'left',
          sortable: false,
          value: 'servico'
        },
        { text: 'Descrição', align: 'left', value: 'descricao' },
        { text: 'Imagem', align: 'left', value: 'imagem_id' },
        { text: '', value: 'action', sortable: false }
      ],
      servicos: [],
      imagens: [],
      editedItem: {
        id: 0,
        servico: '',
        descricao: '',
        imagem_id: ''
      },
      defaultItem: {
        id: 0,
        servico: '',
        descricao: '',
        imagem_id: ''
      }
    }
  },

  computed: {
    // funcao MAP JS, serve para pegar elementos específicos da API
    servicosInfo() {
      return this.servicos.map((c) => ({
        id: c.id,
        servico: c.servico,
        descricao: c.descricao,
        imagem_id: c.imagem_id
      }))
    },
    imagensInfo() {
      return this.imagens.map((c) => ({
        id: c.id,
        titulo: c.titulo,
        descricao: c.descricao
      }))
    },

    onSignup() {
      return this.editedIndex === -1
    }
  },
  async asyncData({ $axios }) {
    const [servicosRes, imagensRes] = await Promise.all([
      $axios.get('/servicos'),
      $axios.get('/imagens')
    ])
    return {
      servicos: servicosRes.data.dados,
      imagens: imagensRes.data.dados
    }
  },
  methods: {
    formTitle() {
      return this.editedIndex === -1 ? 'NOVO SERVIÇO' : 'EDITAR SERVIÇO'
    },
    onSubmit() {
      if (!this.validation) {
        this.$refs.form.validate()
        return
      }
      if (this.onSignup) {
        this.novoServico()
      } else {
        this.atualizaServico()
      }
      this.close()
    },
    reset() {
      this.$refs.form.reset()
    },
    close() {
      this.modalLocal = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
    },
    novoServico() {
      //  váriavel com todos os dados dos serviços
      const ServicoData = {
        id: this.editedItem.id,
        imagem_id: this.editedItem.imagem_id,
        servico: this.editedItem.servico,
        descricao: this.editedItem.descricao
      }
      this.$axios
        .$post('novoServico', ServicoData)
        .then((res) => {
          console.log('resposta vinda do back ')
          console.log(res)
          this.servicos.push(res.dados)
        })
        .catch(({ response }) => {
          window.alert('Campo Inválido')
        })
    },
    atualizaServico() {
      const editableServicoData = {
        id: this.editedItem.id,
        imagem_id: this.editedItem.imagem_id,
        servico: this.editedItem.servico,
        descricao: this.editedItem.descricao
      }
      this.$axios
        .$post('atualizarServico', editableServicoData)
        .then((res) => {
          this.servicos = this.servicos.map((e) => {
            if (e.id === this.editedItem.id) {
              return Object.assign(e, editableServicoData)
            }
            return e
          })
        })
        .catch(({ response }) => {
          window.alert('Erro ao editar Serviço')
        })
      window.location.reload()
    },
    dialogEdit(item) {
      this.modalLocal = true
      this.editedIndex = item.id
      this.editedItem = Object.assign({}, item)
    },
    deletaServico(item) {
      const ok = window.confirm(
        'Você tem certeza de que deseja excluir essa serviço?'
      )
      if (ok) {
        this.$axios
          .post('deletarServico', {
            id: item.id
          })
          .then((res) => {
            this.servicos = this.servicos.filter((e) => e.id !== item.id)
          })
          .catch(({ response }) => {
            window.alert('Erro ao deletar serviço')
          })
      }
      window.location.reload()
    }
  }
}
</script>

<style lang="stylus" scoped>
.bacano {
  background-color: #00695C;
}
</style>
