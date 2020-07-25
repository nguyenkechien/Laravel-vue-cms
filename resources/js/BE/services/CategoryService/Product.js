import http from "./../../http/http-common";

class CategoryProductService {
  async index() {
    try {
      return await http.get("category_products");
    } catch ({ response }) {
      if (response.status === 500) _vm.$router.push({name: 'Logout'})
    }
  }
  show(category) {}
  async create(category) {
    return await http.post("category_products", category);
  }
  async update(category) {
    console.log(category)
    return await http.put('category_products/' + category.id, category);
  }
  async destroy(id) {
    return await http.delete(`category_products/${id}`);
  }
}

export default new CategoryProductService();
