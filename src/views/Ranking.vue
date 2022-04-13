<template>
  <div v-if="showImage">
    <DetailImage @closeFullImage="closeFullImage" />
  </div>
  <div class="ranking">
    <div class="selector-tiempo">
      <div id="dia" class="item-tiempo" @click="tiempoSeleccionado = 'dia'; setTabValue()">Día</div>
      <div id="mes" class="item-tiempo" @click="tiempoSeleccionado = 'mes'; setTabValue()">Mes</div>
      <div id="ano" class="item-tiempo" @click="tiempoSeleccionado = 'ano'; setTabValue()">Año</div>
    </div>
    <div class="fecha-actual">{{ finalTimeLabel }}</div>
    <div class="items-container">
      <RankingItem 
        urlImage='https://neliosoftware.com/es/wp-content/uploads/sites/3/2018/07/aziz-acharki-549137-unsplash-1200x775.jpg'
        username='username'
        order="1"
        likes="7383"
        @click="showFullImage()"
      />
      <RankingItem 
        urlImage='https://c.pxhere.com/photos/1d/87/adult_blur_camera_canon_capture_dslr_dslr_camera_fashion-1549227.jpg!d'
        username='username'
        order="2"
        likes="646"
        @click="showFullImage()"
      />
      <RankingItem 
        urlImage='https://images.unsplash.com/photo-1574217013471-c32c6846cef7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80'
        username='username'
        order="3"
        likes="54"
        @click="showFullImage()"
      />
      <RankingItem 
        urlImage='https://images.unsplash.com/photo-1606946887361-78feb162a525?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80'
        username='username'
        order="4"
        likes="2"
        @click="showFullImage()"
      />
    </div>
  </div>
</template>

<script>
import RankingItem from '../components/RankingItem.vue';
import DetailImage from '../components/DetailImage.vue';

export default {
  data() {
    return {
      meses: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      diaActual: new Date().getDate(),
      mesActual: new Date().getMonth(),
      anoActual: new Date().getFullYear(),
      tiempoSeleccionado: 'dia',
      finalTimeLabel: '',
      showImage: false
    }
  },
  components: {
    RankingItem,
    DetailImage
  },
  mounted() {
    this.setTabValue();
  },
  methods: {
    setTabValue() {
      document.getElementById("dia").classList.remove("tiempo-seleccionado");
      document.getElementById("mes").classList.remove("tiempo-seleccionado");
      document.getElementById("ano").classList.remove("tiempo-seleccionado");
      document.getElementById(this.tiempoSeleccionado).classList.add("tiempo-seleccionado");
      this.setLabelValue(this.tiempoSeleccionado);
    },
    setLabelValue(t) {
      switch(t) {
        case 'dia':
          this.finalTimeLabel = this.diaActual + ' de ' + this.meses[this.mesActual] + ' de ' + this.anoActual;
          break;
        case 'mes':
          this.finalTimeLabel = this.meses[this.mesActual];
          break;
        case 'ano':
          this.finalTimeLabel = this.anoActual;
          break;
      }
    },
    showFullImage() {
      this.showImage = true;
    },
    closeFullImage() {
      this.showImage = false;
    }
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
  max-width: 280px;
  margin: auto;
  margin-top: 10px;
  margin-bottom: 10px;
  font-weight: 500;
  font-size: 20px;
  color: #000000;
  border: 1px solid #f0f0f0;
  border-radius: 5px;
  padding: 5px;
}

.selector-tiempo {
  max-width: 900px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
}

.item-tiempo {
  width: 33%;
  border-radius: 5px;
  padding: 5px;
  cursor: pointer;
}

.tiempo-seleccionado {
  background-color: #f0f0f0;
}

@media (min-width: 768px) {
  .ranking {
    padding-top: 90px;
  }
}
</style>
