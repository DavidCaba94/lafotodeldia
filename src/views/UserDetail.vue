<template>
  <div v-if="showImage">
    <DetailImage
    :imageData="selectedShowImage"
    @closeFullImage="closeFullImage" />
  </div>
  <div class="user">
    <div id="img-perfil" class="img-perfil" v-bind:style="{ backgroundImage: 'url(' + foto + ')' }"></div>
    <div class="user-name">
      <img src="../assets/img/verified.png" v-if="verified">
      @{{ username }}
    </div>
    <div class="btn-follow" v-if="!following" @click="followUser()">
      <img src="../assets/img/follow.png" alt="">
      <p>Seguir</p>
    </div>
    <div class="btn-unfollow" v-if="following" @click="unfollowUser()">
      <img src="../assets/img/unfollow.png" alt="">
      <p>Dejar de seguir</p>
    </div>
    <div class="followers-container">
      <div class="followers-item">
        <p>Seguidores</p>
        <div>{{ numFollowers }}</div>
      </div>
      <div class="followers-item">
        <p>Seguidos</p>
        <div>{{ numFollowed }}</div>
      </div>
    </div>
    <router-link :to="'/prizes-gallery/' + idUser">
      <div class="prizes-box">
        <div class="prize-item">
          <p class="titulo-premio">Foto del día</p>
          <img src="../assets/img/prize-day.png" class="prize-image">
          <p class="num-premios">{{ photosOfDay }}</p>
        </div>
        <div class="prize-item">
          <p class="titulo-premio">Foto del mes</p>
          <img src="../assets/img/prize-month.png" class="prize-image">
          <p class="num-premios">{{ photosOfMonth }}</p>
        </div>
        <div class="prize-item">
          <p class="titulo-premio">Foto del año</p>
          <img src="../assets/img/prize-year.png" class="prize-image">
          <p class="num-premios">{{ photosOfYear }}</p>
        </div>
      </div>
    </router-link>
    <div class="fotos-box">
      <div
        v-for="image of imagesArray"
        :key="image.id"
        class="foto-item"
        @click="showFullImage(image)"
        v-bind:style="{ backgroundImage: 'url(' + image.url + ')' }"></div>
      <p v-if="imagesArray.length === 0">No ha publicado ninguna foto todavía</p>
    </div>
    <router-link :to="'/user-gallery/' + idUser">
      <div class="ver-mas">
        <p>Ver todas las fotos</p>
        <img src="../assets/img/arrow.png">
      </div>
    </router-link>
  </div>
</template>

<script>
import DetailImage from '../components/DetailImage.vue';
import imageService from '../services/imageService.js';
import userService from '../services/userService.js';
import homeService from '../services/homeService.js';

export default {
  data() {
    return {
      idUser: this.$route.params.id,
      username: '',
      foto: '',
      verified: false,
      showImage: false,
      errorLog: null,
      imagesArray: [],
      selectedShowImage: {},
      following: false,
      numFollowed: 0,
      numFollowers: 0,
      photosOfDay: 0,
      photosOfMonth: 0,
      photosOfYear: 0
    }
  },
  components: {
    DetailImage
  },
  mounted() {
    if (this.$route.params.id === this.$store.state.login.id) {
      this.$router.push('/user');
    }
    this.cargarDatosUser(this.$route.params.id);
    this.getIsFollowing();
    this.getnumFollowers();
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
  methods: {
    async cargarDatosUser(idUser) {
      let u = await userService.getUserByIdNoPass(idUser);
      this.username = u.user;
      this.foto = u.foto;
      this.verified = u.verificado === '1' ? true : false;
      this.getAllUserImages(idUser);
      this.getPhotosOfDay();
      this.getPhotosOfMonth();
      this.getPhotosOfYear();
    },
    async getAllUserImages(idUser) {
      this.imagesArray = await imageService.getFirstNineImagesByUser(idUser);
    },
    async getIsFollowing() {
      let followList = await userService.getIsFollowing(this.$store.state.login.id, this.idUser);
      if (followList.length > 0) {
        this.following = true;
      } else {
        this.following = false;
      }
    },
    async followUser() {
      if (this.$store.state.login.id === 0) {
        this.$router.push('/login');
      } else {
        await userService.saveNewFollower(this.$store.state.login.id, this.idUser);
        this.getIsFollowing();
        this.getnumFollowers();
      }
    },
    async unfollowUser() {
      await userService.deleteFollowing(this.$store.state.login.id, this.idUser);
      this.getIsFollowing();
      this.getnumFollowers();
    },
    async getnumFollowers() {
      this.numFollowed = await homeService.getNumFollowedUsers(this.idUser);
      this.numFollowers = await homeService.getNumFollowersUsers(this.idUser);
    },
    async getPhotosOfDay() {
      this.photosOfDay = await userService.getPhotosOfDay(this.idUser);
    },
    async getPhotosOfMonth() {
      this.photosOfMonth = await userService.getPhotosOfMonth(this.idUser);
    },
    async getPhotosOfYear() {
      this.photosOfYear = await userService.getPhotosOfYear(this.idUser);
    },
    showFullImage(image) {
      this.selectedShowImage.urlImage = image.url;
      this.selectedShowImage.likesImage = image.likes;
      this.selectedShowImage.userName = this.username;
      this.selectedShowImage.urlProfile = this.foto;
      this.selectedShowImage.userId = this.$route.params.id;
      this.showImage = true;
    },
    closeFullImage() {
      this.showImage = false;
    }
  }
}
</script>

<style scoped>
.user {
  padding: 10px;
  padding-top: 70px;
  padding-bottom: 90px;
}

.img-perfil {
  width: 200px;
  height: 200px;
  background-image: url('https://c.pxhere.com/photos/1d/87/adult_blur_camera_canon_capture_dslr_dslr_camera_fashion-1549227.jpg!d');
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  border-radius: 100px;
  margin: 0 auto;
  margin-top: 20px;
  margin-bottom: 10px;
}

.user-name {
  font-weight: 700;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
}

.user-name img {
  width: 20px;
  margin-right: 5px;
}

.prizes-box {
  width: 95%;
  max-width: 600px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
  padding: 10px;
  background-color: #ffffff;
  border-radius: 5px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  margin-bottom: 20px;
}

.prize-image {
  width: 50px;
}

.titulo-premio {
  font-size: 12px;
}

.num-premios {
  font-size: 20px;
  font-weight: 700;
  margin: 0;
  margin-bottom: 10px;
}

.fotos-box {
  width: 95%;
  max-width: 600px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: wrap;
  padding: 10px;
  background-color: #ffffff;
  border-radius: 5px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  margin-bottom: 10px;
}

.foto-item {
  width: 30%;
  height: 100px;
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  border-radius: 5px;
  margin: 5px;
  cursor: pointer;
}

.ver-mas {
  width: 95%;
  max-width: 600px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  flex-wrap: nowrap;
  margin-bottom: 20px;
  cursor: pointer;
}

.ver-mas img {
  width: 20px;
}

.ver-mas p {
  margin: 0;
}

.error-log {
  font-size: 12px;
  color: #ff6d6d;
  font-weight: 300;
  margin-top: -10px;
}

.btn-follow {
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
  max-width: 90px;
  margin: 0 auto;
  margin-bottom: 20px;
  background-color: #1fbd54;
  color: #ffffff;
  border-radius: 5px;
  padding: 5px;
  cursor: pointer;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.btn-follow img {
  width: 30px;
}

.btn-follow p {
  margin: 0;
}

.btn-unfollow {
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
  max-width: 150px;
  margin: 0 auto;
  margin-bottom: 20px;
  background-color: #ff6d6d;
  color: #ffffff;
  border-radius: 5px;
  padding: 5px;
  cursor: pointer;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.btn-unfollow img {
  width: 30px;
}

.btn-unfollow p {
  margin: 0;
}

.followers-container {
  max-width: 300px;
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
  margin: 0 auto;
  margin-bottom: 20px;
}

.followers-item p {
  margin-top: 0px;
  margin-bottom: 0px;
}

.followers-item div {
  width: fit-content;
  margin: 0 auto;
  border: 1px solid #3ea1da;
  color: #3ea1da;
  border-radius: 2px;
  margin-top: 5px;
  padding: 2px 7px;
}

a {
  font-weight: 300;
  color: #000000;
  text-decoration: none;
}

a.router-link-exact-active {
  background-color: #f0f0f0;
  border-radius: 5px;
}
</style>