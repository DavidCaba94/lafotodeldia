<template>
  <div class="moderate">
    <p class="moderate-text">Tú decides con tu voto si esta imagen merece ser La Foto del Día</p>
    <div class="items-container">
      <ModerateItem 
        :urlImage="urlImage"
        :date="date"
        :username="username"
      />
    </div>
    <div class="vote-container">
      <div class="vote-button" @click="votar('OK')">
        <img src="../assets/img/like-up.png">
      </div>
      <div class="vote-button" @click="votar('KO')">
        <img src="../assets/img/like-down.png">
      </div>
    </div>
  </div>
</template>

<script>
import ModerateItem from '../components/ModerateItem.vue';

export default {
  data() {
    return {
      idFoto: 0,
      urlImage: 'https://images.unsplash.com/photo-1574217013471-c32c6846cef7?ixlib: rb-1.2.1&ixid: MnwxMjA3fDB8MHxzZWFyY2h8MXx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80',
      date: '25/03/2022',
      username: 'username'
    }
  },
  components: {
    ModerateItem
  },
  methods: {
    getFoto() {
      //cargar nueva foto siguiente al ultimo id guardado en el storage
    },
    votar(voto) {
      console.log(voto);
      //guardar voto en bbdd
      this.setLastVote(this.idFoto);
      this.animationVote(voto);
    },
    setLastVote(id) {
      console.log(id);
      //guardar en storage el ultimo id de la foto votada
    },
    animationVote(voto) {
      console.log(voto);
      this.getFoto();
    }
  }
}
</script>

<style scoped>
.moderate {
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

.vote-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
}

.vote-button {
  width: 40px;
  height: 40px;
  padding: 10px;
  background-color: #ffffff;
  border-radius: 50px;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
  margin: 30px;
  cursor: pointer;
}

.vote-button img {
  width: 30px;
  margin-top: 5px;
}

@media (min-width: 768px) {
  .moderate-text {
    margin-top: 40px;
    margin-bottom: 40px;
  }
}
</style>