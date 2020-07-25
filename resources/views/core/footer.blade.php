
  @if ($footer ?? '')
    {!! $footer !!}
  @else
  {{-- <footer class="footer">
    <div class="footer-widgets">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="footer-widget footer-widget--text">
              <h2 class="widget-title">{{ config('app.name', 'Laravel') }}</h2>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s</p>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="footer-widget footer-widget--text">
              <h4 class="widget-title">Liên hệ</h4>
              <div class="widget-address">
                <span class="widget-address-icon"><i class="fal fa-map-marker-alt"></i></span>
                <span class="widget-address-content">: 1168 Trường Sa, Phường 13, Quận Phú Nhuận</span>
              </div>
              <div class="widget-address">
                <span class="widget-address-icon"><i class="fal fa-phone"></i></span>
                <span class="widget-address-content">: <a href="tel:0987440099">0987440099</a></span>
              </div>
              <div class="widget-address">
                <span class="widget-address-icon"><i class="fal fa-envelope"></i></span>
                <span class="widget-address-content">: <a href="mailto:webdev010199@gmail.com">webdev010199@gmail.com</a></span>
              </div>

              <ul class="widget-society list-inline">
                <li class="widget-society-item list-inline-item">
                  <a href="https://www.facebook.com/energeticthemes" target="_blank">
                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                  </a>
                </li>
                <li class="widget-society-item list-inline-item" target="_blank">
                  <a href="https://instagram.com/energeticthemes">
                    <i class="fab fa-instagram" aria-hidden="true"></i>
                  </a>
                </li>
                <li class="widget-society-item list-inline-item" target="_blank">
                  <a href="https://twitter.com/energeticthemes">
                    <i class="fab fa-twitter" aria-hidden="true"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3 mb-30px">
            <div class="footer-widget footer-widget--form">
              <h4 class="widget-title">Theo dõi chúng tôi</h4>
              <div id="subscribe-us">
                <form method="get" class="form" action="{{ route('home') }}">
                  <div>
                    <label>
                      <input type="email" class="sidebar-search form-field" placeholder="Đăng ký nhận thông tin" value=""
                        name="s" title="Đăng ký nhận thông tin" required="">
                    </label>
                    <button type="submit" class="form-btn-submit">
                      <i class="fal fa-paper-plane"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copy-right">
      <p>©Copy right 2020 By KyS</p>
    </div>
  </footer> --}}
  @endif
