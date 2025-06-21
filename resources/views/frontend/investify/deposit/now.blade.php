@extends('frontend::layouts.user')
@section('title',__('Deposit'))
@section('content')
<style type="text/css">
.gateway-selector {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.gateway-option {
    position: relative;
}

.gateway-input {
    position: absolute;
    opacity: 0;
}

.gateway-label {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s;
}

.gateway-input:checked + .gateway-label {
    border-color: #20B309;
    background-color: rgba(74, 108, 247, 0.05);
}

.gateway-input:focus + .gateway-label {
    box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.2);
}

.gateway-logo {
    max-height: 20px;
    margin-left: auto;
}

.placeholder {
    color: #999;
    justify-content: center;
}

/* Opção 2 - Cards Selecionáveis */
.gateway-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(165px, 1fr));
    gap: 15px;
}

.gateway-card {
    position: relative;
}

.gateway-card-input {
    position: absolute;
    opacity: 0;
}

.gateway-card-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px 15px;
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
    <div class="row gy-30">
        <div class="col-xxl-12">
            <div class="rock-add-money-area">
                <div class="rock-dashboard-card">
                    <div class="rock-dashboard-title-inner">
                        <div class="content">
                            <h3 class="rock-dashboard-tile">{{ __('Deposit Amount') }}</h3>
                            <p class="description">{{ __('Enter your deposit details') }}</p>
                        </div>
                        <button class="site-btn radius-12" data-bs-toggle="modal" data-bs-target="#Deposit">
                                <i class="anticon anticon-info-circle"></i>{{ __('Cadastrar CPF') }}
                            </button>
                        <a class="site-btn gradient-btn radius-12" href="{{ route('user.deposit.log') }}">{{ __('Deposit History') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Deposit" tabindex="-1" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" >
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="background-color: #1d0e24;border: #ffffff solid 1px;">
        <div class="modal-header" style="display: flex;justify-content: space-between;">
          <h5 class="modal-title text-white">{{__('Deposit') }}</h5>
        </div>
        <div class="modal-body">
                    <div class="rock-add-mony-wrapper">
                        <form action="{{ route('user.deposit.now') }}" method="POST" id="deposit-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-30">
                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                    <div class="rock-single-input">
                                        <label class="input-label" for="">{{ __('Payment Method') }}</label>
                                        <div class="gateway-cards">
                                        @foreach($gateways as $gateway)
                                        <div class="gateway-card">
                                            <input type="radio" name="gateway_code" id="gateway_{{ $gateway->tnx }}" value="{{ $gateway->tnx }}" class="gateway-card-input">
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
                                        <p class="input-description charge"></p>
                                    </div>
                                    <div class="rock-single-input">
                                        <label class="input-label" for="">{{ __('Enter Amount:') }}</label>
                                        <div class="input-field">
                                            <input type="text" class="box-input" name="amount" id="amount" placeholder="0.00" value="" oninput="this.value = validateDouble(this.value)" aria-label="Amount" autocomplete="off" required>
                                            <span class="input-icon">
                                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4"
                                                        d="M22 12.5C22 18.0228 17.5228 22.5 12 22.5C6.47715 22.5 2 18.0228 2 12.5C2 6.97715 6.47715 2.5 12 2.5C17.5228 2.5 22 6.97715 22 12.5Z"
                                                        fill="white" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V7.85352C13.9043 8.17998 14.75 9.24122 14.75 10.5C14.75 10.9142 14.4142 11.25 14 11.25C13.5858 11.25 13.25 10.9142 13.25 10.5C13.25 9.80964 12.6904 9.25 12 9.25C11.3096 9.25 10.75 9.80964 10.75 10.5C10.75 11.1904 11.3096 11.75 12 11.75C13.5188 11.75 14.75 12.9812 14.75 14.5C14.75 15.7588 13.9043 16.82 12.75 17.1465V18C12.75 18.4142 12.4142 18.75 12 18.75C11.5858 18.75 11.25 18.4142 11.25 18V17.1465C10.0957 16.82 9.25 15.7588 9.25 14.5C9.25 14.0858 9.58579 13.75 10 13.75C10.4142 13.75 10.75 14.0858 10.75 14.5C10.75 15.1904 11.3096 15.75 12 15.75C12.6904 15.75 13.25 15.1904 13.25 14.5C13.25 13.8096 12.6904 13.25 12 13.25C10.4812 13.25 9.25 12.0188 9.25 10.5C9.25 9.24122 10.0957 8.17998 11.25 7.85352V7C11.25 6.58579 11.5858 6.25 12 6.25Z"
                                                        fill="white" />
                                                </svg>
                                            </span>
                                        </div>
                                        <p class="input-description min-max"></p>
                                    </div>
                                </div>

                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                    <div class="rock-add-mony-details">
                                        <h4 class="title">{{ __('Review Details') }}</h4>
                                        <div class="rock-add-mony-list">
                                            <ul>
                                                <li>
                                                    <span class="title">{{ __('Amount') }}</span>
                                                    <span class="info"><span class="">{{ setting('currency_symbol','global') }}</span> <span class="amount"></span> </span>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                    <div id="btn-area">

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
        var code = $(this).val()
        var url = '{{ route("user.deposit.gateway",":code") }}';
        url = url.replace(':code', code);
        $.get(url, function (data) {

            globalData = data;

            $('.min-max').text('Mínimo ' + '{{ setting('currency_symbol','global') }}' + data.minimum_deposit + ' e ' +
                'Máximo ' + '{{ setting('currency_symbol','global') }}' + data.maximum_deposit )
            var amount = $('#amount').val()

            if (Number(amount) > 0) {
                $('.amount').text((Number(amount)))
            }

            if (data.credentials !== undefined) {
                $('.manual-row').append(data.credentials)
            }

        });

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
        btn.id = 'submit-deposit-btn';
        btn.className = 'site-btn gradient-btn radius-10 w-100 mb-4';
        btn.innerHTML = 'Ir para o Pagamento <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.4" d="M19 13C19 17.4183 15.4183 21 11 21C6.58172 21 3 17.4183 3 13C3 8.58172 6.58172 5 11 5C15.4183 5 19 8.58172 19 13Z" fill="white" /><path fill-rule="evenodd" clip-rule="evenodd" d="M16 3.75C15.5858 3.75 15.25 3.41421 15.25 3C15.25 2.58579 15.5858 2.25 16 2.25H21C21.4142 2.25 21.75 2.58579 21.75 3V8C21.75 8.41421 21.4142 8.75 21 8.75C20.5858 8.75 20.25 8.41421 20.25 8V4.81066L10.5303 14.5303C10.2374 14.8232 9.76256 14.8232 9.46967 14.5303C9.17678 14.2374 9.17678 13.7626 9.46967 13.4697L19.1893 3.75H16Z" fill="white" /></svg>';

        // Adiciona ao DOM
        btnArea.appendChild(btn);

        // Adiciona o evento de click
        btn.addEventListener('click', function () {
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> PROCESSANDO DADOS...';
            document.getElementById('deposit-form').submit();
        });
    }
});
        $('#amount').on('keyup', function (e) {
            "use strict"
            var amount = $(this).val()
            $('.amount').text((Number(amount)))
            $('.currency').text(currency)

            var charge = globalData.charge_type === 'percentage' ? calPercentage(amount, globalData
                .charge) : globalData.charge
            $('.charge2').text(charge + ' ' + currency)

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
</script>
@endsection
