<template>
  <div class="shop-list">
    <p class="concurso-text">
      El total recaudado en el año en comisiones de la venta de los productos irá destinado a los 
      premios del usuario con mayor número de fotos del día, mayor número de fotos del mes y la mejor foto 
      del año
    </p>
    <p class="recaudacion-text">Total recaudado: <strong>10,45€</strong></p>
      <div class="banner-productos">
        <div class="text-banner">
          <img src="https://m.media-amazon.com/images/I/41Xn25rH9xL._AC_.jpg">
          <p>CÁMARAS</p>
        </div>
        <div class="btn-productos">
          <img src="../assets/img/arrow.png">
        </div>
      </div>
      <div class="banner-productos">
        <div class="text-banner">
          <img src="https://m.media-amazon.com/images/I/71v5TKPcE6L._AC_SX679_.jpg">
          <p>OBJETIVOS</p>
        </div>
        <div class="btn-productos">
          <img src="../assets/img/arrow.png">
        </div>
      </div>
      <div class="banner-productos">
        <div class="text-banner">
          <img src="https://m.media-amazon.com/images/I/61pPpftos+L._AC_SX679_.jpg">
          <p>CÁMARAS DEPORTIVAS</p>
        </div>
        <div class="btn-productos">
          <img src="../assets/img/arrow.png">
        </div>
      </div>
      <div class="banner-productos">
        <div class="text-banner">
          <img src="https://m.media-amazon.com/images/I/81JsuwPeEDL._AC_SX679_.jpg">
          <p>INSTANTÁNEAS</p>
        </div>
        <div class="btn-productos">
          <img src="../assets/img/arrow.png">
        </div>
      </div>
      <div class="banner-productos">
        <div class="text-banner">
          <img src="https://m.media-amazon.com/images/I/61vjUCzQCaL._AC_SY879_.jpg">
          <p>TRÍPODES</p>
        </div>
        <div class="btn-productos">
          <img src="../assets/img/arrow.png">
        </div>
      </div>
      <div class="banner-productos">
        <div class="text-banner">
          <img src="https://m.media-amazon.com/images/I/61Ms1fvjRSL._AC_SX450_.jpg">
          <p>ACCESORIOS</p>
        </div>
        <div class="btn-productos">
          <img src="../assets/img/arrow.png">
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name: 'ShopList',
  data() {
    return {

    }
  },
  props: {

  },
  computed: {

  },
  methods: {

  }
}
</script>

<style scoped>
.shop-list {
  padding: 10px;
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

.concurso-text {
  font-size: 12px;
}

.recaudacion-text {
  font-size: 14px;
}

.banner-productos {
  width: 90%;
  max-width: 600px;
  height: 70px;
  margin: 0 auto;
  margin-bottom: 10px;
  border: 1px solid #919191;
  border-radius: 5px;
  padding: 10px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: nowrap;
}

.text-banner {
  font-size: 12px;
  display: flex;
  align-items: center;
}

.text-banner img {
  width: 40px;
  margin-right: 10px;
}

.text-banner p {
  padding-left: 10px;
  padding-right: 10px;
  font-weight: 700;
}

@media (min-width: 768px) {
  .banner-productos {
    margin-top: 20px;
  }
}
</style>