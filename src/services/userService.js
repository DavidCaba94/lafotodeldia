import axios from "axios";

var url = "https://davidcaballerocalvo.es/lafotodeldia/rest/users.php";

export default {
  async getAllUsers() {
    await axios.post(url, {
      opcion:1
    }).then(response =>{
      if(response.status == 200){
        console.log(response.data);
      } else {
        console.log('error');
      }
    });
  },
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
  }
}