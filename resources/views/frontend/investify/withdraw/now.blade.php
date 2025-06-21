@extends('frontend::layouts.user')
@section('title')
    {{ __('Withdraw Now') }}
@endsection
@section('content')
@php
	$customCaptcha = loadCustomCaptcha();
@endphp
<style type="text/css">
.gateway-selector {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.form-label {
color: #404040;
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
    .bank-style-modal {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .bank-style-modal .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        border-radius: 10px 10px 0 0 !important;
    }

    .bank-style-modal .modal-title {
        color: #2c3e50;
        font-weight: 600;
    }

    .account-card {
        display: flex;
        align-items: center;
        padding: 12px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .account-icon {
        width: 40px;
        height: 40px;
        margin-right: 15px;
    }

    .account-icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .account-details h6 {
        margin-bottom: 2px;
        font-weight: 600;
        color: #2c3e50;
    }

    .fee-info {
        border-radius: 8px;
        border-left: 3px solid #3498db;
    }

    #confirm_withdraw {
        border-radius: 8px;
        padding: 10px;
        font-weight: 500;
    }

    .input-group-text {
        background-color: #f8f9fa;
    }
</style>
    <div class="container-fluid default-page">

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

                                <div class="row gy-30">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 ">
                                        <div class="rock-single-input">
                                            <label class="input-label" for="">{{ __('Withdraw Account') }}</label>

                                        <div class="gateway-cards">
                                        @foreach($accounts as $account)
                                                    @php
                                                    $credentials = json_decode($account->credentials, true);
                                                    $rules = \App\Models\WithdrawMethod::where('tnx', $account->withdraw_method_tnx)->first();
                                                    @endphp

                                        <div class="gateway-card">
                                            <input type="radio" name="gateway_code" id="gateway_{{ $account->tnx }}" value="{{ $account->tnx }}" class="gateway-card-input"
                                                       data-charge="{{ $rules->charge}}"
                                                       data-charge_type="{{ $rules->charge_type}}"
                                                       data-min="{{ $rules->min_withdraw ?? 0 }}"
                                                       data-max="{{ $rules->max_withdraw ?? 0 }}">
                                            <label for="gateway_{{ $account->tnx }}" class="gateway-card-label">
                                                @if($rules->icon)
                                                <img src="{{ asset('assets/' . $rules->icon) }}" alt="{{ $account->name }}" class="gateway-card-logo">
                                                @endif
                                                <span class="gateway-card-name" style="font-size: 14px;">{{ $account->method_name }}</span>
                                                <span class="gateway-card-name" style="font-size: 12px;">Apelido da Carteira: <br>{{ array_key_exists('Apelido da Carteira', $credentials) ? $credentials['Apelido da Carteira']['value'] : 'Não informado' }}</span>
                                                <div class="gateway-card-check"><i class="fas fa-check"></i></div>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>

                                        </div>
                                    </div>

                                </div>
                           @else
                           <div class="alert rock-alert" style="background-color: #e10041;">
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

<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bank-style-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="withdrawModalLabel">Confirmar Saque</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.thewithdraw.now') }}" method="POST" id="withdraw-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="withdraw_account" id="selected_gateway">

                            <div class="selected-account-info mb-4">
                                <label class="form-label">{{__('Método Escolhido')}}</label>
                                <div class="account-card">
                                    <div class="account-icon">
                                        <img id="method_icon" src="" alt="Método de Saque">
                                    </div>
                                    <div class="account-details">
                                        <h6 id="method_name"></h6>
                                        <p class="small text-muted" id="wallet_nickname"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="fee-info alert alert-light mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>{{__('Seu Saldo')}}</span>
                                    <span id="" class="fw-bold"><span style="font-size: small">{{ $currencySymbol }} </span>{{showamount($user->balance) }} </span>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">{{__('Valor do Saque')}}</label>
                                <div class="input-group">
                                    <span class="input-group-text">{{ setting('currency_symbol','global') }}</span>
                                    <input type="tel" class="form-control form-control-lg" name="amount" id="amount" placeholder="0.00" oninput="this.value = validateDouble(this.value)" required>
                                </div>
                                <div class="form-text text-end">
                                    <small>Min: <span id="min_amount" class="fw-bold">0,00</span> | Max: <span id="max_amount" class="fw-bold">0,00</span></small>
                                </div>
                            </div>

                            <div class="fee-info alert alert-light mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Taxa de saque:</span>
                                    <span id="fee_value" class="fw-bold">{{ setting('currency_symbol','global') }} 0,00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Valor total:</span>
                                    <span id="total_amount" class="fw-bold">{{ setting('currency_symbol','global') }} 0,00</span>
                                </div>
                            </div>
                                @if($customCaptcha)
                                    <div class="rock-single-input">
                                        <div class="mb-2">
                                            @php echo $customCaptcha @endphp
                                        </div>
                                        <label class="form-label">@lang('Captcha')</label>
                                        <div class="input-group">
                                        <input type="text" name="captcha" class="form-control form-control-lg" placeholder="{{__('Enter the Captcha Above')}}" required>
                                         </div>
                                    </div>
                                @endif
                    <div class="alert alert-warning small" id="balance_warning" style="display: none;">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{__('Você irá Receber')}} <span id="required_balance" class="fw-bold">{{ setting('currency_symbol','global') }} 0,00</span>.
                    </div>

                    <div class="d-grid gap-2" id="btn-area">

                    </div>
                </form>
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

    btnArea.innerHTML = '';

    if (value !== '' && !isNaN(value) && Number(value) > 0) {

        const btn = document.createElement('button');
        btn.type = 'submit';
        btn.id = 'submit-withdraw-btn';
        btn.className = 'site-btn secondary-btn btn-xxl radius-10 mt-3 mb-3';
        btn.innerHTML = `{{__('Solicitar Saque')}}                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4"
                                d="M19 13C19 17.4183 15.4183 21 11 21C6.58172 21 3 17.4183 3 13C3 8.58172 6.58172 5 11 5C15.4183 5 19 8.58172 19 13Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16 3.75C15.5858 3.75 15.25 3.41421 15.25 3C15.25 2.58579 15.5858 2.25 16 2.25H21C21.4142 2.25 21.75 2.58579 21.75 3V8C21.75 8.41421 21.4142 8.75 21 8.75C20.5858 8.75 20.25 8.41421 20.25 8V4.81066L10.5303 14.5303C10.2374 14.8232 9.76256 14.8232 9.46967 14.5303C9.17678 14.2374 9.17678 13.7626 9.46967 13.4697L19.1893 3.75H16Z"
                                fill="white" />
                        </svg>`;

        btnArea.appendChild(btn);


    }
});

document.addEventListener('DOMContentLoaded', function() {
    const withdrawModal = new bootstrap.Modal(document.getElementById('withdrawModal'));
    const gatewayInputs = document.querySelectorAll('.gateway-card-input');
    const amountInput = document.getElementById('amount');
    const feeValue = document.getElementById('fee_value');
    const totalAmount = document.getElementById('total_amount');
    const minAmount = document.getElementById('min_amount');
    const maxAmount = document.getElementById('max_amount');
    const methodName = document.getElementById('method_name');
    const walletNickname = document.getElementById('wallet_nickname');
    const methodIcon = document.getElementById('method_icon');
    const selectedGateway = document.getElementById('selected_gateway');
    const balanceWarning = document.getElementById('balance_warning');
    const requiredBalance = document.getElementById('required_balance');
    const withdrawForm = document.getElementById('withdraw-form');

    let currentCharge = 0;
    let currentChargeType = 'fixed';
    let currentMin = 0;
    let currentMax = 0;


    function validateDouble(value) {

        value = value.replace(/[^\d.]/g, '');

        const parts = value.split('.');
        if (parts.length > 2) {
            value = parts[0] + '.' + parts.slice(1).join('');
        }

        return value;
    }

    amountInput.addEventListener('input', function(e) {
        this.value = validateDouble(this.value);
        const amount = parseFloat(this.value) || 0;
        updateFeeAndTotal(amount);
    });


    gatewayInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.checked) {

                currentCharge = parseFloat(this.dataset.charge) || 0;
                currentChargeType = this.dataset.charge_type || 'fixed';
                currentMin = parseFloat(this.dataset.min) || 0;
                currentMax = parseFloat(this.dataset.max) || 0;


                minAmount.textContent = currentMin.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                maxAmount.textContent = currentMax.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2});


                const cardLabel = this.closest('.gateway-card').querySelector('.gateway-card-label');
                const methodNameText = cardLabel.querySelector('.gateway-card-name').textContent;
                const walletNicknameText = cardLabel.querySelectorAll('.gateway-card-name')[1].textContent;
                const iconSrc = cardLabel.querySelector('img')?.src || '';

                methodName.textContent = methodNameText;
                walletNickname.textContent = walletNicknameText;
                if (iconSrc) {
                    methodIcon.src = iconSrc;
                    methodIcon.style.display = 'block';
                } else {
                    methodIcon.style.display = 'none';
                }

                selectedGateway.value = this.value;

                amountInput.value = '';
                updateFeeAndTotal(0);

                withdrawModal.show();
            }
        });
    });

    function updateFeeAndTotal(amount) {
        let fee = 0;

        if (currentChargeType === 'percentage') {
            fee = amount * (currentCharge / 100);
            feeValue.textContent = `${currentCharge}% (R$ ${fee.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2})})`;
        } else {
            fee = currentCharge;
            feeValue.textContent = `R$ ${fee.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        }

        const total = amount - fee;
        totalAmount.textContent = `R$ ${total.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;

        if (amount > 0) {
            balanceWarning.style.display = 'block';
            requiredBalance.textContent = `R$ ${total.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        } else {
            balanceWarning.style.display = 'none';
        }
    }

    withdrawModal._element.addEventListener('hidden.bs.modal', function() {
        amountInput.value = '';
        updateFeeAndTotal(0);

        gatewayInputs.forEach(input => {
            if (input.checked) {
                input.checked = false;
            }
        });
    });
});

    </script>
@endsection
