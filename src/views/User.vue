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
        <p>Fotos</p>
        <div>{{ numFotos }}</div>
      </div>
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
      <div class="verify-btn" v-if="!sendingEmail" @click="verificarCuenta()">VERIFICAR</div>
      <div>
        <div class="lds-ellipsis" v-if="sendingEmail"><div></div><div></div><div></div><div></div></div>
      </div>
    </div>
    <div class="advertise-email-sent" v-if="successEmailSend === true">
      Se ha enviado el correo de verificación. Revisa tu carpeta de SPAM si no lo encuentras.
    </div>
    <div class="advertise-email-error" v-if="successEmailSend === false">
      Ha ocurrido un error al enviar el correo de verificación, intentalo de nuevo en unos minutos.
    </div>
    <div class="pass-box">
      <p class="titulo-pass">
        <img src="../assets/img/instagram.png">
        INSTAGRAM
      </p>
      <div class="input-box">
        @<input type="text" v-model="instagram">
      </div>
      <p id="error-log" class="error-log" v-if="instagramErrorLog">{{instagramErrorLog}}</p>
      <p id="success-log" class="success-log" v-if="instagramSuccessLog">{{instagramSuccessLog}}</p>
      <div class="btn-confirmar" @click="changeInstagram()">CONFIRMAR</div>
    </div>
    <div class="app-box">
      <p class="titulo-pass">DESCARGA LA APP</p>
      <p>Ya está disponible la app para todos los dispositivos</p>
      <div class="download-icons">
        <img src="../assets/img/android.png">
        <img src="../assets/img/apple.png">
        <img src="../assets/img/windows.png">
        <img src="../assets/img/linux.png">
      </div>
      <p class="error-app" v-if="showAppInstalled">Ya tienes la app instalada en este dispositivo</p>
      <div class="btn-downlad" @click="downloadApp()">DESCARGAR</div>
    </div>
    <div class="pass-box">
      <p class="titulo-pass">CAMBIAR EMAIL</p>
      <div class="input-box">
        <input type="email" v-model="email">
      </div>
      <p id="error-log" class="error-log" v-if="emailErrorLog">{{emailErrorLog}}</p>
      <p id="success-log" class="success-log" v-if="emailSuccessLog">{{emailSuccessLog}}</p>
      <div class="btn-confirmar" @click="changeEmail()">CONFIRMAR</div>
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
      email: '',
      username: '',
      pass: '',
      foto: '',
      verified: false,
      oldPass: '',
      newPass: '',
      instagram: '',
      showImage: false,
      showUpload: false,
      showUploadProfile: false,
      errorLog: null,
      successLog: null,
      emailErrorLog: null,
      emailSuccessLog: null,
      instagramErrorLog: null,
      instagramSuccessLog: null,
      imagesArray: [],
      selectedShowImage: {},
      numFotos: 0,
      numFollowed: 0,
      numFollowers: 0,
      photosOfDay: 0,
      photosOfMonth: 0,
      photosOfYear: 0,
      sendingEmail: false,
      successEmailSend: null,
      deferredPrompt: null,
      showAppInstalled: false
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
    window.addEventListener("beforeinstallprompt", e => {
      e.preventDefault();
      this.deferredPrompt = e;
    });
    window.addEventListener("appinstalled", () => {
      this.deferredPrompt = null;
    });
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
      this.email = u.email;
      this.foto = u.foto;
      this.verified = u.verificado === '1' ? true : false;
      this.instagram = u.instagram !== null ? u.instagram : '';
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
    },
    async changeEmail() {
      this.emailErrorLog = null;
      this.emailSuccessLog = null;
      let updateSuccess = await userService.updateEmailUsuario(this.$store.state.login.id, this.email);
      if (updateSuccess) {
        this.$store.state.login.email = this.email;
        localStorage.setItem(localStorage.getItem('user').email, this.email);
        this.emailSuccessLog = 'Email actualizado';
      } else {
        this.emailErrorLog = 'Error al actualizar el email';
      }
    },
    async changeInstagram() {
      this.instagramErrorLog = null;
      this.instagramSuccessLog = null;
      let updateSuccess = await userService.updateInstagramUsuario(this.$store.state.login.id, this.instagram);
      if (updateSuccess) {
        this.instagramSuccessLog = 'Instagram actualizado';
      } else {
        this.instagramErrorLog = 'Error al actualizar el instagram';
      }
    },
    async getnumFollowers() {
      this.numFotos = await homeService.getNumFotosByUser(this.$store.state.login.id);
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
    async verificarCuenta() {
      this.successEmailSend = null;
      this.sendingEmail = true;
      this.successEmailSend = await userService.sendVerificationEmail(this.$store.state.login.email, this.$store.state.login.id + '::' + this.generateRandomCode(), this.$store.state.login.user);
      this.sendingEmail = false;
    },
    generateRandomCode() {
      return Math.floor(Math.round(Math.random() * 1000000000000000));
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
    },
    downloadApp() {
      if (this.deferredPrompt !== null) {
        this.deferredPrompt.prompt();
      } else {
        this.showAppInstalled = true;
      }
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

.app-box {
  width: 95%;
  max-width: 600px;
  margin: 0 auto;
  padding: 10px;
  background-color: #ffffff;
  border-radius: 5px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  margin-bottom: 20px;
  color: #000000;
}

.download-icons img {
  width: 50px;
}

.titulo-pass {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
  font-weight: 700;
}

.titulo-pass img {
  width: 25px;
  margin-right: 5px;
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

.btn-downlad {
  max-width: 150px;
  margin: 0 auto;
  margin-bottom: 20px;
  margin-top: 20px;
  background-color: #00a315;
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

.error-app {
  font-size: 12px;
  color: #000000;
  font-weight: 300;
  margin-top: 10px;
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
  justify-content: space-between;
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

.advertise-email-sent {
  max-width: 400px;
  margin: 0 auto;
  background-color: #1fbd54;
  border-radius: 5px;
  padding: 10px;
  margin-bottom: 20px;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
}

.advertise-email-error {
  max-width: 400px;
  margin: 0 auto;
  background-color: #ff6d6d;
  border-radius: 5px;
  padding: 10px;
  margin-bottom: 20px;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
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


/* LOADER */
.lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 20px;
  margin-top: 10px;
}
.lds-ellipsis div {
  position: absolute;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #ffffff;
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
</style>