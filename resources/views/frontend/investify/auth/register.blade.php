@extends('frontend::layouts.auth')

@section('title')
{{ __('Register') }}
@endsection
@section('content')
@php
	$customCaptcha = loadCustomCaptcha();
@endphp
<style type="text/css">
.modal-body *{
  color: white;
}
</style>
<section class="rock-auth-section fix">
    <div class="container">
        <div class="rock-auth-wrapper">
            <div class="rock-auth-main">
                <div class="rock-auth-logo">
                    <a href="">
                        <img src="{{ asset(setting('site_logo','global')) }}" alt="logo">
                    </a>
                </div>
                <div class="rock-auth-main-inner">
                    <div class="rock-auth-from">
                        <div class="rock-auth-content">
                            <h3 class="title">{{ $data['title'] }}</h3>
                            <p class="description">{{ $data['bottom_text'] }}</p>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            @foreach($errors->all() as $error)
                            <strong>{{ $error }}</strong>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <form action="{{ route('register') }}" method="POST" autocomplete="off" onsubmit="return validateForm(this)">
                            @csrf
                    <div class="alert mb-4" role="alert" style="background: #19875400;color: #ffffff;border: #e2a014 1px solid;border-radius: 15px;">
                        <div class="content text-center">
                            <span>{{__('Convite enviado por:')}} <br>{{$indicadornome}} </span>
                        </div>
                    </div>
                            <div class="row gy-24">
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="rock-single-input">
                                        <label class="rock-input-label"
                                            for="first_name">{{ __('First Name') }}<span>*</span></label>
                                        <div class="input-field">
                                            <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="rock-single-input">
                                        <label class="rock-input-label"
                                            for="last_name">{{ __('Last Name') }}<span>*</span></label>
                                        <div class="input-field">
                                            <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                    <div class="rock-single-input">
                                        <label class="rock-input-label"
                                            for="email">{{ __('Email Address') }}<span>*</span></label>
                                        <div class="input-field">
                                            <input type="email" name="email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                </div>
                                @if(getPageSetting('username_show'))
                                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                    <div class="rock-single-input">
                                        <label class="rock-input-label"
                                            for="username">{{ __('Username') }}<span>*</span></label>
                                        <div class="input-field">
                                            <input type="text" name="username" id="username_input" placeholder="Ex: joaodasilva" value="{{ old('username') }}" required autocomplete="off">
                                        </div>
                                        <span id="user_name" style="font-size:15px;">{{route('register')}}?convite=</span>
                                    </div>
                                </div>
                                @endif
                                @if(getPageSetting('country_show'))
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="rock-single-input">
                                        <label class="rock-input-label"
                                            for="c-select">{{ __('Select Country') }}<span>*</span></label>
                                        <div class="input-select">
                                            <select name="country" id="countrySelect">
                                                @foreach( getCountries() as $country)
                                                <option @if( $location->country_code == $country['code']) selected
                                                    @endif value="{{ $country['name'].':'.$country['dial_code'] }}">
                                                    {{ $country['name']  }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(getPageSetting('phone_show'))
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="rock-single-input">
                                        <label class="rock-input-label"
                                            for="phonen">{{ __('WhatsApp') }}<span>*</span></label>
                                        <div class="input-field input-group">
                                            <span class="input-group-text"
                                                id="dial-code">{{ getLocation()->dial_code }}</span>
                                            <input type="text" name="phone" value="{{ old('phone') }}" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(getPageSetting('referral_code_show'))
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="rock-single-input">
                                        <label class="rock-input-label"
                                            for="invite">{{ __('Referral Code') }}  @if(settingValue('sign_up_referral'))<span>*</span>@endif</label>
                                        <div class="input-field">
                                            <input type="text" name="invite" @if(settingValue('sign_up_referral')) required @endif
                                                value="{{ request('invite') ?? old('invite') }}">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="rock-single-input">
                                        <label class="rock-input-label"
                                            for="password">{{ __('Password') }}<span>*</span></label>
                                        <div class="input-field">
                                            <input type="password" name="password"  required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="rock-single-input">
                                        <label class="rock-input-label"
                                            for="cpassword">{{ __('Confirm Password') }}<span>*</span></label>
                                        <div class="input-field">
                                            <input type="password" name="password_confirmation"  required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                @if($customCaptcha)
                                    <div class="rock-single-input">
                                        <div class="mb-2">
                                            @php echo $customCaptcha @endphp
                                        </div>
                                        <label class="rock-input-label">@lang('Captcha')</label>
                                        <div class="input-field">
                                        <input type="text" name="captcha" placeholder="{{__('Enter the Captcha Above')}}" required>
                                         </div>
                                    </div>
                                @endif
                                <div class="rock-auth-checkbox">
                                    <input id="i_agree" type="checkbox" name="i_agree" value="yes"/>
                                    <label class="terms-condition" for="i_agree">
                                        {{ __('I agree with') }}
                                        <a href="" data-toggle="modal" data-target="#exampleModalTerms">{{ __('Terms & Condition') }}</a>
                                        <div style="visibility: hidden;color: #f93940;font-weight: 900;" id="agree_chk_error">
                                         Para prosseguir, você deve concordar com os Termos e Condições!
                                          </div>
                                    </label>
                                </div>
                            </div>
                            <div class="rock-auth-btn text-center mt-4">
                                <button class="site-btn gradient-btn w-100"
                                    type="submit">{{ __('Create Account') }}</button>
                            </div>
                        </form>
                        <div class="rock-auth-bottm">

                            <p>{{ __('Already have an account?') }}
                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rock-auth-shapes">
                <div class="shape-one">
                    <img src="{{ asset('assets/frontend/theme_base/hardrock/images/rock-shapes/auth/auth-01.png') }}"
                        alt="auth shape">
                </div>
                <div class="shape-two">
                    <img src="{{ asset('assets/frontend/theme_base/hardrock/images/rock-shapes/auth/auth-02.png') }}"
                        alt="auth shape">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModalTerms" tabindex="-1" role="dialog" aria-labelledby="#exampleModalTerms" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background-color: #170a1e;border: #ffffff solid 2px;border-radius: 15px;">
      <div class="modal-header">
        <h5 class="modal-title text-white" id="#exampleModalTerms">{{ __('Terms & Condition') }}</h5>
      </div>
      <div class="modal-body text-white">
      @php
    $page = \App\Models\Page::where('code', 'terms')->where('locale', 'pt-br')->first();
    $data = json_decode($page->data ?? '');
    @endphp
{!! $data->content ?? '' !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="site-btn gradient-btn radius-12 w-100" data-dismiss="modal">{{ __('Fechar') }}</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@if($googleReCaptcha)
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
$('#username_input').on('input', function() {
    let cleanUsername = $(this).val()
        .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
        .replace(/[^a-zA-Z0-9_]/g, "")
        .toLowerCase();

    $('#user_name').text("{{ route('register') }}?convite=" + cleanUsername);
});
function validateForm(form)
{
    if(!form.i_agree.checked)
    {
        document.getElementById('agree_chk_error').style.visibility='visible';
        return false;
    }
    else
    {
        document.getElementById('agree_chk_error').style.visibility='hidden';
        return true;
    }
}
    $('#countrySelect').on('change', function (e) {
        "use strict";
        e.preventDefault();
        var country = $(this).val();
        $('#dial-code').html(country.split(":")[1])
    })

</script>
@endsection
