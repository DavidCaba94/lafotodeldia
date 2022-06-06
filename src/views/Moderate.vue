<template>
  <div v-if="!userLogged">
    <Unauthorized />
  </div>
  <div class="moderate" v-if="userLogged && nextImage !== null  && !loading">
    <p class="moderate-text">Tú decides con tu voto si esta imagen merece ser La Foto del Día</p>
    <div class="items-container">
      <div class="moderate-item">
        <div class="img-container">
            <img :src="urlImage">
        </div>
        <router-link :to="'/user-detail/' + idUser">
          <div class="username-container">
            <img src="../assets/img/verified.png" v-if="verified">
            @{{ username }}
          </div>
        </router-link>
      </div>
    </div>
    <div class="vote-container">
      <div class="vote-button" @click="votar('OK')">
        <img src="../assets/img/like-up.png">
      </div>
      <div class="vote-button" @click="votar('KO')">
        <img src="../assets/img/like-down.png">
      </div>
    </div>
  </div>
  <div class="moderate" v-if="userLogged && nextImage === null && !loading">
    <img class="img-no-photos" src="../assets/img/photos-icon.png">
    <p class="moderate-text">No hay más fotos para moderar hoy</p>
  </div>
  <div class="lds-ellipsis" v-if="loading"><div></div><div></div><div></div><div></div></div>
  <!-- SNACKBAR -->
  <div id="snackbar-ok">
    <img src="../assets/img/like-up.png">
  </div>
  <div id="snackbar-ko">
    <img src="../assets/img/like-down.png">
  </div>
</template>

<script>
import Unauthorized from '../components/Unauthorized.vue';
import imageService from '../services/imageService.js';

export default {
  data() {
    return {
      idFoto: 0,
      urlImage: '',
      date: '',
      username: '',
      idUser: 0,
      verified: false,
      imagesArray: [],
      nextImage: null,
      loading: true
    }
  },
  components: {
    Unauthorized
  },
  computed: {
    userLogged() {
      var isLogged = false;
      if (this.$store.state.login.user !== '' && this.$store.state.login.pass !== '') {
        isLogged = true;
      } else {
        isLogged = false;
      }

      return isLogged;
    }
  },
  mounted() {
    this.getLastImageVoted();
  },
  methods: {
    async getLastImageVoted() {
      this.loading = true;
      var idLastImageVoted = await imageService.getLastImageVotedByUser(this.$store.state.login.id);
      this.getNextImage(idLastImageVoted);
    },
    async getNextImage(idLastImageVoted) {
      this.nextImage = await imageService.getNextImageToVote(idLastImageVoted);
      if(this.nextImage !== null) {
        this.idFoto = this.nextImage.id;
        this.urlImage = this.nextImage.url;
        this.date = this.nextImage.date;
        this.username = this.nextImage.user;
        this.verified = this.nextImage.verificado;
        this.idUser = this.nextImage.id_user;
        this.loading = false;
      } else {
        this.loading = false;
      }
    },
    async votar(voto) {
      if (voto === 'OK') {
        this.showOKNotification();
        await this.updateImageVoted();
      } else if (voto === 'KO') {
        this.showKONotification();
      }
      await this.setLastImageVoted();
      this.getLastImageVoted();
    },
    async setLastImageVoted() {
      await imageService.updateLastImageVotedByUser(this.$store.state.login.id, this.idFoto);
    },
    async updateImageVoted() {
      await imageService.updateImageVoted(this.idFoto);
    },
    showOKNotification() {
      var x = document.getElementById("snackbar-ok");
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 1000);
    },
    showKONotification() {
      var x = document.getElementById("snackbar-ko");
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 1000);
    }
  }
}
</script>

<style scoped>
a {
  font-weight: 300;
  color: #000000;
  text-decoration: none;
}

a.router-link-exact-active {
  background-color: #f0f0f0;
  border-radius: 5px;
}

.moderate {
  padding: 10px;
  padding-top: 70px;
  padding-bottom: 90px;
}

.items-container {
  max-width: 1000px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  margin: 0 auto;
}

.vote-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
}

.vote-button {
  width: 40px;
  height: 40px;
  padding: 10px;
  background-color: #ffffff;
  border-radius: 50px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  margin: 30px;
  cursor: pointer;
}

.vote-button img {
  width: 30px;
  margin-top: 5px;
}

.moderate-item {
  width: 90%;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  cursor: pointer;
  margin: 5px;
  border-radius: 5px;
}

.img-container img {
  width: 95%;
  border-radius: 5px;
  margin-top: 10px;
}

.username-container {
  font-size: 14px;
  font-weight: 700;
  margin-top: 10px;
  margin-bottom: 10px;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
  cursor: pointer;
}

.username-container img {
  width: 20px;
  margin-right: 5px;
}

.date-container {
  font-weight: 300;
  font-size: 18px;
  margin-top: 10px;
  margin-bottom: 10px;
  text-align: center;
}

.img-no-photos {
  width: 150px;
  opacity: 0.3;
  margin-top: 100px;
}

@media (min-width: 768px) {
  .moderate-text {
    margin-top: 40px;
    margin-bottom: 40px;
  }

  .img-container img {
    margin-top: 20px;
  }
}

/* LOADER */
.lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 20px;
  margin-top: 120px;
}
.lds-ellipsis div {
  position: absolute;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #000000;
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
  left: 8px;
  animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
  left: 8px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
  left: 32px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
  left: 56px;
  animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
  0% {
      transform: scale(0);
  }
  100% {
      transform: scale(1);
  }
}
@keyframes lds-ellipsis3 {
  0% {
      transform: scale(1);
  }
  100% {
      transform: scale(0);
  }
}
@keyframes lds-ellipsis2 {
  0% {
      transform: translate(0, 0);
  }
  100% {
      transform: translate(24px, 0);
  }
}

#snackbar-ok {
  visibility: hidden;
  position: fixed;
  z-index: 1;
  left: calc(50% - 25px);
  top: 80px;
}

#snackbar-ok img {
  width: 50px;
}

#snackbar-ko {
  visibility: hidden;
  position: fixed;
  z-index: 1;
  left: calc(50% - 25px);
  top: 80px;
}

#snackbar-ko img {
  width: 50px;
}

#snackbar-ok.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

#snackbar-ko.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {top: 0; opacity: 0;}
  to {top: 80px; opacity: 1;}
}

@keyframes fadein {
  from {top: 0; opacity: 0;}
  to {top: 80px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {top: 80px; opacity: 1;}
  to {top: 0; opacity: 0;}
}

@keyframes fadeout {
  from {top: 80px; opacity: 1;}
  to {top: 0; opacity: 0;}
}
</style>