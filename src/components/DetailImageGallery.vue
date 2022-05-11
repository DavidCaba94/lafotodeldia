<template>
  <div class="detail-image">
    <div class="close-box">
      <img class="close" @click="closeFullImage()" src="../assets/img/close-light.png">
    </div>
    <div class="img-container">
      <div class="box-img-show">
        <img class="img-show" :src="imageData.urlImage">
        <div class="btn-delete" v-if="deleteEnabled" @click="deleteImage(imageData.imageId)"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DetailImageGallery',
  data() {
    return {
      deleteEnabled: this.$route.params.id === this.$store.state.login.id ? true : false
    }
  },
  props: {
      imageData: Object
  },
  computed: {

  },
  methods: {
    closeFullImage() {
      this.$emit('closeFullImage');
    },
    deleteImage(id) {
      console.log(id);
      // dialog de confirmación de delete
      // emit para actualizar el array de imagenes
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
  overflow-x: scroll;
}

.close-box {
  width: 95%;
  text-align: right;
}

.close {
  width: 20px;
  margin-top: 17px;
  margin-right: 6px;
  background-color: #e76d6d;
  border-radius: 50px;
  padding: 5px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  cursor: pointer;
}

.img-container {
  height: 80%;
  margin-top: 20px;
  padding: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
}

.box-img-show {
  width: 90%;
  max-width: 600px;
  margin: 0 auto;
  border-radius: 5px;
  margin-top: 5px;
}

.img-show {
  width: 100%;
  border-radius: 5px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.btn-delete {
  position: absolute;
  background-color: #ffffff;
  width: 40px;
  height: 40px;
  border-radius: 50px;
  margin-top: -55px;
  margin-left: 10px;
  background-image: url("../assets/img/delete.png");
  background-repeat: no-repeat;
  background-size: 25px;
  background-position: center;
  cursor: pointer;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.btn-delete:hover {
  background-color: #ff8585;
}
</style>