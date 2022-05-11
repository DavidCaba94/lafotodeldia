<template>
  <div v-if="showImage">
    <DetailImageGallery
    :imageData="selectedShowImage"
    @closeFullImage="closeFullImage" />
  </div>
  <div class="gallery">
    <router-link :to="'/user-detail/' + idUser">
      <div class="close-box">
        <img class="close" src="../assets/img/arrow-back.png"> Volver al perfil
      </div>
    </router-link>
    <div class="lds-ellipsis" v-if="loading"><div></div><div></div><div></div><div></div></div>
    <div v-if="!loading && imagesArray.length === 0">
      <img class="img-no-photos" src="../assets/img/photos-icon.png">
      <p>Este usuario no ha publicado fotos todavía</p>
    </div>
    <div class="gallery-box">
      <img
        v-for="image of imagesArray"
        :key="image.id"
        class="gallery-item"
        @click="showFullImage(image.id, image.url)"
        :src="image.url">
    </div>
  </div>
</template>

<script>
import imageService from '../services/imageService.js';
import DetailImageGallery from '../components/DetailImageGallery.vue';

export default {
  name: 'UserGallery',
  data() {
    return {
      idUser: this.$route.params.id,
      loading: false,
      imagesArray: [],
      selectedShowImage: {},
      showImage: false
    }
  },
  components: {
    DetailImageGallery
  },
  created() {
    this.getAllUserImages(this.$route.params.id);
  },
  methods: {
    async getAllUserImages(idUser) {
      this.loading = true;
      this.imagesArray = await imageService.getAllImagesByUser(idUser);
      this.loading = false;
    },
    showFullImage(imageId, url) {
      this.selectedShowImage.urlImage = url;
      this.selectedShowImage.userName = this.username;
      this.selectedShowImage.urlProfile = this.foto;
      this.selectedShowImage.userId = this.$route.params.id;
      this.selectedShowImage.imageId = imageId;
      this.showImage = true;
    },
    closeFullImage() {
      this.showImage = false;
    }
  }
}
</script>

<style scoped>
.gallery {
  padding: 10px;
  padding-top: 70px;
  padding-bottom: 90px;
}

.close-box {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  width: 95%;
  text-align: left;
  margin: 0 auto;
  margin-top: 10px;
  margin-left: 10px;
}

.close {
  width: 20px;
  margin-right: 5px;
  cursor: pointer;
}

.gallery-box {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  width: 100%;
  max-width: 900px;
  margin: 0 auto;
  margin-top: 20px;
}

.gallery-item {
  width: 30%;
  margin: 5px;
  border-radius: 5px;
  cursor: pointer;
}

.img-no-photos {
  width: 150px;
  opacity: 0.3;
  margin-top: 40px;
}

@media (min-width: 768px) {
  .close-box {
    width: auto;
    max-width: 850px;
    margin: 0 auto;
    margin-top: 20px;
    margin-left: auto;
  }
}

a {
  font-weight: 300;
  color: #000000;
  text-decoration: none;
}

a.router-link-exact-active {
  background-color: #f0f0f0;
  border-radius: 5px;
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
    background: rgb(0, 0, 0);
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