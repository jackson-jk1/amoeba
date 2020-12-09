<template>
  <v-card flat max-width="500" class="mx-auto" color="#fff">
    <v-container fluid>
      <div class="fundo">
        <div class="sobe">
          <v-img class="white--text align-center" :src="localUrl + caminho">
            <v-card-title class="text-center"
              ><h3>
                {{ categoria[1].nome }} <br />
                <h2><a href="#">+</a></h2>
              </h3></v-card-title
            >
          </v-img>
        </div>
      </div>
    </v-container>
  </v-card>
</template>

<script>
export default {
  props: {
    caminho: {
      type: String,
      required: true
    },
    link: {
      type: String,
      required: true
    },
    categoria: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  data() {
    return {
      localUrl: 'http://localhost:8000/storage/'
    }
  }
}
</script>

<style>
.v-application h3 {
  color: #fff;
  text-decoration: none;
  margin: auto;
  font-size: 22px;
}
@media (max-width: 408px) {
  .v-application h3 {
    opacity: 0;
  }
}
.v-application h3 h2 a {
  color: #70b9b0 !important;
  font-size: 24px;
  text-decoration: none;
  margin-left: auto;
}
.v-application h3 a:hover {
  color: #00695c;
}

.fundo .v-image:hover div {
  transform: scale(1.1);
  background-color: rgba(7, 56, 57, 0.4);
}
.fundo .v-image div {
  border-radius: 5px;
  height: 100%;
  width: 100%;
  transition: 0.3s ease-in-out;
}
.v-card__title {
  opacity: 0;
  display: flex;
  flex-wrap: wrap;
  font-size: 1.5rem;
  font-weight: 400;
  letter-spacing: normal;
  line-height: 2rem;
  padding: 140px;
  text-align: center;
}
.v-card__title:hover {
  opacity: 1;
  top: calc(50% - 30px);
}
</style>
