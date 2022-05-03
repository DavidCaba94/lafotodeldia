<template>
  <div class="upload-image">
    <div class="close-box">
      <img class="close" @click="closeUploadProfileImage()" src="../assets/img/close.png">
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
      <div class="btn-guardar" v-if="!saving" @click="saveImage()">Guardar</div>
      <div class="lds-ellipsis" v-if="saving"><div></div><div></div><div></div><div></div></div>
    </div>
  </div>
</template>

<script>
import imageService from '../services/imageService.js';
import userService from '../services/userService.js';

export default {
  name: 'UploadProfileImage',
  data() {
    return {
      isFotoToShow: false,
      saving: false
    }
  },
  computed: {

  },
  methods: {
    closeUploadProfileImage() {
      this.$emit('closeUploadProfileImage');
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
      this.saving = true;
      var formData = new FormData();
      var files = document.querySelector('#upload-photo').files[0];
      formData.append('file',files);
      let uploadedImage = await imageService.uploadProfileImage(formData);
      if (uploadedImage !== 0 && uploadedImage !== 1) {
        let dataForm = {
          id: this.$store.state.login.id,
          foto: uploadedImage
        };
        let updateSuccess = await userService.updateFotoUsuario(dataForm);
        if (updateSuccess) {
          this.$store.state.login.foto = uploadedImage;
          var existing = localStorage.getItem('user');
          existing = existing ? JSON.parse(existing) : {};
          existing['foto'] = uploadedImage;
          localStorage.setItem('user', JSON.stringify(existing));
          this.saving = false;
          this.closeUploadProfileImage();
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
  overflow-x: scroll;
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

/* LOADER */
.lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 20px;
  margin-top: 20px;
}
.lds-ellipsis div {
  position: absolute;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #1fbd54;
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
  left: 8px;
  animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
  left: 8px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
  left: 32px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
  left: 56px;
  animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
  0% {
      transform: scale(0);
  }
  100% {
      transform: scale(1);
  }
}
@keyframes lds-ellipsis3 {
  0% {
      transform: scale(1);
  }
  100% {
      transform: scale(0);
  }
}
@keyframes lds-ellipsis2 {
  0% {
      transform: translate(0, 0);
  }
  100% {
      transform: translate(24px, 0);
  }
}
</style>