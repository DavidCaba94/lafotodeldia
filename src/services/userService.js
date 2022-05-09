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
      pass: form.pass
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
  }
}