<template>
  <div class="historical-item">
    <div class="img-container">
        <img :src="urlImage">
    </div>
    <div class="username-container">{{ username }}</div>
    <div class="date-container">{{ date }}</div>
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
      date: String,
      username: String
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
    font-size: 16px;
    margin-top: 10px;
    text-align: center;
}

.date-container {
    font-weight: 300;
    font-size: 18px;
    margin-top: 10px;
    margin-bottom: 10px;
    text-align: center;
}

@media (min-width: 768px) {
    .img-container img {
        margin-top: 20px;
    }
}
</style>