<template>
  <v-container class="white--text">
    <v-layout>
      <v-flex>
        <span class="font-weight-thin display-2">Mensagens</span>
      </v-flex>
    </v-layout>
    <v-divider color="grey" />
    <v-card-title>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Pesquisar"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-layout>
      <v-flex>
        <v-data-table
          :headers="headers"
          :items="mensagensInfo"
          :search="search"
          class="elevation-3 bacano"
        >
          <template v-slot:item.action="{ item }">
            <v-icon medium color="error" @click="deletaMensagem(item)">
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
        { text: 'Email', value: 'email' },
        { text: 'Assunto', value: 'assunto' },
        { text: 'Mensagem', value: 'mensagem', sortable: false },
        { text: '', value: 'action', sortable: false }
      ],
      mensagens: [],
      editedItem: {
        id: 0,
        nome: '',
        email: '',
        assunto: '',
        mensagem: ''
      },
      defaultItem: {
        id: 0,
        nome: '',
        email: '',
        assunto: '',
        mensagem: ''
      }
    }
  },

  computed: {
    // funcao MAP JS, serve para pegar elementos específicos da API
    mensagensInfo() {
      return this.mensagens.map((c) => ({
        id: c.id,
        nome: c.nome,
        email: c.email,
        assunto: c.assunto,
        mensagem: c.mensagem
      }))
    },
    onSignup() {
      return this.editedIndex === -1
    }
  },
  async asyncData({ $axios }) {
    const [mensagensRes] = await Promise.all([$axios.get('/mensagens')])
    return {
      mensagens: mensagensRes.data.dados
    }
  },
  methods: {
    deletaMensagem(item) {
      const ok = window.confirm(
        'Você tem certeza de que deseja excluir essa mensagem ?'
      )
      if (ok) {
        this.$axios
          .post('deletarMensagem', {
            id: item.id
          })
          .then((res) => {
            this.menssagens = this.mensagens.filter((e) => e.id !== item.id)
          })
          .catch(({ response }) => {
            window.alert('Erro ao deletar mensagem')
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
