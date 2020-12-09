<template>
  <div>
    <v-icon class="contact-icons" href="#">mdi-map-marker</v-icon>
    <p class="contact-icons-text">{{ endereco }}</p>
    <v-icon class="contact-icons" href="#">mdi-email</v-icon>
    <p class="contact-icons-text">{{ email }}</p>
    <v-icon class="contact-icons" href="#">mdi-phone</v-icon>
    <p class="contact-icons-text">{{ telefone }}</p>
  </div>
</template>
<script>
export default {
  props: {
    endereco: {
      type: String,
      required: true
    },
    email: {
      type: String,
      required: true
    },
    telefone: {
      type: String,
      required: true
    }
  }
}
</script>
<style scoped>
.v-btn {
  color: rgb(255, 255, 255) !important;
  background: rgb(112, 185, 176) !important;
  border-width: 0px !important;
  border-style: initial !important;
  border-color: initial !important;
  border-image: initial !important;
  padding: 10px 24px !important;
  transition: all 0.4s ease 0s !important;
}
.contact-icons {
  font-size: 32px !important;
  color: rgb(112, 185, 176) !important;
  float: left !important;
  line-height: 1 !important;
}
.contact-icons-text {
  word-wrap: normal;
  line-height: 28px !important;
  font-size: 14px !important;
  padding: 0px 0px 10px 42px !important;
  color: rgb(119, 119, 119) !important;
  text-align: left !important;
}
</style>
