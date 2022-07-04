<template>
  <div class="detail-image">
    <div class="close-box">
      <img class="close" @click="closeFullImage()" src="../assets/img/close-light.png">
    </div>
    <div class="img-container" @click="closeFullImage()">
      <div class="box-img-show">
        <v-lazy-image class="img-show" :src="imageData.urlImage" />
        <router-link :to="'/user-detail/' + imageData.userId">
          <div class="profile-show">
            <div class="flex-box">
              <div class="profile-img">
                <div v-bind:style="{ backgroundImage: 'url(' + imageData.urlProfile + ')' }"></div>
              </div>
              <div class="profile-name">@{{ imageData.userName }}</div>
            </div>
            <div class="flex-box">
              <img class="img-likes" src="../assets/img/like-up.png">
              <div class="profile-name">{{ imageData.likesImage }}</div>
            </div>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import VLazyImage from "v-lazy-image";

export default {
  name: 'DetailImage',
  data() {
    return {

    }
  },
  props: {
      imageData: Object
  },
  components: {
    VLazyImage
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
  margin-top: 17px;
  margin-right: 6px;
  background-color: #e76d6d;
  border-radius: 50px;
  padding: 5px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
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
  justify-content: space-between;
  padding: 5px;
  padding-right: 10px;
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

.profile-img div {
  width: 24px;
  height: 24px;
  margin: 0 auto;
  margin-top: 1px;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  border-radius: 50px;
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

.flex-box {
  display: flex;
  align-items: center;
  justify-content: center;
}

.img-likes {
  width: 20px;
  height: 20px;
}

.v-lazy-image {
  filter: blur(4px);
  transition: filter 0.7s;
}

.v-lazy-image-loaded {
  filter: blur(0);
}
</style>