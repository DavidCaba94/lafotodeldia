<template>
  <div class="detail-image">
    <div class="close-box">
      <img class="close" @click="closeFullImage()" src="../assets/img/close.png">
    </div>
    <div class="img-container">
      <img class="img-show" :src="urlImage">
    </div>
  </div>
</template>

<script>
export default {
  name: 'DetailImage',
  data() {
    return {

    }
  },
  props: {
      urlImage: String
  },
  computed: {

  },
  methods: {
    closeFullImage() {
      this.$emit('closeFullImage');
    }
  }
}
</script>

<style scoped>
.detail-image {
  width: 100%;
  height: 100vh;
  background-color: #ffffff50;
  -webkit-backdrop-filter: blur(5px);
  backdrop-filter: blur(5px);
  position: fixed;
  top: 0;
  z-index: 9;
}

.close-box {
  width: 95%;
  text-align: right;
}

.close {
  width: 20px;
  margin-top: 20px;
  margin-right: 10px;
  cursor: pointer;
}

.img-container {
  margin-top: 20px;
  padding: 10px;
}

.img-show {
  width: 90%;
  max-width: 600px;
  border-radius: 5px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}
</style>