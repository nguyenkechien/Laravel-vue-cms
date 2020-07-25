import http from "./../http/http-common";

class BlogService {
  async index() {
    try {
      return await http.get("/posts");
    } catch ({ response }) {
      if (response.status === 500) _vm.$router.push({name: 'Logout'})
    }
  }
  show(post) { }
  async create(post) {
    return await http.post("/posts", post);
  }
  async update(post) {
    const data = {
      title: post.title,
      content: post.content,
      thumbnail_id: post.thumbnail_id,
      meta_title: post.meta_title,
      meta_description: post.meta_description,
      meta_keywords: post.meta_keywords,
      tags: post.tags,
      keywords: post.keywords,
      param: post.param,
      publish: post.publish,
      category_id: post.category_id,
      updated_at: post.updated_at
    };
    return await http.put("/posts/" + post.id, data);
  }
  async destroy(post) {
    return await http.delete(`/posts/${post.id}`);
  }
}

export default new BlogService();
