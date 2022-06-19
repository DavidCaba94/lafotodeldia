<template>
  <div class="registro">
    <div class="registro-box">
      <p class="titulo-registro">Registro</p>
      <p class="subtitulo-registro">Regístrate para tener acceso a todas las funcionalidades</p>
      <div class="input-box">
        <input type="text" placeholder="Usuario (Ej: JohnDoe23)" v-model="registroForm.user" @keyup="disableSpaces()">
        <input type="email" placeholder="Email" v-model="registroForm.email">
        <input type="password" placeholder="Contraseña" v-model="registroForm.pass">
        <input type="password" placeholder="Confirmar contraseña" v-model="registroForm.pass2">
      </div>
      <p id="error-log" class="error-log" v-if="errorLog">{{errorLog}}</p>
      <div class="btn-registro" @click="checkRegistro()" v-if="!loading">CONFIRMAR</div>
      <div class="lds-ellipsis" v-if="loading"><div></div><div></div><div></div><div></div></div>
    </div>
  </div>
</template>

<script>
import userService from '../services/userService.js';

export default {
  name: 'Registro',
  data() {
    return {
      registroForm: {
        user: '',
        email: '',
        pass: '',
        pass2: ''
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
    async registro() {
      this.errorLog = null;
      this.loading = true;
      let userComprobado = await userService.getUserByNameOrEmail(this.registroForm);
      if(this.registroForm.pass === this.registroForm.pass2) {
        if(userComprobado) {
          this.errorLog = 'El nombre de usuario o el email ya existen';
        } else {
          await userService.registrarUsuario(this.registroForm) ? this.$router.push('/login') : this.$router.push('error');
        }
      } else {
        this.errorLog = 'Las contraseñas no son iguales';
      }
      this.loading = false;
    },
    checkRegistro() {
      this.errorLog = null;
      if(this.registroForm.user !== '' && this.registroForm.email !== '' && this.registroForm.pass !== '' && this.registroForm.pass2 !== '') {
        this.registro();
      } else {
        this.errorLog = 'Todos los campos son obligatorios';
      }
    },
    disableSpaces() {
      this.registroForm.user = this.registroForm.user.replace(/\s/g, '');
    }
  }
}
</script>

<style scoped>
.registro {
  padding: 10px;
  padding-top: 70px;
  padding-bottom: 90px;
}

.registro-box {
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

.registro-box .titulo-registro {
    font-size: 30px;
    font-weight: 700;
    padding: 20px;
    margin-bottom: 0;
    margin-top: 0;
}

.registro-box .subtitulo-registro {
    width: 260px;
    margin: 0 auto;
    font-size: 14px;
    font-weight: 300;
    margin-bottom: 0;
    margin-top: 0;
    color: #7a7a7a;
}

.registro-box .input-box {
    padding: 30px;
}

.registro-box .input-box input {
    width: 95%;
    max-width: 220px;
    margin-bottom: 10px;
    border: 0px;
    border-bottom: 1px solid;
    padding: 10px;
    font-family: 'Roboto', sans-serif;
}

.registro-box .input-box input:focus-visible {
    outline: 0px;
}

.registro-box .btn-registro {
    max-width: 150px;
    margin: 0 auto;
    margin-bottom: 20px;
    background-color: #000000;
    color: #ffffff;
    border-radius: 5px;
    padding: 5px;
    cursor: pointer;
}

.registro-box .texto-registro {
    width: 260px;
    margin: 0 auto;
    font-size: 12px;
    font-weight: 300;
    margin-bottom: 0;
    margin-top: 0;
    color: #7a7a7a;
}

.registro-box .texto-registro a {
    color: #7a7a7a;
}

.registro-box .error-log {
    font-size: 12px;
    color: #ff6d6d;
    font-weight: 300;
    margin-top: -20px;
}

@media (min-width: 768px) {
  .registro-box {
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