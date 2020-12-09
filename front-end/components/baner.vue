<template>
  <div class="backgroundd">
    <div class="layerr">
      <v-row justify="center" aling="center">
        <v-col lg="12" md="12" sm="12" xs="12">
          <div>
            <h1 class="display-1 font-weight-light text-center mb-4">
              Welcome to Amoeba
            </h1>
          </div>
          <div class="centra font-weight-light text-center mb-12">
            <h2>
              We are team of talanted designers making websites with Bootstrap
            </h2>
          </div>
          <div class="centra">
            <v-btn text class="text-center text-capitalize botao">
              Get Started
            </v-btn>
          </div>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Baner'
}
</script>

<style scoped>
.backgroundd {
  position: relative;
  height: 75vh;
  background-image: url('/imagens/hero-background.jpg');
  background-attachment: fixed;
  background-repeat: no-repeat;
  background-position: center;
}

.v-application .display-1 {
  font-size: 3rem !important;
  font-weight: 400;
  line-height: 2.5rem;
  letter-spacing: 0.0073529412em !important;
  font-family: 'Roboto', sans-serif !important;
}

.layerr {
  background-color: rgba(112, 185, 176, 0.85);
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.v-btn:not(.v-btn--round).v-size--default {
  height: 45px;
  min-width: 150px;
  padding: 0px 16px;
  align-content: center;
}
.v-btn:hover {
  background-color: #fff;
  color: rgba(106, 170, 167, 0.9);
}
.v-application .font-weight-light h2 {
  font-weight: 300 !important;
  font-size: 1.1em;
}
.centra {
  display: flex;
  justify-content: center;
  margin-bottom: 10px;
}
.botao {
  border: 1px solid #fff;
  border-radius: 20px;
  font-size: 1em;
}
</style>
