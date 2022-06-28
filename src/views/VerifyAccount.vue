<template>
  <div class="verify-account">
    <div v-if="initialScreen">
      <p>Hola @{{ username }}</p>
      <p>Pulsa el siguiente botón para terminar la verificación de tu cuenta</p>
      <div class="verification-button" @click="updateVerificationUser()">Verificar</div>
    </div>
    <div class="lds-ellipsis" v-if="loading"><div></div><div></div><div></div><div></div></div>
    <div v-if="successScreen">
      <img src="../assets/img/verified.png">
      <p>Enhorabuena, ya estás verificado</p>
      <router-link to="/">
        <div class="verification-button">Volver</div>
      </router-link>
    </div>
    <div v-if="errorScreen">
      <img src="../assets/img/like-down.png">
      <p>Algo no ha salido bien, intentalo de nuevo más tarde</p>
      <router-link to="/">
        <div class="verification-button">Volver</div>
      </router-link>
    </div>
  </div>
</template>

<script>
import userService from '../services/userService.js';

export default {
  name: 'VerifyAccount',
  data() {
    return {
      code: this.$route.params.code,
      username: '',
      loading: false,
      initialScreen: true,
      successScreen: false,
      errorScreen: false
    }
  },
  mounted() {
    this.checkUsername();
  },
  methods: {
    async checkUsername() {
      let user = await userService.getUserByIdNoPass(this.code.split('::')[0]);
      this.username = user.user;
    },
    async updateVerificationUser() {
      this.initialScreen = false;
      this.loading = true;
      let success = await userService.updateVerificadoUsuario(this.code.split('::')[0]);
      if (success) {
        this.loading = false;
        this.successScreen = true;
      } else {
        this.loading = false;
        this.errorScreen = true;
      }
    }
  }
}
</script>

<style scoped>
.verify-account {
  padding: 10px;
  padding-top: 170px;
  padding-bottom: 90px;
}

.verify-account p {
  font-weight: 700;
}

.verification-button {
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
  max-width: 90px;
  margin: 0 auto;
  margin-bottom: 20px;
  background-color: #74c4f1;
  color: #ffffff;
  border-radius: 5px;
  padding: 5px;
  cursor: pointer;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
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
}
.lds-ellipsis div {
  position: absolute;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: rgb(0, 0, 0);
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