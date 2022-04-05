<template>
  <div class="home">
    <p class="home-text">Esta es la foto ganadora del día de ayer</p>
    <div class="items-container">
      <HistoricalItem 
        urlImage='https://c.pxhere.com/photos/1d/87/adult_blur_camera_canon_capture_dslr_dslr_camera_fashion-1549227.jpg!d'
        date='24/03/2022'
        username='username'
      />
    </div>
    <router-link to="/products">
      <div class="btn-productos">VER PRODUCTOS</div>
    </router-link>
  </div>
</template>

<script>
import HistoricalItem from '../components/HistoricalItem.vue';

export default {
  data() {
    return {
      
    }
  },
  components: {
    HistoricalItem
  },
}
</script>

<style scoped>
.home {
  padding: 10px;
  padding-top: 70px;
  padding-bottom: 90px;
}

a {
  font-weight: 300;
  color: #000000;
  text-decoration: none;
}

.btn-productos {
  background-color: #f0f0f0;
  border-radius: 5px;
  padding: 5px;
  cursor: pointer;
  margin-top: 30px;
}

.items-container {
  max-width: 1000px;
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: wrap;
  margin: 0 auto;
}

@media (min-width: 768px) {
  .home-text {
    margin-top: 40px;
    margin-bottom: 40px;
  }
}
</style>