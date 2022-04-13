<template>
  <div class="detail-image">
    <div class="close-box">
      <img class="close" @click="closeFullImage()" src="../assets/img/close.png">
    </div>
    <div class="img-container">
      <img class="img-show" src="https://images.unsplash.com/photo-1606946887361-78feb162a525?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Zm90b3xlbnwwfHwwfHw%3D&w=1000&q=80">
    </div>
  </div>
</template>

<script>
export default {
  name: 'DetailImage',
  data() {
    return {

    }
  },
  computed: {

  },
  methods: {
    closeFullImage() {
      this.$emit('closeFullImage');
    }
  }
}
</script>

<style scoped>
.detail-image {
  width: 100%;
  height: 100vh;
  background-color: #ffffff50;
  -webkit-backdrop-filter: blur(5px);
  backdrop-filter: blur(5px);
  position: fixed;
  top: 0;
}

.close-box {
  width: 95%;
  text-align: right;
}

.close {
  width: 20px;
  margin-top: 20px;
  margin-right: 10px;
  cursor: pointer;
}

.img-container {
  margin-top: 20px;
  padding: 10px;
}

.img-show {
  width: 90%;
  max-width: 600px;
  border-radius: 5px;
}
</style>