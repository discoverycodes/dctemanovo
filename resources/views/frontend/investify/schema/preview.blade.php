@extends('frontend::layouts.user')
@section('title')
{{ __('Schema Preview') }}
@endsection
@section('content')
<!-- Schema Preview section start -->
<div class="rock-schema-preview-area">
    <div class="rock-dashboard-card">
        <div class="rock-dashboard-title-inner">
            <div class="content">
                <h3 class="rock-dashboard-tile">{{ __('Review and Confirm Investment') }}</h3>
            </div>
        </div>
        <div class="rock-schema-preview-forrm">
            <form action="{{ route('user.invest-now') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="schema-preview-table table-responsive">
                    <div class="rock-custom-table">
                        <div class="contents">
                            <div class="site-table-list">
                                <div class="site-table-col">
                                    <span>{{ __('Plano Selecionado') }}:</span>
                                </div>
                                <div class="site-table-col">
                                    <div class="rock-single-input">
                                        <div class="input-select">
                                            {{$schema->name}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="site-table-list">
                                <div class="site-table-col">
                                    <span>{{ __('Amount:') }}</span>
                                </div>
                                <div class="site-table-col">
                                    <span id="amount">
                                         {{ $schema->type == 'range' ? 'Mínimo ' . setting('currency_symbol','global').showAmount( $schema->min_amount ) . ' - ' . 'Máximo ' . setting('currency_symbol','global').showAmount( $schema->max_amount ) : setting('currency_symbol','global').showAmount( $schema->fixed_amount ) }}
                                    </span>
                                </div>
                            </div>
                           <div class="site-table-list">
                                <div class="site-table-col">
                                    <span>{{ __('Retorno a cada 10 Dias:') }}</span>
                                </div>
                                <div class="site-table-col">
                                    @if($schema->interest_type == 'fixed')
                                        <span id="return-interest">
                                      {{ $currencySymbol . showAmount($schema->fixed_roi)}}
                                    </span>
                                    @else
                                        <span id="return-interest">
                                      {{ $schema->schedule->name . ' ' . $schema->min_roi . '-' . $schema->max_roi .' '. ($schema->roi_interest_type == 'percentage' ? '%' : '$') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="site-table-list">
                                <div class="site-table-col">
                                    <span>{{ __('Retorno Total:') }}</span>
                                </div>
                                <div class="site-table-col">
                                    @if($schema->interest_type == 'fixed')
                                        <span id="return-interest">
                                      {{ $currencySymbol . showAmount($schema->fixed_roi * 3)}} {{ __('em ') }} {{ __('30 Dias') }}
                                    </span>
                                    @else
                                        <span id="return-interest">
                                      {{ $schema->schedule->name . ' ' . $schema->min_roi . '-' . $schema->max_roi .' '. ($schema->roi_interest_type == 'percentage' ? '%' : '$') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="rock-input-btn-wrap mt-30">
                                <button type="submit" class="site-btn gradient-btn radius-10" href="add-money-successfully.html">
                                    {{ __('Invest Now') }}
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M19 13C19 17.4183 15.4183 21 11 21C6.58172 21 3 17.4183 3 13C3 8.58172 6.58172 5 11 5C15.4183 5 19 8.58172 19 13Z"
                                            fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16 3.75C15.5858 3.75 15.25 3.41421 15.25 3C15.25 2.58579 15.5858 2.25 16 2.25H21C21.4142 2.25 21.75 2.58579 21.75 3V8C21.75 8.41421 21.4142 8.75 21 8.75C20.5858 8.75 20.25 8.41421 20.25 8V4.81066L10.5303 14.5303C10.2374 14.8232 9.76256 14.8232 9.46967 14.5303C9.17678 14.2374 9.17678 13.7626 9.46967 13.4697L19.1893 3.75H16Z"
                                            fill="white" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Schema Preview section end -->
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
            url: url,
            success: function (result) {
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
            $.get('{{ route('gateway.list') }}',
                function (data) {
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

</script>
@endsection
