<template>
  <a class="product-item" :href="url" target="_blank">
    <div class="img-container">
      <div v-bind:style="{ backgroundImage: 'url(' + urlImage + ')' }"></div>
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
  width: 150px;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  cursor: pointer;
  margin: 10px;
  border-radius: 5px;
}

.img-container div {
  width: 130px;
  height: 130px;
  border-radius: 5px;
  margin-top: 10px;
  margin-left: 10px;
  background-position: center;
  background-size: contain;
  background-repeat: no-repeat;
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