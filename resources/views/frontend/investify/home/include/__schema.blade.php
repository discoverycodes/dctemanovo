@php
$schemas = \App\Models\Schema::where('status',true)->with('schedule')->get();
@endphp
<section class="rock-pricing-section o-x-clip p-relative z-index-11 include-bg"
    data-background="{{ asset('assets/frontend/theme_base/hardrock/images/bg/price-pattren.png') }}" id="schema">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-6 col-lg-8">
                <div class="section-title-wrapper-four text-center">
                    <span class="subtitle-four">{{ $data['title_small'] }}</span>
                    <h2 class="section-title-four">{{ $data['title_big'] }}</h2>
                </div>
            </div>
        </div>
        <div class="rock-pricing-main">
            <div class="row gy-30">
                    @foreach($schemas as $index => $schema)

                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <div class="rock-pricing-item @if($schema->featured) is-active @endif">
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
                                                            fill="white" />
                                                        <path
                                                            d="M9.50695 4.09195L11.6049 6.71441C12.4056 7.71523 13.9278 7.71523 14.7284 6.71441L16.8264 4.09195C17.1545 3.68174 17.3333 3.17205 17.3333 2.64673V2.54296C17.3333 1.32257 16.344 0.333252 15.1236 0.333252H14.8758C14.4484 0.333252 14.0386 0.503021 13.7364 0.805212C13.4217 1.11985 12.9116 1.11985 12.597 0.805212C12.2948 0.503021 11.8849 0.333252 11.4575 0.333252H11.2097C9.98932 0.333252 9 1.32257 9 2.54296V2.64673C9 3.17205 9.17879 3.68174 9.50695 4.09195Z"
                                                            fill="white" />
                                                    </svg>
                                                </span>
                                                <p class="list-item-text">{{ __('Investment') }}</p>
                                            </div>
                                            <div class="list-valu" >
                                                <span style="font-size: 22px;">{{ $schema->type == 'range' ? $currencySymbol . showAmount($schema->min_amount) . '-' . $currencySymbol . showAmount($schema->max_amount) : $currencySymbol . showAmount($schema->fixed_amount) }}</span>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="price-value text-center mb-4">
                                @if($schema->roi_interest_type == 'fixed')
                                <span>{{__('Dobre seu Investimento em 30 Dias')}}</span>
                                     <span class="price-badge" style="font-size: 16px;">{{ $currencySymbol . showAmount($schema->fixed_roi)}} {{ __('a cada ') }} {{ __('10 Dias') }}</span>
                                    <span class="price-badge" style="font-size: 16px;">{{ $currencySymbol . showAmount($schema->fixed_roi * 3)}} {{ __('em ') }} {{ __('30 Dias') }}</span>
                                @else
                                    <span class="price-badge" style="font-size: 16px;">{{ $schema->schedule->name . ' ' . $schema->min_roi . '-' . $schema->max_roi . ($schema->roi_interest_type == 'percentage' ? '%' : '$') }}</span>
                                @endif

                            </div>

                            <div class="price-shape">
                                <img src="{{ asset('assets/frontend/theme_base/hardrock/images/rock-shapes/pricing/pricing-shape-01.png') }}" alt="pricing">
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
            <div class="price-world-bg">
                <img src="{{ asset('assets/frontend/theme_base/hardrock/images/bg/price-world-bg.png') }}" alt="price">
            </div>
        </div>
    </div>
</section>