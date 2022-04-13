<template>
  <div v-if="showImage">
    <DetailImage @closeFullImage="closeFullImage" />
  </div>
  <div class="historical">
    <div class="selector-tiempo">
      <div id="mes" class="item-tiempo" @click="setMes()">{{ mesSeleccionado }}</div>
      <div id="ano" class="item-tiempo" @click="setAno()">{{ anoSeleccionado }}</div>
    </div>
    <div class="items-container">
      <HistoricalItem 
        urlImage='https://neliosoftware.com/es/wp-content/uploads/sites/3/2018/07/aziz-acharki-549137-unsplash-1200x775.jpg'
        date='23/03/2022'
        username='username'
        @click="showFullImage()"
      />
      <HistoricalItem 
        urlImage='https://c.pxhere.com/photos/1d/87/adult_blur_camera_canon_capture_dslr_dslr_camera_fashion-1549227.jpg!d'
        date='24/03/2022'
        username='username'
        @click="showFullImage()"
      />
      <HistoricalItem 
        urlImage='https://images.unsplash.com/photo-1574217013471-c32c6846cef7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80'
        date='25/03/2022'
        username='username'
        @click="showFullImage()"
      />
      <HistoricalItem 
        urlImage='https://images.unsplash.com/photo-1606946887361-78feb162a525?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80'
        date='26/03/2022'
        username='username'
        @click="showFullImage()"
      />
    </div>
  </div>
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
      showImage: false
    }
  },
  components: {
    HistoricalItem,
    DetailImage
  },
  mounted() {
    this.mesSeleccionado = this.meses[this.mesActual];
    this.anoSeleccionado = this.anoActual;
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
    },
    selectAno(ano) {
      this.anoSeleccionado = ano;
      this.modalAnos = false;
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
  margin: 0 auto;
  margin-top: 100px;
  padding: 10px;
  background-color: #ffffff;
  border-radius: 5px;
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

@media (min-width: 768px) {
  .historical {
    padding-top: 90px;
  }
}
</style>
