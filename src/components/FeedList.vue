<template>
  <div class="feed-list" @scroll="onScroll">
    <div class="yesterday-container" v-if="lastDayImage.length !== 0">
      <router-link :to="'/user-detail/' + lastDayImage[0].id_user">
        <div class="yesterday-item">
          <div class="img-yesterday" v-bind:style="{ backgroundImage: 'url(' + lastDayImage[0].url + ')' }"></div>
          <div class="user-date">
            <div class="user-yesterday">
              <img src="../assets/img/verified.png" v-if="lastDayImage[0].verificado === '1'">
              @{{ lastDayImage[0].user }}
            </div>
            <div class="date-yesterday">{{ transformDateFirstDay(lastDayImage[0].date) }}</div>
          </div>
          <img class="prize-yesterday" src="../assets/img/prize-day.png">
        </div>
      </router-link>
    </div>
    <div class="lds-ellipsis" v-if="loading"><div></div><div></div><div></div><div></div></div>
    <div class="items-container" v-if="feedImages.length > 0">
      <FeedItem v-for="img in feedImages" :key="img.id"
        :image="img"
      />
    </div>
    <div class="no-items-container" v-if="!loading && feedImages.length === 0">
      <img class="img-no-photos" src="../assets/img/photos-icon.png">
      <p>Comienza a seguir a gente para ver sus publicaciones</p>
    </div>
    <div class="lds-ellipsis" v-if="loadingMore"><div></div><div></div><div></div><div></div></div>
  </div>
</template>

<script>
import FeedItem from '../components/FeedItem.vue';
import homeService from '../services/homeService.js';
import utils from '../utils/utils.js';

export default {
  name: 'FeedList',
  data() {
    return {
      lastDayImage: [],
      feedImages: [],
      loading: false,
      loadingMore: false,
      scrollCounter: 0,
      noMoreImages: false
    }
  },
  props: {

  },
  computed: {

  },
  mounted() {
    this.getLastDayImage();
    this.getFeedImages();
    this.scroll();
  },
  components: {
    FeedItem
  },
  methods: {
    async getLastDayImage() {
      this.lastDayImage = await homeService.getLastDayImage(this.getYesterdayDay());
    },
    async getFeedImages() {
      this.feedImages = [];
      this.loading = true;
      this.feedImages = await homeService.getListFeedImages(this.$store.state.login.id);
      this.loading = false;
    },
    async getFeedImagesWithLimit() {
      let feedImagesLimited = [];
      this.scrollCounter++;
      this.loadingMore = true;
      feedImagesLimited = await homeService.getListFeedImagesWithLimit(this.$store.state.login.id, (this.scrollCounter*10) + 1);
      this.loadingMore = false;
      if(feedImagesLimited.length === 0) {
        this.noMoreImages = true;
      } else {
        feedImagesLimited.forEach(img => {
          this.feedImages.push(img);
        });
      }
    },
    getYesterdayDay() {
      var today = new Date();
      var yesterday = new Date(today);
      yesterday.setDate(today.getDate() - 1);
      var dd = yesterday.getDate();
      var mm = yesterday.getMonth() + 1;
      var yyyy = yesterday.getFullYear();
      if (dd < 10) {
        dd = '0' + dd;
      }
      if (mm < 10) {
        mm = '0' + mm;
      }
      yesterday = yyyy + '-' + mm + '-' + dd;
      return yesterday;
    },
    transformDateFirstDay(dateToTransform) {
      return utils.transformDate(dateToTransform);
    },
    scroll () {
      window.onscroll = () => {
        let bottomOfWindow = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop) 
                           + window.innerHeight === document.documentElement.offsetHeight;
        if (bottomOfWindow && !this.noMoreImages) {
          this.getFeedImagesWithLimit();
        }
      };
      window.touchmove = () => {
        let bottomOfWindow = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop) 
                           + window.innerHeight === document.documentElement.offsetHeight;
        if (bottomOfWindow && !this.noMoreImages) {
          this.getFeedImagesWithLimit();
        }
      }
    }
  }
}
</script>

<style scoped>
.feed-list {
  padding: 10px;
}

a {
  font-weight: 300;
  color: #000000;
  text-decoration: none;
}

.items-container {
  max-width: 600px;
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: wrap;
  margin: 0 auto;
}

.yesterday-container {
  max-width: 1000px;
  padding: 10px;
  margin: 0 auto;
}

.yesterday-item {
  width: 90%;
  max-width: 380px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: nowrap;
  background-color: #ffffff;
  padding: 10px;
  border-radius: 5px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  cursor: pointer;
}

.yesterday-item div {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  flex-wrap: nowrap;
}

.prize-yesterday {
  width: 30px;
}

.img-yesterday {
  width: 90px;
  height: 60px;
  border-radius: 5px;
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  margin-right: 10px;
}

.user-date {
  display: block !important;
}

.user-yesterday {
  font-size: 14px;
  font-weight: 700;
  margin-top: 10px;
  margin-bottom: 10px;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
  cursor: pointer;
}

.user-yesterday img {
  width: 20px;
  margin-right: 5px;
}

.date-yesterday {
  font-size: 14px;
  justify-content: center !important;
}

.img-no-photos {
  width: 150px;
  opacity: 0.3;
  margin-top: 20px;
}

@media (min-width: 768px) {
  .home-text {
    margin-top: 40px;
    margin-bottom: 40px;
  }
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
  background: #000000;
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