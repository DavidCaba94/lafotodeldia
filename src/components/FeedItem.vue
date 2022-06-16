<template>
  <div class="feed-item">
    <router-link :to="'/user-detail/' + image.id_user">
      <div class="flex-box">
        <div class="profile-img">
          <img :src="image.foto">
        </div>
        <div class="username-container">
          <img src="../assets/img/verified.png" v-if="image.verificado === '1'">
          @{{ image.user }}
        </div>
      </div>
    </router-link>
    <div class="img-container">
        <img :src="image.url">
    </div>
    <div class="footer-container">
      <div class="date-container">{{ transformDateFirstDay(image.date) }}</div>
      <div class="likes-container">
        <img src="../assets/img/like-up.png">
        <div>{{ image.likes }}</div>
      </div>
    </div>
  </div>
</template>

<script>
import utils from '../utils/utils.js';

export default {
  name: 'FeedItem',
  data() {
    return {

    }
  },
  props: {
    image: Object
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
.feed-item {
  width: 90%;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  cursor: pointer;
  margin: 5px;
  border-radius: 5px;
}

a {
  font-weight: 300;
  color: #000000;
  text-decoration: none;
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

.date-container {
  font-weight: 300;
  font-size: 14px;
  margin-top: 10px;
  margin-bottom: 10px;
  text-align: center;
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

.profile-img img {
  width: 28px;
  height: 28px;
  border-radius: 50px;
  margin-top: 1px;
  margin-left: 0px;
}

.footer-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-left: 10px;
  padding-right: 10px;
}

@media (min-width: 768px) {
  .img-container img {
    margin-top: 5px;
  }
}
</style>