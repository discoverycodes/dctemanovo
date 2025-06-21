@extends('frontend::layouts.user')
@section('title')
{{ __('All Schema') }}
@endsection
@section('content')
<style>
[aria-hidden="true"] {
    display: none !important;
}
#investmentModal .modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}
#investmentModal .text-primary {
    color: #8BC34A !important;
}
#modalPlanSummary {
    font-weight: 500;
    color: #333;
    line-height: 1.4;
}

    .modal-header {

    }

    .btn-primary {
        background-color: #53811d;
        border-color: #53811d;
    }

    .btn-primary:hover {
        background-color: #003d66;
        border-color: #003d66;
    }

    #submitButton {
        transition: all 0.2s;
    }

    #submitButton:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 83, 138, 0.3);
    }

    .card {
        border-radius: 10px !important;
    }
</style>
<!-- Container-fluid starts-->
<div class="container-fluid default-page">
    <div class="row gy-30">
        <div class="col-xxl-12">
            <!-- Pricing section srart -->
            <section class="rock-dashboard-pricing-section">
                <div class="row gy-30">
                    @foreach($schemas as $index => $schema)

                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <div class="rock-pricing-item @if($schema->featured) is-active @endif" data-background="{{ asset('assets/frontend/theme_base/hardrock/images/bg/ranking-badge.png') }}" style="background-size:cover;">
                            <h3 class="item-title">{{ $schema->name }}</h3>
                                 <div class="price-list">
                                <ul class="icon-list">
                                    <li>
                                        <div class="single-list">
                                            <div class="list-content">
                                                <span class="list-item-icon">
                                                    <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.4"
                                                            d="M2.33366 3.6665H0.666992V11.1665L4.25935 12.9627C5.18506 13.4255 6.20581 13.6665 7.24078 13.6665H14.0003C14.9208 13.6665 15.667 12.9203 15.667 11.9998C15.667 11.0794 14.9208 10.3332 14.0003 10.3332H12.6807C11.9044 10.3332 11.1389 10.1524 10.4446 9.80531L7.99365 8.57983C8.15391 8.43226 8.2863 8.24923 8.37767 8.03602C8.72231 7.23187 8.35373 6.30029 7.5522 5.94961L2.33366 3.6665Z"
                                                            fill="green" />
                                                        <path
                                                            d="M9.50695 4.09195L11.6049 6.71441C12.4056 7.71523 13.9278 7.71523 14.7284 6.71441L16.8264 4.09195C17.1545 3.68174 17.3333 3.17205 17.3333 2.64673V2.54296C17.3333 1.32257 16.344 0.333252 15.1236 0.333252H14.8758C14.4484 0.333252 14.0386 0.503021 13.7364 0.805212C13.4217 1.11985 12.9116 1.11985 12.597 0.805212C12.2948 0.503021 11.8849 0.333252 11.4575 0.333252H11.2097C9.98932 0.333252 9 1.32257 9 2.54296V2.64673C9 3.17205 9.17879 3.68174 9.50695 4.09195Z"
                                                            fill="green" />
                                                    </svg>
                                                </span>
                                                <p class="list-item-text">{{ __('Investment') }}</p>
                                            </div>

                                            <div class="list-valu" >
                                                <span style="font-size: 18px;">@if($schema->type == 'range')
    <o style="font-size: small">{{ $currencySymbol }}</o>{{ showAmount($schema->min_amount) }} -
    <o style="font-size: small">{{ $currencySymbol }}</o>{{ showAmount($schema->max_amount) }}
@else
    <o style="font-size: small">{{ $currencySymbol }}</o>{{ showAmount($schema->fixed_amount) }}
@endif</span>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="price-value text-center mb-4">
                                @if($schema->roi_interest_type == 'fixed')
<span style="
    background: rgb(104 129 75);
    border-radius: 10px;
    padding: 5px 11px;
    color: var(--td-white);
    font-size: 15px;
    font-weight: 500;">{{__('Dobre seu Investimento em 30 Dias')}}</span>
                                    <span class="price-badge" style="font-size: 16px;"><i class="fas fa-chart-line"></i> <span style="color: #339900"><b><span style="font-size: small">{{ $currencySymbol}}</span>{{showAmount($schema->fixed_roi)}} </b></span>{{ __('a cada ') }} {{ __('10 Dias') }}</span>
                                    <span class="price-badge" style="font-size: 16px;"><i class="fas fa-chart-line"></i> <span style="color: #339900"><b><span style="font-size: small">{{ $currencySymbol}}</span>{{showAmount($schema->fixed_roi * $schema->number_of_period)}}</b></span> {{ __('em ') }} {{ __('30 Dias') }}</span>
                                @else
                                    <span class="price-badge" style="font-size: 16px;">{{ $schema->schedule->name . ' ' . $schema->min_roi . '-' . $schema->max_roi . ($schema->roi_interest_type == 'percentage' ? '%' : '$') }}</span>
                                @endif

                            </div>

                            <div class="price-btn-wrp">

                            <a class="choose site-btn secondary-btn" href="#" data-schema-id="{{ $schema->id }}"
       data-fixed-roi="{{ $schema->fixed_roi }}"
       data-number-of-period="{{ $schema->number_of_period }}"> <span><svg width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle opacity="0.4" cx="12" cy="12" r="10" transform="rotate(180 12 12)"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M22.5018 2.44254C22.8096 2.71963 22.8346 3.19385 22.5575 3.50173L13.8199 13.0991C12.8454 14.1819 11.1955 14.3168 10.0579 13.4068L6.53151 10.5857C6.20806 10.3269 6.15562 9.85493 6.41438 9.53149C6.67313 9.20804 7.1451 9.1556 7.46855 9.41436L10.995 12.2355C11.512 12.6492 12.262 12.5878 12.705 12.0956L21.4426 2.49828C21.7197 2.1904 22.1939 2.16544 22.5018 2.44254Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    {{ __('Invest Now') }}
                                </a>

                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            <!-- Pricing section end -->
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
<div class="modal fade" id="investmentModal" tabindex="-1" aria-modal="true" aria-labelledby="modalTitle" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="dialog">
        <div class="modal-content border-0" style="border-radius: 12px; overflow: hidden; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);">
            <form action="{{ route('user.invest-now') }}" method="post" id="investmentForm">
                @csrf
                <input type="hidden" name="schema_id" id="modalSchemaId">
                <input type="hidden" name="fixed_roi" id="modalFixedRoi">
                <input type="hidden" name="number_of_period" id="modalNumberOfPeriod">

                <div class="modal-header">
                    <h5 class="modal-title">{{__('Confirmar Investimento')}}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">

                    <div class="" style="display: grid;grid-template-columns: repeat(2, 4fr);gap: 20px 20px;">
                    <div class="card border-0 shadow-sm mb-3" style="background-color: #dbdbdb;border-left: 5px solid #3e1c43 !important;">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted small">{{__('Você escolheu')}}:</h6>
                            <div id="modalPlanText" class="d-flex justify-content-between align-items-center">

                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-3" style="background-color: #dbdbdb;border-left: 5px solid #1c6494 !important;">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted small">{{__('Valor')}}: </h6>
                            <div id="modalAmountText" class="d-flex justify-content-between align-items-center">
                            </div>
                        </div>
                    </div>
                  </div>

                    <div class="card border-0 shadow-sm mb-4" style="background-color: #dbdbdb !important;border-left: 5px solid #4CAF50 !important;">
                        <div class="card-body text-center">
                            <h6 class="card-subtitle mb-2 text-muted small">{{__('Rendimento Total')}}:</h6>
                            <div class="text-center">
                                <span id="modalTotalText" class="h5 text-success fw-bold" style="font-size: 24px;"></span>

                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-2 mb-2 py-3 fw-bold" id="submitButton">
                        <i class="fas fa-check-circle me-2"></i>
                        {{__('Confirmar Investimento')}}
                    </button>

                </div>

                <div class="modal-footer border-top-0 justify-content-center">
                    <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">
                        {{__('Cancelar')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
document.querySelectorAll('.choose').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();

        const schemaId = this.getAttribute('data-schema-id');
        const fixedRoi = this.getAttribute('data-fixed-roi');
        const numberOfPeriod = this.getAttribute('data-number-of-period');

        const totalReturn = (parseFloat(fixedRoi) * parseInt(numberOfPeriod)).toFixed(2);

        document.getElementById('modalSchemaId').value = schemaId;
        document.getElementById('modalFixedRoi').value = fixedRoi;


        const planName = this.closest('.rock-pricing-item').querySelector('.item-title').textContent;
        const amount = this.closest('.rock-pricing-item').querySelector('.list-valu span').textContent;

        // Preenche os cards
        document.getElementById('modalPlanText').innerHTML = `
            <span class="fw-bold" style="color: #3e1c43">${planName}</span>
        `;

        document.getElementById('modalAmountText').innerHTML = `
            <span class="fw-bold" style="color: #00538A">${amount}</span>
        `;

        document.getElementById('modalTotalText').textContent = `R$ ${totalReturn.replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, '$1.')}`;

        // Resetar o estado do formulário
        const form = document.getElementById('investmentForm');
        const submitButton = document.getElementById('submitButton');
        form.classList.remove('was-submitted');
        submitButton.disabled = false;
        submitButton.innerHTML = `<i class="fas fa-check-circle me-2"></i> {{__('Confirmar Investimento')}}`;

        new bootstrap.Modal(document.getElementById('investmentModal')).show();
    });
});

document.getElementById('investmentForm').addEventListener('submit', function(e) {
    const submitButton = document.getElementById('submitButton');

    if (this.classList.contains('was-submitted')) {
        e.preventDefault();
        return;
    }

    this.classList.add('was-submitted');
    submitButton.disabled = true;
    submitButton.innerHTML = `<i class="fas fa-spinner fa-spin me-2"></i> {{__('Processando...')}}`;
});

window.onpageshow = function(event) {
    if (event.persisted) {
        window.location.reload();
    }
};
</script>
@endsection