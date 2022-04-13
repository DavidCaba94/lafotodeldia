<template>
  <div v-if="!userLogged">
    <Unauthorized />
  </div>
  <div v-if="showImage">
    <DetailImage @closeFullImage="closeFullImage" />
  </div>
  <div class="user" v-if="userLogged">
    <div class="img-perfil"></div>
    <div class="user-name">{{ username }}</div>
    <div class="prizes-box">
      <div class="prize-item">
        <p class="titulo-premio">Foto del día</p>
        <img src="../assets/img/prize-day.png" class="prize-image">
        <p class="num-premios">0</p>
      </div>
      <div class="prize-item">
        <p class="titulo-premio">Foto del mes</p>
        <img src="../assets/img/prize-month.png" class="prize-image">
        <p class="num-premios">0</p>
      </div>
      <div class="prize-item">
        <p class="titulo-premio">Foto del año</p>
        <img src="../assets/img/prize-year.png" class="prize-image">
        <p class="num-premios">0</p>
      </div>
    </div>
    <div class="fotos-box">
      <img class="foto-item" @click="showFullImage()" src="https://neliosoftware.com/es/wp-content/uploads/sites/3/2018/07/aziz-acharki-549137-unsplash-1200x775.jpg">
      <img class="foto-item" @click="showFullImage()" src="https://c.pxhere.com/photos/1d/87/adult_blur_camera_canon_capture_dslr_dslr_camera_fashion-1549227.jpg!d">
      <img class="foto-item" @click="showFullImage()" src="https://images.unsplash.com/photo-1574217013471-c32c6846cef7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80">
      <img class="foto-item" @click="showFullImage()" src="https://images.unsplash.com/photo-1606946887361-78feb162a525?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80">
      <img class="foto-item" @click="showFullImage()" src="https://neliosoftware.com/es/wp-content/uploads/sites/3/2018/07/aziz-acharki-549137-unsplash-1200x775.jpg">
      <img class="foto-item" @click="showFullImage()" src="https://c.pxhere.com/photos/1d/87/adult_blur_camera_canon_capture_dslr_dslr_camera_fashion-1549227.jpg!d">
      <img class="foto-item" @click="showFullImage()" src="https://images.unsplash.com/photo-1574217013471-c32c6846cef7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80">
      <img class="foto-item" @click="showFullImage()" src="https://images.unsplash.com/photo-1606946887361-78feb162a525?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80">
      <img class="foto-item" @click="showFullImage()" src="https://neliosoftware.com/es/wp-content/uploads/sites/3/2018/07/aziz-acharki-549137-unsplash-1200x775.jpg">
    </div>
    <div class="ver-mas">
      <p>Ver todas las fotos</p>
      <img src="../assets/img/arrow.png">
    </div>
    <div class="pass-box">
      <p class="titulo-pass">CAMBIAR CONTRASEÑA</p>
      <div class="input-box">
        <input type="password" placeholder="Contraseña antigua" v-model="oldPass">
        <input type="password" placeholder="Nueva contraseña" v-model="newPass">
      </div>
      <p id="error-log" class="error-log" v-if="errorLog">{{errorLog}}</p>
      <div class="btn-confirmar" @click="changePass()">CONFIRMAR</div>
    </div>
    <div class="cerrar-sesion" @click="cerrarSesion()">CERRAR SESION</div>
  </div>
</template>

<script>
import Unauthorized from '../components/Unauthorized.vue';
import DetailImage from '../components/DetailImage.vue';

export default {
  data() {
    return {
      username: '',
      pass: '',
      oldPass: '',
      newPass: '',
      showImage: false,
      errorLog: null
    }
  },
  components: {
    Unauthorized,
    DetailImage
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
    cargarDatosUser() {
      this.username = this.$store.state.login.user;
      this.pass = this.$store.state.login.pass;
    },
    changePass() {
      this.errorLog = null;
      if (this.oldPass === this.pass) {
        // cambio de contraseña
      } else {
        this.errorLog = 'Contraseña antigua incorrecta';
      }
    },
    showFullImage() {
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

.user-name {
  font-weight: 700;
  margin-bottom: 20px;
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
</style>