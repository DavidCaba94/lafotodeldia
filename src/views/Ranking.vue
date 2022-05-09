<template>
  <div v-if="showImage">
    <DetailImage
    :imageData="selectedShowImage"
    @closeFullImage="closeFullImage" />
  </div>
  <div class="ranking">
    <div class="selector-tiempo">
      <div id="dia" class="item-tiempo" @click="tiempoSeleccionado = 'dia'; setTabValue()">Día</div>
      <div id="mes" class="item-tiempo" @click="tiempoSeleccionado = 'mes'; setTabValue()">Mes</div>
      <div id="ano" class="item-tiempo" @click="tiempoSeleccionado = 'ano'; setTabValue()">Año</div>
    </div>
    <div class="fecha-actual">{{ finalTimeLabel }}</div>
    <div class="items-container" v-if="!loading">
      <RankingItem v-for="(image, index) of imagesArray" :key="image.id"
        :urlImage="image.url"
        :username="image.user"
        :order="index + 1"
        :likes="image.likes"
        @click="showFullImage(image)"
      />
    </div>
    <div class="lds-ellipsis" v-if="loading"><div></div><div></div><div></div><div></div></div>
    <p v-if="!loading && imagesArray.length === 0">No hay fotos para mostrar en esta fecha.</p>
  </div>
</template>

<script>
import RankingItem from '../components/RankingItem.vue';
import DetailImage from '../components/DetailImage.vue';
import imageService from '../services/imageService.js';

export default {
  data() {
    return {
      meses: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      diaActual: new Date().getDate(),
      mesActual: new Date().getMonth(),
      anoActual: new Date().getFullYear(),
      tiempoSeleccionado: 'dia',
      finalTimeLabel: '',
      showImage: false,
      imagesArray: [],
      loading: false,
      selectedShowImage: {}
    }
  },
  components: {
    RankingItem,
    DetailImage
  },
  mounted() {
    this.setTabValue();
    this.getAllImagesByDate(this.anoActual + '-' + (this.mesActual + 1) + '-' + this.diaActual);
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
          this.getAllImagesByDate(this.anoActual + '-' + (this.mesActual + 1) + '-' + this.diaActual);
          break;
        case 'mes':
          this.finalTimeLabel = this.meses[this.mesActual];
          this.getAllImagesByDateRange(this.anoActual + '-' + (this.mesActual + 1) + '-01', this.anoActual + '-' + (this.mesActual + 1) + '-' + this.getLastDayOfMonth(this.mesActual, this.anoActual));
          break;
        case 'ano':
          this.finalTimeLabel = this.anoActual;
          this.getAllImagesByDateRange(this.anoActual + '-01-01', this.anoActual + '-12-31');
          break;
      }
    },
    async getAllImagesByDate(dateToSend) {
      this.loading = true;
      this.imagesArray = await imageService.getImagesByDate(dateToSend);
      this.loading = false;
    },
    async getAllImagesByDateRange(dateIni, dateFin) {
      this.loading = true;
      this.imagesArray = await imageService.getImagesByDateRange(dateIni, dateFin);
      this.loading = false;
    },
    getLastDayOfMonth(mes, ano) {
      return new Date(ano, mes + 1, 0).getDate();
    },
    showFullImage(image) {
      this.selectedShowImage.urlImage = image.url;
      this.selectedShowImage.userName = image.user;
      this.selectedShowImage.urlProfile = image.foto;
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
  margin-top: 20px;
  margin-bottom: 20px;
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
  padding: 5px;
  padding-bottom: 7px;
  cursor: pointer;
}

.tiempo-seleccionado {
  border-bottom: 2px solid #238fff;
}

@media (min-width: 768px) {
  .ranking {
    padding-top: 90px;
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
