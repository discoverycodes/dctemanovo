@extends('frontend::layouts.user')
@section('title')
    {{ __('Withdraw Now') }}
@endsection
@section('content')

    <div class="container-fluid default-page">

         @if(auth()->check() && auth()->user()->cpf === '0')
         <div class="alert rock-alert fade show customAlert" role="alert" style="background-color: #e10041;">
                <div class="alert-content-inner d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z" fill="#E9D8A6"></path>
                                <circle cx="18" cy="8" r="4" fill="#E9D8A6"></circle>
                            </svg>
                        </div>
                        <strong>
                         Para Sacar via PIX, cadastre seu CPF
                        </strong>
                    </div>
                    <div class="alert-btn-groupe">
                     <button class="site-btn radius-12" data-bs-toggle="modal" data-bs-target="#cpfmodal">
                                <i class="anticon anticon-info-circle"></i>{{ __('Cadastrar CPF') }}
                            </button>
                    </div>
                </div>
            </div>

                    @endif

        <div class="row gy-30">
            <div class="col-xxl-12">
                <div class="rock-withdraw-area">
                    <div class="rock-dashboard-card">
                        <div class="rock-dashboard-title-inner">
                            <div class="content">
                                <h3 class="rock-dashboard-tile">{{ __('Withdraw Money') }}</h3>
                            </div>
                            <a class="site-btn gradient-btn radius-12" href="{{ route('user.withdraw.account.index') }}" >
                                {{ __('Withdraw Account') }}
                            </a>
                        </div>
                        <div class="rock-add-mony-wrapper">
                            @if($accounts->count() == 0)
                               <div class="text-center">
                         <a href="{{ route('user.withdraw.account.create') }}"
                           class="site-btn gradient-btn radius-12">{{ __('Adicione uma Conta de Saque') }}</a>
                         </div>
                         @elseif($invest->count() > 0)
                            <form action="{{ route('user.thewithdraw.now') }}" method="POST" id="withdraw-form" autocomplete="off">
                                @csrf
                                <div class="row gy-30">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 ">
                                        <div class="rock-single-input">
                                            <label class="input-label" for="">{{ __('Withdraw Method') }}</label>
                                            <div class="input-select">
                                                <select name="withdraw_account" id="withdrawAccountId">
                                                    <option selected disabled>{{ __('Withdraw Method') }}</option>
                                                    @foreach($accounts as $account)
                                                      @php
                                                    $credentials = json_decode($account->credentials, true);
                                                @endphp
                                                        <option value="{{ $account->tnx }}">{{ $account->method_name }} -  Apelido da Carteira: {{ array_key_exists('Apelido da Carteira', $credentials) ? $credentials['Apelido da Carteira']['value'] : 'Não informado' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="input-description processing-time"></p>
                                        </div>
                                        <div class="rock-single-input">
                                            <label class="input-label" for="">{{ __('Enter Amount') }}</label>
                                            <div class="input-field">
                                                <input type="text" class="box-input withdrawAmount" name="amount" id="amount" placeholder="0.00" oninput="this.value = validateDouble(this.value)">
                                                <span class="input-icon">
                                                    <svg width="24" height="25" viewBox="0 0 24 25"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.4"
                                                            d="M22 12.5C22 18.0228 17.5228 22.5 12 22.5C6.47715 22.5 2 18.0228 2 12.5C2 6.97715 6.47715 2.5 12 2.5C17.5228 2.5 22 6.97715 22 12.5Z"
                                                            fill="white" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V7.85352C13.9043 8.17998 14.75 9.24122 14.75 10.5C14.75 10.9142 14.4142 11.25 14 11.25C13.5858 11.25 13.25 10.9142 13.25 10.5C13.25 9.80964 12.6904 9.25 12 9.25C11.3096 9.25 10.75 9.80964 10.75 10.5C10.75 11.1904 11.3096 11.75 12 11.75C13.5188 11.75 14.75 12.9812 14.75 14.5C14.75 15.7588 13.9043 16.82 12.75 17.1465V18C12.75 18.4142 12.4142 18.75 12 18.75C11.5858 18.75 11.25 18.4142 11.25 18V17.1465C10.0957 16.82 9.25 15.7588 9.25 14.5C9.25 14.0858 9.58579 13.75 10 13.75C10.4142 13.75 10.75 14.0858 10.75 14.5C10.75 15.1904 11.3096 15.75 12 15.75C12.6904 15.75 13.25 15.1904 13.25 14.5C13.25 13.8096 12.6904 13.25 12 13.25C10.4812 13.25 9.25 12.0188 9.25 10.5C9.25 9.24122 10.0957 8.17998 11.25 7.85352V7C11.25 6.58579 11.5858 6.25 12 6.25Z"
                                                            fill="white" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <p class="input-description withdrawAmountRange"></p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 ">
                                        <div class="rock-add-mony-details">
                                            <h4 class="title">{{ __('Withdraw Details') }}</h4>
                                            <div class="rock-add-mony-list">
                                                <ul class="reviewDetails">
                                                    <li class="detailsCol">
                                                        <span class="title">{{ __('Withdraw Amount') }}</span>
                                                        <span class="info">{{ setting('currency_symbol','global') }}<span class="withdrawAmount"></span></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rock-input-btn-wrap justify-content-end" id="btn-area">

                                    </div>
                                </div>
                            </form>
                           @else
               <div class="alert rock-alert fade show customAlert" role="alert" style="background-color: #e10041;">
                <div class="alert-content-inner d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z" fill="#E9D8A6"></path>
                                <circle cx="18" cy="8" r="4" fill="#E9D8A6"></circle>
                            </svg>
                        </div>
                        <strong>
                        {{ __('Para Sacar Valores, você precisa fazer um Investimento') }}
                        </strong>
                    </div>
                    <div class="alert-btn-groupe">
                         <a href="{{ route('user.schema') }}" class="site-btn radius-12">
                    <i class="anticon anticon-info-circle"></i>{{ __('Ver Planos') }}
                </a>

                    </div>
                </div>
            </div>
                    @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
 document.getElementById('amount').addEventListener('input', function () {
    const value = this.value.trim();
    const btnArea = document.getElementById('btn-area');

    // Remove o botão se já existir
    btnArea.innerHTML = '';

    // Verifica se o valor é válido
    if (value !== '' && !isNaN(value) && Number(value) > 0) {
        // Cria o botão dinamicamente
        const btn = document.createElement('button');
        btn.type = 'submit';
        btn.id = 'submit-withdraw-btn';
        btn.className = 'site-btn gradient-btn radius-10';
        btn.innerHTML = '<i class="anticon anticon-double-right"></i> Solicitar Saque';

        // Adiciona ao DOM
        btnArea.appendChild(btn);

        // Adiciona o evento de click
        btn.addEventListener('click', function () {
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> PROCESSANDO SAQUE...';
            document.getElementById('withdraw-form').submit();
        });
    }
});
        "use strict";
        var info = [];
        $("#withdrawAccountId").on('change', function (e) {
            e.preventDefault();
            $('.amount').show();

            $('.reviewDetails').children().not(':first', ':second').remove();
            document.getElementById("amount").value = '';
            $('.withdrawAmount').text('');
            var accountId = $(this).val()
            var amount = $('.withdrawAmount').val();
            if (accountId) {

                var url = '{{ route("user.withdraw.details",['accountId' => ':accountId', 'amount' => ':amount']) }}';
                url = url.replace(':accountId', accountId,);
                url = url.replace(':amount', amount);

                $.get(url, function (data) {
                    $(data.html).insertAfter(".detailsCol");
                    info = data.info;
                    $('.withdrawAmountRange').text(info.range)
                    $('.processing-time').text(info.processing_time)
                })
            }


        })
       $(".withdrawAmount").on('keyup', function (e) {
            "use strict"
            e.preventDefault();
            var amount = $(this).val().replace(',', '.');
            var parsed = parseFloat(amount);

            if (!isNaN(parsed)) {
                var formattedAmount = parsed.toLocaleString('pt-BR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                $('.withdrawAmount').text(formattedAmount);
            } else {
                $('.withdrawAmount').text('0,00');
            }

            var charge = info.charge_type === 'percentage' ? calPercentage(amount, info.charge) : info.charge
            var formattedCharge = parseFloat(charge).toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            $('.withdrawFee').text(formattedCharge);
            $('.processing-time').text(info.processing_time)
            $('.withdrawAmountRange').text(info.range)
            var amountNumber = Number(amount);
            var charge = (amountNumber * Number(info.charge)) / 100;
            var total = amountNumber + charge;

            $('.pay-amount').text(total.toLocaleString('pt-BR', { minimumFractionDigits: 2 }));
            })
        window.onpageshow = function(event) {
                if (event.persisted) {
                    window.location.reload();
                }
        };
    </script>
@endsection
