<template>
  <div class="menu">
    <div id="nav">
      <div class="desktop-menu">
        <div class="icon-lettering">
          <a href="/">
            <div class="icon-img"></div>
          </a>
          <a href="/">
            <div class="lettering"></div>
          </a>
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
          <div class="user-img" v-if="!userLogged"></div>
          <div class="user-loged-img" v-if="userLogged && userImage !== null">
            <div class="img-user-loged" v-bind:style="{ backgroundImage: 'url(' + userImage + ')' }"></div>
          </div>
        </router-link>
      </div>
      <div class="header-mobile">
        <a href="/">
          <div class="icon-img"></div>
        </a>
        <div class="lettering"></div>
        <router-link to="/user">
          <div class="user-img" v-if="!userLogged"></div>
          <div class="user-loged-img" v-if="userLogged && userImage !== null">
            <div class="img-user-loged" v-bind:style="{ backgroundImage: 'url(' + userImage + ')' }"></div>
          </div>
        </router-link>
      </div>
      <div class="mobile-menu">
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
      userImage: this.$store.state.login.foto ? this.$store.state.login.foto : null
    }
  },
  created() {
    this.setStoredLogin();
  },
  computed: {
    userLogged() {
      var isLogged = false;
      if (this.$store.state.login.user !== '' && this.$store.state.login.pass !== '') {
        isLogged = true;
        this.setUserInicial();
      } else {
        isLogged = false;
      }

      return isLogged;
    }
  },
  methods: {
    setUserInicial() {
      this.userImage = this.$store.state.login.foto ? this.$store.state.login.foto : null;
    },
    setStoredLogin() {
      if (JSON.parse(localStorage.getItem('user'))) {
        this.$store.commit('setStoredLogin', JSON.parse(localStorage.getItem('user')));
      }
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
  z-index: 1;
}

.desktop-menu {
  position: fixed;
  width: 100%;
  height: 70px;
  background-color: #ffffff;
  top: 0;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  display: none;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
}

.header-mobile {
  position: fixed;
  width: 100%;
  height: 60px;
  background-color: #ffffff;
  top: 0;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: nowrap;
  z-index: 1;
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

.user-loged-no-img {
  width: 30px;
  height: 30px;
  font-size: 24px;
  font-weight: 700;
  color: #000000;
  border: 1px solid #000000;
  margin: 10px;
  border-radius: 5px;
  cursor: pointer;
}

.user-loged-img {
  width: 35px;
  height: 35px;
  font-size: 24px;
  font-weight: 700;
  color: #000000;
  border: 1px solid #000000;
  margin: 10px;
  border-radius: 50px;
  cursor: pointer;
}

.img-user-loged {
  width: 33px;
  height: 33px;
  margin: 0 auto;
  margin-top: 1px;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  border-radius: 50px;
}

.icon-img {
  width: 30px;
  height: 30px;
  background-image: url('../assets/img/shutter-color.png');
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  margin: 10px;
  margin-left: 15px;
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

@media (min-width: 768px) {
  .desktop-menu {
    display: flex;
  }

  .mobile-menu {
    display: none;
  }

  .header-mobile {
    display: none;
  }
}
</style>