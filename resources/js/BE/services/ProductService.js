import http from "./../http/http-common";

class ProductService {
  async index() {
    try {
      return await http.get("/products");
    } catch ({ response }) {
      if (response.status === 500) _vm.$router.push({name: 'Logout'})
    }
  }
  show(product) {}
  async create(product) {
    const data = {
      title: product.title,
      content: product.content,
      price: product.price,
      thumbnail_id: product.thumbnail_id,
      meta_title: product.meta_title,
      meta_description: product.meta_description,
      meta_keywords: product.meta_keywords,
      tags: product.tags,
      keywords: product.keywords,
      param: product.param,
      publish: product.publish,
      category_products_id: product.category_products_id,
    };
    return await http.post("/products", data);
  }
  async update(product) {
    const data = {
      title: product.title,
      content: product.content,
      price: product.price,
      thumbnail_id: product.thumbnail_id,
      meta_title: product.meta_title,
      meta_description: product.meta_description,
      meta_keywords: product.meta_keywords,
      tags: product.tags,
      keywords: product.keywords,
      param: product.param,
      publish: product.publish,
      category_products_id: product.category_products_id,
      updated_at: product.updated_at
    };
    return await http.put("/products/" + product.id, data);
  }
  async destroy(product) {
    return await http.delete(`/products/${product.id}`);
  }
}

export default new ProductService();
