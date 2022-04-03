<template>
  <div class="historical">
    HISTORIAL
    <div class="items-container">
      <HistoricalItem 
        urlImage='https://neliosoftware.com/es/wp-content/uploads/sites/3/2018/07/aziz-acharki-549137-unsplash-1200x775.jpg'
        date='23/03/2022'
        username='username'
      />
      <HistoricalItem 
        urlImage='https://c.pxhere.com/photos/1d/87/adult_blur_camera_canon_capture_dslr_dslr_camera_fashion-1549227.jpg!d'
        date='24/03/2022'
        username='username'
      />
      <HistoricalItem 
        urlImage='https://images.unsplash.com/photo-1574217013471-c32c6846cef7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80'
        date='25/03/2022'
        username='username'
      />
      <HistoricalItem 
        urlImage='https://images.unsplash.com/photo-1606946887361-78feb162a525?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80'
        date='26/03/2022'
        username='username'
      />
    </div>
  </div>
</template>

<script>
import HistoricalItem from '../components/HistoricalItem.vue';

export default {
  components: {
    HistoricalItem
  }
}
</script>

<style scoped>
.historical {
  padding: 10px;
  padding-top: 70px;
  padding-bottom: 90px;
}

.items-container {
  max-width: 1000px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  margin: 0 auto;
}

@media (min-width: 768px) {
  .historical {
    padding-top: 90px;
  }
}
</style>
