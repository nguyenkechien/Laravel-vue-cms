import './index.scss';

export class FancyBox {
  constructor(options) {
    this.data = {
      /**
       * @type {JQuery}
       */
      el: $('a[data-fancybox]'),
      /**
       * @type {JQuery}
       */
      fancyBox: null,
      closeFancyBox: () => {}
    };
    this.init();
  }

  init() {
    this.initRender();
    this.handlerEvent();
  }

  handlerEvent() {
    const self = this;
    this.data.el.on('click', function (e) {
      e.preventDefault();
      const that = $(this);
      const src = that.attr('href');
      const content = that.attr('data-caption');
      self.data.fancyBox.addClass('open')
      self.render({ src, content })
    });
    $('#fancybox .fancybox-close').on('click', function (e) {
      e.preventDefault();
      self.data.closeFancyBox();
    });

    document.onkeydown = evt => {
      evt = evt || window.event;
      evt.keyCode === 27 ? self.data.closeFancyBox() : false;
    }
  }

  render({ src, content }) {
    const body = $('body');
    const self = this;
    body.css('overflow', 'hidden');
    const img = `<img src="${src}" alt="${content}" title="${content}" />`;
    self.data.fancyBox.find('.fancybox-img').empty().append(img);
    self.data.fancyBox.find('.fancybox-caption .fancybox-caption-body').html(content)
  }
  initRender() {
    const self = this;
    const body = $('body');
    const template = `
    <div id="fancybox" class="fancybox">
      <div class="fancybox-wrap">
      <div class="fancybox-close">
      <a hre="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="38.75" height="38.75" viewBox="0 0 38.75 38.75"><path d="M20,.625A19.375,19.375,0,1,0,39.375,20,19.372,19.372,0,0,0,20,.625Zm0,36.25A16.875,16.875,0,1,1,36.875,20,16.874,16.874,0,0,1,20,36.875Zm7.406-22.289a.953.953,0,0,0,0-1.328l-.664-.664a.938.938,0,0,0-1.328,0L20,18.008l-5.414-5.414a.938.938,0,0,0-1.328,0l-.664.664a.938.938,0,0,0,0,1.328L18.008,20l-5.414,5.414a.938.938,0,0,0,0,1.328l.664.664a.938.938,0,0,0,1.328,0L20,21.992l5.414,5.414a.938.938,0,0,0,1.328,0l.664-.664a.938.938,0,0,0,0-1.328L21.992,20Z" transform="translate(-0.625 -0.625)" fill="#707070"/></svg>
      </a>
      </div>
      <div class="fancybox-content">
      <div class="fancybox-img">
      </div>
      </div>
      <div class="fancybox-caption">
        <div class="fancybox-caption-body"> Text Text</div>
      </div>
      </div>
    </div>`;
    if (!body.find('#fancybox').length) {
      body.append(template);
      self.data.closeFancyBox = function () {
        body.find('#fancybox').removeClass('open');
        body.css('overflow', 'unset');
      }
      self.data.fancyBox = body.find('#fancybox');
    }
  }
}
