@extends('frontend::layouts.user')
@section('title')
    {{ __('Schema Preview') }}
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">{{ __('Review and Confirm Investment') }}</h3>
                </div>
                <div class="site-card-body">
                    <form action="{{route('user.invest-now')}}" method="post" enctype="multipart/form-data" onsubmit="disableSubmitButton()">
                        @csrf
                        <div class="progress-steps-form">
                            <div class="transaction-list table-responsive">
                                <table class="table preview-table">
                                    <tbody>
                                    <tr>
                                        <td><strong>{{ __('Plano Selecionado') }}: {{$schema->name}}</strong></td>

                                    </tr>


                                    <tr>
                                        <td><strong>{{ __('Valor:') }}</strong></td>
                                        <td id="amount">
                                            {{ $schema->type == 'range' ? 'Mínimo ' . setting('currency_symbol','global').showAmount( $schema->min_amount ) . ' - ' . 'Máximo ' . setting('currency_symbol','global').showAmount( $schema->max_amount ) : setting('currency_symbol','global').showAmount( $schema->fixed_amount ) }}
                                        </td>
                                    </tr>
                                       @if($schema->fixed_amount == 0)
                                    <tr>
                                        <td><strong>{{ __('Digite o Valor') }}</strong></td>
                                        <td>
                                            <div class="input-group mb-0">
                                                <input type="text" class="form-control"
                                                       @if($schema->type == 'fixed') value="{{ $schema->fixed_amount }}"
                                                       readonly @endif placeholder="{{ __('Digite o Valor') }}"
                                                       oninput="this.value = validateDouble(this.value)"
                                                       aria-label="Amount" name="invest_amount" id="enter-amount"
                                                       aria-describedby="basic-addon1" required>
                                                <span class="input-group-text" id="basic-addon1">{{ setting('currency_symbol','global') }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <input type="hidden" name="invest_amount" value="{{ $schema->fixed_amount }}" />
                                    @endif


                                    <tr>
                                        <td><strong>{{ __('Return of Interest:') }}</strong></td>
                                        <td id="return-interest">
                                            @if($schema->interest_type == 'fixed')
                                                <p>{{ $schema->fixed_roi .' '. ($schema->roi_interest_type == 'percentage' ? '%' : '$') }} {{__('em')}} {{ $schema->schedule->name }}</p>
                                            @else
                                                <p>{{ $schema->schedule->name . ' ' . $schema->min_roi . '-' . $schema->max_roi .' '. ($schema->roi_interest_type == 'percentage' ? '%' : '$') }}</p>
                                            @endif
                                        </td>
                                    </tr>
                           

                                    </tbody>
                                </table>
                            </div>
                            <div class="button">
                                <button type="submit" class="site-btn primary-btn me-3" id="submit-btn">
                                    <i class="anticon anticon-check"></i>{{ __('Invest Now') }}
                                </button>
                                <a href="{{route('user.schema')}}" class="site-btn black-btn">
                                    <i class="anticon anticon-stop"></i>{{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>


        $("#select-schema").on('change', function (e) {
            "use strict";
            e.preventDefault();
            var id = $(this).val();
            var invest_amount = $("#enter-amount");
            invest_amount.val('');
            invest_amount.attr('readonly', false);

            var url = '{{ route("user.schema.select", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url, success: function (result) {
                    $('#amount').html(result.amount_range);
                    $('#holiday').html(result.holiday);
                    $('#return-interest').html(result.return_interest);
                    $('#number-period').html(result.number_period);
                    $('#capital_back').html(result.capital_back);

                    if (result.invest_amount > 0) {
                        invest_amount.val(result.invest_amount);
                        invest_amount.attr('readonly', true);
                    }

                }
            });
        });

        $("#enter-amount").on('keyup', function (e) {
            "use strict";
            e.preventDefault();
            var amount = $(this).val();
            $("#total-amount").html(amount);
        })

        $("#selectWallet").on('change', function (e) {
            "use strict";
            $('.gatewaySelect').empty();
            $('.manual-row').empty();
            var wallet = $(this).val();
            if (wallet === 'gateway') {
                $.get('{{ route('gateway.list') }}', function (data) {
                    $('.gatewaySelect').append(data)
                    $('select').niceSelect();

                });
            }

        })
        $('body').on('change', '#gatewaySelect', function (e) {
            "use strict"
            e.preventDefault();
            $('.manual-row').empty();
            var code = $(this).val()
            var url = '{{ route("user.deposit.gateway",":code") }}';
            url = url.replace(':code', code);
            $.get(url, function (data) {
                $('.invest-gateway-charge').text('Charge ' + data.charge_gateway)
                if (data.credentials !== undefined) {
                    $('.manual-row').append(data.credentials)
                    imagePreview()
                }
            });
        });

function disableSubmitButton() {
    const btn = document.getElementById('submit-btn');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> PROCESSANDO...';

    // Opcional: Remove o atributo disabled se houver erro na validação
    window.addEventListener('unload', function() {
        btn.disabled = false;
        btn.innerHTML = '<i class="anticon anticon-check"></i>Investir Agora';
    });
}


    </script>
@endsection
