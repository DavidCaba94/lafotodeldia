<template>
  <div v-if="!userLogged">
    <Unauthorized />
  </div>
  <div v-if="userLogged" class="social-list">
    <div class="selector-users">
      <div id="seguidores" class="item-users" @click="tabSeleccionado = 'seguidores'; setTabValue()">
        <div>Seguidores</div>
        <span>{{ numFollowers }}</span>
      </div>
      <div id="seguidos" class="item-users" @click="tabSeleccionado = 'seguidos'; setTabValue()">
        <div>Seguidos</div>
        <span>{{ numFollowed }}</span>
      </div>
      <div id="todos" class="item-users" @click="tabSeleccionado = 'todos'; setTabValue()">
        <div>Todos</div>
        <span>{{ numUsers }}</span>
      </div>
    </div>
    <div class="lds-ellipsis" v-if="loading"><div></div><div></div><div></div><div></div></div>
    <div v-if="tabSeleccionado === 'seguidores'">
      <SocialItem v-for="user in followersUserList" :key="user.id" 
        :user="user"
        :followButton="true"
        :unfollowButton="false"
        @followUser="followUser"
        @unfollowUser="unfollowUser"
      />
    </div>
    <div v-if="tabSeleccionado === 'seguidos'">
      <SocialItem v-for="user in followedUserList" :key="user.id" 
        :user="user"
        :followButton="false"
        :unfollowButton="true"
        @followUser="followUser"
        @unfollowUser="unfollowUser"
      />
    </div>
    <div v-if="tabSeleccionado === 'todos'">
      <SocialItem v-for="user in allUsersList" :key="user.id" 
        :user="user"
        :followButton="true"
        :unfollowButton="false"
        @followUser="followUser"
        @unfollowUser="unfollowUser"
      />
    </div>
  </div>
</template>

<script>
import Unauthorized from '../components/Unauthorized.vue';
import SocialItem from '../components/SocialItem.vue';
import homeService from '../services/homeService.js';

export default {
  name: 'SocialList',
  data() {
    return {
      allUsersList: [],
      followersUserList: [],
      followedUserList: [],
      loading: false,
      tabSeleccionado: 'seguidores',
      numUsers: 0,
      numFollowed: 0,
      numFollowers: 0
    }
  },
  props: {

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
  components: {
    Unauthorized,
    SocialItem
  },
  async mounted() {
    this.setTabValue();
    this.getNumsTabs();
  },
  methods: {
    async getAllUsers() {
      this.allUsersList = [];
      this.loading = true;
      this.allUsersList = await homeService.getAllUsers();
      this.loading = false;
    },
    async getFollowedUsers() {
      this.followedUserList = [];
      this.loading = true;
      this.followedUserList = await homeService.getFollowedUsers(this.$store.state.login.id);
      this.loading = false;
    },
    async getFollowersUsers() {
      this.followersUserList = [];
      this.loading = true;
      this.followersUserList = await homeService.getFollowersUsers(this.$store.state.login.id);
      this.loading = false;
    },
    setTabValue() {
      document.getElementById("seguidores").classList.remove("users-seleccionado");
      document.getElementById("seguidos").classList.remove("users-seleccionado");
      document.getElementById("todos").classList.remove("users-seleccionado");
      document.getElementById(this.tabSeleccionado).classList.add("users-seleccionado");
      this.getTabList(this.tabSeleccionado);
    },
    getTabList(t) {
      switch(t) {
        case 'seguidores':
          this.getFollowersUsers();
          break;
        case 'seguidos':
          this.getFollowedUsers();
          break;
        case 'todos':
          this.getAllUsers();
          break;
      }
    },
    async followUser(idFollowing) {
      let followSuccess = await homeService.saveNewFollower(this.$store.state.login.id, idFollowing);
      if (followSuccess) {
        // this.changeFollowButton(idFollowing);
      }
      this.getNumsTabs();
    },
    unfollowUser(idUser) {
      homeService.unfollowUser(idUser);
    },
    changeFollowButton(idUser) {
      let user = this.allUsersList.find(user => user.id === idUser);
      if (user.followed) {
        user.followed = false;
      } else {
        user.followed = true;
      }
    },
    async getNumsTabs() {
      this.numUsers = await homeService.getNumUsers();
      this.numFollowed = await homeService.getNumFollowedUsers(this.$store.state.login.id);
      this.numFollowers = await homeService.getNumFollowersUsers(this.$store.state.login.id);
    },
  }
}
</script>

<style scoped>
.social-list {
  padding: 10px;
}

.selector-users {
  max-width: 900px;
  margin: 0 auto;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
}

.item-users {
  display: block;
  width: 33%;
  padding: 5px;
  padding-bottom: 7px;
  cursor: pointer;
}

.item-users div {
  margin-bottom: 7px;
}

.item-users span {
  border: 1px solid #238fff;
  color: #238fff;
  padding: 2px 5px;
  border-radius: 2px;
}

.users-seleccionado {
  background-color: #238dff1c;
  border-radius: 2px;
}


/* LOADER */
.lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 20px;
  margin-top: 20px;
}
.lds-ellipsis div {
  position: absolute;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #000000;
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