<template>
  <div class="home">
    HOME
    <router-link to="/products">
      <div class="btn-productos">VER PRODUCTOS</div>
    </router-link>
  </div>
</template>

<script>
export default {

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
}
</style>