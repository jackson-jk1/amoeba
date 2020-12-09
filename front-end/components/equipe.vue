<template>
  <v-conainer>
    <div class="card-team">
      <v-card flex d-flex flex-column flat color="#fff">
        <div class="member">
          <v-img :src="path + url"></v-img>
          <h4>{{ nome }}</h4>
          <span>{{ cargo }}</span>
          <p>{{ descricao }}</p>
          <div class="social-icons-team">
            <v-btn v-ripple="false" :href="twitterLink" icon tile
              ><v-icon>mdi-twitter</v-icon>
            </v-btn>
            <v-btn v-ripple="false" :href="facebookLink" icon tile
              ><v-icon>mdi-facebook</v-icon></v-btn
            >
            <v-btn v-ripple="false" :href="instagramLink" icon tile
              ><v-icon>mdi-instagram</v-icon></v-btn
            >
            <v-btn v-ripple="false" :href="linkedinLink" icon tile
              ><v-icon>mdi-linkedin</v-icon></v-btn
            >
          </div>
        </div>
      </v-card>
    </div>
  </v-conainer>
</template>
<script>
export default {
  props: {
    id: {
      type: Number,
      required: true
    },

    imagemId: {
      type: Number,
      required: true
    },

    url: {
      type: String,
      required: true
    },
    nome: {
      type: String,
      required: true
    },
    descricao: {
      type: String,
      required: true
    },
    cargo: {
      type: String,
      required: true
    },
    twitterLink: {
      type: String,
      required: true
    },
    facebookLink: {
      type: String,
      required: true
    },
    instagramLink: {
      type: String,
      required: true
    },
    linkedinLink: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      path: 'http://localhost:8000/storage/'
    }
  },
  head() {
    return {
      link: [
        {
          href:
            'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap',
          rel: 'stylesheet'
        }
      ]
    }
  }
}
</script>

<style scoped>
.member {
  text-align: center;
  margin-bottom: 20px;
  padding: 30px 20px;
  background: #fff;
  font-family: 'Open Sans', sans-serif;
}
.member h4 {
  font-weight: 700;
  margin-bottom: 2px;
  font-size: 18px;
  color: #777;
}
.member span {
  font-style: italic;
  display: block;
  font-size: 13px;
  color: #777;
}
.member p {
  padding-top: 10px;
  font-size: 14px;
  font-style: italic;
  color: #aaaaaa;
  margin-top: 0;
  text-align: center;
}

.member .v-image {
  max-width: 50%;
  padding: 100px;
  border-radius: 50%;
  margin: 0 auto 30px auto !important;
}
.v-application a:hover {
  color: #3c8b81 !important;
  transition: 0.3s;
}
.v-application a {
  color: #92cac3 !important;
}
.v-image {
  vertical-align: middle !important;
  border-style: none !important;
}
.v-card {
  box-shadow: 0px 0px 12px 0px rgba(0, 0, 0, 0.1) !important;
}
.card-team {
  margin: 0px 2px;
}
.social-icons-team {
  margin-top: 15px;
}
.v-btn.v-size--default {
  margin-top: 0px;
  width: auto;
}
.v-btn {
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  margin: 0px 2px;
}
.v-btn i {
  font-size: 21px !important;
  margin: -3px;
}
.v-btn:hover:before {
  color: #fff !important;
  background-color: #fff !important;
}
.v-btn:before {
  color: #fff;
}
.v-ripple__animation {
  color: rgba(255, 255, 255, 0) !important;
  opacity: 0 !important;
  background-color: rgba(255, 255, 255, 0) !important;
  background: rgba(255, 255, 255, 0) !important;
}
</style>
