<template>
  <div v-if="!userLogged">
    <Unauthorized />
  </div>
  <div class="user" v-if="userLogged">
    USUARIO
    <div class="cerrar-sesion" @click="cerrarSesion()">CERRAR SESION</div>
  </div>
</template>

<script>
import Unauthorized from '../components/Unauthorized.vue';

export default {
  data() {
    return {
      
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
  methods: {
    cerrarSesion() {
      localStorage.removeItem('user');
      this.$store.commit('closeSession');
      this.$router.push('/');
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
</style>