<template>
  <div class="home">
    <div class="tabs-home">
      <div id="feed" class="item-tab-home" @click="tabSelected = 'feed'; setTabValue()">
        <img v-if="tabSelected !== 'feed'" src="../assets/img/feed.png">
        <img v-if="tabSelected === 'feed'" src="../assets/img/feed-active.png">
      </div>
      <div id="social" class="item-tab-home" @click="tabSelected = 'social'; setTabValue()">
        <img v-if="tabSelected !== 'social'" src="../assets/img/users.png">
        <img v-if="tabSelected === 'social'" src="../assets/img/users-active.png">
      </div>
      <div id="shop" class="item-tab-home" @click="tabSelected = 'shop'; setTabValue()">
        <img v-if="tabSelected !== 'shop'" src="../assets/img/shop.png">
        <img v-if="tabSelected === 'shop'" src="../assets/img/shop-active.png">
      </div>
    </div>
    <FeedList v-if="tabSelected === 'feed'" />
    <SocialList v-if="tabSelected === 'social'" />
    <ShopList v-if="tabSelected === 'shop'" />
  </div>
</template>

<script>
import FeedList from '../components/FeedList.vue';
import SocialList from '../components/SocialList.vue';
import ShopList from '../components/ShopList.vue';

export default {
  data() {
    return {
      tabSelected: 'feed',
    }
  },
  components: {
    FeedList,
    SocialList,
    ShopList
  },
  mounted() {
    this.setTabValue();
  },
  methods: {
    setTabValue() {
      document.getElementById("feed").classList.remove("tab-home-seleccionado");
      document.getElementById("social").classList.remove("tab-home-seleccionado");
      document.getElementById("shop").classList.remove("tab-home-seleccionado");
      document.getElementById(this.tabSelected).classList.add("tab-home-seleccionado");
    }
  }
}
</script>

<style scoped>
.home {
  padding-top: 70px;
  padding-bottom: 90px;
}

a {
  font-weight: 300;
  color: #000000;
  text-decoration: none;
}

.tabs-home {
  max-width: 900px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
  padding-left: 10px;
  padding-right: 10px;
}

.item-tab-home {
  width: 33%;
  padding: 5px;
  padding-bottom: 7px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.item-tab-home img {
  width: 25px;
}

.tab-home-seleccionado {
  border-bottom: 2px solid #238fff;
  color: #238fff;
}

@media (min-width: 768px) {
  .home {
    padding-top: 90px;
  }
}
</style>