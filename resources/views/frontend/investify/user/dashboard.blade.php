@extends('frontend::layouts.user')
@section('title')
{{ __('Dashboard') }}
@endsection
@section('content')
<style type="text/css">

/* Opção 2 - Cards Selecionáveis */
.gateway-cards {
    display: flex;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 25px;
}

.gateway-card {
    position: relative;
    min-width: 110px;
}

.gateway-card-input {
    position: absolute;
    opacity: 0;
}

.gateway-card-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px 15px;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.gateway-card-input:checked + .gateway-card-label {
    border-color: #21445c;
    box-shadow: 0 5px 15px rgba(74, 108, 247, 0.1);
    background-color: #21445c;
}

.gateway-card-logo {
    max-height: 40px;
    margin-bottom: 15px;
    transition: transform 0.3s;
}

.gateway-card-name {
    font-weight: 500;
    text-align: center;
}

.gateway-card-check {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 20px;
    height: 20px;
    background: #538b12;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transform: scale(0.5);
    transition: all 0.3s;
    font-size: 12px;
}

.gateway-card-input:checked + .gateway-card-label .gateway-card-check {
    opacity: 1;
    transform: scale(1);
}

.gateway-card-input:checked + .gateway-card-label .gateway-card-logo {
    transform: scale(1.1);
}
</style>
<div class="container-fluid default-page">
    <div class="row gy-24 gy-xs-16">
        @if(setting('kyc_verification','permission'))
            @include('frontend::user.include.__kyc_info')
        @endif
        <div class="col-xxl-12">
            <!-- Show desktop-screen content -->
            <div class="rock-desktop-screen-show">
                <div class="rock-dashboard-level-area">
                    <div class="dashboard-card">
                        <div class="rock-dashboard-level-wrapper">
                            @if($user->rank != null)
                            <div class="rock-dashboard-level-contents">
                                <div class="thumb">
                                    <img src="{{ asset('assets/'.$user->rank->icon) }}" alt="level">
                                </div>
                                <div class="content">
                                    <span class="lavel">{{ __('Você é Usuário') }}</span>
                                    <h4 class="lavel-title">{{ $user->rank->ranking_name }}</h4>
                                </div>
                            </div>
                            @endif
                            @if(setting('sign_up_referral','permission'))
                            <div class="rock-dashboard-referral">
                                <div class="contents">
                                    <h4 class="link-title">{{ __('Referral URL') }}</h4>
                                    <div class="referral-link">
                                        <p class="referral-url-copy">{{ $referral->link }}</p>
                                        <button class="referral-url-copy-btn" onclick="copyToClipboard()">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4"
                                                    d="M8 6C8 3.79086 9.79086 2 12 2H18C20.2092 2 22 3.79086 22 6V12C22 14.2091 20.2092 16 18 16H12C9.79086 16 8 14.2091 8 12V6Z"
                                                    fill="white" />
                                                <path
                                                    d="M2 12C2 9.79086 3.79086 8 6 8H12C14.2092 8 16 9.79086 16 12V18C16 20.2091 14.2092 22 12 22H6C3.79086 22 2 20.2091 2 18V12Z"
                                                    fill="white" />
                                            </svg>
                                        </button>
                                        <span id="copy-message" class="copy-message">{{ __('Copied!') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if($user->rank != null)
            <!-- Show mobile-screen content -->
            <div class="rock-mobile-screen-show">
                <div class="rock-dashboard-level-area">
                    <div class="rock-dashboard-level-contents">
                        <div class="thumb" data-background="{{ asset('assets/frontend/theme_base/hardrock/images/bg/mobile-level-bg.png') }}">
                            <img src="{{ asset('assets/'.$user->rank->icon) }}" alt="level">
                        </div>
                        <div class="content">
                            <h4 class="lavel">{{ __('Você é Usuário') }}</h4>
                            <span class="lavel-title">{{ $user->rank->ranking_name }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Show mobile-screen content -->
            @endif
            <div class="rock-mobile-screen-show">
                <div class="rock-account-card-main">
                    <div class="rock-account-card">
                        <div class="content-inner">
                            <div class="card-content">
                                <h4 class="title text-white">{{ $currencySymbol.showamount($user->balance) }}</h4>
                                <div class="info">
                                    <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M22 6H6C3.79086 6 2 7.79086 2 10V18C2 20.2091 3.79086 22 6 22H18C20.2091 22 22 20.2091 22 18V6Z"
                                                fill="white" />
                                            <path d="M22 6C22 3.79086 20.2091 2 18 2H12C9.79086 2 8 3.79086 8 6H22Z"
                                                fill="white" />
                                            <path
                                                d="M2 12L2 16L6 16C7.10457 16 8 15.1046 8 14C8 12.8954 7.10457 12 6 12L2 12Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    <h5 class="info-text text-white">{{ __('Saldo Atual') }}</h5>
                                </div>
                            </div>

                        </div>
                        <div class="card-shape">
                            <img src="{{ asset('assets/frontend/theme_base/hardrock/images/rock-shapes/card-shape.png') }}" alt="">
                        </div>
                    </div>
                    <div class="account-bg-shape">
                        <img src="{{ asset('assets/frontend/theme_base/hardrock/images/bg/ac-balance-bg.png') }}" alt="">
                    </div>
                </div>

        @if(setting('sign_up_referral','permission'))
        <div class="col-xl-12 mb-3">
            <!-- Show mobile-screen content -->
            <div class="rock-mobile-screen-show">
                <div class="rock-dashboard-referral-mobile mt-30">
                    <div class="rock-dashboard-referral">
                        <div class="contents">
                            <h4 class="link-title">{{ __('Referral URL') }}</h4>
                            <div class="referral-link">
                                <p class="referral-url-copy">{{ $referral->link }}</p>
                                <button class="referral-url-copy-btn" onclick="copyToClipboard()">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M8 6C8 3.79086 9.79086 2 12 2H18C20.2092 2 22 3.79086 22 6V12C22 14.2091 20.2092 16 18 16H12C9.79086 16 8 14.2091 8 12V6Z"
                                            fill="white" />
                                        <path
                                            d="M2 12C2 9.79086 3.79086 8 6 8H12C14.2092 8 16 9.79086 16 12V18C16 20.2091 14.2092 22 12 22H6C3.79086 22 2 20.2091 2 18V12Z"
                                            fill="white" />
                                    </svg>
                                </button>
                                <span id="copy-message" class="copy-message">{{ __('Copied!') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
                @if(!empty($user->token_suporte))
                 <div class="text-center mt-1 mb-4">{{__('Código de Atendimento')}} <br><b>{{$user->token_suporte}}</b></div>
                 @endif
                <div class="rock-shortcut-btn-wrap">

                    <a class="rock-shortcut-btn" href="#" data-bs-toggle="modal" data-bs-target="#Deposit">
                        <span class="icon"><svg width="21" height="16" viewBox="0 0 21 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                    d="M2.66602 4H0.666016V13L4.97685 15.1554C6.08769 15.7108 7.3126 16 8.55456 16H16.666C17.7706 16 18.666 15.1046 18.666 14C18.666 12.8954 17.7706 12 16.666 12H15.0824C14.151 12 13.2323 11.7831 12.3991 11.3666L9.45801 9.896C9.65031 9.7189 9.80919 9.49927 9.91883 9.24342C10.3324 8.27844 9.8901 7.16054 8.92826 6.73973L2.66602 4Z"
                                    fill="white" />
                                <circle cx="16.666" cy="4" r="4" fill="white" />
                            </svg>
                        </span>
                        <span class="text">{{ __('Depositar') }}</span>
                    </a>
                    <a class="rock-shortcut-btn" href="{{ route('user.schema') }}">
                        <span class="icon"><svg width="21" height="16" viewBox="0 0 21 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                    d="M2.66602 4H0.666016V13L4.97685 15.1554C6.08769 15.7108 7.3126 16 8.55456 16H16.666C17.7706 16 18.666 15.1046 18.666 14C18.666 12.8954 17.7706 12 16.666 12H15.0824C14.151 12 13.2323 11.7831 12.3991 11.3666L9.45801 9.896C9.65031 9.7189 9.80919 9.49927 9.91883 9.24342C10.3324 8.27844 9.8901 7.16054 8.92826 6.73973L2.66602 4Z"
                                    fill="white" />
                                <circle cx="16.666" cy="4" r="4" fill="white" />
                            </svg>
                        </span>
                        <span class="text">{{ __('Invest') }}</span>
                    </a>
                    <a class="rock-shortcut-btn" href="{{ route('user.withdraw.view') }}">
                        <span class="icon"><svg width="21" height="16" viewBox="0 0 21 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                    d="M2.66602 4H0.666016V13L4.97685 15.1554C6.08769 15.7108 7.3126 16 8.55456 16H16.666C17.7706 16 18.666 15.1046 18.666 14C18.666 12.8954 17.7706 12 16.666 12H15.0824C14.151 12 13.2323 11.7831 12.3991 11.3666L9.45801 9.896C9.65031 9.7189 9.80919 9.49927 9.91883 9.24342C10.3324 8.27844 9.8901 7.16054 8.92826 6.73973L2.66602 4Z"
                                    fill="white" />
                                <circle cx="16.666" cy="4" r="4" fill="white" />
                            </svg>
                        </span>
                        <span class="text">{{ __('Sacar') }}</span>
                    </a>
                </div>
            </div>
            <!-- Show desktop-screen content -->
            <div class="rock-desktop-screen-show">
                <div class="rock-dashboard-grid">
                    <div class="rock-account-card-wrapper">
                        <div class="rock-account-card-main mb-2">
                            <div class="rock-account-card">
                                <div class="content-inner">
                                    <div class="card-content">
                                        <h4 class="title text-white">{{ $currencySymbol.showamount($user->balance) }}</h4>
                                        <div class="info">
                                            <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4"
                                                        d="M22 6H6C3.79086 6 2 7.79086 2 10V18C2 20.2091 3.79086 22 6 22H18C20.2091 22 22 20.2091 22 18V6Z"
                                                        fill="white" />
                                                    <path
                                                        d="M22 6C22 3.79086 20.2091 2 18 2H12C9.79086 2 8 3.79086 8 6H22Z"
                                                        fill="white" />
                                                    <path
                                                        d="M2 12L2 16L6 16C7.10457 16 8 15.1046 8 14C8 12.8954 7.10457 12 6 12L2 12Z"
                                                        fill="white" />
                                                </svg>
                                            </span>
                                            <h5 class="info-text text-white">{{ __('Saldo Atual') }}</h5>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-shape">
                                    <img src="{{ asset('assets/frontend/theme_base/hardrock/images/rock-shapes/card-shape.png') }}" alt="">
                                </div>
                            </div>
                            <div class="rock-account-btn mb-2">
                                <a class="site-btn gradient-btn" href="#" data-bs-toggle="modal" data-bs-target="#Deposit">
                                    <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z"
                                                fill="white" />
                                            <circle cx="18" cy="8" r="4" fill="white" />
                                        </svg>
                                    </span>
                                    {{ __('Depositar') }}
                                </a>
                                <a class="site-btn outline-opcity-btn" href="{{ route('user.schema') }}"> <span><svg width="24"
                                            height="25" viewBox="0 0 24 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M19 13.5C19 17.9183 15.4183 21.5 11 21.5C6.58172 21.5 3 17.9183 3 13.5C3 9.08172 6.58172 5.5 11 5.5C15.4183 5.5 19 9.08172 19 13.5Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M16 4.25C15.5858 4.25 15.25 3.91421 15.25 3.5C15.25 3.08579 15.5858 2.75 16 2.75H21C21.4142 2.75 21.75 3.08579 21.75 3.5V8.5C21.75 8.91421 21.4142 9.25 21 9.25C20.5858 9.25 20.25 8.91421 20.25 8.5V5.31066L10.5303 15.0303C10.2374 15.3232 9.76256 15.3232 9.46967 15.0303C9.17678 14.7374 9.17678 14.2626 9.46967 13.9697L19.1893 4.25H16Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    {{ __('Invest Now') }}
                                </a>
                            </div>
                            <div class="account-bg-shape">
                                <img src="{{ asset('assets/frontend/theme_base/hardrock/images/bg/ac-balance-bg.png') }}" alt="">
                            </div>
                        </div>
                    @if(!empty($user->token_suporte))
                    <div class="text-center mt-1">{{__('Código de Atendimento')}} <br><b>{{$user->token_suporte}}</b></div>
                    @endif
                    </div>
                    <div class="rock-single-card-grid">

                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                <img src="{{ asset('assets/frontend/theme_base/hardrock/images/investors/acai-1.png') }}" alt="">
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title"><span>{{ $currencySymbol }}</span>{{ showamount($dataCount['total_deposit']) }}</h3>
                                <p class="description">{{ __('Depositado') }}</p>
                            </div>
                        </div>
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                <img src="{{ asset('assets/frontend/theme_base/hardrock/images/investors/acai-1.png') }}" alt="">
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title"><span>{{ $currencySymbol }}</span>{{ showamount($dataCount['total_investment']) }}
                                </h3>
                                <p class="description">{{ __('Investido') }}</p>
                            </div>
                        </div>
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                <img src="{{ asset('assets/frontend/theme_base/hardrock/images/investors/acai-1.png') }}" alt="">
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title"><span>{{ $currencySymbol }}</span>{{ showamount($dataCount['total_profit']) }}</h3>
                                <p class="description">{{ __('Lucros') }}</p>
                            </div>
                        </div>

                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                <img src="{{ asset('assets/frontend/theme_base/hardrock/images/investors/acai-1.png') }}" alt="">
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title"><span>{{ $currencySymbol }}</span>{{ showamount($dataCount['total_withdraw']) }}</h3>
                                <p class="description">{{ __('Sacado') }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-12">
            <!-- Show mobile-screen content -->
            <div class="rock-mobile-screen-show">
                <!-- rock all navigation start -->
                <div class="rock-all-navigation-mobile">
                    <h6 class="rock-mobile-title">{{ __('All Navigations') }}</h6>
                    <div class="all-navigation-inner">
                        <div class="all-navigation-grid">

                            <div class="single-navigation-item">
                                <a href="{{ route('user.invest-logs') }}">
                                    <span class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z"
                                                fill="white" />
                                            <circle cx="18" cy="8" r="4" fill="white" />
                                        </svg>
                                    </span>
                                    <span class="title">{{ __('Invest Logs') }}</span>
                                </a>
                            </div>
                            <div class="single-navigation-item">
                                <a href="{{ route('user.transactions') }}">
                                    <span class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M2 4C2 2.89543 2.89543 2 4 2H12C13.1046 2 14 2.89543 14 4V8C14 9.10457 13.1046 10 12 10H4C2.89543 10 2 9.10457 2 8V4Z"
                                                fill="white" />
                                            <path opacity="0.4"
                                                d="M10 16C10 14.8954 10.8954 14 12 14H20C21.1046 14 22 14.8954 22 16V20C22 21.1046 21.1046 22 20 22H12C10.8954 22 10 21.1046 10 20V16Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M20.6036 6.75L19.8839 7.46967C19.591 7.76256 19.591 8.23744 19.8839 8.53033C20.1768 8.82322 20.6517 8.82322 20.9445 8.53033L22.2374 7.23744C22.9209 6.55402 22.9209 5.44598 22.2374 4.76256L20.9445 3.46967C20.6517 3.17678 20.1768 3.17678 19.8839 3.46967C19.591 3.76256 19.591 4.23744 19.8839 4.53033L20.6036 5.25L16 5.25C15.5858 5.25 15.25 5.58579 15.25 6C15.25 6.41421 15.5858 6.75 16 6.75L20.6036 6.75Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.39645 18.75L4.11612 19.4697C4.40901 19.7626 4.40901 20.2374 4.11612 20.5303C3.82322 20.8232 3.34835 20.8232 3.05546 20.5303L1.76256 19.2374C1.07915 18.554 1.07914 17.446 1.76256 16.7626L3.05546 15.4697C3.34835 15.1768 3.82322 15.1768 4.11612 15.4697C4.40901 15.7626 4.40901 16.2374 4.11612 16.5303L3.39645 17.25L8 17.25C8.41421 17.25 8.75 17.5858 8.75 18C8.75 18.4142 8.41421 18.75 8 18.75L3.39645 18.75Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    <span class="title">{{ __('Transactions') }}</span>
                                </a>
                            </div>

                            <div class="single-navigation-item">
                                <a href="{{ route('user.deposit.log') }}">
                                    <span class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M20 13C20 17.9706 15.9706 22 11 22C6.02944 22 2 17.9706 2 13C2 8.02944 6.02944 4 11 4C15.9706 4 20 8.02944 20 13Z"
                                                fill="white" />
                                            <path
                                                d="M21.8025 10.0128C21.0104 6.08419 17.9158 2.98956 13.9872 2.19745C12.9045 1.97914 12 2.89543 12 4V10C12 11.1046 12.8954 12 14 12H20C21.1046 12 22.0209 11.0955 21.8025 10.0128Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    <span class="title">{{ __('Deposit Log') }}</span>
                                </a>
                            </div>

                        </div>
                        <div class="moretext">
                            <div class="all-navigation-grid">

                                <div class="single-navigation-item">
                                    <a href="{{ route('user.withdraw.log') }}">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4"
                                                    d="M18 4C19.1046 4 20 4.89543 20 6C20 7.10457 19.1046 8 18 8L10 8C8.89543 8 8 7.10457 8 6C8 4.89543 8.89543 4 10 4L18 4Z"
                                                    fill="white" />
                                                <path opacity="0.4"
                                                    d="M18 12C19.1046 12 20 12.8954 20 14C20 15.1046 19.1046 16 18 16L10 16C8.89543 16 8 15.1046 8 14C8 12.8954 8.89543 12 10 12L18 12Z"
                                                    fill="white" />
                                                <rect x="16" y="8" width="4" height="12" rx="2"
                                                    transform="rotate(90 16 8)" fill="white" />
                                                <rect x="17" y="16" width="4" height="12" rx="2"
                                                    transform="rotate(90 17 16)" fill="white" />
                                            </svg>
                                        </span>
                                        <span class="title">{{ __('Withdraw Log') }}</span>
                                    </a>
                                </div>
                                <div class="single-navigation-item">
                                    <a href="{{ route('user.ranking-badge') }}">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M17 10.101V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V10.101C8.27052 8.80447 10.0413 8 12 8C13.9587 8 15.7295 8.80447 17 10.101Z"
                                                    fill="white" />
                                                <circle opacity="0.4" cx="12" cy="15" r="7" fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M22.5303 9.46967C22.8232 9.76256 22.8232 10.2374 22.5303 10.5303L21.5303 11.5303C21.2374 11.8232 20.7626 11.8232 20.4697 11.5303C20.1768 11.2374 20.1768 10.7626 20.4697 10.4697L21.4697 9.46967C21.7626 9.17678 22.2374 9.17678 22.5303 9.46967Z"
                                                    fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M20.4697 18.4697C20.7626 18.1768 21.2374 18.1768 21.5303 18.4697L22.5303 19.4697C22.8232 19.7626 22.8232 20.2374 22.5303 20.5303C22.2374 20.8232 21.7626 20.8232 21.4697 20.5303L20.4697 19.5303C20.1768 19.2374 20.1768 18.7626 20.4697 18.4697Z"
                                                    fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M1.46967 9.46967C1.17678 9.76256 1.17678 10.2374 1.46967 10.5303L2.46967 11.5303C2.76256 11.8232 3.23744 11.8232 3.53033 11.5303C3.82322 11.2374 3.82322 10.7626 3.53033 10.4697L2.53033 9.46967C2.23744 9.17678 1.76256 9.17678 1.46967 9.46967Z"
                                                    fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M3.53033 18.4697C3.23744 18.1768 2.76256 18.1768 2.46967 18.4697L1.46967 19.4697C1.17678 19.7626 1.17678 20.2374 1.46967 20.5303C1.76256 20.8232 2.23744 20.8232 2.53033 20.5303L3.53033 19.5303C3.82322 19.2374 3.82322 18.7626 3.53033 18.4697Z"
                                                    fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12.3945 11.362C12.6156 11.4987 12.7502 11.7401 12.7502 12V17.25H13.0002C13.4144 17.25 13.7502 17.5858 13.7502 18C13.7502 18.4142 13.4144 18.75 13.0002 18.75H11.0002C10.586 18.75 10.2502 18.4142 10.2502 18C10.2502 17.5858 10.586 17.25 11.0002 17.25H11.2502V13.2072C10.8984 13.3321 10.5006 13.1778 10.3293 12.8354C10.1441 12.4649 10.2943 12.0144 10.6648 11.8292L11.6648 11.3292C11.8972 11.2129 12.1734 11.2254 12.3945 11.362Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="title">{{ __('Ranking') }}</span>
                                    </a>
                                </div>
                                <div class="single-navigation-item">
                                    <a href="{{ route('user.referral') }}">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4"
                                                    d="M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z"
                                                    fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.8694 13.75C9.79795 13.753 8.7328 14.0456 7.30683 14.6844C6.92882 14.8538 6.4851 14.6847 6.31574 14.3066C6.14638 13.9286 6.31553 13.4849 6.69354 13.3156C8.21341 12.6346 9.49813 12.2538 10.8652 12.25C12.2263 12.2463 13.5951 12.6166 15.2836 13.3056C15.6671 13.4621 15.8511 13.8999 15.6946 14.2834C15.5381 14.6669 15.1003 14.8509 14.7168 14.6944C13.105 14.0366 11.9468 13.747 10.8694 13.75Z"
                                                    fill="white" />
                                                <circle cx="3" cy="3" r="3" transform="matrix(1 0 0 -1 8 11)"
                                                    fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M18.75 16C18.75 15.5858 18.4142 15.25 18 15.25C17.5858 15.25 17.25 15.5858 17.25 16V17.25H16C15.5858 17.25 15.25 17.5858 15.25 18C15.25 18.4142 15.5858 18.75 16 18.75H17.25V20C17.25 20.4142 17.5858 20.75 18 20.75C18.4142 20.75 18.75 20.4142 18.75 20V18.75H20C20.4142 18.75 20.75 18.4142 20.75 18C20.75 17.5858 20.4142 17.25 20 17.25H18.75V16Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="title">{{ __('Referral') }}</span>
                                    </a>
                                </div>
                                <div class="single-navigation-item">
                                    <a href="{{ route('user.setting.show') }}">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4"
                                                    d="M12.9545 3H11.0455C9.99109 3 9.13635 3.80589 9.13635 4.8C9.13635 5.93761 7.91917 6.66087 6.92 6.11697L6.81852 6.06172C5.90541 5.56467 4.73782 5.85964 4.21064 6.72057L3.25609 8.27942C2.72891 9.14034 3.04176 10.2412 3.95487 10.7383C4.95451 11.2824 4.95451 12.7176 3.95487 13.2617C3.04176 13.7588 2.72891 14.8597 3.25609 15.7206L4.21064 17.2794C4.73782 18.1404 5.90541 18.4353 6.81851 17.9383L6.92 17.883C7.91917 17.3391 9.13635 18.0624 9.13635 19.2C9.13635 20.1941 9.99109 21 11.0455 21H12.9545C14.0089 21 14.8636 20.1941 14.8636 19.2C14.8636 18.0624 16.0808 17.3391 17.08 17.883L17.1815 17.9383C18.0946 18.4353 19.2622 18.1403 19.7894 17.2794L20.7439 15.7206C21.2711 14.8596 20.9582 13.7588 20.0451 13.2617C19.0455 12.7176 19.0455 11.2824 20.0451 10.7383C20.9582 10.2412 21.2711 9.14036 20.7439 8.27943L19.7894 6.72058C19.2622 5.85966 18.0946 5.56468 17.1815 6.06174L17.08 6.11698C16.0808 6.66088 14.8636 5.93762 14.8636 4.8C14.8636 3.80589 14.0089 3 12.9545 3Z"
                                                    fill="white" />
                                                <circle cx="12" cy="12" r="3" fill="white" />
                                            </svg>
                                        </span>
                                        <span class="title">{{ __('Settings') }}</span>
                                    </a>
                                </div>
                                <div class="single-navigation-item">
                                    <a href="{{ route('user.negociacoes') }}">
                                        <span class="icon">
                                        <i class="fas fa-bar-chart"></i>
                                        </span>
                                        <span class="title">{{ __('Negociações Açaí Prime') }}</span>
                                    </a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-15">
                        <button class="rock-moreless-button site-btn transparent-btn">{{ __('Load more') }}</button>
                    </div>
                </div>
                <!-- rock all navigation start -->
            </div>
        </div>
        <div class="col-xl-12">
            <!-- Show mobile-screen content -->
            <div class="rock-mobile-screen-show">
                <div class="rock-mobile-common-table mt-30 mb-30">
                    <h6 class="rock-mobile-title mb-15">{{ __('All Statistic') }}</h6>
                    <!-- rock all navigation start -->
                    <div class="rock-single-card-grid">

                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z"
                                            fill="black" />
                                        <circle cx="18" cy="8" r="4" fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title"><span>{{ $currencySymbol }}</span>{{ showamount($dataCount['total_deposit']) }}</h3>
                                <p class="description">{{ __('Depositado') }}</p>
                            </div>
                        </div>
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z"
                                            fill="black" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 5.75C12.4142 5.75 12.75 6.08579 12.75 6.5V7.35352C13.9043 7.67998 14.75 8.74122 14.75 10C14.75 10.4142 14.4142 10.75 14 10.75C13.5858 10.75 13.25 10.4142 13.25 10C13.25 9.30964 12.6904 8.75 12 8.75C11.3096 8.75 10.75 9.30964 10.75 10C10.75 10.6904 11.3096 11.25 12 11.25C13.5188 11.25 14.75 12.4812 14.75 14C14.75 15.2588 13.9043 16.32 12.75 16.6465V17.5C12.75 17.9142 12.4142 18.25 12 18.25C11.5858 18.25 11.25 17.9142 11.25 17.5V16.6465C10.0957 16.32 9.25 15.2588 9.25 14C9.25 13.5858 9.58579 13.25 10 13.25C10.4142 13.25 10.75 13.5858 10.75 14C10.75 14.6904 11.3096 15.25 12 15.25C12.6904 15.25 13.25 14.6904 13.25 14C13.25 13.3096 12.6904 12.75 12 12.75C10.4812 12.75 9.25 11.5188 9.25 10C9.25 8.74122 10.0957 7.67998 11.25 7.35352V6.5C11.25 6.08579 11.5858 5.75 12 5.75Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title"><span>{{ $currencySymbol }}</span>{{ showamount($dataCount['total_investment']) }}
                                </h3>
                                <p class="description">{{ __('Investido') }}</p>
                            </div>
                        </div>
                        <div class="moretext-2 rock-single-card-grid">
                            <div class="rock-single-card">
                                <div class="icon">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M14.0859 7L9.91411 7L8.51303 5.39296C7.13959 3.81763 8.74185 1.46298 10.7471 2.10985L11.6748 2.40914C11.8861 2.47728 12.1139 2.47728 12.3252 2.40914L13.2529 2.10985C15.2582 1.46298 16.8604 3.81763 15.487 5.39296L14.0859 7Z"
                                                fill="black" />
                                            <path opacity="0.4"
                                                d="M5.68355 10.2103C6.46632 7.7055 8.78612 6 11.4104 6H12.5881C15.2125 6 17.5323 7.7055 18.315 10.2104L19.565 14.2104C20.7724 18.0739 17.886 22 13.8381 22H10.1604C6.11259 22 3.22618 18.0739 4.43355 14.2104L5.68355 10.2103Z"
                                                fill="black" />
                                            <path
                                                d="M12 20C12 18.8954 12.8954 18 14 18H20C21.1046 18 22 18.8954 22 20C22 21.1046 21.1046 22 20 22H14C12.8954 22 12 21.1046 12 20Z"
                                                fill="black" />
                                            <path
                                                d="M12 16C12 14.8954 12.8954 14 14 14H19.3333H20C21.1046 14 22 14.8954 22 16C22 17.1046 21.1046 18 20 18H14C12.8954 18 12 17.1046 12 16Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="content">
                                    <h3 class="title"><span>{{ $currencySymbol }}</span>{{ showamount($dataCount['total_profit']) }}</h3>
                                    <p class="description">{{ __('Lucros') }}</p>
                                </div>
                            </div>

                            <div class="rock-single-card">
                                <div class="icon">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M4 12C4 10.8954 4.89543 10 6 10H15C16.1046 10 17 10.8954 17 12C17 13.1046 16.1046 14 15 14H6C4.89543 14 4 13.1046 4 12Z"
                                                fill="black" />
                                            <path
                                                d="M15 14H6.16667C4.97005 14 4 14.8954 4 16C4 17.1046 4.97005 18 6.16667 18H15C16.1046 18 17 17.1046 17 16C17 14.8954 16.1046 14 15 14Z"
                                                fill="black" />
                                            <path opacity="0.4"
                                                d="M20 18C20 15.7909 18.2091 14 16 14C15.8007 14 15.6047 14.0146 15.4132 14.0427C13.4823 14.3266 12 15.9902 12 18C12 20.2091 13.7909 22 16 22C18.2091 22 20 20.2091 20 18Z"
                                                fill="black" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M11.25 3.39645L10.5303 4.11612C10.2374 4.40901 9.76256 4.40901 9.46967 4.11612C9.17678 3.82322 9.17678 3.34835 9.46967 3.05546L10.7626 1.76256C11.446 1.07915 12.554 1.07914 13.2374 1.76256L14.5303 3.05546C14.8232 3.34835 14.8232 3.82322 14.5303 4.11612C14.2374 4.40901 13.7626 4.40901 13.4697 4.11612L12.75 3.39645L12.75 7C12.75 7.41421 12.4142 7.75 12 7.75C11.5858 7.75 11.25 7.41421 11.25 7L11.25 3.39645Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="content">
                                    <h3 class="title"><span>{{ $currencySymbol }}</span>{{ showamount($dataCount['total_withdraw']) }}</h3>
                                    <p class="description">{{ __('Sacado') }}</p>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="rock-moreless-button-2 site-btn transparent-btn">{{ __('Load more') }}</button>
                        </div>
                    </div>
                    <!-- rock all navigation start -->
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <!-- Show desktop-screen content -->
            <div class="rock-desktop-screen-show">
                <div class="rock-recent-transactions-area">
                    <div class="rock-dashboard-card">
                        <div class="rock-dashboard-title-inner">
                            <h3 class="rock-dashboard-tile">{{ __('Recent Transactions') }}</h3>
                        </div>
                        <div class="rock-recent-transactions-table">
                            <div class="rock-custom-table">
                                <div class="contents">
                                    <div class="site-table-list site-table-head">
                                        <div class="site-table-col">{{ __('Description') }}</div>
                                        <div class="site-table-col">{{ __('Transaction ID') }}</div>
                                        <div class="site-table-col">{{ __('Amount') }}</div>
                                        <div class="site-table-col">{{ __('Charge') }}</div>
                                        <div class="site-table-col">{{ __('Status') }}</div>
                                    </div>
                                    @foreach($recentTransactions as $transaction)
                                    <div class="site-table-list">
                                        <div class="site-table-col">
                                            <div class="transactions-description">
                                                <div class="iocn">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.4"
                                                            d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z"
                                                            fill="#E9D8A6" />
                                                        <circle cx="18" cy="8" r="4" fill="#E9D8A6" />
                                                    </svg>
                                                </div>
                                                <div class="content">
                                                    <h4 class="title pinkDiamond-text">
                                                        {{ $transaction->description }}
                                                    </h4>
                                                    <p class="description">{{ formatar_data_brasileira($transaction->created_at) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="site-table-col">
                                            <span class="white-text">{{ $transaction->tnx }}</span>
                                        </div>

                                        @php
                                        $minusSvg ='<svg width="8" height="12" viewBox="0 0 8 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.55545 11.4419C3.79953 11.686 4.19526 11.686 4.43934 11.4419L7.77267 8.10861C8.01675 7.86453 8.01675 7.4688 7.77267 7.22472C7.52859 6.98065 7.13286 6.98065 6.88879 7.22472L4.6224 9.49112V1C4.6224 0.654822 4.34257 0.375 3.9974 0.375C3.65222 0.375 3.3724 0.654822 3.3724 1V9.49112L1.106 7.22472C0.861927 6.98065 0.466198 6.98065 0.222121 7.22472C-0.0219569 7.4688 -0.0219569 7.86453 0.222121 8.10861L3.55545 11.4419Z"
                                                fill="#FF3E3E" />
                                        </svg>';

                                        $plusSvg = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9.55545 4.55806C9.79953 4.31398 10.1953 4.31398 10.4393 4.55806L13.7727 7.89139C14.0167 8.13547 14.0167 8.5312 13.7727 8.77528C13.5286 9.01935 13.1329 9.01935 12.8888 8.77528L10.6224 6.50888V15C10.6224 15.3452 10.3426 15.625 9.9974 15.625C9.65222 15.625 9.3724 15.3452 9.3724 15V6.50888L7.106 8.77528C6.86193 9.01935 6.4662 9.01935 6.22212 8.77528C5.97804 8.5312 5.97804 8.13547 6.22212 7.89139L9.55545 4.55806Z"
                                                fill="#85FFC4" />
                                        </svg>';
                                        @endphp
                                        <div class="site-table-col">
                                            <span
                                                class="{{ txn_type($transaction->type->value,['success-text','danger-text'],'hardrock') }}">
                                                {{ txn_type($transaction->type->value,['+','-'],'hardrock') }}
                                                {{ setting('currency_symbol','global'). showamount($transaction->amount) }}

                                                @if(txn_type($transaction->type->value,['+','-'],'hardrock') == '-')
                                                {!! $minusSvg !!}
                                                @else
                                                {!! $plusSvg !!}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="site-table-col">
                                            <span class="white-text">{{ setting('currency_symbol','global') . showamount($transaction->charge)}}</span>
                                        </div>
                                        <div class="site-table-col">
                                            <span @class([ 'rock-badge' , 'badge-success'=> $transaction->status->value ==
                                                'success',
                                                'danger' => $transaction->status->value == 'failed',
                                                'warning' => $transaction->status->value == 'pending',
                                                ])>

                                    @if($transaction->status->value == \App\Enums\TxnStatus::Pending->value)
                                        {{ __('Pendente') }}
                                    @elseif($transaction->status->value ==  \App\Enums\TxnStatus::Success->value)
                                       {{ __('Sucesso') }}
                                    @elseif($transaction->status->value ==  \App\Enums\TxnStatus::Failed->value)
                                        {{ __('Cancelado') }}
                                        @elseif($transaction->status->value ==  \App\Enums\TxnStatus::Estornado->value)
                                        {{ __('Estornado') }}
                                    @endif
                                            </span>
                                        </div>

                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Show mobile-screen content -->
            <div class="rock-mobile-screen-show">
                <div class="rock-mobile-common-table">
                    <h6 class="rock-mobile-title mb-15">{{ __('Recent Transactions') }}</h6>
                    @foreach($recentTransactions as $transaction)
                    <div class="rock-mobile-table-card">
                        <div class="transactions-description">
                            <div class="iocn">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4"
                                        d="M20 10C20 15.5228 15.5228 20 10 20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10Z"
                                        fill="#FFD6FF" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 3.75C10.4142 3.75 10.75 4.08579 10.75 4.5V5.35352C11.9043 5.67998 12.75 6.74122 12.75 8C12.75 8.41421 12.4142 8.75 12 8.75C11.5858 8.75 11.25 8.41421 11.25 8C11.25 7.30964 10.6904 6.75 10 6.75C9.30964 6.75 8.75 7.30964 8.75 8C8.75 8.69036 9.30964 9.25 10 9.25C11.5188 9.25 12.75 10.4812 12.75 12C12.75 13.2588 11.9043 14.32 10.75 14.6465V15.5C10.75 15.9142 10.4142 16.25 10 16.25C9.58579 16.25 9.25 15.9142 9.25 15.5V14.6465C8.09575 14.32 7.25 13.2588 7.25 12C7.25 11.5858 7.58579 11.25 8 11.25C8.41421 11.25 8.75 11.5858 8.75 12C8.75 12.6904 9.30964 13.25 10 13.25C10.6904 13.25 11.25 12.6904 11.25 12C11.25 11.3096 10.6904 10.75 10 10.75C8.48122 10.75 7.25 9.51878 7.25 8C7.25 6.74122 8.09575 5.67998 9.25 5.35352V4.5C9.25 4.08579 9.58579 3.75 10 3.75Z"
                                        fill="#FFD6FF" />
                                </svg>
                            </div>
                            <div class="content">
                                <h4 class="title pinkDiamond-text">{{ $transaction->description }}</h4>
                                <p class="description">{{ formatar_data_brasileira($transaction->created_at) }}</p>
                            </div>
                        </div>
                        @php
                        $minusSvg ='<svg width="8" height="12" viewBox="0 0 8 12" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.55545 11.4419C3.79953 11.686 4.19526 11.686 4.43934 11.4419L7.77267 8.10861C8.01675 7.86453 8.01675 7.4688 7.77267 7.22472C7.52859 6.98065 7.13286 6.98065 6.88879 7.22472L4.6224 9.49112V1C4.6224 0.654822 4.34257 0.375 3.9974 0.375C3.65222 0.375 3.3724 0.654822 3.3724 1V9.49112L1.106 7.22472C0.861927 6.98065 0.466198 6.98065 0.222121 7.22472C-0.0219569 7.4688 -0.0219569 7.86453 0.222121 8.10861L3.55545 11.4419Z"
                                fill="#FF3E3E" />
                        </svg>';

                        $plusSvg = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.55545 4.55806C9.79953 4.31398 10.1953 4.31398 10.4393 4.55806L13.7727 7.89139C14.0167 8.13547 14.0167 8.5312 13.7727 8.77528C13.5286 9.01935 13.1329 9.01935 12.8888 8.77528L10.6224 6.50888V15C10.6224 15.3452 10.3426 15.625 9.9974 15.625C9.65222 15.625 9.3724 15.3452 9.3724 15V6.50888L7.106 8.77528C6.86193 9.01935 6.4662 9.01935 6.22212 8.77528C5.97804 8.5312 5.97804 8.13547 6.22212 7.89139L9.55545 4.55806Z"
                                fill="#85FFC4" />
                        </svg>';
                        @endphp
                        <div class="transactions-short-content">
                            <span
                                class="{{ txn_type($transaction->type->value,['success-text','danger-text'],'hardrock') }}">
                                {{ txn_type($transaction->type->value,['+','-'],'hardrock') }}
                                {{ $currencySymbol.showAmount($transaction->amount)}}

                                @if(txn_type($transaction->type->value,['+','-'],'hardrock') == '-')
                                {!! $minusSvg !!}
                                @else
                                {!! $plusSvg !!}
                                @endif
                            </span>
                            <span class="white-text d-block">
                                -{{ $currencySymbol.showAmount($transaction->charge)}}
                            </span>

                        </div>
                        <div class="transaction-id">
                            <span class="white-text d-block">
                                {{ $transaction->tnx }}
                            </span>
                        </div>
                        <div class="transactions-badge">
                            <span @class([ 'rock-badge' , 'success'=> $transaction->status->value == 'success',
                                'danger' => $transaction->status->value == 'failed',
                                'warning' => $transaction->status->value == 'pending',
                                ])>
                                @if($transaction->status->value == \App\Enums\TxnStatus::Pending->value)
                                        {{ __('Pendente') }}
                                    @elseif($transaction->status->value ==  \App\Enums\TxnStatus::Success->value)
                                       {{ __('Sucesso') }}
                                    @elseif($transaction->status->value ==  \App\Enums\TxnStatus::Failed->value)
                                        {{ __('Cancelado') }}
                                        @elseif($transaction->status->value ==  \App\Enums\TxnStatus::Estornado->value)
                                        {{ __('Estornado') }}
                                    @endif
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Container-fluid Ends-->
<div class="modal fade" id="Deposit" tabindex="-1" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" >
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header" style="display: flex;justify-content: space-between;">
          <h5 class="modal-title">{{__('Deposit') }}</h5>
        </div>
        <div class="modal-body">
                    <div class="rock-add-mony-wrapper">
                        <form action="{{ route('user.deposit.now') }}" method="POST" id="deposit-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                    <div class="rock-single-input" style="
    display: flex;
    flex-wrap: nowrap;
    flex-direction: column;
    grid-template-columns: repeat(auto-fill, minmax(123px, 1fr));
    justify-content: center;
    gap: 10px;
    align-items: center;
">
                                        <label class="input-label text-black">{{ __('Payment Method') }}</label>
                                        <div class="gateway-cards">
                                            @foreach($gateways as $gateway)
                                            @php
                                            $rules = \App\Models\DepositMethod::where('tnx',$gateway->tnx)->first();
                                            @endphp
                                            <div class="gateway-card">
                                                <input type="radio" name="gateway_code" id="gateway_{{ $gateway->tnx }}"
                                                       value="{{ $gateway->tnx }}"
                                                       class="gateway-card-input"
                                                       data-min="{{ $rules->minimum_deposit ?? 0 }}"
                                                       data-max="{{ $rules->maximum_deposit ?? 0 }}">
                                                <label for="gateway_{{ $gateway->tnx }}" class="gateway-card-label">
                                                    @if($gateway->logo)
                                                    <img src="{{ asset('assets/' . $gateway->logo) }}" alt="{{ $gateway->name }}" class="gateway-card-logo">
                                                    @endif
                                                    <span class="gateway-card-name">{{ $gateway->name }}</span>
                                                    <div class="gateway-card-check"><i class="fas fa-check"></i></div>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                <label for="amount" class="form-label text-black">{{ __('Enter Amount:') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">{{ $currencySymbol }} </span>
                                 <input type="tel" class="form-control form-control-lg" name="amount" id="amount" placeholder="0.00" value="" oninput="this.value = validateDouble(this.value)" aria-label="Amount" autocomplete="off" required>
                                </div>
                                <div class="form-text text-end">
                                    <p class="input-description min-max text-black" style="font-size: 12px;"></p>
                                </div>
                            </div>
                         </div>

                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                    <div class="rock-add-mony-details">
                                        <h4 class="title text-black">{{ __('Review Details') }}</h4>
                                        <div class="fee-info alert alert-light mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span>{{ __('Amount') }}</span>
                                            <span id="fee_value" class="fw-bold">{{ setting('currency_symbol','global') }} <span class="amount">0,00</span> </span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                    <div class="d-grid gap-2" id="btn-area">

                                    </div>
                            </div>
                        </form>
                    </div>
              </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="fecharModal()">{{__('Cancelar')}}</button>
      </div>
      </div>

  </div>
</div>

@endsection
@section('script')
<script>
function fecharModal() {
    var modal = bootstrap.Modal.getInstance(document.getElementById('Deposit'));
    modal.hide();
    document.getElementById('btn-area').innerHTML = '';
    document.getElementById('amount').value = '';
    $('.gateway-card-input').prop('checked', false);
}
    var globalData;
    var currency = @json($currency)

    $(".gateway-card-input").on('change', function (e) {
        "use strict"
        e.preventDefault();
        $('.manual-row').empty();
        $('.amount').text('');
        document.getElementById('amount').value = '';
        document.getElementById('btn-area').innerHTML = '';

    const gatewayInputs = document.querySelectorAll('.gateway-card-input');
    const descriptionEl = document.querySelector('.input-description');
    const currencySymbol = '{{ $currencySymbol }}';

    function showAmount(amount) {
        return parseFloat(amount).toFixed(2).replace('.', ',');
    }

        if (this.checked) {
            const min = this.getAttribute('data-min');
            const max = this.getAttribute('data-max');

            descriptionEl.innerHTML = `
                <strong>{{__('Min')}}:</strong> ${currencySymbol}${showAmount(min)} /
                <strong>{{__('Max')}}:</strong> ${currencySymbol}${showAmount(max)}
            `;
        }

        document.getElementById('amount').addEventListener('input', function () {
            const value = this.value.trim();
            const btnArea = document.getElementById('btn-area');

            btnArea.innerHTML = '';

            if (value !== '' && !isNaN(value) && Number(value) > 0) {

                const btn = document.createElement('button');
                btn.type = 'submit';
                btn.id = 'submit-deposit-btn';
                btn.className = 'site-btn secondary-btn btn-xxl radius-10 mt-3 mb-3';
                btn.innerHTML = 'Ir para o Pagamento <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.4" d="M19 13C19 17.4183 15.4183 21 11 21C6.58172 21 3 17.4183 3 13C3 8.58172 6.58172 5 11 5C15.4183 5 19 8.58172 19 13Z" fill="white" /><path fill-rule="evenodd" clip-rule="evenodd" d="M16 3.75C15.5858 3.75 15.25 3.41421 15.25 3C15.25 2.58579 15.5858 2.25 16 2.25H21C21.4142 2.25 21.75 2.58579 21.75 3V8C21.75 8.41421 21.4142 8.75 21 8.75C20.5858 8.75 20.25 8.41421 20.25 8V4.81066L10.5303 14.5303C10.2374 14.8232 9.76256 14.8232 9.46967 14.5303C9.17678 14.2374 9.17678 13.7626 9.46967 13.4697L19.1893 3.75H16Z" fill="white" /></svg>';

                btnArea.appendChild(btn);

                btn.addEventListener('click', function () {
                    btn.disabled = true;
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> PROCESSANDO DADOS...';
                    document.getElementById('deposit-form').submit();
                });
            }
        });

        $('#amount').on('keyup', function (e) {
            "use strict"
            let amount = parseFloat($(this).val()) || 0;
              let formattedAmount = amount.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            $('.amount').text(formattedAmount);
            $('.currency').text(currency)

            var total = (Number(amount) + Number(charge));

            $('.total').text(total + ' ' + currency)

            $('.pay-amount').text(total * globalData.rate + ' ' + globalData.currency)
        })
    });
    function showCloseButton(event) {
      const button = event.target.parentElement.nextElementSibling;
      button.style.display = 'block';
    }
        window.onpageshow = function(event) {
                if (event.persisted) {
                    window.location.reload();
                }
        };
    document.addEventListener('DOMContentLoaded', () => {
      const copyButtons = document.querySelectorAll('.referral-url-copy-btn');

      copyButtons.forEach(button => {
        button.addEventListener('click', (event) => {
          const referralLink = button.previousElementSibling.textContent;
          copyToClipboard(referralLink, button.nextElementSibling);
        });
      });
    });

    function copyToClipboard(linkText, copyMessageElement) {
      const textArea = document.createElement('textarea');
      textArea.value = linkText;
      document.body.appendChild(textArea);
      textArea.select();
      document.execCommand('copy');
      document.body.removeChild(textArea);

      copyMessageElement.style.opacity = 1;
      setTimeout(() => {
        copyMessageElement.style.opacity = 0;
      }, 2000);
    }

    // Load More
    $('.rock-moreless-button').click(function () {
      $('.moretext').slideToggle();
      if ($('.rock-moreless-button').text() == "Load more") {
        $(this).text("Load less")
      } else {
        $(this).text("Load more")
      }
    });

    $('.rock-moreless-button-2').click(function () {
      let moreText = $('.moretext-2');
      let button = $(this);

      if (moreText.css('display') === 'none') {
        moreText.css('display', 'flex').hide();
        moreText.stop().slideDown('slow', function () {
          $(this).css('height', 'auto');
        });
        button.text("Load less");
      } else {
        moreText.stop().slideUp('slow', function () {
          $(this).css('display', 'none');
        });
        button.text("Load more");
      }
    });
</script>
@endsection
