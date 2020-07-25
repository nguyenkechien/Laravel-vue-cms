import "./../bootstrap";
import { GridFreeStyle } from "./../functions/Grid-FreeStyle";
import { FancyBox } from "./../functions/Fancybox/Fancybox";
import { sleep } from "./../functions/sleep";
const loader = $(".loading");
const grid = new GridFreeStyle();

$(document).ready(function() {
  grid.init(()=>{
    loader.fadeOut(300);
    new FancyBox();
  });
  sleep(500);
  postHover();
  filterPost();
});

function postHover() {
  $(".post-overlay-item-container").hover(
    function() {
      const that = $(this);
      that
        .parents(".post-meta-thumb")
        .find(".post-img")
        .css("transform", "scale(1.2)");
    },
    function() {
      const that = $(this);
      that
        .parents(".post-meta-thumb")
        .find(".post-img")
        .css("transform", "scale(1)");
    }
  );
}

function backTop() {
  $("html, body").animate(
    {
      scrollTop: 0
    },
    500
  );
}


function filterPost() {
  $('.filter-item').on('click', function () {
    loader.fadeIn(300);
    $('.filter-item').removeClass('active');
    const that = $(this);
    that.addClass('active');
    const dataFilter = that.find('a.filter-item-content').attr('data-filter');
    $.ajax({
      url: `${window.location.origin}?category=${dataFilter}`,
      method: "GET",
      async: true,
      success: async function (res) {
        $('.home-page .blog-list .blog-list-left').empty().append(res);
        $('.home-page .hero-banner-desc p').html(that.find('a.filter-item-content').text());
        grid.init(()=>{
          $('.loading').fadeOut(300);
        });
        await sleep(500);
        postHover();
      },
      error: function (err) {
        console.log(err);
        $('.loading').fadeOut(300);
      }
    })
  })
}
