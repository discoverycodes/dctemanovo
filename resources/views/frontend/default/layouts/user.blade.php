<!DOCTYPE html>
<html lang="en">
@include('frontend::include.__head')
<style>
#investment-carousel {
    display: flex;
    overflow: hidden; /* Mantemos o hidden, mas o conteúdo tem que ser largo o suficiente */
    white-space: nowrap;
    width: 100%; /* Ocupa toda a largura disponível */
    align-items: center; /* Alinha os itens no meio */
}

.carousel0-item {
    flex: 0 0 auto;
    width: 130px;
    height: 50px;
    margin-right: 20px;
    background: #198754;
    padding: 0px 0px 0px 0px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    color: #ffffff;
    display: flex;
    font-size: 12px;
    flex-direction: column;
    align-items: stretch;
    justify-content: center;
}

.cardcarousel {
    text-align: center;
}

.cardcarousel h3 {
    font-size: 16px;
    font-weight: bold;
}

.cardcarousel p {
    font-size: 14px;
    color: green;
}

</style>
<body class="{{ session()->get('site-color-mode') ?? 'dark-theme' }}">
@php
$osinvestments = \App\Models\Invest::with('user')->orderBy('created_at', 'desc')->take(20)->get();
@endphp
@include('notify::components.notify')
<!--Full Layout-->
<div class="panel-layout">
    <!--Header-->
    @include('frontend::include.__user_header')
    <!--/Header-->

    <div class="desktop-screen-show">
        @include('frontend::include.__user_side_nav')
    </div>

    <div class="page-container">
        <div class="main-content">
            <div class="section-gap">
                <div class="container-fluid">
                @if($osinvestments->isNotEmpty() && $osinvestments->count() > 20)
                 <p>Pessoas Investindo Agora!</p>
                <div id="investment-carousel" class="carousel mb-3">

                @foreach($osinvestments as $oinvestment)
                    <div class="carousel0-item">
                        <span style="text-transform: capitalize !important;">
                            {{ mb_convert_case($oinvestment->user->first_name ?? 'Usuário', MB_CASE_TITLE, "UTF-8") }}
                        </span>
                        <span>
                            {{ setting('currency_symbol','global') . showamount($oinvestment->invest_amount) }}
                        </span>
                    </div>
                @endforeach
            </div>
                 @endif

                    @if(auth()->check() && auth()->user()->cpf === '0')
                          <div class="alert site-alert alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert" style="background: #e91e42;color: rgb(255 255 255 / 80%);">
                        <div class="content d-flex align-items-center">
                            <div class="icon me-2" style="background: rgb(2 42 62);color: #ffffff;"><i class="anticon anticon-warning"></i></div>
                            <span> Para Sacar via PIX, cadastre seu CPF </span>
                        </div>
                        <div class="action d-flex">
                            <button class="site-btn-sm blue-btn me-2" data-bs-toggle="modal" data-bs-target="#cpfmodal">
                                <i class="anticon anticon-info-circle"></i>{{ __('Cadastrar CPF') }}
                            </button>
                        </div>
                    </div>
                    @endif

                    @if(setting('kyc_verification','permission'))
                        {{-- Kyc Info--}}
                        @include('frontend::user.include.__kyc_info')
                        @include('frontend::user.mobile_screen_include.kyc.__user_kyc_mobile')
                    @endif
                    @php
                        $messages = App\Models\Notification::where('for','popup')->where('user_id', auth()->id())->where('read',0)->get();
                     @endphp
                        @if($messages )
                        @include('frontend::user.include.__message',['messages' => $messages])
                        @endif
                    <!--Page Content-->
                    @yield('content')
                    <!--Page Content-->
                </div>
            </div>
        </div>
    </div>


    <!-- Show in 575px in Mobile Screen -->
    <div class="mobile-screen-show">
        @include('frontend::user.mobile_screen_include.__menu')
    </div>

    <!-- Show in 575px in Mobile Screen End -->

    <!-- Automatic Popup -->
    @if(Session::get('signup_bonus'))
        @include('frontend::user.include.__signup_bonus')
    @endif

    <!-- /Automatic Popup End -->
</div>
<!--/Full Layout-->

@include('frontend::include.__script')


</body>
</html>

