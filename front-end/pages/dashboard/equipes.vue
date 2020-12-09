<template app>
  <v-container class="white--text">
    <v-layout>
      <v-flex>
        <span class="font-weight-thin display-2">EQUIPE</span>
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
        NOVO ITEM
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
                    v-model="editedItem.nome"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Nome"
                  />
                  <v-text-field
                    v-model="editedItem.cargo"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Cargo"
                  />
                  <v-text-field
                    v-model="editedItem.descricao"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Descrição"
                  />
                  <v-text-field
                    v-model="editedItem.twitter"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Twitter"
                  />
                  <v-text-field
                    v-model="editedItem.facebook"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Facebook"
                  />
                  <v-text-field
                    v-model="editedItem.instagram"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Instagram"
                  />
                  <v-text-field
                    v-model="editedItem.linkedin"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="LinkedIn"
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
          :items="equipesInfo"
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
            <v-icon medium color="error" @click="deletaPessoa(item)">
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
        { text: 'Nome', value: 'nome' },
        { text: 'Cargo', align: 'left', value: 'cargo', sortable: false },
        { text: 'Descrição', value: 'descricao', sortable: false },
        { text: 'Twitter', value: 'twitter', sortable: false },
        { text: 'Facebook', value: 'facebook', sortable: false },
        { text: 'Instagram', value: 'instagram', sortable: false },
        { text: 'Linkedin', value: 'linkedin', sortable: false },
        { text: '', value: 'action', sortable: false }
      ],
      equipes: [],
      imagens: [],
      editedItem: {
        id: 0,
        nome: '',
        cargo: '',
        descricao: '',
        twitter: '',
        facebook: '',
        instagram: '',
        linkedin: '',
        imagem_id: ''
      },
      defaultItem: {
        id: 0,
        nome: '',
        cargo: '',
        descricao: '',
        twitter: '',
        facebook: '',
        instagram: '',
        linkedin: '',
        imagem_id: ''
      }
    }
  },

  computed: {
    // funcao MAP JS, serve para pegar elementos específicos da API
    equipesInfo() {
      return this.equipes.map((c) => ({
        id: c.id,
        nome: c.nome,
        cargo: c.cargo,
        descricao: c.descricao,
        twitter: c.twitter_link,
        facebook: c.facebook_link,
        instagram: c.instagram_link,
        linkedin: c.linkedin_link,
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
    const [equipesRes, imagensRes] = await Promise.all([
      $axios.get('/equipes'),
      $axios.get('/imagens')
    ])
    return {
      equipes: equipesRes.data.dados,
      imagens: imagensRes.data.dados
    }
  },
  methods: {
    formTitle() {
      return this.editedIndex === -1 ? 'NOVO ITEM' : 'EDITAR ITEM'
    },
    onSubmit() {
      if (!this.validation) {
        this.$refs.form.validate()
        return
      }
      if (this.onSignup) {
        this.novaEquipe()
      } else {
        this.atualizaEquipe()
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
    novaEquipe() {
      //  váriavel com todos os dados dos serviços
      const PessoaData = {
        id: this.editedItem.id,
        nome: this.editedItem.nome,
        imagem_id: this.editedItem.imagem_id,
        cargo: this.editedItem.cargo,
        descricao: this.editedItem.descricao,
        twitter: this.editedItem.twitter,
        facebook: this.editedItem.facebook,
        instagram: this.editedItem.instagram,
        linkedin: this.editedItem.linkedin
      }
      this.$axios
        .$post('novoEquipe', PessoaData)
        .then((res) => {
          this.equipes.push(res.dados)
        })
        .catch(({ response }) => {
          window.alert('Campo Inválido')
          console.log(response)
        })
    },
    atualizaEquipe() {
      const editablePessoaData = {
        id: this.editedItem.id,
        nome: this.editedItem.nome,
        imagem_id: this.editedItem.imagem_id,
        cargo: this.editedItem.cargo,
        descricao: this.editedItem.descricao,
        twitter: this.editedItem.twitter,
        facebook: this.editedItem.facebook,
        instagram: this.editedItem.instagram,
        linkedin: this.editedItem.linkedin
      }
      this.$axios
        .$post('atualizarEquipe', editablePessoaData)
        .then((res) => {
          this.equipes = this.equipes.map((e) => {
            if (e.id === this.editedItem.id) {
              return Object.assign(e, editablePessoaData)
            }
            return e
          })
        })
        .catch(({ response }) => {
          window.alert('Erro ao editar item')
        })
      window.location.reload()
    },
    dialogEdit(item) {
      this.modalLocal = true
      this.editedIndex = item.id
      this.editedItem = Object.assign({}, item)
    },
    deletaPessoa(item) {
      const ok = window.confirm(
        'Você tem certeza de que deseja excluir essa pessoa?'
      )
      if (ok) {
        this.$axios
          .post('deletarEquipe', {
            id: item.id
          })
          .then((res) => {
            this.equipes = this.equipes.filter((e) => e.id !== item.id)
          })
          .catch(({ response }) => {
            window.alert('Erro ao deletar pessoa')
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
