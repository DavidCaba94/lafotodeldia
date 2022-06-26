<template>
  <div v-if="!userLogged">
    <Unauthorized />
  </div>
  <div v-if="showImage">
    <DetailImage
    :imageData="selectedShowImage"
    @closeFullImage="closeFullImage" />
  </div>
  <div v-if="showUpload">
    <UploadImage @closeUploadImage="closeUploadImage" />
  </div>
  <div v-if="showUploadProfile">
    <UploadProfileImage @closeUploadProfileImage="closeUploadProfileImage" />
  </div>
  <div class="user" v-if="userLogged">
    <div id="img-perfil" class="img-perfil" v-bind:style="{ backgroundImage: 'url(' + foto + ')' }">
      <div class="edit-img-perfil" @click="showUploadProfileImage()">
        <img src="../assets/img/edit.png">
      </div>
    </div>
    <div class="user-name">
      <img src="../assets/img/verified.png" v-if="verified">
      @{{ username }}
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
    <div class="new-image" @click="showUploadImage()">
      <img src="../assets/img/photo-light.png" alt="">
      <p>SUBIR IMAGEN</p>
    </div>
    <div class="fotos-box">
      <div
        v-for="image of imagesArray"
        :key="image.id"
        class="foto-item"
        @click="showFullImage(image)"
        v-bind:style="{ backgroundImage: 'url(' + image.url + ')' }"></div>
      <p v-if="imagesArray.length === 0">No has publicado ninguna foto todavía</p>
    </div>
    <router-link :to="'/user-gallery/' + idUser">
      <div class="ver-mas">
        <p>Ver todas las fotos</p>
        <img src="../assets/img/arrow.png">
      </div>
    </router-link>
    <div class="verify-box" v-if="!verified">
      <p>Verifica tu cuenta mediante un email</p>
      <div class="verify-btn" @click="verificarCuenta()">VERIFICAR</div>
    </div>
    <div class="pass-box">
      <p class="titulo-pass">CAMBIAR CONTRASEÑA</p>
      <div class="input-box">
        <input type="password" placeholder="Contraseña antigua" v-model="oldPass">
        <input type="password" placeholder="Nueva contraseña" v-model="newPass">
      </div>
      <p id="error-log" class="error-log" v-if="errorLog">{{errorLog}}</p>
      <p id="success-log" class="success-log" v-if="successLog">{{successLog}}</p>
      <div class="btn-confirmar" @click="changePass()">CONFIRMAR</div>
    </div>
    <div class="cerrar-sesion" @click="cerrarSesion()">CERRAR SESION</div>
  </div>
</template>

<script>
import Unauthorized from '../components/Unauthorized.vue';
import DetailImage from '../components/DetailImage.vue';
import UploadImage from '../components/UploadImage.vue';
import UploadProfileImage from '../components/UploadProfileImage.vue';
import imageService from '../services/imageService.js';
import md5 from 'md5';
import userService from '../services/userService.js';
import homeService from '../services/homeService.js';

export default {
  data() {
    return {
      idUser: this.$store.state.login.id,
      username: '',
      pass: '',
      foto: '',
      verified: false,
      oldPass: '',
      newPass: '',
      showImage: false,
      showUpload: false,
      showUploadProfile: false,
      errorLog: null,
      successLog: null,
      imagesArray: [],
      selectedShowImage: {},
      numFollowed: 0,
      numFollowers: 0,
      photosOfDay: 0,
      photosOfMonth: 0,
      photosOfYear: 0
    }
  },
  components: {
    Unauthorized,
    DetailImage,
    UploadImage,
    UploadProfileImage
  },
  created() {
    this.getAllUserImages();
  },
  computed: {
    userLogged() {
      var isLogged = false;
      if (this.$store.state.login.user !== '' && this.$store.state.login.pass !== '') {
        this.cargarDatosUser();
        isLogged = true;
      } else {
        isLogged = false;
      }

      return isLogged;
    }
  },
  methods: {
    cerrarSesion() {
      localStorage.removeItem('user');
      this.$store.commit('closeSession');
      this.$router.push('/');
    },
    async cargarDatosUser() {
      let u = await userService.getUserById(this.$store.state.login.id);
      this.username = u.user;
      this.pass = u.pass;
      this.foto = u.foto;
      this.verified = u.verificado === '1' ? true : false;
      this.getnumFollowers();
      this.getPhotosOfDay();
      this.getPhotosOfMonth();
      this.getPhotosOfYear();
    },
    async changePass() {
      this.errorLog = null;
      this.successLog = null;
      if (md5(this.oldPass) === this.pass) {
        let updateSuccess = await userService.updatePassUsuario(this.$store.state.login.id, this.newPass);
        if (updateSuccess) {
          this.pass = md5(this.newPass);
          this.$store.state.login.pass = md5(this.newPass);
          localStorage.setItem(localStorage.getItem('user').pass, md5(this.newPass));
          this.oldPass = '';
          this.newPass = '';
          this.successLog = 'Contraseña cambiada correctamente';
        } else {
          this.errorLog = 'Error al cambiar la contraseña';
        }
      } else {
        this.errorLog = 'Contraseña antigua incorrecta';
      }
      console.log(md5(this.oldPass) + ' - ' + this.pass);
    },
    async getnumFollowers() {
      this.numFollowed = await homeService.getNumFollowedUsers(this.$store.state.login.id);
      this.numFollowers = await homeService.getNumFollowersUsers(this.$store.state.login.id);
    },
    async getAllUserImages() {
      this.imagesArray = await imageService.getFirstNineImagesByUser(this.$store.state.login.id);
    },
    async getPhotosOfDay() {
      this.photosOfDay = await userService.getPhotosOfDay(this.$store.state.login.id);
    },
    async getPhotosOfMonth() {
      this.photosOfMonth = await userService.getPhotosOfMonth(this.$store.state.login.id);
    },
    async getPhotosOfYear() {
      this.photosOfYear = await userService.getPhotosOfYear(this.$store.state.login.id);
    },
    verificarCuenta() {
      // verificar cuenta
    },
    showUploadImage() {
      this.showUpload = true;
    },
    closeUploadImage() {
      this.showUpload = false;
      this.getAllUserImages();
    },
    showUploadProfileImage() {
      this.showUploadProfile = true;
    },
    closeUploadProfileImage() {
      this.showUploadProfile = false;
      this.foto = JSON.parse(localStorage.getItem('user')).foto;
    },
    showFullImage(image) {
      this.selectedShowImage.urlImage = image.url;
      this.selectedShowImage.likesImage = image.likes;
      this.selectedShowImage.userName = this.username;
      this.selectedShowImage.urlProfile = this.foto;
      this.selectedShowImage.userId = this.$store.state.login.id;
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

.cerrar-sesion {
  max-width: 150px;
  margin: 0 auto;
  margin-bottom: 20px;
  background-color: #ff5e5e;
  color: #ffffff;
  border-radius: 5px;
  padding: 5px;
  cursor: pointer;
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

.edit-img-perfil {
  position: absolute;
  width: 50px;
  height: 50px;
  margin-top: 150px;
  margin-left: 150px;
  background-color: #ffffff;
  border: 1px solid #cfcfcf;
  border-radius: 50px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  cursor: pointer;
}

.edit-img-perfil img {
  width: 30px;
  margin-top: 10px;
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

.pass-box {
  width: 95%;
  max-width: 600px;
  margin: 0 auto;
  padding: 10px;
  background-color: #ffffff;
  border-radius: 5px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  margin-bottom: 20px;
}

.titulo-pass {
  font-weight: 700;
}

.input-box {
    padding: 10px;
    max-width: 400px;
    margin: 0 auto;
}

.input-box input {
    width: 95%;
    max-width: 220px;
    margin-bottom: 10px;
    border: 0px;
    border-bottom: 1px solid;
    padding: 10px;
    font-family: 'Roboto', sans-serif;
}

.input-box input:focus-visible {
    outline: 0px;
}

.btn-confirmar {
    max-width: 150px;
    margin: 0 auto;
    margin-bottom: 20px;
    background-color: #000000;
    color: #ffffff;
    border-radius: 5px;
    padding: 5px;
    cursor: pointer;
}

.error-log {
    font-size: 12px;
    color: #ff6d6d;
    font-weight: 300;
    margin-top: -10px;
}

.success-log {
    font-size: 12px;
    color: #00a315;
    font-weight: 300;
    margin-top: -10px;
}

.new-image {
    display: flex;
    align-items: center;
    justify-content: space-around;
    flex-wrap: nowrap;
    max-width: 150px;
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

.new-image img {
    width: 30px;
}

.new-image p {
    margin: 0;
}

.verify-box {
  max-width: 400px;
  margin: 0 auto;
  background-color: #74c4f1;
  border-radius: 5px;
  padding: 10px;
  margin-bottom: 20px;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
}

.verify-box p {
  margin: 0;
}

.verify-btn {
  background-color: #3ea1da;
  padding: 5px;
  border-radius: 5px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  cursor: pointer;
  margin-left: 10px;
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