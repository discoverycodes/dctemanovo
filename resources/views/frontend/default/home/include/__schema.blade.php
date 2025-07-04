@php
    $schemas = \App\Models\Schema::where('status',true)->with('schedule')->get();
@endphp
<section class="white-bg section-style-2">
    <div class="bat-left" style="background: url({{ asset($data['left_top_img']) }}) repeat;" data-aos="fade-down-right"
         data-aos-duration="2000"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-12">
                <div class="section-title text-center">
                    <h4 data-aos="fade-down" data-aos-duration="2000">{{ $data['title_small'] }}</h4>
                    <h2 data-aos="fade-down" data-aos-duration="1500">{{ $data['title_big'] }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($schemas as $schema)
                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="single-investment-plan">
                        <img
                            class="investment-plan-icon"
                            src="{{ asset($schema->icon) }}"
                            alt=""
                        />
                        @if($schema->badge)
                            <div class="feature-plan">{{$schema->badge}}</div>
                        @endif

                        <h3>{{$schema->name}}</h3>
                        @if($schema->interest_type == 'fixed')
                            <p>{{ $schema->schedule->name . ' ' . $schema->fixed_roi .' '. ($schema->roi_interest_type == 'percentage' ? '%' : '$') }}</p>
                        @else
                            <p>{{ $schema->schedule->name . ' ' . $schema->min_roi . '-' . $schema->max_roi .' '. ($schema->roi_interest_type == 'percentage' ? '%' : '$') }}</p>
                        @endif
                        <ul> 
                            <li>{{ __('Investment') }} <span class="special">
                                                                {{ $schema->type == 'range' ? $currencySymbol . $schema->min_amount . '-' . $currencySymbol . $schema->max_amount : $currencySymbol . $schema->fixed_amount }}
                                                            </span></li>
                            <li>{{ __('Capital Back') }} <span>{{ $schema->capital_back ? __('Yes') : __('No') }}</span> 
                            </li>
                            <li>{{ __('Return Type') }} <span>{{ __(ucwords($schema->return_type)) }}</span></li>
                            <li>{{ __('Number of Period') }}
                                <span>{{ ($schema->return_type == 'period' ? $schema->number_of_period.' ' : __('Unlimited').' ' ).($schema->number_of_period == 1 ? __('Time') : __('Times') )  }}</span>
                            </li>
                            <li>{{ __('Profit Withdraw') }} <span>{{ __('Anytime') }}</span></li>
                            <li>{{ __('Cancel') }} <span> @if($schema->schema_cancel)
                                        {{ __('Within').' '. $schema->expiry_minute .' '. 'Minute' }}
                                    @else
                                        {{ __('No') }}
                                    @endif</span></li>
                        </ul>
                        <div class="holidays"><span class="star">*</span>@if( null != $schema->off_days)
                                {{ implode(', ', json_decode($schema->off_days,true))  .' '.__('are')}}
                            @else
                                {{ __('No Profit') }}
                            @endif {{ __('Holidays') }}</div>
                        <a href="{{route('user.schema.preview',$schema->id)}}" class="site-btn grad-btn w-100 centered"><i
                                class="anticon anticon-check"></i>{{ __('Invest Now') }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
