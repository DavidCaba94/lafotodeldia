import axios from "axios";

var url = "https://davidcaballerocalvo.es/lafotodeldia/rest/";

export default {
  async uploadImage(form) {
    let uploadedImage;
    await axios.post(url + 'upload_image.php', {
      opcion:1,
      user: form.user,
      email: form.email
    }).then(response =>{
      if(response.status == 200){
        uploadedImage = response.data[0];
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
  }
}