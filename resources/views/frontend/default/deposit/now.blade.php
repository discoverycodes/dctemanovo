@extends('frontend::deposit.index')
@section('deposit_content')
    <div class="progress-steps-form">
        <form action="{{ route('user.deposit.now') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-3">
                    <label for="gatewaySelect" class="form-label">{{ __('Payment Method:') }}</label>
                    <div class="input-group">
                        <select name="gateway_code" id="gatewaySelect" class="site-nice-select">
                            <option selected disabled>--{{ __('Select Gateway') }}--</option>
                            @foreach($gateways as $gateway)
                                <option value="{{ $gateway->gateway_code }}">{{ $gateway->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-info-text charge"></div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <label for="amount" class="form-label">{{ __('Enter Amount:') }}</label>
                    <div class="input-group">
                        <input type="tel" name="amount" class="form-control"
                               oninput="this.value = validateDouble(this.value)" aria-label="Amount" id="amount"
                               aria-describedby="basic-addon1">
                        <span class="input-group-text" id="basic-addon1">{{ setting('currency_symbol','global') }}</span>
                    </div>
                    <div class="input-info-text min-max"></div>
                </div>

            </div>

            <div class="row manual-row">

            </div>

            <div class="transaction-list table-responsive">
                <div class="user-panel-title">
                    <h3>{{ __('Review Details:') }}</h3>
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <td><strong>{{ __('Amount') }}</strong></td>
                        <td><span class="currency"></span> <span class="amount"></span> </td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="buttons">
                <button type="submit" class="site-btn blue-btn">
                    {{ __('Proceed to Payment') }}<i class="anticon anticon-double-right"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>

        var globalData;
        var currency = @json(setting('currency_symbol','global'))

        $("#gatewaySelect").on('change', function (e) {
            "use strict"
            e.preventDefault();
            $('.manual-row').empty();
            var code = $(this).val()
            var url = '{{ route("user.deposit.gateway",":code") }}';
            url = url.replace(':code', code);
            $.get(url, function (data) {

                globalData = data;

                if (data.currency === currency) {
                    $('.conversion').addClass('hidden');
                } else {
                    $('.conversion').removeClass('hidden');
                }

                $('.conversion-rate').text('1' + ' ' + currency + ' = ' + data.rate + ' ' + data.currency)


                $('.min-max').text('Minimum ' + data.minimum_deposit + ' ' + currency + ' and ' + 'Maximum ' + data.maximum_deposit + ' ' + currency)
                var amount = $('#amount').val()

                if (Number(amount) > 0) {
                    $('.amount').text((Number(amount)))
                    var charge = data.charge_type === 'percentage' ? calPercentage(amount, data.charge) : data.charge
                    $('.charge2').text(charge + ' ' + currency)
                    $('.total').text((Number(amount) + Number(charge)) + ' ' + currency)
                }

                if (data.credentials !== undefined) {
                    $('.manual-row').append(data.credentials)
                    imagePreview()
                }

            });

            $('#amount').on('keyup', function (e) {
                "use strict"
    var amount = $(this).val().replace(',', '.'); // Substitui vírgula por ponto (se o user digitar vírgula)
    var parsed = parseFloat(amount);

    if (!isNaN(parsed)) {
        var formattedAmount = parsed.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        $('.amount').text(formattedAmount);
    } else {
        $('.amount').text('0,00'); // Valor padrão caso o campo esteja vazio ou inválido
    }
                $('.currency').text(currency)

                var charge = globalData.charge_type === 'percentage' ? calPercentage(amount, globalData.charge) : globalData.charge
                $('.charge2').text(charge + ' ' + currency)

                var total = (Number(amount) + Number(charge));

                $('.total').text(total + ' ' + currency)

                $('.pay-amount').text(total * globalData.rate + ' ' + globalData.currency)
            })


        });
    </script>
@endsection
