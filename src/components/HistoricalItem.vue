<template>
  <div class="historical-item">
    <div class="img-container">
        <img :src="urlImage">
    </div>
    <div class="username-container">
      <img src="../assets/img/verified.png" v-if="verificado === '1'">
      @{{ username }}
    </div>
    <div class="date-container">{{ date }}</div>
    <div class="likes-container">
      <img src="../assets/img/like-up.png">
      <div>{{ likes }}</div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HistricalItem',
  data() {
    return {

    }
  },
  props: {
      urlImage: String,
      username: String,
      order: Number,
      likes: String,
      date: String,
      verificado: String
  },
  computed: {

  },
  methods: {

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
  margin-top: 10px;
}

.username-container {
  font-size: 14px;
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
  font-size: 18px;
  margin-top: 10px;
  margin-bottom: 10px;
  text-align: center;
}

.likes-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
  margin-bottom: 10px;
}

.likes-container img {
  width: 20px;
}

@media (min-width: 768px) {
  .img-container img {
    margin-top: 20px;
  }
}
</style>