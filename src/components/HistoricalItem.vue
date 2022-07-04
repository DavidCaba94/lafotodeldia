<template>
  <div class="historical-item">
    <div class="flex-box">
      <div class="profile-img">
        <div v-bind:style="{ backgroundImage: 'url(' + image.foto + ')' }"></div>
      </div>
      <div class="username-container">
        <img src="../assets/img/verified.png" v-if="image.verificado === '1'">
        @{{ image.user }}
      </div>
    </div>
    <div class="img-container">
        <v-lazy-image :src="image.url" />
    </div>
    <div class="footer-container">
      <div class="date-container">
        <img class="prize-foto" src="../assets/img/prize-day.png">
        {{ transformDateFirstDay(image.date) }}
      </div>
      <div class="likes-container">
        <img src="../assets/img/like-up.png">
        <div>{{ image.likes }}</div>
      </div>
    </div>
  </div>
</template>

<script>
import VLazyImage from "v-lazy-image";
import utils from '../utils/utils.js';

export default {
  name: 'HistricalItem',
  data() {
    return {

    }
  },
  props: {
      image: Object,
  },
  components: {
    VLazyImage
  },
  computed: {

  },
  methods: {
    transformDateFirstDay(dateToTransform) {
      return utils.transformDate(dateToTransform);
    }
  }
}
</script>

<style scoped>
.historical-item {
  width: 90%;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  cursor: pointer;
  margin: 5px;
  border-radius: 5px;
}

.img-container img {
  width: 95%;
  border-radius: 5px;
  margin-top: 5px;
}

.username-container {
  font-size: 12px;
  font-weight: 700;
  margin-top: 10px;
  margin-bottom: 10px;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
  cursor: pointer;
}

.username-container img {
  width: 20px;
  margin-right: 5px;
}

.likes-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
}

.likes-container img {
  width: 20px;
}

.date-container {
  font-weight: 300;
  font-size: 14px;
  margin-top: 5px;
  margin-bottom: 5px;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
}

.prize-foto {
  width: 30px;
}

.flex-box {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding-left: 10px;
  padding-right: 10px;
  padding-top: 5px;
}

.profile-img {
  width: 30px;
  height: 30px;
  font-size: 24px;
  font-weight: 700;
  color: #000000;
  border: 1px solid #000000;
  margin-right: 10px;
  border-radius: 50px;
}

.profile-img div {
  width: 28px;
  height: 28px;
  margin: 0 auto;
  margin-top: 1px;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  border-radius: 50px;
}

.footer-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-left: 10px;
  padding-right: 10px;
}

.v-lazy-image {
  filter: blur(4px);
  transition: filter 0.7s;
}

.v-lazy-image-loaded {
  filter: blur(0);
}

@media (min-width: 768px) {
  .img-container img {
    margin-top: 20px;
  }
}
</style>