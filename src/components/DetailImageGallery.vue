<template>
  <div class="detail-image">
    <div class="close-box">
      <img class="close" @click="closeFullImage()" src="../assets/img/close-light.png">
    </div>
    <div class="img-container" @click="() => {if(!deleteEnabled){closeFullImage()}}">
      <div class="box-img-show">
        <v-lazy-image class="img-show" :src="imageData.urlImage" />
        <div class="flex-box">
          <div class="flex-likes-pill">
            <img class="img-likes" src="../assets/img/like-up.png">
            <div class="likes-text">{{ imageData.likesImage }}</div>
          </div>
          <div class="btn-delete" v-if="deleteEnabled" @click="openDeleteDialog()"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="delete-dialog" v-if="deleteDialog">
    <div class="delete-dialog-box">
      <div class="delete-dialog-text">¿Estás seguro de que quieres eliminar esta imagen?</div>
      <div class="delete-dialog-buttons">
        <div class="btn-delete-dialog-ok" @click="deleteImage(imageData.imageId)">Sí</div>
        <div class="btn-delete-dialog-ko" @click="closeDeleteDialog()">No</div>
      </div>
    </div>    
  </div>
</template>

<script>
import VLazyImage from "v-lazy-image";

export default {
  name: 'DetailImageGallery',
  data() {
    return {
      deleteEnabled: this.$route.params.id === this.$store.state.login.id ? true : false,
      deleteDialog: false
    }
  },
  emits: ["closeFullImage", "deleteImage"],
  props: {
      imageData: Object
  },
  components: {
    VLazyImage
  },
  methods: {
    closeFullImage() {
      this.$emit('closeFullImage');
    },
    openDeleteDialog() {
      this.deleteDialog = true;
    },
    deleteImage(id) {
      this.deleteDialog = false;
      this.$emit('deleteImage', id);
    },
    closeDeleteDialog() {
      this.deleteDialog = false;
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
  background-color: #ffffff;
  width: 30px;
  height: 30px;
  margin-left: 5px;
  border-radius: 50px;
  background-image: url("../assets/img/delete.png");
  background-repeat: no-repeat;
  background-size: 20px;
  background-position: center;
  cursor: pointer;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.btn-delete:hover {
  background-color: #ff8585;
}

.flex-box {
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
  margin-top: -40px;
}

.flex-likes-pill {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: 10px;
  background-color: #ffffff;
  border-radius: 5px;
  padding: 2px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.img-likes {
  width: 20px;
  height: 20px;
}

.likes-text {
  margin-right: 5px;
  font-size: 14px;
}

.delete-dialog {
  width: 100%;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #ffffff50;
  -webkit-backdrop-filter: blur(5px);
  backdrop-filter: blur(5px);
  position: fixed;
  top: 0;
  z-index: 9;
  overflow-x: scroll;
}

.delete-dialog-box {
  width: 250px;
  height: 90px;
  background-color: #ffffff;
  border-radius: 5px;
  padding: 10px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.delete-dialog-text {
  font-size: 14px;
  font-weight: 700;
  margin-bottom: 10px;
}

.delete-dialog-buttons {
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-delete-dialog-ok {
  border-radius: 5px;
  background-color: #49b84f;
  color: #ffffff;
  font-size: 14px;
  font-weight: 700;
  cursor: pointer;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  padding: 5px 15px;
  margin: 10px;
}

.btn-delete-dialog-ko {
  border-radius: 5px;
  background-color: #e76d6d;
  color: #ffffff;
  font-size: 14px;
  font-weight: 700;
  cursor: pointer;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  padding: 5px 15px;
  margin: 10px;
}

.v-lazy-image {
  filter: blur(4px);
  transition: filter 0.7s;
}

.v-lazy-image-loaded {
  filter: blur(0);
}
</style>