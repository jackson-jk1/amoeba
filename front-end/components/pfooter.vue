<template>
  <section class="ft">
    <footer id="footer">
      <v-container>
        <v-row justify="center" align="center">
          &copy; Copyright &nbsp;<strong><span>Amoeba</span></strong>
          . All Rights Reserved
        </v-row>
        <v-row id="credits" justify="center" align="center"
          >Designed by &nbsp;<a>Equipe6</a></v-row
        >
      </v-container>
    </footer>
  </section>
</template>
<script>
export default {
  data() {
    return {}
  }
}
</script>
<style scoped>
#footer {
  background: #073839 !important;
  padding: 30px 0 !important;
  color: #fff !important;
  font-size: 14px !important;
}
#credits {
  padding-top: 10px !important;
  text-align: center !important;
  font-size: 13px !important;
  color: #fff !important;
}
a {
  color: #43aea0;
}
a:hover {
  color: #00d3b8;
  text-decoration: none;
}
#ft-icon {
  position: fixed;
  display: none;
  width: 40px;
  height: 40px;
  border-radius: 3px;
  right: 15px;
  bottom: 15px;
  background: #70b9b0;
  color: #fff;
  transition: display 0.5s ease-in-out;
  z-index: 99999;
}
</style>
