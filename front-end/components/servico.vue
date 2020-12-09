<template>
  <v-card flat max-width="400" min-width="300" class="ajuste grey lighten-4">
    <v-container fluid>
      <div>
        <v-img :src="path + url" contain max-height="80"></v-img>
      </div>
      <div class="d-flex justify-center mt-4 text-center">
        <h3>
          <a class=" hover" href="http://localhost:3000/">{{ servico }}</a>
        </h3>
      </div>
      <div class="d-flex justify-center mt-2 text-center">
        <a>{{ descricao }}</a>
      </div>
    </v-container>
  </v-card>
</template>
<script>
export default {
  props: {
    id: {
      type: Number,
      required: true
    },

    imgId: {
      type: Number,
      required: true
    },

    url: {
      type: String,
      required: true
    },
    servico: {
      type: String,
      required: true
    },
    descricao: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      path: 'http://localhost:8000/storage/'
    }
  }
}
</script>

<style>
.ajuste {
  overflow-x: hidden;
}
a.hover h3 {
  color: #b3b3b3;
}
.v-application a {
  color: #b3b3b3;
}
.v-application h3 a {
  color: #b3b3b3 !important;
  font-size: 24px;
  text-decoration: none;
  margin-left: auto;
}
.v-application h3 a:hover {
  color: #70b9b0 !important;
}
</style>
