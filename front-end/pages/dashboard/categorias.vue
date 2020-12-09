<template>
  <v-container class="white--text">
    <v-layout>
      <v-flex>
        <span class="font-weight-thin display-2">CATEGORIAS</span>
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
        NOVA CATEGORIA
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
                    label="Categoria"
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
          :headers="headers"
          :items="categoriasInfo"
          :search="search"
          class="elevation-3 bacano"
        >
          <template v-slot:item.action="{ item }">
            <v-icon class="mr-2" color="primary" @click="dialogEdit(item)">
              mdi-circle-edit-outline
            </v-icon>
            <v-icon medium color="error" @click="deletaCategoria(item)">
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
          text: 'Categorias',
          align: 'left',
          value: 'nome'
        },
        { text: '', value: 'action', sortable: false }
      ],
      categorias: [],
      editedItem: {
        id: 0,
        nome: ''
      },
      defaultItem: {
        id: 0,
        nome: ''
      }
    }
  },

  computed: {
    // funcao MAP JS, serve para pegar elementos específicos da API
    categoriasInfo() {
      return this.categorias.map((c) => ({
        id: c.id,
        nome: c.nome
      }))
    },
    onSignup() {
      return this.editedIndex === -1
    }
  },
  asyncData(context) {
    return context.app.$axios
      .get('/categorias')
      .then((res) => ({ categorias: res.data.dados }))
  },
  methods: {
    formTitle() {
      return this.editedIndex === -1 ? 'NOVO CATEGORIA' : 'EDITAR CATEGORIA'
    },
    onSubmit() {
      if (!this.validation) {
        this.$refs.form.validate()
        return
      }
      if (this.onSignup) {
        this.novoCategoria()
      } else {
        this.atualizaCategoria()
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
    novoCategoria() {
      const CategoriaData = {
        id: this.editedItem.id,
        nome: this.editedItem.nome
      }
      this.$axios
        .$post('novoCategoria', CategoriaData)
        .then((res) => {
          this.categorias.push(res.dados)
        })
        .catch(({ response }) => {
          window.alert('Campo Inválido')
        })
    },
    atualizaCategoria() {
      const editableCategoriaData = {
        id: this.editedItem.id,
        nome: this.editedItem.nome
      }
      this.$axios
        .$post('atualizarCategoria', editableCategoriaData)
        .then((res) => {
          this.categorias = this.categorias.map((e) => {
            if (e.id === this.editedItem.id) {
              return Object.assign(e, editableCategoriaData)
            }
            return e
          })
        })
        .catch(({ response }) => {
          window.alert('Erro ao editar categoria')
        })
      window.location.reload()
    },
    dialogEdit(item) {
      this.modalLocal = true
      this.editedIndex = item.id
      this.editedItem = Object.assign({}, item)
    },
    deletaCategoria(item) {
      const ok = window.confirm(
        'Você tem certeza de que deseja excluir essa categoria?'
      )
      if (ok) {
        this.$axios
          .post('deletarCategoria', {
            id: item.id
          })
          .then((res) => {
            this.categorias = this.categorias.filter((e) => e.id !== item.id)
          })
          .catch(({ response }) => {
            window.alert('Erro ao deletar categoria')
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
