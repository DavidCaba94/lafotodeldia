<template>
  <div class="menu">
    <div id="nav">
      <div class="desktop-menu" v-if="!screenWidthMobile">
        <div class="icon-lettering">
          <div class="icon-img"></div>
          <div class="lettering"></div>
        </div>
        <router-link to="/">
          <div class="desktop-item">Inicio</div>
        </router-link>
        <router-link to="/ranking">
          <div class="desktop-item">Ranking</div>
        </router-link>
        <router-link to="/moderate">
          <div class="desktop-item">Moderar</div>
        </router-link>
        <router-link to="/historical">
          <div class="desktop-item">Historial</div>
        </router-link>
        <router-link to="/user">
          <div class="user-img"></div>
        </router-link>
      </div>
      <div class="header-mobile" v-if="screenWidthMobile">
        <div class="icon-img"></div>
        <div class="lettering"></div>
        <router-link to="/user">
          <div class="user-img"></div>
        </router-link>
      </div>
      <div class="mobile-menu" v-if="screenWidthMobile">
        <router-link to="/">
          <div class="mobile-item">
            <img alt="Inicio" class="mobile-item-image" src="../assets/img/home.png">
            <p>Inicio</p>
          </div>
        </router-link>
        <router-link to="/ranking">
          <div class="mobile-item">
            <img alt="Ranking" class="mobile-item-image" src="../assets/img/ranking.png">
            <p>Ranking</p>
          </div>
        </router-link>
        <router-link to="/moderate">
          <div class="mobile-item">
            <img alt="Moderar" class="mobile-item-image" src="../assets/img/like.png">
            <p>Moderar</p>
          </div>
        </router-link>
        <router-link to="/historical">
          <div class="mobile-item">
            <img alt="Historial" class="mobile-item-image" src="../assets/img/historical.png">
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
  computed: {
    screenWidthMobile() {
      return this.isMobile();
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
  background-color: #f0f0f0;
  border-radius: 5px;
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

.desktop-menu {
  width: 100%;
  height: 70px;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
}

.header-mobile {
  width: 100%;
  height: 60px;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: nowrap;
}

.header-mobile a {
  margin-right: 10px;
}

.mobile-item {
  width: 60px;
  padding: 5px;
}

.desktop-item {
  padding: 5px;
}

.mobile-item p {
  margin: 0;
}

.mobile-item-image {
  width: 25px;
}

.user-img {
  width: 30px;
  height: 30px;
  background-image: url('../assets/img/user.svg');
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  margin: 10px;
  cursor: pointer;
}

.icon-img {
  width: 30px;
  height: 30px;
  background-image: url('../assets/img/shutter-color.png');
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  margin: 10px;
}

.lettering {
  width: 130px;
  height: 30px;
  background-image: url('../assets/img/lettering.png');
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
}

.icon-lettering {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: nowrap;
}
</style>