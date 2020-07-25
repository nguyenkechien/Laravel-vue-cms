import http from "./../../http/http-common";

class CategoryBlogService {
  async index() {
    try {
      return await http.get("/category");
    } catch ({ response }) {
      if (response.status === 500) _vm.$router.push({name: 'Logout'})
    }
  }
  show(category) {}
  async create(category) {
    return await http.post("/category", category);
  }
  async update(category) {
    return await http.put('/category/' + category.id, category);
  }
  async destroy(id) {
    return await http.delete(`/category/${id}`);
  }
}

export default new CategoryBlogService();
