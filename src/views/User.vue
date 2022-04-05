<template>
  <div v-if="!userLogged">
    <Unauthorized />
  </div>
  <div class="user" v-if="userLogged">
    USUARIO
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
    
  }
}
</script>

<style scoped>
.user {
  padding: 10px;
  padding-top: 70px;
  padding-bottom: 90px;
}
</style>