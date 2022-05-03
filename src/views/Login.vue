<template>
  <div class="login">
    <div class="login-box">
      <p class="titulo-login">Log In</p>
      <p class="subtitulo-login">Entra para tener acceso a todas las funcionalidades</p>
      <div class="input-box">
        <input type="text" placeholder="Usuario" v-model="loginForm.user">
        <input type="password" placeholder="Contraseña" v-model="loginForm.pass">
      </div>
      <p id="error-log" class="error-log" v-if="errorLog">{{errorLog}}</p>
      <div class="btn-login" @click="login()" v-if="!loading">ENTRAR</div>
      <div class="lds-ellipsis" v-if="loading"><div></div><div></div><div></div><div></div></div>
      <p class="texto-registro">Si no tienes cuenta puedes registrarte <router-link to="/registro">aquí</router-link></p>
    </div>
  </div>
</template>

<script>
import userService from '../services/userService.js';

export default {
  name: 'Login',
  data() {
    return {
      loginForm: {
        user: '',
        pass: ''
      },
      errorLog: null,
      loading: false
    }
  },
  created() {
    this.errorLog = null;
    this.loading = false;
  },
  methods: {
    async login() {
      this.errorLog = null;
      this.loading = true;
      let finalUser = await userService.getUserByLogin(this.loginForm);
      if (finalUser) {
        this.$store.commit('login', finalUser);
        localStorage.setItem('user', JSON.stringify(finalUser));
        this.$router.push('/');
      } else {
        this.errorLog = 'Usuario o contraseña incorrectos';
      }
      this.loading = false;
    }
  }
}
</script>

<style scoped>
.login{
  padding: 10px;
  padding-top: 70px;
  padding-bottom: 90px;
}

.login-box {
  width: 95%;
  max-width: 450px;
  margin: 0 auto;
  margin-top: 50px;
  border-radius: 10px;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  padding: 10px;
}

.login-box .titulo-login {
    font-size: 30px;
    font-weight: 700;
    padding: 20px;
    margin-bottom: 0;
    margin-top: 0;
}

.login-box .subtitulo-login {
    width: 260px;
    margin: 0 auto;
    font-size: 14px;
    font-weight: 300;
    margin-bottom: 0;
    margin-top: 0;
    color: #7a7a7a;
}

.login-box .input-box {
    padding: 30px;
}

.login-box .input-box input {
    width: 95%;
    max-width: 220px;
    margin-bottom: 10px;
    border: 0px;
    border-bottom: 1px solid;
    padding: 10px;
    font-family: 'Roboto', sans-serif;
}

.login-box .input-box input:focus-visible {
    outline: 0px;
}

.login-box .btn-login {
    max-width: 150px;
    margin: 0 auto;
    margin-bottom: 20px;
    background-color: #000000;
    color: #ffffff;
    border-radius: 5px;
    padding: 5px;
    cursor: pointer;
}

.login-box .texto-registro {
    width: 260px;
    margin: 0 auto;
    font-size: 12px;
    font-weight: 300;
    margin-bottom: 10px;
    margin-top: 0;
    color: #7a7a7a;
}

.login-box .texto-registro a {
    color: #7a7a7a;
}

.login-box .error-log {
    font-size: 12px;
    color: #ff6d6d;
    font-weight: 300;
    margin-top: -20px;
}

@media (min-width: 768px) {
  .login-box {
    margin-top: 200px;
  }
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