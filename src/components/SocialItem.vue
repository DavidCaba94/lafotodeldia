<template>
  <div class="social-item">
    <router-link :to="'/user-detail/' + user.id">
      <div class="flex-box">
        <div class="profile-img">
          <img :src="user.foto">
        </div>
        <div class="profile-name">@{{ user.user }}</div>
      </div>
    </router-link>
    <div class="flex-box">
      <div class="follow-button" v-if="followButton && this.$store.state.login.id !== user.id" @click="followUser()">
        <img src="../assets/img/follow-green.png">
      </div>
      <div class="unfollow-button" v-if="unfollowButton && this.$store.state.login.id !== user.id" @click="unfollowUser()">
        <img src="../assets/img/unfollow-red.png">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SocialItem',
  data() {
    return {

    }
  },
  props: {
    user: Object,
    followButton: Boolean,
    unfollowButton: Boolean
  },
  computed: {

  },
  methods: {
    followUser() {
      this.$emit('followUser', this.user.id);
    },
    unfollowUser() {
      this.$emit('unfollowUser', this.user.id);
    }
  }
}
</script>

<style scoped>
.social-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: nowrap;
  max-width: 300px;
  margin: 0 auto;
  margin-top: 10px;
  padding: 10px;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  border-radius: 5px;
}

a {
  font-weight: 300;
  color: #000000;
  text-decoration: none;
}

.profile-img {
  width: 36px;
  height: 36px;
  font-size: 24px;
  font-weight: 700;
  color: #000000;
  border: 1px solid #000000;
  margin-right: 10px;
  border-radius: 50px;
}

.profile-img img {
  width: 34px;
  height: 34px;
  border-radius: 50px;
  margin-top: 1px;
  margin-left: 0px;
}

.profile-name {
  font-size: 12px;
  font-weight: 700;
}

.flex-box {
  display: flex;
  align-items: center;
  justify-content: center;
}

.follow-button {
  width: 30px;
  height: 30px;
  border-radius: 50px;
  border: 1px solid #1fbd54;
  cursor: pointer;
}

.follow-button img {
  width: 20px;
  height: 20px;
  margin-top: 4px;
  margin-left: 4px;
}

.unfollow-button {
  width: 30px;
  height: 30px;
  border-radius: 50px;
  border: 1px solid #ff5e5e;
  cursor: pointer;
}

.unfollow-button img {
  width: 20px;
  height: 20px;
  margin-top: 4px;
  margin-left: 4px;
}
</style>