<template>
  <div class="detail-image">
    <div class="close-box">
      <img class="close" @click="closeFullImage()" src="../assets/img/close-light.png">
    </div>
    <div class="img-container" @click="closeFullImage()">
      <div class="box-img-show">
        <v-lazy-image class="img-show" :src="imageData.urlImage" />
        <div class="flex-box">
          <div class="flex-likes-pill">
            <img class="img-likes" src="../assets/img/like-up.png">
            <div class="likes-text">{{ imageData.likesImage }}</div>
          </div>
          <div class="prizes-box">
            <img class="prize-img" src="../assets/img/prize-day.png">
            <img class="prize-img" v-if="imageData.isFotoOfMonth" src="../assets/img/prize-month.png">
            <img class="prize-img" v-if="imageData.isFotoOfYear" src="../assets/img/prize-year.png">
            <div class="date-label">{{ transformDateFirstDay(imageData.date) }}</div>
          </div> 
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VLazyImage from "v-lazy-image";
import utils from '../utils/utils.js';

export default {
  name: 'DetailImagePrize',
  data() {
    return {
      
    }
  },
  emits: ["closeFullImage"],
  props: {
      imageData: Object
  },
  components: {
    VLazyImage
  },
  methods: {
    closeFullImage() {
      this.$emit('closeFullImage');
    },
    transformDateFirstDay(dateToTransform) {
      return utils.transformDate(dateToTransform);
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
}

.img-show {
  width: 100%;
  border-radius: 5px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.flex-box {
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
  margin-top: -40px;
}

.flex-likes-pill {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: 10px;
  background-color: #ffffff;
  border-radius: 5px;
  padding: 2px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.img-likes {
  width: 20px;
  height: 20px;
}

.likes-text {
  margin-right: 5px;
  font-size: 14px;
}

.v-lazy-image {
  filter: blur(4px);
  transition: filter 0.7s;
}

.v-lazy-image-loaded {
  filter: blur(0);
}

.prizes-box {
  display: flex;
  width: fit-content;
  height: 20px;
  background-color: #ffffff;
  border-radius: 5px;
  padding: 2px 2px;
  margin-left: 5px;
}

.prize-img {
  width: 20px;
}

.date-label {
  font-size: 14px;
  font-weight: 300;
  margin-left: 2px;
  margin-top: 2px;
}
</style>