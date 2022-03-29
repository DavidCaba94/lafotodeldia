<template>
  <div class="menu">
    <div id="nav">
      <div class="desktop-menu" v-if="!isMobile()">
        <router-link to="/">Inicio</router-link>
        <router-link to="/ranking">Ranking</router-link>
        <router-link to="/moderate">Moderar</router-link>
        <router-link to="/historical">Historial</router-link>
      </div>
      <div class="header-mobile" v-if="isMobile()">
        LA FOTO DEL DIA
      </div>
      <div class="mobile-menu" v-if="isMobile()">
        <router-link to="/">
          <div class="mobile-item">
            <img alt="Inicio" class="mobile-item-image" src="../assets/logo.png">
            <p>Inicio</p>
          </div>
        </router-link>
        <router-link to="/ranking">
          <div class="mobile-item">
            <img alt="Ranking" class="mobile-item-image" src="../assets/logo.png">
            <p>Ranking</p>
          </div>
        </router-link>
        <router-link to="/moderate">
          <div class="mobile-item">
            <img alt="Moderar" class="mobile-item-image" src="../assets/logo.png">
            <p>Moderar</p>
          </div>
        </router-link>
        <router-link to="/historical">
          <div class="mobile-item">
            <img alt="Historial" class="mobile-item-image" src="../assets/logo.png">
            <p>Historial</p>
          </div>
        </router-link>
      </div>
    </div>
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'Menu',
  data() {
    return {

    }
  },
  methods: {
    isMobile() {
      return screen.width <= 768;
    }
  }
}
</script>

<style scoped>
#nav {
  padding: 0px;
}

#nav a {
  font-weight: 300;
  color: #000000;
  text-decoration: none;
}

#nav a.router-link-exact-active {
  color: #42b983;
}

.mobile-menu {
  position: fixed;
  width: 100%;
  height: 70px;
  background-color: #ffffff;
  bottom: 0;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
}

.header-mobile {
  width: 100%;
  height: 50px;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.mobile-item {
  padding: 10px;
}

.mobile-item p {
  margin: 0;
}

.mobile-item-image {
  width: 25px;
}

</style>