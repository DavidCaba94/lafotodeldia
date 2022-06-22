import axios from "axios";

var url = "https://davidcaballerocalvo.es/lafotodeldia/rest/";

export default {
  async uploadImage(file) {
    let uploadedImage;
    await axios.post(url + 'upload_image.php', file).then(response =>{
      if(response.status == 200){
        uploadedImage = response.data;
      } else {
        console.log('error');
      }
    });
    return uploadedImage;
  },
  async uploadProfileImage(file) {
    let uploadedProfileImage;
    await axios.post(url + 'upload_perfil_image.php', file).then(response =>{
      if(response.status == 200){
        uploadedProfileImage = response.data;
      } else {
        console.log('error');
      }
    });
    return uploadedProfileImage;
  },
  async saveImage(form) {
    let successSave = false;
    await axios.post(url + 'images.php', {
      opcion:2, 
      id_user: form.id_user,
      url: form.url, 
      likes: form.likes,
      date: form.date
    }).then(response =>{
      if(response.status == 200){
        successSave = true;
      } else {
        console.log('error');
      }
    });
    return successSave;
  },
  async getAllImagesByUser(id_user) {
    let imagesArray = [];
    await axios.post(url + 'images.php', {
      opcion:3,
      id_user: id_user
    }).then(response =>{
      if(response.status == 200){
        imagesArray = response.data;
      } else {
        console.log('error');
      }
    });
    return imagesArray;
  },
  async getFirstNineImagesByUser(id_user) {
    let imagesArray = [];
    await axios.post(url + 'images.php', {
      opcion:4,
      id_user: id_user
    }).then(response =>{
      if(response.status == 200){
        imagesArray = response.data;
      } else {
        console.log('error');
      }
    });
    return imagesArray;
  },
  async getImagesByDate(date) {
    let imagesArray = [];
    await axios.post(url + 'images.php', {
      opcion:5,
      date: date
    }).then(response =>{
      if(response.status == 200){
        imagesArray = response.data;
      } else {
        console.log('error');
      }
    });
    return imagesArray;
  },
  async getImagesByDateRange(dateIni, dateFin) {
    let imagesArray = [];
    await axios.post(url + 'images.php', {
      opcion:6,
      date_ini: dateIni,
      date_fin: dateFin
    }).then(response =>{
      if(response.status == 200){
        imagesArray = response.data;
      } else {
        console.log('error');
      }
    });
    return imagesArray;
  },
  async deleteImageById(idImage) {
    let successDelete = false;
    await axios.post(url + 'images.php', {
      opcion:7,
      id: idImage
    }).then(response =>{
      if(response.status == 200){
        successDelete = true;
      } else {
        console.log('error');
      }
    });
    return successDelete;
  },
  async getAllImagesOfToday(date) {
    let imagesArray = [];
    await axios.post(url + 'images.php', {
      opcion:8,
      date: date
    }).then(response =>{
      if(response.status == 200){
        imagesArray = response.data;
      } else {
        console.log('error');
      }
    });
    return imagesArray;
  },
  async getLastImageVotedByUser(id_user) {
    let idImage;
    await axios.post(url + 'images.php', {
      opcion:9,
      id_user: id_user
    }).then(response =>{
      if(response.status == 200){
        if(response.data.length > 0){
          idImage = response.data[0].id_image;
        } else {
          this.setLastImageVotedByUser(id_user);
        }
      } else {
        console.log('error');
      }
    });
    return idImage;
  },
  async setLastImageVotedByUser(id_user) {
    let successSet = false;
    await axios.post(url + 'images.php', {
      opcion:10,
      id_user: id_user
    }).then(response =>{
      if(response.status == 200){
        successSet = true;
      } else {
        console.log('error');
      }
    });
    return successSet;
  },
  async getNextImageToVote(id_image) {
    let image;
    let diaActual = new Date().getDate();
    let mesActual = new Date().getMonth();
    let anoActual = new Date().getFullYear();
    await axios.post(url + 'images.php', {
      opcion:11,
      id_image: id_image,
      date: anoActual + '-' + (mesActual + 1) + '-' + diaActual
    }).then(response =>{
      if(response.status == 200){
        if(response.data.length > 0){
          image = response.data[0];
        } else {
          image = null
        }
      } else {
        console.log('error');
      }
    });
    return image;
  },
  async updateLastImageVotedByUser(id_user, id_image) {
    let successSet = false;
    await axios.post(url + 'images.php', {
      opcion:12,
      id_user: id_user,
      id_image: id_image
    }).then(response =>{
      if(response.status == 200){
        successSet = true;
      } else {
        console.log('error');
      }
    });
    return successSet;
  },
  async updateImageVoted(id_image) {
    let successSet = false;
    await axios.post(url + 'images.php', {
      opcion:13,
      id_image: id_image
    }).then(response =>{
      if(response.status == 200){
        successSet = true;
      } else {
        console.log('error');
      }
    });
    return successSet;
  },
  async getFotoOfTheMonth(dateIni, dateFin) {
    let image;
    await axios.post(url + 'images.php', {
      opcion:14,
      date_ini: dateIni,
      date_fin: dateFin
    }).then(response =>{
      if(response.status == 200){
        if(response.data.length > 0){
          image = response.data[0];
        } else {
          image = null
        }
      } else {
        console.log('error');
      }
    });
    return image;
  },
  async getWinnersOfMonth(dateIni, dateFin) {
    let imagesArray = [];
    await axios.post(url + 'images.php', {
      opcion:15,
      date_ini: dateIni,
      date_fin: dateFin
    }).then(response =>{
      if(response.status == 200){
        imagesArray = response.data;
      } else {
        console.log('error');
      }
    });
    return imagesArray;
  },
  async getMostVotedImageOfDay(date) {
    let imagesArray = [];
    await axios.post(url + 'images.php', {
      opcion:16,
      date: date
    }).then(response =>{
      if(response.status == 200){
        imagesArray = response.data;
      } else {
        console.log('error');
      }
    });
    return imagesArray;
  },
  async getImageById(idFoto) {
    let imagesArray = [];
    await axios.post(url + 'images.php', {
      opcion:17,
      id: idFoto
    }).then(response =>{
      if(response.status == 200){
        imagesArray = response.data;
      } else {
        console.log('error');
      }
    });
    return imagesArray;
  },
  async updateMostVotedImageOfDay(idFoto, date) {
    let successSave = false;
    await axios.post(url + 'images.php', {
      opcion:18,
      id_image: idFoto,
      date: date
    }).then(response =>{
      if(response.status == 200){
        successSave = true;
      } else {
        console.log('error');
      }
    });
    return successSave;
  },
  async setMostVotedImageOfDay(idFoto, date) {
    let successSave = false;
    await axios.post(url + 'images.php', {
      opcion:19,
      id_image: idFoto,
      date: date
    }).then(response =>{
      if(response.status == 200){
        successSave = true;
      } else {
        console.log('error');
      }
    });
    return successSave;
  }
}