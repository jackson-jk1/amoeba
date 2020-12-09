<template>
  <div class="background">
    <div class="layer">
      <v-row justify="center" aling="center" style="height: 100%">
        <v-col cols="12">
          <div>
            <h2 class="display-1 font-weight-regular text-center ">
              Call To Action
            </h2>
          </div>
        </v-col>
        <v-col cols="12">
          <div class="text-center font-weight-light">
            <p class="write ml-12 mr-12">
              Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
              cupidatat non proident, sunt in culpa qui officia deserunt mollit
              anim id est laborum.
            </p>
          </div>
        </v-col>
        <v-col cols="6">
          <div class="centra">
            <v-btn text class="text-center text-capitalize botao mb-12">
              Call To Action
            </v-btn>
          </div>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Call'
}
</script>

<style scoped>
.background {
  position: relative;
  min-height: 45vh;
  background-image: url('/imagens/call-to-action-bg.jpg');
  background-attachment: fixed;
  background-repeat: no-repeat;
  background-position: center;
}

.v-application .display-1 {
  font-size: 2rem !important;
  font-weight: 400;
  line-height: 2.5rem;
  letter-spacing: 0.0073529412em !important;
  font-family: 'Roboto', sans-serif !important;
}

.layer {
  background-color: rgba(106, 170, 167, 0.2);
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  padding-top: 50px;
}

.v-btn:not(.v-btn--round).v-size--default {
  height: 45px;
  width: 170px;
  min-width: 64px;
  padding: 0px 16px;
  align-content: center;
}

.v-btn:hover {
  background-color: rgba(106, 170, 167, 0.9);
  border: rgba(106, 170, 167, 0.9);
}
.centra {
  display: flex;
  justify-content: center;
}
.botao {
  border: 2px solid #fff;
  border-radius: 20px;
}
.write {
  color: #fff;
  font-size: 0.9em;
}
</style>
