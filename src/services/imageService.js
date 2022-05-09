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
  }
}