@php
    $schemas = \App\Models\Schema::where('status',1)->with('schedule')->get(['id','name','type','min_amount','max_amount','fixed_amount']);
@endphp

<section class="section-style light-blue-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-12">
                <div class="section-title text-center">
                    <h4 data-aos="fade-down" data-aos-duration="2000">{{ $data['calculation_title_small'] }}</h4>
                    <h2 data-aos="fade-down" data-aos-duration="1500">
                        {{ $data['calculation_title_big'] }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-12">
                <div class="earnings-calculator-img" data-aos="fade-right" data-aos-duration="2000">
                    <img class="rounded" src="{{ asset($data['calculation_left_img']) }}" alt="">
                    <a href="{{ $data['intro_video'] }}" class="video video-popup"><i class="fas fa-play"></i></a>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="earnings-calculator" data-aos="fade-left" data-aos-duration="2000">
                    <form action="#">
                        <div class="single-box">
                            <label for="">{{ __('Investment Plans:') }}</label>
                            <select name="selectCalculationPlan" id="selectPlan"
                                    class="site-nice-select plan-selects mb-2">
                                <option value="0">{{ __('---Select Plan---') }}</option>
                                @foreach($schemas as $schema)
                                    <option value="{{ $schema->id }}">{{ $schema->name }}
                                        ({{ $schema->type == 'range' ? $currencySymbol . $schema->min_amount . '-' . $currencySymbol . $schema->max_amount : $currencySymbol . $schema->fixed_amount }}
                                        )
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="single-box">
                            <label for="">{{ __('Enter Amount:') }} </label>
                            <div class="input-group">
                                <input type="text" id="enter-amount" class="form-control" aria-label="Amount"
                                       aria-describedby="basic-addon1">
                                <span class="input-group-text" id="basic-addon1">{{ $currency }}</span>
                            </div>
                        </div>

                        <div class="single-box">
                            <div class="input-info-text charge " id="amount-level"></div>
                        </div>

                        <div class="single-box">
                            <label for="">{{ __('Profit:') }} <span id="profit-label"></span></label>
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" id="profit" disabled>
                                <span class="input-group-text" id="basic-addon1">{{ $currency }}</span>
                            </div>
                        </div>
                        <div class="single-box mb-0">
                            <a href="{{ route('register') }}" class="site-btn primary-btn w-100 centered"><i
                                    class="anticon anticon-bank"></i>{{ __("Let's Start Earning") }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@push('script')
    <script>
        $('#selectPlan').on('change', function(e) {
            e.preventDefault();

            var id = $(this).val();

            if (id != 0) {
                var invest_amount = $("#enter-amount");
                invest_amount.val('');
                invest_amount.attr('readonly', false);

                var url = '{{ route("user.schema.select", ":id") }}';

                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    success: function(result) {
                        $('#amount-level').html('Capital Back: ' + result.capital_back);
                        $('#profit-label').html(result.return_interest + ' - ' + result.number_period);

                        if (result.invest_amount > 0) {
                            invest_amount.val(result.invest_amount);
                            invest_amount.attr('readonly', true);
                        }

                        calculateProfit(result);
                    }
                });
            }
        });

        $('#enter-amount').on('keyup', function(e) {
            e.preventDefault();
            var id = $('#selectPlan').val();

            if (id != 0) {
                var url = '{{ route("user.schema.select", ":id") }}';
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    success: function(result) {
                        calculateProfit(result);
                    }
                });
            }
        });

        function calculateProfit(result) {
            console.log(result.roi_interest_type);
            var invest_amount = $("#enter-amount").val();

            if (result.number_period === 'Unlimited Times') {
                $('#profit').val('Unlimited');
            } else {
                if (result.interest_type === 'range') {
                    if (result.roi_interest_type === 'percentage') {
                        $('#profit').val(result.min_roi + '%' + ' - ' + result.max_roi + '%');
                    } else {
                        $('#profit').val('$' + result.min_roi + ' - $' + result.max_roi);
                    }
                } else {
                    $('#profit').val(calPercentage(invest_amount, result.interest) * result.period);
                }
            }
        }

        function calPercentage(amount, percentage) {
            return (amount * percentage) / 100;
        }

    </script>
@endpush
