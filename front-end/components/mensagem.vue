<template>
  <v-form ref="messageform" class="form-control">
    <v-text-field
      v-model="message.nome"
      :rules="nomeRules"
      type="text"
      light
      solo
      clearable
      placeholder="Your Name"
      required
    ></v-text-field>
    <v-text-field
      v-model="message.email"
      :rules="emailRules"
      required
      type="email"
      light
      solo
      clearable
      placeholder="Your Email"
    ></v-text-field>
    <v-text-field
      v-model="message.assunto"
      :rules="assuntoRules"
      required
      type="text"
      light
      solo
      clearable
      placeholder="Subject"
    ></v-text-field>
    <v-textarea
      v-model="message.mensagem"
      :rules="messageRules"
      type="text"
      light
      solo
      placeholder="Message"
      height="150px"
    ></v-textarea>
    <v-btn
      id="submitbtn"
      class="text-capitalize"
      type="submit"
      depressed
      tile
      :ripple="btnripple"
      @click.prevent="salvar()"
      >Send Message</v-btn
    >
  </v-form>
</template>
<script>
export default {
  data() {
    return {
      btnripple: false,
      message: {
        nome: '',
        email: '',
        assunto: '',
        mensagem: ''
      },
      nomeRules: [
        (v) => !!v || 'Please enter at least 4 chars',
        (v) => (v && v.length > 4) || 'Please enter at least 4 chars'
      ],
      emailRules: [
        (v) => !!v || 'Please enter a valid email',
        (v) => /.+@.+/.test(v) || 'Please enter a valid email'
      ],
      assuntoRules: [
        (v) => !!v || 'Please enter at least 8 chars of subject',
        (v) => (v && v.length > 8) || 'Please enter at least 8 chars of subject'
      ],
      messageRules: [(v) => !!v || 'Please write something for us']
    }
  },
  methods: {
    salvar() {
      this.$axios
        .post('/novoMensagem', {
          nome: this.message.nome,
          email: this.message.email,
          assunto: this.message.assunto,
          mensagem: this.message.mensagem
        })
        .then(() => {
          this.$refs.messageform.reset()
        })
        .catch(({ response }) => {
          const { mensagem, errosSecundarios: erros } = response.data
          const listaErros = erros
            ? `\n ${Object.values(erros).join('\n')}`
            : ''
          this.$toast.error(`${mensagem}${listaErros}`, { duration: 5000 })
        })
    }
  }
}
</script>
<style scoped>
.form-control {
  padding: 0.375rem 0.75rem;
}
#submitbtn {
  background: #70b9b0 !important;
  border: 0 !important;
  padding: 10px 24px !important;
  color: #fff !important;
  transition: 0.4s !important;
}
#submitbtn:hover {
  background: #92cac3;
}
</style>
