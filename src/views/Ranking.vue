<template>
  <div class="ranking">
    <div class="fecha-actual">{{ diaActual }}/{{ mesActual }}/{{ anoActual }}</div>
    <div class="items-container">
      <RankingItem 
        urlImage='https://neliosoftware.com/es/wp-content/uploads/sites/3/2018/07/aziz-acharki-549137-unsplash-1200x775.jpg'
        username='username'
        order="1"
        likes="7383"
      />
      <RankingItem 
        urlImage='https://c.pxhere.com/photos/1d/87/adult_blur_camera_canon_capture_dslr_dslr_camera_fashion-1549227.jpg!d'
        username='username'
        order="2"
        likes="646"
      />
      <RankingItem 
        urlImage='https://images.unsplash.com/photo-1574217013471-c32c6846cef7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80'
        username='username'
        order="3"
        likes="54"
      />
      <RankingItem 
        urlImage='https://images.unsplash.com/photo-1606946887361-78feb162a525?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80'
        username='username'
        order="4"
        likes="2"
      />
    </div>
  </div>
</template>

<script>
import RankingItem from '../components/RankingItem.vue';

export default {
  data() {
    return {
      diaActual: new Date().getDate(),
      mesActual: new Date().getMonth(),
      anoActual: new Date().getFullYear()
    }
  },
  components: {
    RankingItem
  }
}
</script>

<style scoped>
.ranking {
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

.fecha-actual {
  width: 90%;
  max-width: 900px;
  margin: auto;
  margin-top: 10px;
  margin-bottom: 10px;
  font-weight: 500;
  font-size: 20px;
  color: #000000;
  background-color: #f0f0f0;
  border-radius: 5px;
  padding: 5px;
}

@media (min-width: 768px) {
  .ranking {
    padding-top: 90px;
  }
}
</style>
