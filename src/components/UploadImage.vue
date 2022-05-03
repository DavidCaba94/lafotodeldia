<template>
  <div class="upload-image">
    <div class="close-box">
      <img class="close" @click="closeUploadImage()" src="../assets/img/close.png">
    </div>
    <div class="upload-container">
      <p>Selecciona una imagen para subir</p>
      <label for="upload-photo">
        <div class="new-image">
          <img src="../assets/img/search-light.png" alt="">
          <p>Buscar...</p>
        </div>
      </label>
      <input type="file" name="photo" id="upload-photo" @change="changeInputImage()" />
      <img id="image-uploaded" class="image-uploaded" src="#" v-if="isFotoToShow">
      <div class="no-foto" v-if="!isFotoToShow"></div>
      <div class="btn-guardar" @click="saveImage()">Publicar</div>
    </div>
  </div>
</template>

<script>
import imageService from '../services/imageService.js';

export default {
  name: 'UploadImage',
  data() {
    return {
      isFotoToShow: false
    }
  },
  computed: {

  },
  methods: {
    closeUploadImage() {
      this.$emit('closeUploadImage');
    },
    async changeInputImage() {
      const file = document.querySelector('#upload-photo').files[0];
      if(file !== null) {
        const reader = new FileReader()
        let rawImg;
        reader.onloadend = () => {
          rawImg = reader.result;
          document.getElementById('image-uploaded').setAttribute("src", rawImg);
        }
        reader.readAsDataURL(file);
        this.isFotoToShow = true;
      }
    },
    async saveImage() {
      var formData = new FormData();
      var files = document.querySelector('#upload-photo').files[0];
      formData.append('file',files);
      let uploadedImage = await imageService.uploadImage(formData);
      if (uploadedImage !== 0 && uploadedImage !== 1) {
        debugger;
        let dataForm = {
          id_user: this.$store.state.login.id,
          url: uploadedImage,
          likes: 0,
          date: new Date().toISOString().slice(0, 10)
        };
        let updateSuccess = await imageService.saveImage(dataForm);
        if (updateSuccess) {
          this.closeUploadImage();
        }
      }
    }
  }
}
</script>

<style scoped>
.upload-image {
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

.upload-container {
  width: 90%;
  max-width: 600px;
  margin: 0 auto;
  border-radius: 5px;
  margin-top: 20px;
  padding: 10px;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.new-image {
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
  max-width: 100px;
  margin: 0 auto;
  margin-bottom: 20px;
  background-color: #000000;
  color: #ffffff;
  border-radius: 5px;
  padding: 5px;
  cursor: pointer;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.new-image img {
  width: 30px;
}

.new-image p {
  margin: 0;
}

#upload-photo {
  opacity: 0;
  position: absolute;
  z-index: -1;
}

.btn-guardar {
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
  max-width: 70px;
  margin: 0 auto;
  margin-top: 20px;
  margin-bottom: 20px;
  background-color: #1fbd54;
  color: #ffffff;
  border-radius: 5px;
  padding: 8px;
  cursor: pointer;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.image-uploaded {
  width: 90%;
  border-radius: 5px;
}

.no-foto {
  width: 90%;
  height: 350px;
  margin: 0 auto;
  border-radius: 5px;
  background-color: #e7e7e7;
  background-image: url('../assets/img/photo.png');
  background-size: auto;
  background-position: center;
  background-repeat: no-repeat;
  opacity: 0.5;
}
</style>