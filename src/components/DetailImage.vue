<template>
  <div class="detail-image">
    <div class="close-box">
      <img class="close" @click="closeFullImage()" src="../assets/img/close.png">
    </div>
    <div class="img-container">
      <div class="box-img-show">
        <img class="img-show" :src="imageData.urlImage">
        <router-link :to="'/user-detail/' + imageData.userId">
          <div class="profile-show">
            <div class="profile-img">
              <img :src="imageData.urlProfile">
            </div>
            <div class="profile-name">@{{ imageData.userName }}</div>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DetailImage',
  data() {
    return {

    }
  },
  props: {
      imageData: Object
  },
  computed: {

  },
  methods: {
    closeFullImage() {
      this.$emit('closeFullImage');
    }
  }
}
</script>

<style scoped>
.detail-image {
  width: 100%;
  height: 100vh;
  background-color: #ffffff50;
  -webkit-backdrop-filter: blur(5px);
  backdrop-filter: blur(5px);
  position: fixed;
  top: 0;
  z-index: 9;
  overflow-x: scroll;
}

.close-box {
  width: 95%;
  text-align: right;
}

.close {
  width: 20px;
  margin-top: 20px;
  margin-right: 10px;
  cursor: pointer;
}

.img-container {
  height: 80%;
  margin-top: 20px;
  padding: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
}

.box-img-show {
  width: 90%;
  max-width: 600px;
  margin: 0 auto;
  border-radius: 5px;
  margin-top: 5px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.img-show {
  width: 100%;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}

.profile-show {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding: 5px;
  margin-top: -4px;
  background-color: #ffffff;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
  cursor: pointer;
}

.profile-img {
  width: 26px;
  height: 26px;
  font-size: 24px;
  font-weight: 700;
  color: #000000;
  border: 1px solid #000000;
  margin-right: 10px;
  border-radius: 50px;
}

.profile-img img {
  width: 24px;
  height: 24px;
  border-radius: 50px;
  margin-top: 1px;
  margin-left: 0px;
}

.profile-name {
  font-size: 12px;
  font-weight: 700;
}

a {
  font-weight: 300;
  color: #000000;
  text-decoration: none;
}

a.router-link-exact-active {
  background-color: #f0f0f0;
  border-radius: 5px;
}

</style>