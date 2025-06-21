@extends('frontend::layouts.user')
@section('title')
    {{ __('Withdraw Now') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">{{ __('Withdraw Money') }}</h3>
                    <div class="card-header-links">
                        <a href="{{ route('user.withdraw.account.index') }}"
                           class="card-header-link">{{ __('Withdraw Account') }} </a>
                    </div>
                </div>
                <div class="site-card-body">
                            @php
                            $investiu = \App\Models\Invest::where('user_id', $user->id)->count();
                            @endphp
                            @if($user->balance >= 25)
                          <div class="alert site-alert alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                        <div class="content d-flex align-items-center">
                            <div class="icon me-2"><i class="anticon anticon-warning"></i></div>

                            @if($investiu == 0)
                            <span> Você sabia que é possível Investir utilizando Seu Saldo? </span>
                            @else
                            <span> Você sabia que é possível Reinvestir utilizando Seu Saldo? </span>
                            @endif
                        </div>
                        <div class="action d-flex">
                            <a href="{{ route('user.schema') }}" class="site-btn-sm blue-btn me-2">
                                <i class="anticon anticon-info-circle"></i>@if($investiu == 0) {{ __('Investir Agora') }}   @else {{ __('Reinvestir Agora') }}   @endif
                            </a>
                        </div>
                    </div>
                     @endif
                     @if($user->balance == 10)
                        <div class="alert site-alert alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert" style="background: #e91e42;color: rgb(255 255 255 / 80%);">
                        <div class="content d-flex align-items-center">
                            <div class="icon me-2" style="background: rgb(2 42 62);color: #ffffff;"><i class="anticon anticon-warning"></i></div>
                            <span> Á PEDIDO DE MUITOS USUÁRIOS, ESTAMOS ATUALIZANDO O MÉTODO DE SAQUE. E TAMBÉM, COLOCAREMOS OUTRAS OPÇÕES DE CHAVES. <br>
                            APROVEITAREMOS O PROCESSO, PARA REALIZAR A MANUTENÇÃO EM NOSSOS SERVIDORES, TRAZENDO O QUE HÁ DE MELHOR PARA VOCÊ!<br>
                            PEDIMOS A COMPREENSÃO E PACIÊNCIA DE TODOS. MUITO OBRIGADO!</span>
                        </div>

                    </div>
                     @else
                    <div class="progress-steps-form">
                        @if($accounts->count() == 0)
                      <div class="text-center">
                         <a href="{{ route('user.withdraw.account.create') }}"
                           class="site-btn blue-btn">{{ __('Adicione uma Conta de Saque') }}</a>
                         </div>
                         @elseif($invest->count() > 0)
                        <form action="{{ route('user.thewithdraw.now') }}" method="post" id="withdraw-form">
                            @csrf
                            <input type="hidden" name="form_token" value="{{ Str::random(40) }}">
                            <div class="row">
                                <div class="col-xl-6 col-md-12 mb-3">
                                    <label for="exampleFormControlInput1"
                                           class="form-label">{{ __('Withdraw Account') }}</label>
                                    <div class="input-group">
                                        <select name="withdraw_account" id="withdrawAccountId" class="site-nice-select">
                                            <option selected disabled>{{ __('Withdraw Method') }}</option>
                                            @foreach($accounts as $account)
                                              @php
                                                    $credentials = json_decode($account->credentials, true);
                                                @endphp
                                                <option value="{{ $account->tnx }}">{{ $account->method_name }} -  Apelido da Carteira: {{ array_key_exists('Apelido da Carteira', $credentials) ? $credentials['Apelido da Carteira']['value'] : 'Não informado' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-info-text processing-time"></div>
                                </div>
                                <div class="col-xl-6 col-md-12 amount" style="display:none;">
                                    <label for="exampleFormControlInput1" class="form-label">{{ __('Amount') }}</label>
                                    <div class="input-group">
                                        <input type="text" name="amount"
                                               oninput="this.value = validateDouble(this.value)"
                                               class="form-control withdrawAmount" id="amount" placeholder="Enter Amount">
                                    </div>
                                    <div class="input-info-text withdrawAmountRange"></div>
                                </div>
                            </div>
                            <div class="transaction-list table-responsive">
                                <div class="user-panel-title">
                                    <h3>{{ __('Withdraw Details') }}</h3>
                                </div>
                                <table class="table">
                                    <tbody class="selectDetailsTbody">
                                    <tr class="detailsCol">
                                        <td><strong>{{ __('Withdraw Amount') }}</strong></td>
                                        <td>{{ setting('currency_symbol','global') }} <span class="withdrawAmount"></span> </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="buttons" id="btn-area">


                            </div>
                        </form>
                            @else
                    <div class="row desktop-screen-show">
    <div class="col">
                <div class="alert site-alert alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
            <div class="content d-flex align-items-center">
                <div class="icon me-2"><i class="anticon anticon-warning"></i></div>
                <span> {{ __('Para Sacar Valores, você precisa fazer um Investimento') }} </span>
            </div>
            <div class="action d-flex">
                <a href="{{ route('user.schema') }}" class="site-btn-sm grad-btn me-2">
                    <i class="anticon anticon-info-circle"></i>{{ __('Ver Planos') }}
                </a>
            </div>
        </div>
            </div>
</div>

                    @endif


                    </div>
                    @endif
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
        btn.type = 'button';
        btn.id = 'submit-withdraw-btn';
        btn.className = 'site-btn blue-btn';
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

            $('.selectDetailsTbody').children().not(':first', ':second').remove();
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

            // Limpa o cache da página quando o usuário volta
            window.onpageshow = function(event) {
                if (event.persisted) {
                    window.location.reload();
                }
            };
    </script>
@endsection
