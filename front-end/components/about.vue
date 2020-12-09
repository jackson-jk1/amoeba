<template>
  <section class="aboutus">
    <v-container>
      <v-layout>
        <v-row align="center" justify="center">
          <div>
            <h1 class="grey--text mb-5 mt-12 font-weight-light display-1">
              About Us
            </h1>
          </div>
        </v-row>
      </v-layout>

      <v-row justify="center" aling="center" class="mr-12 ml-12">
        <v-col cols="12" xs="12" lg="6" max-width="800">
          <h1 class="grey--text">{{ titulo }}</h1>
          <p class="grey--text font-italic">{{ subTitulo }}</p>
          <ul>
            <li v-for="(ask, a) in asks" :key="a" class="grey--text mb-2">
              <i class="mdi mdi-checkbox-marked-circle-outline"></i>
              {{ ask.text }}
            </li>
          </ul>
          <p class="grey--text mt-8">{{ textoFinal }}</p>
        </v-col>
        <v-col cols="12" xs="6" lg="6">
          <v-img src="/imagens/about-img.jpg"></v-img>
        </v-col>
      </v-row>
    </v-container>
  </section>
</template>
<script>
export default {
  data() {
    return {
      titulo:
        'Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.',

      subTitulo:
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',

      asks: [
        {
          text: 'Ullamco laboris nisi ut aliquip ex ea commodo consequat.'
        },
        {
          text: ' Duis aute irure dolor in reprehenderit in voluptate velit.'
        },
        {
          text:
            ' Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.'
        }
      ],

      textoFinal:
        'Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'
    }
  }
}
</script>
<style scoped>
.aboutus {
  background-color: #fff;
}
ul {
  list-style-type: none;
}
li {
  font-size: 1.12em;
}
p {
  font-size: 1.12em;
}
h1 {
  font-size: 1.8em;
}
i {
  color: #18ffd5;
}
</style>
