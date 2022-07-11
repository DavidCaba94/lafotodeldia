import axios from "axios";

var url = "https://davidcaballerocalvo.es/lafotodeldia/rest/users.php";
var urlMail = "https://davidcaballerocalvo.es/lafotodeldia/rest/send_mail_verify.php";

export default {
  async getUserByNameOrEmail(form) {
    let finalUser;
    await axios.post(url, {
      opcion:3,
      user: form.user,
      email: form.email
    }).then(response =>{
      if(response.status == 200){
        finalUser = response.data[0];
      } else {
        console.log('error');
      }
    });
    return finalUser;
  },
  async getUserByLogin(form) {
    let finalUser;
    await axios.post(url, {
      opcion:4,
      user: form.user,
      pass: form.pass
    }).then(response =>{
      if(response.status == 200){
        finalUser = response.data[0];
      } else {
        console.log('error');
      }
    });
    return finalUser;
  },
  async getUserById(id) {
    let finalUser;
    await axios.post(url, {
      opcion:6,
      id: id
    }).then(response =>{
      if(response.status == 200){
        finalUser = response.data[0];
      } else {
        console.log('error');
      }
    });
    return finalUser;
  },
  async getUserByIdNoPass(id) {
    let finalUser;
    await axios.post(url, {
      opcion:11,
      id: id
    }).then(response =>{
      if(response.status == 200){
        finalUser = response.data[0];
      } else {
        console.log('error');
      }
    });
    return finalUser;
  },
  async registrarUsuario(form) {
    let successReg = false;
    await axios.post(url, {
      opcion:2, 
      user: form.user,
      email: form.email, 
      pass: form.pass,
      foto: 'https://davidcaballerocalvo.es/lafotodeldia/rest/perfil-images/default-user-img.svg'
    }).then(response =>{
      if(response.status == 200){
        successReg = true;
      } else {
        console.log('error');
      }
    });
    return successReg;
  },
  async updateFotoUsuario(form) {
    let successUpdate = false;
    await axios.post(url, {
      opcion:5, 
      id: form.id,
      foto: form.foto
    }).then(response =>{
      if(response.status == 200){
        successUpdate = true;
      } else {
        console.log('error');
      }
    });
    return successUpdate;
  },
  async saveNewFollower(idUser, idFollowing) {
    let successSave = false;
    await axios.post(url, {
      opcion:7,
      id_user: idUser,
      id_following: idFollowing
    }).then(response =>{
      if(response.status == 200){
        successSave = true;
      } else {
        console.log('error');
      }
    });
    return successSave;
  },
  async deleteFollowing(idUser, idFollowing) {
    let successDelete = false;
    await axios.post(url, {
      opcion:8,
      id_user: idUser,
      id_following: idFollowing
    }).then(response =>{
      if(response.status == 200){
        successDelete = true;
      } else {
        console.log('error');
      }
    });
    return successDelete;
  },
  async getIsFollowing(idUser, idFollowing) {
    let idList = [];
    await axios.post(url, {
      opcion:9,
      id_user: idUser,
      id_following: idFollowing
    }).then(response =>{
      if(response.status == 200){
        idList = response.data;
      } else {
        console.log('error');
      }
    });
    return idList;
  },
  async updatePassUsuario(id, pass) {
    let successUpdate = false;
    await axios.post(url, {
      opcion:10, 
      id: id,
      pass: pass
    }).then(response =>{
      if(response.status == 200){
        successUpdate = true;
      } else {
        console.log('error');
      }
    });
    return successUpdate;
  },
  async getPhotosOfDay(idUser) {
    let numPhotos = 0;
    await axios.post(url, {
      opcion:12,
      id: idUser
    }).then(response =>{
      if(response.status == 200){
        numPhotos = response.data[0].numPhotosOfDay;
      } else {
        console.log('error');
      }
    });
    return numPhotos;
  },
  async getPhotosOfMonth(idUser) {
    let numPhotos = 0;
    await axios.post(url, {
      opcion:13,
      id: idUser
    }).then(response =>{
      if(response.status == 200){
        numPhotos = response.data[0].numPhotosOfMonth;
      } else {
        console.log('error');
      }
    });
    return numPhotos;
  },
  async getPhotosOfYear(idUser) {
    let numPhotos = 0;
    await axios.post(url, {
      opcion:14,
      id: idUser
    }).then(response =>{
      if(response.status == 200){
        numPhotos = response.data[0].numPhotosOfYear;
      } else {
        console.log('error');
      }
    });
    return numPhotos;
  },
  async sendVerificationEmail(email, code, user) {
    let successSend = false;
    await axios.post(urlMail, {
      email: email,
      code: code,
      user: user
    }).then(response =>{
      if(response.status == 200){
        successSend = true;
      }
    });
    return successSend;
  },
  async updateVerificadoUsuario(idUser) {
    let successUpdate = false;
    await axios.post(url, {
      opcion:15, 
      id: idUser
    }).then(response =>{
      if(response.status == 200){
        successUpdate = true;
      } else {
        console.log('error');
      }
    });
    return successUpdate;
  },
  async updateEmailUsuario(idUser, email) {
    let successUpdate = false;
    await axios.post(url, {
      opcion:16, 
      id: idUser,
      email: email
    }).then(response =>{
      if(response.status == 200){
        successUpdate = true;
      } else {
        console.log('error');
      }
    });
    return successUpdate;
  },
  async updateInstagramUsuario(idUser, instagram) {
    let successUpdate = false;
    await axios.post(url, {
      opcion:17, 
      id: idUser,
      instagram: instagram
    }).then(response =>{
      if(response.status == 200){
        successUpdate = true;
      } else {
        console.log('error');
      }
    });
    return successUpdate;
  }
}