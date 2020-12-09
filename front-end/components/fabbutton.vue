<template>
  <v-fab-transition>
    <v-btn
      v-show="fab"
      v-scroll="onScroll"
      depressed
      fab
      fixed
      right
      bottom
      height="40px"
      width="40px"
      color="#70b9b0"
      :ripple="notrip"
      @click="toTop"
      ><v-icon>mdi-chevron-up</v-icon></v-btn
    ></v-fab-transition
  >
</template>
<script>
export default {
  data() {
    return {
      notrip: false,
      fab: false
    }
  },
  methods: {
    onScroll(e) {
      if (typeof window === 'undefined') return
      const top = window.pageYOffset || e.target.scrollTop || 0
      this.fab = top > 60
    },
    toTop() {
      this.$vuetify.goTo(0, { duration: 1500 })
    }
  }
}
</script>
<style scoped>
.v-btn--round {
  border-radius: 3px !important;
}
.v-icon {
  font-size: 30px !important;
  font-weight: 400;
}
.v-btn:hover {
  color: #fff;
  background: #8bc6bf;
  transition: background 0.2s ease-in-out;
  display: inline-flex;
}
button {
  right: 5px !important;
  bottom: 5px !important;
}
</style>
