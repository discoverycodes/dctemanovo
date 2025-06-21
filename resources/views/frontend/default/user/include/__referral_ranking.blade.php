<div class="row">


    @if($user->rank != null)
    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="user-ranking" @if($user->rank->icon) style="background: url({{ asset('assets/'.$user->rank->icon) }});" @endif>
            <div class="rank" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->rank->ranking_name }}">
                <img src="{{ asset('assets/'.$user->avatar) }}" alt="">
            </div>
        </div>
    </div>
    @endif
    @if(setting('sign_up_referral','permission'))
        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">{{ __('Referral URL') }}</h3>
                </div>
                <div class="site-card-body">
                    <div class="referral-link">
                        <div class="referral-link-form">
                            <input type="text" value="{{ $referral->link }}" id="refLink"/>
                            <button type="submit" onclick="copyRef()">
                                <i class="anticon anticon-copy"></i>
                                <span id="copy">{{ __('Copy') }}</span>
                            </button>
                        </div>
                        <p class="referral-joined">
                            {{ __('Indicados') }} {{ $referral->relationships()->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
