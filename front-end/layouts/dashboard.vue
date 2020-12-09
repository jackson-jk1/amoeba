<template>
  <v-app id="inspire" class="dashboard">
    <nav>
      <v-app-bar flat app class="teal darken-3 pb-4">
        <v-toolbar-title>
          <h1 class=" mt-3 ml-12">Amoeba</h1>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-icon
          @click="
            changeIcon()
            drawer = !drawer
          "
          >{{ menuicon }}</v-icon
        >
      </v-app-bar>
      <v-container>
        <v-content>
          <nuxt />
        </v-content>
      </v-container>
      <v-navigation-drawer v-model="drawer" color="#01292a" app>
        <v-list>
          <v-list-item
            v-for="(item, d) in items"
            :key="d"
            text
            :to="item.to"
            router
            exact
          >
            <v-list-item-icon>
              <v-icon class="white--text">{{ item.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title class="white--text">{{
                item.title
              }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
    </nav>
    <v-footer class="teal darken-3 pb-4" fixed app>
      <span>&copy; 2020</span>
    </v-footer>
  </v-app>
</template>
<script>
export default {
  data() {
    return {
      menuicon: 'mdi-menu',
      drawer: false,
      items: [
        {
          icon: 'mdi-home',
          title: 'Home',
          to: ''
        },
        {
          icon: 'mdi-image-area',
          title: 'Imagens',
          to: '/dashboard/imagens'
        },
        {
          icon: 'mdi-clipboard',
          title: 'Categorias',
          to: '/dashboard/categorias'
        },
        {
          icon: 'mdi-clipboard-text',
          title: 'Serviços',
          to: '/dashboard/servico'
        },
        {
          icon: 'mdi-content-copy',
          title: 'Portfolio',
          to: '/dashboard/portfolio'
        },
        {
          icon: 'mdi-account-multiple',
          title: 'Equipe',
          to: '/dashboard/equipes'
        },
        {
          icon: 'mdi-headset',
          title: 'Contatos',
          to: '/dashboard/contatos'
        },
        {
          icon: 'mdi-message-alert',
          title: 'Mensagens',
          to: '/dashboard/mensagem'
        }
      ]
    }
  },
  methods: {
    changeIcon() {
      if (this.menuicon === 'mdi-menu') {
        this.menuicon = 'mdi-window-close'
      } else this.menuicon = 'mdi-menu'
    }
  }
}
</script>
<style scoped>
.v-btn.v-size--default {
  font-size: 2em;
}
.v-application .teal {
  font-size: 0.575rem;
}
span.v-btn__content.dash {
  font-size: 0.775rem;
}

.v-btn.v-size--default {
  margin-top: 20px;
}
.v-application a {
  color: #00695c;
}
.v-application .d-flex {
  align-content: center;
}
</style>
