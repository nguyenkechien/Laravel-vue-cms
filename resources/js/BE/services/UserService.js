import http from "./../http/http-common";

class UserService {
  async index() {
    try {
      return await http.get("/user");
    } catch ({ response }) {
      if (response.status === 500) _vm.$router.push({name: 'Logout'})
    }
  }
}

export default new UserService();
