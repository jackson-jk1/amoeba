<template>
  <section class="faq">
    <v-container>
      <v-layout>
        <v-row align="center" justify="center">
          <div class="title">
            <h2>Frequently Asked Questions</h2>
          </div>
        </v-row>
      </v-layout>
      <v-layout>
        <v-row align="center" justify="start">
          <v-list class="faq-list">
            <v-list-group
              v-for="(ask, f) in asks"
              :key="f"
              color="rgb(242, 249, 248)"
              sub-group
              prepend-icon="mdi-chevron-down black--text"
              no-action
              class="faq-list-group"
              :ripple="notshine"
            >
              <template v-slot:activator>
                <v-list-item-title class="faq-item-title">{{
                  ask.title
                }}</v-list-item-title>
              </template>
              <v-list-item light class="faq-item">{{ ask.text }}</v-list-item>
            </v-list-group>
          </v-list>
        </v-row>
      </v-layout>
    </v-container>
  </section>
</template>
<script>
export default {
  data() {
    return {
      textColor: 'rgb(242, 249, 248)',
      notshine: false,
      asks: [
        {
          title: 'Non consectetur a erat nam at lectus urna duis?',
          text:
            'Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.'
        },
        {
          title:
            'Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?',
          text:
            'Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.'
        },
        {
          title:
            'Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?',
          text:
            'Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis'
        },
        {
          title: 'Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?',
          text:
            'Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.'
        },
        {
          title:
            'Tempus quam pellentesque nec nam aliquam sem et tortor consequat?',
          text:
            'Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in'
        },
        {
          title:
            'Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor?',
          text:
            'Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.'
        }
      ]
    }
  }
}
</script>
<style scoped>
section.faq {
  background-color: rgb(242, 249, 248);
  padding: 60px 0px;
}
section.faq h2 {
  font-size: 32px;
  font-weight: 300;
  margin-bottom: 20px;
  padding-bottom: 0px;
  color: rgb(85, 85, 85);
}
.title {
  font-size: 32px;
  font-family: Lato, sans-serif;
  font-weight: 300;
  margin-bottom: 20px;
  padding-bottom: 0px;
  color: rgb(85, 85, 85);
}
.faq-list {
  color: rgb(52, 58, 64);
  background-color: rgb(242, 249, 248);
  padding: 0px;
  list-style: none !important;
}
.faq-item-title:hover {
  color: #43aea0 !important;
}
.faq-item-title:active {
  color: #00d3b8 !important;
}
.faq-item-title {
  color: #343a40;
  position: relative;
  font-family: #70b9b0;
  font-size: 18px;
  font-weight: 400;
}
.v-list-item__title,
.v-list-item__subtitle {
  flex: 1 1 100%;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: normal;
}
.faq-list-group {
  color: rgba(255, 255, 255, 0);
}
.faq-item {
  color: #777 !important;
  margin-bottom: 20px;
  font-size: 15px;
}
.v-list-item__title,
.v-list-item__subtitle {
  white-space: normal !important;
}
</style>
