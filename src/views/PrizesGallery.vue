<template>
  <div v-if="showImage">
    <DetailImagePrize
    :imageData="selectedShowImage"
    @closeFullImage="closeFullImage"/>
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
      <p>Este usuario no tiene ninguna foto premiada</p>
    </div>
    <div class="gallery-box">
      <div
        v-for="image of imagesArray"
        :key="image.id"
        class="gallery-item"
        @click="showFullImage(image, isPhotoOfMonth(image.id), isPhotoOfYear(image.id))"
        v-bind:style="{ backgroundImage: 'url(' + image.url + ')' }">
        <div class="prizes-box">
          <img class="prize-img" src="../assets/img/prize-day.png">
          <img class="prize-img" v-if="isPhotoOfMonth(image.id)" src="../assets/img/prize-month.png">
          <img class="prize-img" v-if="isPhotoOfYear(image.id)" src="../assets/img/prize-year.png">
        </div>  
      </div>
    </div>
  </div>
</template>

<script>
import imageService from '../services/imageService.js';
import DetailImagePrize from '../components/DetailImagePrize.vue';

export default {
  name: 'PrizesGallery',
  data() {
    return {
      idUser: this.$route.params.id,
      loading: false,
      imagesArray: [],
      monthPrizes: [],
      yearPrizes: [],
      selectedShowImage: {},
      showImage: false
    }
  },
  components: {
    DetailImagePrize
  },
  created() {
    this.getAllUserPrizedImages(this.$route.params.id);
  },
  methods: {
    async getAllUserPrizedImages(idUser) {
      this.imagesArray = [];
      this.loading = true;
      this.imagesArray = await imageService.getAllPrizedImagesByUser(idUser);
      this.loading = false;
      this.getMonthUserPrizedImages(this.$route.params.id);
      this.getYearUserPrizedImages(this.$route.params.id);
    },
    async getMonthUserPrizedImages(idUser) {
      this.monthPrizes = [];
      this.loading = true;
      this.monthPrizes = await imageService.getMonthPrizedImagesByUser(idUser);
      this.loading = false;
    },
    async getYearUserPrizedImages(idUser) {
      this.yearPrizes = [];
      this.loading = true;
      this.yearPrizes = await imageService.getYearPrizedImagesByUser(idUser);
      this.loading = false;
    },
    isPhotoOfMonth(idImage) {
      let include = false;
      this.monthPrizes.forEach(element => {
        if(idImage === element.id) {
          include = true;
        }
      });
      return include;
    },
    isPhotoOfYear(idImage) {
      let include = false;
      this.yearPrizes.forEach(element => {
        if(idImage === element.id) {
          include = true;
        }
      });
      return include;
    },
    showFullImage(image, isFotoOfMoth, isFotoOfYear) {
      this.selectedShowImage.urlImage = image.url;
      this.selectedShowImage.likesImage = image.likes;
      this.selectedShowImage.userName = this.username;
      this.selectedShowImage.urlProfile = this.foto;
      this.selectedShowImage.userId = this.$route.params.id;
      this.selectedShowImage.imageId = image.id;
      this.selectedShowImage.isFotoOfMonth = isFotoOfMoth;
      this.selectedShowImage.isFotoOfYear = isFotoOfYear;
      this.selectedShowImage.date = image.date;
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
  height: 100px;
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  margin: 5px;
  border-radius: 5px;
  cursor: pointer;
}

.img-no-photos {
  width: 150px;
  opacity: 0.3;
  margin-top: 40px;
}

.prizes-box {
  display: flex;
  width: fit-content;
  height: 15px;
  background-color: #ffffff;
  border-radius: 2px;
  padding: 2px 2px;
  margin-top: 75px;
  margin-left: 5px;
}

.prize-img {
  width: 15px;
}

@media (min-width: 768px) {
  .close-box {
    width: auto;
    max-width: 850px;
    margin: 0 auto;
    margin-top: 20px;
    margin-left: auto;
  }

  .gallery-item {
    height: 200px;
  }

  .prizes-box {
    height: 20px;
    background-color: #ffffff;
    border-radius: 2px;
    padding: 2px 2px;
    margin-top: 170px;
    margin-left: 5px;
  }

  .prize-img {
    width: 20px;
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