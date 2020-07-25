import http from "./../http/http-common";

class BlockService {
  async index() {
    try {
      return await http.get("/blocks");
    } catch ({ response }) {
      if (response.status === 500) _vm.$router.push({name: 'Logout'})
    }
  }
  show(block) { }
  async create(block) {
    return await http.post("/blocks", block);
  }
  async update(block) {
    const data = {
      name: block.name,
      content: block.content,
      updated_at: block.updated_at
    };
    return await http.put("/blocks/" + block.id, data);
  }
  async destroy(block) {
    return await http.delete(`/blocks/${block.id}`);
  }
}

export default new BlockService();
