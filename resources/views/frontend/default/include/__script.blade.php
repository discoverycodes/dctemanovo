<script src="{{ asset('assets/global/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/global/js/jquery-migrate.js') }}"></script>

<script src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/scrollUp.min.js') }}"></script>

<script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/global/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/global/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/global/js/lucide.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/aos.js') }}"></script>
<script src="{{ asset('assets/global/js/datatables.min.js') }}" type="text/javascript" charset="utf8"></script>
<script src="{{ asset('assets/global/js/simple-notify.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/main.js?var=5') }}"></script>
<script src="{{ asset('assets/frontend/js/cookie.js') }}"></script>
<script src="{{ asset('assets/global/js/custom.js?var=5') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.1/jquery.inputmask.min.js"></script>


@include('global.__t_notify')
@if(auth()->check())
    <script src="{{ asset('assets/global/js/pusher.min.js') }}"></script>
    @include('global.__notification_script',['for'=>'user','userId' => auth()->user()->id])
@endif
@if(setting('site_animation','permission'))
    <script>
        (function ($) {
            'use strict';
            // AOS initialization
            AOS.init();
        })(jQuery);
    </script>
@endif
@if(setting('back_to_top','permission'))
    <script>
        (function ($) {
            'use strict';
            // To top
            $.scrollUp({
                scrollText: '<i class="fas fa-caret-up"></i>',
                easingType: 'linear',
                scrollSpeed: 500,
                animation: 'fade'
            });
        })(jQuery);

    </script>
@endif

<script src="{{ asset('assets/vendor/mckenziearts/laravel-notify/js/notify.js') }}"></script> 

@yield('script')
@stack('script')

@php
    $googleAnalytics = plugin_active('Google Analytics');
    $tawkChat = plugin_active('Tawk Chat');
    $fb = plugin_active('Facebook Messenger');
@endphp

@if($googleAnalytics)
    @include('frontend::plugin.google_analytics',['GoogleAnalyticsId' => json_decode($googleAnalytics?->data,true)['app_id']])
@endif
@if($tawkChat)
    @include('frontend::plugin.tawk',['data' => json_decode($tawkChat->data, true)])
@endif
@if($fb)
    @include('frontend::plugin.fb',['data' => json_decode($fb->data, true)])
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.getElementById('investment-carousel');
    const items = carousel.querySelectorAll('.carousel0-item');

    // Clonar os itens para fazer o loop infinito
    items.forEach(item => {
        const clone = item.cloneNode(true);
        carousel.appendChild(clone);
    });

    let scrollSpeed = 1; // Velocidade do scroll (pixels por movimento)

    function autoScroll() {
        carousel.scrollLeft += scrollSpeed;

        // Se chegou no final da primeira metade (original + clone), volta suavemente
        if (carousel.scrollLeft >= carousel.scrollWidth / 2) {
            carousel.scrollLeft = 0;
        }
    }

    setInterval(autoScroll, 16); // Aproximadamente 60 frames por segundo (bem fluido)
});
</script>



@if (auth()->check() && auth()->user()->cpf === '0')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        Inputmask({"mask": "999.999.999-99"}).mask(document.getElementById("cpf"));
    });
    </script>

<!-- Modal -->
<div class="modal fade" id="cpfmodal" tabindex="-1" aria-hidden="true">>
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Informe seu CPF Verdadeiro</h5>
        </div>
        <form method="POST" action="{{ route('user.setting.atualizar-phone') }}">
        @csrf
        <div class="modal-body">
          <p>Para sua segurança, informe seu CPF.</p>
          <p><span style="color: #E91E63">Importante: Informe seu CPF verdadeiro, pois os Saques serão pagos somente para Tipo de Chave Pix Cpf e para o mesmo CPF cadastrado aqui!</span></p>
           <div class="progress-steps-form">
            <div class="col-xl-12 col-md-12">
            <label for="phone">Seu CPF:</label>
                        <div class="input-group">
                          <input type="tel" class="form-control" name="cpf" id="cpf" placeholder="999.999.999-99" required>
                        </div>
                    </div>
                </div>
           </div>
        <div class="modal-footer">
          <button type="submit" class="site-btn blue-btn w-100">Salvar Cpf</button>

        </div>
        </form>
      </div>

  </div>
</div>

@endif


