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
  async getAllUsersWithLimit(limit) {
    let users = [];
    await axios.post(url, {
      opcion:15,
      first_limit: limit - 1
    }).then(response =>{
      if(response.status == 200){
        users = response.data;
      } else {
        console.log('error');
      }
    });
    return users;
  },
  async getAllUsersByName(user) {
    let users = [];
    await axios.post(url, {
      opcion:14,
      user: user
    }).then(response =>{
      if(response.status == 200){
        users = response.data;
      } else {
        console.log('error');
      }
    });
    return users;
  },
  async getFollowedUsers(idUser) {
    let users = [];
    await axios.post(url, {
      opcion:4,
      id_user: idUser
    }).then(response =>{
      if(response.status == 200){
        users = response.data;
      } else {
        console.log('error');
      }
    });
    return users;
  },
  async getFollowersUsers(idUser) {
    let users = [];
    await axios.post(url, {
      opcion:6,
      id_user: idUser
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
  },
  async getNumFotosByUser(idUser) {
    let numFotos = 0;
    await axios.post(url, {
      opcion:13,
      id_user: idUser
    }).then(response =>{
      if(response.status == 200){
        numFotos = response.data[0].numFotos;
      } else {
        console.log('error');
      }
    });
    return numFotos;
  },
  async getNumFollowedUsers(idUser) {
    let numFollowedUsers = 0;
    await axios.post(url, {
      opcion:5,
      id_user: idUser
    }).then(response =>{
      if(response.status == 200){
        numFollowedUsers = response.data[0].numFollowedUsers;
      } else {
        console.log('error');
      }
    });
    return numFollowedUsers;
  },
  async getNumFollowersUsers(idUser) {
    let numFollowersUsers = 0;
    await axios.post(url, {
      opcion:7,
      id_user: idUser
    }).then(response =>{
      if(response.status == 200){
        numFollowersUsers = response.data[0].numFollowersUsers;
      } else {
        console.log('error');
      }
    });
    return numFollowersUsers;
  },
  async saveNewFollower(idUser, idFollowing) {
    let successSave = false;
    await axios.post(url, {
      opcion:3,
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
      opcion:9,
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
  async getListOfIds(idUser) {
    let idList = [];
    await axios.post(url, {
      opcion:8,
      id_user: idUser
    }).then(response =>{
      if(response.status == 200){
        idList = response.data;
      } else {
        console.log('error');
      }
    });
    return idList;
  },
  async getLastDayImage(date) {
    let lastDayImage = {};
    await axios.post(url, {
      opcion:10,
      date: date
    }).then(response =>{
      if(response.status == 200){
        lastDayImage = response.data;
      } else {
        console.log('error');
      }
    });
    return lastDayImage;
  },
  async getListFeedImages(idUser) {
    let feedImageList = [];
    await axios.post(url, {
      opcion:11,
      id_user: idUser
    }).then(response =>{
      if(response.status == 200){
        feedImageList = response.data;
      } else {
        console.log('error');
      }
    });
    return feedImageList;
  },
  async getListFeedImagesWithLimit(idUser, limit) {
    let feedImageListWithLimit = [];
    await axios.post(url, {
      opcion:12,
      id_user: idUser,
      first_limit: limit - 1
    }).then(response =>{
      if(response.status == 200){
        feedImageListWithLimit = response.data;
      } else {
        console.log('error');
      }
    });
    return feedImageListWithLimit;
  }
}