<template>
  <nav>
    <v-toolbar flat app color="#2d6760">
      <v-app-bar flat min-height="60px" max-height="80px" color="#2d6760">
        <v-toolbar-title>
          <h1 class=" mt-3 mb-5 ml-12">Amoeba</h1>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items
          v-for="item in items"
          :key="item.title"
          class="hidden-md-and-down mb-5"
        >
          <v-btn depressed text :ripple="notbright" color="white">
            {{ item.title }}</v-btn
          ></v-toolbar-items
        >

        <v-icon
          class="hidden-lg-and-up "
          @click="
            changeIcon()
            drawer = !drawer
          "
          >{{ menuicon }}</v-icon
        >
      </v-app-bar>
    </v-toolbar>
    <v-navigation-drawer v-model="drawer" temporary color="#01292a" app>
      <v-list>
        <v-list-item v-for="(item, n) in items" :key="n" text>
          <v-list-item-action>
            <v-icon class="white--text">{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title class="white--text">{{
              item.title
            }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </nav>
</template>
<script>
export default {
  data() {
    return {
      menuicon: 'mdi-menu',
      drawer: false,
      notbright: true,
      items: [
        { icon: 'mdi-home', title: 'Home' },
        { icon: 'mdi mdi-help', title: 'About Us' },
        { icon: 'mdi-clipboard-text', title: 'Services' },
        { icon: 'mdi-clipboard', title: 'Portfolio' },
        { icon: 'mdi-account-multiple', title: 'Team' },
        { icon: 'mdi mdi-flag', title: 'Dashboard', route: '/dashboard' },
        { icon: 'mdi mdi-message-reply', title: 'Contact Us' }
      ]
    }
  },
  methods: {
    scrollFunction() {
      if (
        document.body.scrollTop > 80 ||
        document.documentElement.scrollTop > 80
      ) {
        document.getElementByClass('v-app-bar').style.paddingTop = '30px'
        document.getElementByClass('v-app-bar').style.backgroundColor = 'red'
      } else {
        document.getElementByClass('v-app-bar').style.paddingTop = '80px'
        document.getElementByClass('v-app-bar').style.backgroundColor = 'blue'
      }
    },
    changeIcon() {
      if (this.menuicon === 'mdi-menu') {
        this.menuicon = 'mdi-window-close'
      } else this.menuicon = 'mdi-menu'
    },
    backIcon() {
      if (this.menuicon === 'mdi-window-close') this.menuicon = 'mdi-menu'
    }
  }
}
</script>
<style scoped>
.v-btn.v-size--default {
  font-size: 0.775rem;
  color: #fff;
}
.v-application a {
  color: #00695c;
}
</style>
