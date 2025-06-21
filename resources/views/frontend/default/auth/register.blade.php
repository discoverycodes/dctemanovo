@extends('frontend::layouts.auth')

@section('title')
    {{ __('Register') }}
@endsection
@section('content')


    <!-- Login Section -->
    <section class="section-style site-auth">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-md-12">
                    <div class="auth-content">
                        <div class="logo">
                            <a href="{{ route('home')}}"><img src="{{ asset(setting('site_logo','global')) }}" alt=""/></a>
                        </div>
                        <div class="title">
                            <h2> {{ $data['title'] }}</h2>
                            <p>{{ $data['bottom_text'] }}</p>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                @foreach($errors->all() as $error)
                                    <strong>{{ __('You Entered') }} {{ $error }}</strong>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif


                        <div class="site-auth-form">
                            <form method="POST" action="{{ route('register') }}" class="row">
                                @csrf
                               <div class="alert site-alert alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert" style="background: #198754;color: #ffffff;">
                        <div class="content d-flex align-items-center">
                            <div class="icon me-2" style="background: rgb(7 28 38);color: #ffffff;"><i class="anticon anticon-user" style="font-size: 28px;"></i></div>
                            <span>Seu Patrocinador: {{$indicadornome}}</span>
                        </div>
                    </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="single-field">
                                        <label class="box-label" for="name">{{ __('First Name') }}<span
                                                class="required-field">*</span></label>
                                        <input
                                            class="box-input"
                                            type="text"
                                            placeholder="{{ __('First Name') }}"
                                            name="first_name"
                                            value="{{ old('first_name') }}"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="single-field">
                                        <label class="box-label" for="name">{{ __('Last Name') }}<span
                                                class="required-field">*</span></label>
                                        <input
                                            class="box-input"
                                            type="text"
                                            placeholder="{{ __('Last Name') }}"
                                            name="last_name"
                                            value="{{ old('last_name') }}"
                                            required
                                        />
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="single-field">
                                        <label class="box-label" for="email">{{ __('Email Address') }}<span
                                                class="required-field">*</span></label>
                                        <input
                                            class="box-input"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="{{ __('Email Address') }}"
                                            required
                                        />
                                    </div>
                                </div>

                                @if(getPageSetting('username_show'))
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="single-field">
                                            <label class="box-label" for="username">{{ __('User Name') }}<span
                                                    class="required-field">*</span></label>
                                            <input
                                                class="box-input"
                                                type="text"
                                                placeholder="{{ __('User Name') }}"
                                                name="username"
                                                value="{{ old('username') }}"
                                                required
                                            />
                                        </div>
                                    </div>
                                @endif
                                @if(getPageSetting('country_show'))
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="single-field">
                                            <label class="box-label" for="username">{{ __('Select Country') }}<span
                                                    class="required-field">*</span></label>

                                            <select name="country" id="countrySelect" class="site-nice-select">

                                                @foreach( getCountries() as $country)
                                                    <option @if( $location->country_code == $country['code']) selected
                                                            @endif value="{{ $country['name'].':'.$country['dial_code'] }}">
                                                        {{ $country['name']  }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                @endif
                                @if(getPageSetting('phone_show'))
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="single-field">
                                            <label class="box-label" for="username">{{ __('Phone Number') }}<span
                                                    class="required-field">*</span></label>
                                            <div class="input-group joint-input"><span class="input-group-text"
                                                                                       id="dial-code">{{ getLocation()->dial_code }}</span>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Phone Number"
                                                    name="phone"
                                                    value="{{ old('phone') }}"
                                                    aria-label="Username"
                                                    aria-describedby="basic-addon1"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{--@if(getPageSetting('referral_code_show'))--}}
                                    {{--<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">--}}
                                        {{--<div class="single-field">--}}
                                            {{--<label class="box-label"--}}
                                                   {{--for="invite">{{ __('Referral Code') }}</label>--}}
                                            {{--<input--}}
                                                {{--class="box-input"--}}
                                                {{--type="text"--}}
                                                {{--placeholder="Enter Your Referral Code"--}}
                                                {{--name="invite"--}}
                                                {{--value="{{ request('invite') ?? old('invite') }}"--}}
                                            {{--/>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                                @if(getPageSetting('referral_code_show'))
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="single-field">
                                            <label class="box-label" for="invite">{{ __('Referral Code') }}</label>
                                            <input
                                                    class="box-input"
                                                    type="text"
                                                    placeholder="Enter Your Referral Code"
                                                    name="invite"
                                                    value="{{ request('invite') ?? old('invite') }}"
                                                    {{-- No 'required' attribute here, making it optional --}}
                                            />
                                        </div>
                                    </div>
                                @endif


                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="single-field">
                                        <label class="box-label" for="password">{{ __('Password') }}<span
                                                class="required-field">*</span></label
                                        >
                                        <div class="password">
                                            <input
                                                class="box-input"
                                                type="password"
                                                name="password"
                                                placeholder="{{ __('Password') }}"
                                                required
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="single-field">
                                        <label class="box-label" for="password">{{ __('Confirm Password') }}<span
                                                class="required-field">*</span></label>
                                        <div class="password">
                                            <input
                                                class="box-input"
                                                type="password"
                                                name="password_confirmation"
                                                placeholder="{{ __('Confirm Password') }}"
                                                required
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                    <div class="single-field">
                                        @if($googleReCaptcha)
                                            <div class="g-recaptcha" id="feedback-recaptcha"
                                                 data-sitekey="{{ json_decode($googleReCaptcha->data,true)['google_recaptcha_key'] }}">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                    <div class="single-field">
                                        <input
                                            class="form-check-input check-input"
                                            type="checkbox"
                                            name="i_agree"
                                            value="yes"
                                            id="flexCheckDefault"
                                            required
                                        />
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ __('I agree with') }}
                                            <a href="#" data-toggle="modal" data-target="#exampleModalTerms">{{ __('Terms & Condition') }}</a>
                                        </label>
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <button type="submit" class="site-btn blue-btn w-100 centered">
                                        {{ __('Create Account') }}
                                    </button>
                                </div>
                            </form>
                            <div class="singnup-text">
                                <p>{{ __('Already have an account?') }} <a
                                        href="{{ route('login') }}">{{ __('Login') }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Modal -->
<div class="modal fade" id="exampleModalTerms" tabindex="-1" role="dialog" aria-labelledby="#exampleModalTerms" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="#exampleModalTerms">{{ __('Terms & Condition') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      @php
    $page = \App\Models\Page::where('code', 'terms')->where('locale', 'pt-br')->first();
    $data = json_decode($page->data ?? '');
    @endphp
{!! $data->content ?? '' !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Fechar') }}</button>
      </div>
    </div>
  </div>
</div>
    <!-- Login Section End -->
@endsection
@section('script')
    @if($googleReCaptcha)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $('#countrySelect').on('change', function (e) {
            "use strict";
            e.preventDefault();
            var country = $(this).val();
            $('#dial-code').html(country.split(":")[1])
        })
    </script>
@endsection

