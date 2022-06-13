<template>
  <div class="feed-list">
    <p class="home-text">Esta es la foto ganadora del día de ayer</p>
    <div class="items-container">
      <HistoricalItem 
        urlImage='https://c.pxhere.com/photos/1d/87/adult_blur_camera_canon_capture_dslr_dslr_camera_fashion-1549227.jpg!d'
        date='24/03/2022'
        username='username'
      />
    </div>
  </div>
</template>

<script>
import HistoricalItem from '../components/HistoricalItem.vue';

export default {
  name: 'FeedList',
  data() {
    return {

    }
  },
  props: {

  },
  computed: {

  },
  components: {
    HistoricalItem
  },
  methods: {

  }
}
</script>

<style scoped>
.feed-list {
  padding: 10px;
}

.home-text {
  font-weight: 700;
}

.items-container {
  max-width: 1000px;
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: wrap;
  margin: 0 auto;
}

@media (min-width: 768px) {
  .home-text {
    margin-top: 40px;
    margin-bottom: 40px;
  }
}
</style>