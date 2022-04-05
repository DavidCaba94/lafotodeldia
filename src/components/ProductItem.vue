<template>
  <a class="product-item" :href="url" target="_blank">
    <div class="img-container">
      <img :src="urlImage">
    </div>
    <div class="name-container">{{ name }}</div>
  </a>
</template>

<script>
export default {
  name: 'ProductItem',
  data() {
    return {

    }
  },
  props: {
    urlImage: String,
    name: String,
    url: String
  },
  computed: {

  },
  methods: {

  }
}
</script>

<style scoped>
.product-item {
  width: 300px;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  cursor: pointer;
  margin: 10px;
  border-radius: 5px;
}

.img-container img {
  width: 95%;
  border-radius: 5px;
  margin-top: 10px;
}

.name-container {
  font-size: 16px;
  font-weight: 700;
  margin-top: 10px;
  text-align: center;
  padding: 20px;
}

a {
  color: #000000;
  text-decoration: none;
}

@media (min-width: 768px) {
  .img-container img {
    margin-top: 20px;
  }
}
</style>