<template>
  <div v-if="showImage">
    <DetailImage
    :imageData="selectedShowImage"
    @closeFullImage="closeFullImage" />
  </div>
  <div class="historical">
    <div class="selector-tiempo">
      <div id="mes" class="item-tiempo" @click="setMes()">{{ mesSeleccionado }}</div>
      <div id="ano" class="item-tiempo" @click="setAno()">{{ anoSeleccionado }}</div>
    </div>
    <div class="items-container" v-if="fotoOfTheMonth !== null">
      <div class="month-photo-item" @click="showFullImage(fotoOfTheMonth)">
        <div class="img-container">
            <img :src="fotoOfTheMonth.url">
        </div>
        <div class="username-container">
          <img src="../assets/img/verified.png" v-if="fotoOfTheMonth.verificado">
          @{{ fotoOfTheMonth.user }}
        </div>
        <div class="date-container">{{ 'Foto del mes de ' + mesSeleccionado }}</div>
        <div class="likes-container">
          <img src="../assets/img/like-up.png">
          <div>{{ fotoOfTheMonth.likes }}</div>
        </div>
      </div>
      <HistoricalItem v-for="(image) of winnersOfMonth" :key="image.id"
        :urlImage="image.url"
        :date='image.date'
        :username='image.user'
        :likes='image.likes'
        :verificado="image.verificado"
        @click="showFullImage(image)"
      />
    </div>
    <div v-if="fotoOfTheMonth === null">
      <img class="img-no-photos" src="../assets/img/photos-icon.png">
      <p>No hay fotos para este mes</p>
    </div>
  </div>
  <div class="lds-ellipsis" v-if="loading"><div></div><div></div><div></div><div></div></div>
  <div class="modal-fecha" v-if="modalMeses">
    <div class="lista-fecha">
      <div class="item-fecha" v-for="(mes, index) in meses" v-bind:key="index" @click="selectMes(mes)">
        {{ mes }}
      </div>
    </div>
  </div>
  <div class="modal-fecha" v-if="modalAnos">
    <div class="lista-fecha">
      <div class="item-fecha" v-for="(ano, index) in anos" v-bind:key="index" @click="selectAno(ano)">
        {{ ano }}
      </div>
    </div>
  </div>
</template>

<script>
import HistoricalItem from '../components/HistoricalItem.vue';
import DetailImage from '../components/DetailImage.vue';
import imageService from '../services/imageService.js';

export default {
  data() {
    return {
      meses: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      anos: ['2022', '2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030', '2031', '2032'],
      mesActual: new Date().getMonth(),
      anoActual: new Date().getFullYear(),
      mesSeleccionado: '',
      anoSeleccionado: '',
      modalMeses: false,
      modalAnos: false,
      showImage: false,
      selectedShowImage: {},
      fotoOfTheMonth: {},
      winnersOfMonth: [],
      loading: false
    }
  },
  components: {
    HistoricalItem,
    DetailImage
  },
  mounted() {
    this.mesSeleccionado = this.meses[this.mesActual];
    this.anoSeleccionado = this.anoActual;
    this.loading = true;
    this.getFotoOfTheMonth(this.mesActual, this.anoActual);
    this.getWinnersOfMonth(this.mesActual, this.anoActual);
  },
  methods: {
    setMes() {
      this.modalMeses = true;
    },
    setAno() {
      this.modalAnos = true;
    },
    selectMes(mes) {
      this.mesSeleccionado = mes;
      this.modalMeses = false;
      this.getFotoOfTheMonth(this.meses.indexOf(mes), this.anoSeleccionado);
      this.getWinnersOfMonth(this.meses.indexOf(mes), this.anoSeleccionado);
    },
    selectAno(ano) {
      this.anoSeleccionado = ano;
      this.modalAnos = false;
      this.getFotoOfTheMonth(this.meses.indexOf(this.mesSeleccionado), ano);
      this.getWinnersOfMonth(this.meses.indexOf(this.mesSeleccionado), ano);
    },
    showFullImage(img) {
      this.selectedShowImage.urlImage = img.url;
      this.selectedShowImage.userName = img.user;
      this.selectedShowImage.urlProfile = img.foto;
      this.selectedShowImage.userId = img.id_user;
      this.selectedShowImage.likesImage = img.likes;
      this.showImage = true;
    },
    closeFullImage() {
      this.showImage = false;
    },
    async getFotoOfTheMonth(mes, ano) {
      this.fotoOfTheMonth = await imageService.getFotoOfTheMonth(ano + '-' + (mes + 1) + '-01', ano + '-' + (mes + 1) + '-' + this.getLastDayOfMonth(mes, ano));
      this.loading = false;
    },
    async getWinnersOfMonth(mes, ano) {
      this.winnersOfMonth = await imageService.getWinnersOfMonth(ano + '-' + (mes + 1) + '-01', ano + '-' + (mes + 1) + '-' + this.getLastDayOfMonth(mes, ano));
    },
    getLastDayOfMonth(mes, ano) {
      return new Date(ano, mes + 1, 0).getDate();
    }
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

.selector-tiempo {
  max-width: 900px;
  margin: 0 auto;
  margin-top: 20px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: nowrap;
}

.item-tiempo {
  width: 40%;
  background-color: #f0f0f0;
  border-radius: 5px;
  padding: 5px;
  cursor: pointer;
}

.modal-fecha {
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  padding: 10px;
  background-color: #7a7a7a2b;
}

.lista-fecha {
  width: 250px;
  max-height: 400px;
  margin: 0 auto;
  margin-top: 100px;
  padding: 10px;
  background-color: #ffffff;
  border-radius: 5px;
  overflow-x: hidden;
  overflow-y: scroll;
}

.item-fecha {
  padding: 10px;
  border-bottom: 1px solid #f0f0f0;
  cursor: pointer;
  border-radius: 5px;
}

.item-fecha:hover {
  background-color: #f0f0f0;
}

.item-fecha:last-child {
  border-bottom: 0px;
}

.month-photo-item {
  width: 90%;
  background-color: #ffffff;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  cursor: pointer;
  margin: 5px;
  border-radius: 5px;
  border: 3px solid #238fff;
}

.month-photo-item .img-container img {
    width: 95%;
    border-radius: 5px;
    margin-top: 10px;
}

.month-photo-item .username-container {
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

.month-photo-item .username-container img {
  width: 20px;
  margin-right: 5px;
}

.month-photo-item .date-container {
    font-weight: 300;
    font-size: 18px;
    margin-top: 10px;
    margin-bottom: 10px;
    text-align: center;
}

.img-no-photos {
  width: 150px;
  opacity: 0.3;
  margin-top: 100px;
}

.likes-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
  margin-bottom: 10px;
}

.likes-container img {
  width: 20px;
}

@media (min-width: 768px) {
  .historical {
    padding-top: 90px;
  }

  .month-photo-item .img-container img {
    margin-top: 20px;
  }
}

/* LOADER */
.lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 20px;
  margin-top: 120px;
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
