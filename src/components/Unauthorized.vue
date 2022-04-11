<template>
  <div class="unauthorized">
    <p>Debes tener una cuenta y acceder a ella para usar esta funcionalidad de la aplicación</p>
    <p>Puedes acceder a tu cuenta</p>
    <router-link to="/login">
      <div class="btn-login">LOGIN</div>
    </router-link>
    <p>O registrarte si no tienes una</p>
    <router-link to="/registro">
      <div class="btn-login">REGISTRO</div>
    </router-link>
  </div>
</template>

<script>
export default {
  name: 'Unauthorized',
  data() {
    return {

    }
  },
  computed: {

  },
  methods: {

  }
}
</script>

<style scoped>
.unauthorized {
  margin-top: 150px;
  padding: 10px;
}

a {
  font-weight: 300;
  color: #000000;
  text-decoration: none;
}

.btn-login {
  width: 150px;
  margin: 0 auto;
  background-color: #f0f0f0;
  border-radius: 5px;
  padding: 5px;
  cursor: pointer;
}
</style>