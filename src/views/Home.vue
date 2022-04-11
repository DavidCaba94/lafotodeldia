<template>
  <div class="home">
    <router-link to="/products">
      <div class="banner-productos">
        <div class="text-banner">
          <img src="https://m.media-amazon.com/images/I/41Xn25rH9xL._AC_.jpg">
          <p>LOS MEJORES PRODUCTOS RECOMENDADOS PARA FOTOGRAFÍA</p>
        </div>
        <div class="btn-productos">
          <img src="../assets/img/arrow.png">
        </div>
      </div>
    </router-link>
    <p class="home-text">Esta es la foto ganadora del día de ayer</p>
    <div class="items-container">
      <HistoricalItem 
        urlImage='https://c.pxhere.com/photos/1d/87/adult_blur_camera_canon_capture_dslr_dslr_camera_fashion-1549227.jpg!d'
        date='24/03/2022'
        username='username'
      />
    </div>
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
  width: 40px;
  height: 40px;
  border-radius: 50px;
  cursor: pointer;
  padding: 0px 6px;
}

.btn-productos img {
  width: 20px;
  margin-top: 10px;
}

.items-container {
  max-width: 1000px;
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: wrap;
  margin: 0 auto;
}

.banner-productos {
  width: 90%;
  max-width: 600px;
  height: 70px;
  margin: 0 auto;
  border: 1px solid #919191;
  border-radius: 5px;
  padding: 10px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
}

.text-banner {
  font-size: 12px;
  display: contents;
}

.text-banner img {
  width: 40px;
}

.text-banner p {
  padding-left: 10px;
  padding-right: 10px;
}

@media (min-width: 768px) {
  .home-text {
    margin-top: 40px;
    margin-bottom: 40px;
  }

  .banner-productos {
    margin-top: 20px;
  }
}
</style>