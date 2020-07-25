import http from "../http/http-common";

class UploadFilesService {
  async getFiles() {
    try {
      return await http.get("/assets");
    } catch ({ response }) {
      if (response.status === 500) _vm.$router.push({name: 'Logout'})
    }
  }

  async upload(files, onUploadProgress) {
    let formData = new FormData();
    for (let file of files) {
      formData.append("photos[]", file);
    };

    return await http.post("/assets", formData, {
      headers: {
        "Content-Type": "multipart/form-data"
      },
      onUploadProgress
    });
  }

  async deleteFile(fileName, onUploadProgress) {
    return await http.delete(`/assets/${fileName}`, onUploadProgress)
  }
}

export default new UploadFilesService();
