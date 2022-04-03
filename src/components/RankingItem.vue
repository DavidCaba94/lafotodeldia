<template>
  <div class="ranking-item">
    <div class="img-container">
      <div class="order-container">#{{ order }}</div>
      <img :src="urlImage">
    </div>
    <div class="username-container">{{ username }}</div>
    <div class="likes-container">
      <img src="../assets/img/like.png">
      <div>{{ likes }}</div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'RankingItem',
  data() {
    return {

    }
  },
  props: {
      urlImage: String,
      username: String,
      order: String,
      likes: String
  },
  computed: {

  },
  methods: {

  }
}
</script>

<style scoped>
.ranking-item {
  width: 90%;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  cursor: pointer;
  margin: 5px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px;
}

.img-container {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  flex-wrap: nowrap;
}

.img-container img {
  width: 120px;
  border-radius: 5px;
  margin-left: 10px;
}

.username-container {
  font-size: 16px;
  text-align: center;
}

.order-container {
  font-weight: 700;
  font-size: 18px;
  text-align: center;
}

.likes-container {
  display: block;
}

.likes-container img {
  width: 20px;
}

@media (min-width: 768px) {
  .img-container img {
    width: 250px;
  }

  .img-container {
    margin-left: 30px;
  }

  .likes-container {
    margin-right: 30px;
  }
}
</style>