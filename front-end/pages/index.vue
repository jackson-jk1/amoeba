<template>
  <v-app class=" grey lighten-4 ">
    <v-content>
      <navbar></navbar>
      <baner></baner>
      <about></about>
      <section class=" grey lighten-4">
        <v-container class=" grey lighten-4">
          <v-row class="pl-2">
            <v-col
              v-for="(colNum, s) in servicos"
              :key="s"
              xs="12"
              lg="4"
              md="4"
              sm="6"
            >
              <servico
                :id="colNum.id"
                :img-id="colNum.imagem_id"
                :descricao="colNum.descricao"
                :servico="colNum.servico"
                :url="colNum.imagem.caminho"
              >
              </servico>
            </v-col>
          </v-row>
        </v-container>
      </section>
      <v-container fluid class="white justify-center">
        <h2
          style="text-align:center; padding-bottom: 20px;"
          class=" grey--text display-1"
        >
          Our Portfolio
        </h2>
        <div flat class="d-flex justify-center mb-5 ">
          <v-btn
            text
            class="dois"
            @click="
              portState = 'all'
              filtraPort()
            "
            >ALL</v-btn
          >
          <v-btn
            text
            class="dois"
            @click="
              portState = 'app'
              filtraPort()
            "
            >APP</v-btn
          >
          <v-btn
            text
            class="dois"
            @click="
              portState = 'card'
              filtraPort()
            "
            >CARD</v-btn
          >
          <v-btn
            text
            class="dois"
            @click="
              portState = 'web'
              filtraPort()
            "
            >WEB</v-btn
          >
        </div>
        <v-row class="justify-center">
          <v-col
            v-for="(colNume, p) in portFiltered"
            :key="p"
            cols="12"
            xs="12"
            sm="8"
            md="6"
            lg="4"
            xl="4"
          >
            <portifolio
              :link="colNume.link"
              :categoria="colNume.categoria"
              :caminho="colNume.imagem.caminho"
            >
            </portifolio>
          </v-col>
        </v-row>

        <call></call>
        <faq></faq>
      </v-container>
      <section class="white">
        <v-container class="white">
          <v-row>
            <v-col align="center" justify="center" lg="12">
              <div class="title-team">
                <h1>Our Team</h1>
                <p>
                  Magnam dolores commodi suscipit. Necessitatibus eius
                  consequatur ex aliquid fuga eum quidem. Sit sint consectetur
                  velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit
                  suscipit alias ea. Quia fugiat sit in iste officiis commodi
                  quidem hic quas.
                </p>
              </div>
            </v-col>
          </v-row>
          <v-row align="stretch">
            <v-col
              v-for="(colEquipe, e) in equipes"
              :key="e"
              lg="4"
              md="4"
              sm="12"
              d-flex
              flex-column
              align="stretch"
            >
              <equipe
                :id="colEquipe.id"
                :nome="colEquipe.nome"
                :cargo="colEquipe.cargo"
                :descricao="colEquipe.descricao"
                :imagem-id="colEquipe.imagem_id"
                :twitter-link="colEquipe.twitter_link"
                :facebook-link="colEquipe.facebook_link"
                :instagram-link="colEquipe.instagram_link"
                :linkedin-link="colEquipe.linkedin_link"
                :url="colEquipe.imagem.caminho"
              >
              </equipe>
            </v-col>
          </v-row>
        </v-container>
      </section>
      <section class="contact-info">
        <v-container>
          <div>
            <v-row class="title-contact" align="center" justify="center">
              <h2>Contact Us</h2>
              <p>{{ subtext.message }}</p>
            </v-row>
          </div>
          <v-row>
            <v-col lg="4" md="6" sm="12">
              <div class="about">
                <h3>Amoeba</h3>
                <p>
                  Cras fermentum odio eu feugiat. Justo eget magna fermentum
                  iaculis eu non diam hasellus. Scelerisque felis imperdiet
                  proin fermentum leo. Amet volutpat consequat mauris nunc
                  congue.
                </p>
              </div>
              <div class="social-media">
                <a href="#"
                  ><v-icon
                    v-for="social in socials"
                    :key="social.icon"
                    class="social-icons"
                    >{{ social.icon }}</v-icon
                  ></a
                >
              </div>
            </v-col>
            <v-col
              v-for="(colContato, c) in contatos"
              :key="c"
              align="center"
              lg="2"
              md="4"
              sm="12"
            >
              <contatos
                :endereco="colContato.endereco"
                :email="colContato.email"
                :telefone="colContato.telefone"
              >
              </contatos>
            </v-col>
            <v-col align="center" lg="" md="12" sm="12">
              <mensagem></mensagem>
            </v-col>
          </v-row>
        </v-container>
      </section>
      <mapa></mapa>
      <pfooter></pfooter>
      <fabbutton></fabbutton>
    </v-content>
  </v-app>
</template>
<script>
import servico from '~/components/servico'
import baner from '~/components/baner'
import about from '~/components/about'
import contatos from '~/components/contatos'
import call from '~/components/call'
import faq from '~/components/faq'
import mapa from '~/components/mapa'
import portifolio from '~/components/portifolio'
import equipe from '~/components/equipe'
import pfooter from '~/components/pfooter'
import navbar from '~/components/navbar'
import fabbutton from '~/components/fabbutton'
import mensagem from '~/components/mensagem'
export default {
  layout: 'default',
  components: {
    navbar,
    servico,
    baner,
    equipe,
    about,
    faq,
    contatos,
    call,
    mapa,
    portifolio,
    pfooter,
    fabbutton,
    mensagem
  },
  data() {
    return {
      servicos: [],
      imagens: [],
      categorias: [],
      portfolios: [],
      equipes: [],
      contatos: [],
      portFiltered: [],
      portState: 'all',
      justify: 'center',
      alignment: 'center',
      subtext: {
        message:
          'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem.Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.',
        message2:
          'Cras fermentum odio eu feugiat. Justo eget magna fermentum iaculis eu non diam hasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.'
      },
      socials: [
        { icon: 'mdi-twitter' },
        { icon: 'mdi-facebook' },
        { icon: 'mdi-instagram' },
        { icon: 'mdi-linkedin' }
      ]
    }
  },
  head() {
    return {
      title: 'Amoeba',
      link: [{ rel: 'icon', type: 'image/png', href: 'imagens/favicon.ico' }]
    }
  },
  async asyncData({ $axios }) {
    const [
      servicoRes,
      imagemRes,
      portfoliosRes,
      categoriasRes,
      equipesRes,
      contatosRes
    ] = await Promise.all([
      $axios.get('/servicos'),
      $axios.get('/imagens'),
      $axios.get('/portfolios'),
      $axios.get('/categorias'),
      $axios.get('/equipes'),
      $axios.get('/contatos')
    ])

    return {
      servicos: servicoRes.data.dados,
      imagens: imagemRes.data.dados,
      portfolios: portfoliosRes.data.dados,
      categorias: categoriasRes.data.dados,
      equipes: equipesRes.data.dados,
      contatos: contatosRes.data.dados
    }
  },
  mounted() {
    this.filtraPort()
  },
  methods: {
    filtraPort() {
      return (this.portFiltered = this.portfolios.filter(
        (value) =>
          value.categoria[1].nome === this.portState ||
          value.categoria[0].nome === this.portState
      ))
    }
  }
}
</script>
<style>
.title-team {
  padding: 60px 0;
  padding-bottom: 30px;
}
.title-team h1 {
  font-size: 32px;
  font-weight: 300;
  margin-bottom: 20px;
  padding-bottom: 0;
  color: #555;
}
.title-team p {
  color: #777;
  margin-bottom: 0;
}
.dois {
  background-color: #fff;
  color: grey !important;
  height: 45px;
}
.dois:hover {
  background-color: rgba(106, 170, 167, 0.9);
  color: #fff !important;
}
.v-btn--contained {
  box-shadow: none;
}
.v-btn {
  margin: 10px;
}
.title-contact {
  text-align: center;
  padding-bottom: 30px;
  font-family: 'Open Sans', sans-serif;
  color: rgb(119, 119, 119);
}
.title-contact h2 {
  font-size: 32px;
  font-weight: 300;
  margin-bottom: 20px;
  padding-bottom: 0;
  color: #555;
}
.title-contact p {
  margin-top: 0px;
  margin-bottom: 0px;
  font-family: 'Open Sans', sans-serif;
  color: rgb(119, 119, 119);
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  text-align: center;
}
.contact-info {
  color: black;
  background-color: #f2f9f8 !important;
  padding: 60px 0px;
}
.about h3 {
  font-size: 36px;
  line-height: 1;
  font-weight: 500;
  letter-spacing: 1px;
  color: rgb(112, 185, 176);
  margin: 0px 0px 10px;
  padding: 0px;
  font-family: Lato, sans-serif;
}
.about p {
  font-size: 14px;
  line-height: 24px;
  font-family: Lato, sans-serif;
  color: rgb(136, 136, 136);
  margin-top: 0px;
  margin-bottom: 1rem;
  text-align: left;
}
.social-icons {
  font-size: 18px !important;
  display: inline-block !important;
  background: #fff !important;
  color: #70b9b0 !important;
  line-height: 1 !important;
  padding: 8px 0 !important;
  margin-right: 4px !important;
  border-radius: 50% !important;
  text-align: center !important;
  width: 36px !important;
  height: 36px !important;
  transition: 0.3s !important;
  border: 1px solid #70b9b0 !important;
}
.social-media {
  padding-bottom: 20px !important;
}
.social-icons:hover {
  color: #ffff !important;
  background-color: #70b9b0 !important;
}
.row {
  margin: 0px;
}
.v-application .font-weight-light {
  font-weight: 300 !important;
  font-size: 1.3em;
}
</style>
