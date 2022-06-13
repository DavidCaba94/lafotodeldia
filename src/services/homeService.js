import axios from "axios";

var url = "https://davidcaballerocalvo.es/lafotodeldia/rest/home.php";

export default {
  async getAllUsers() {
    let users = [];
    await axios.post(url, {
      opcion:1
    }).then(response =>{
      if(response.status == 200){
        users = response.data;
      } else {
        console.log('error');
      }
    });
    return users;
  },
  async getNumUsers() {
    let numUsers = 0;
    await axios.post(url, {
      opcion:2
    }).then(response =>{
      if(response.status == 200){
        numUsers = response.data[0].numUsers;
      } else {
        console.log('error');
      }
    });
    return numUsers;
  }
}