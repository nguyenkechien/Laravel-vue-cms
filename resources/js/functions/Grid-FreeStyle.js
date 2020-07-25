export class GridFreeStyle {
  constructor() { }
  init(cb) {
    const self = this;
    self.resizeAllGridItems();
    $(window).on("resize", function () {
      self.resizeAllGridItems();
    });
    setTimeout(() => cb ? cb() : null, 500);
  }
  async resizeGridItem(item) {
    return new Promise((resolve) => {
      setTimeout(() => {
        const grid = $(".grid");
        const rowHeight = parseInt(grid.css("grid-auto-rows"));
        const rowGap = parseInt(grid.css("grid-row-gap"));
        const elHeight = $(item)
          .find(".grid-item-content")
          .height();
        const rowSpan = Math.ceil((elHeight + rowGap) / (rowHeight + rowGap));
        resolve(item.style.gridRowEnd = "span " + rowSpan)
      }, 300)
    })
  }
  async resizeAllGridItems() {
    const self = this;
    const item = $(".grid-item");
    const grid = $(".grid");
    await Promise.all(item.each(async function (i, e) {
      await self.resizeGridItem(e);
    })).then(() => {
      grid.css("opacity", 1);
    })
  }
}
