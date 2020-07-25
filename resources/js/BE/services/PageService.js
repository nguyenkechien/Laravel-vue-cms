import http from "./../http/http-common";

class PageService {
  async index() {
    try {
      return await http.get("/pages");
    } catch ({ response }) {
      if (response.status === 500) _vm.$router.push({name: 'Logout'})
    }
  }
  show(page) { }
  async create(page) {
    return await http.post("/pages", page);
  }
  async update(page) {
    const data = {
      name: page.name,
      content: page.content,
      param: page.param,
      meta_title: page.meta_title,
      meta_description: page.meta_description,
      meta_keywords: page.meta_keywords,
      meta_thumbnail: page.meta_thumbnail,
      updated_at: page.updated_at
    };
    return await http.put("/pages/" + page.id, data);
  }
  async destroy(page) {
    return await http.delete(`/pages/${page.id}`);
  }
}

export default new PageService();
