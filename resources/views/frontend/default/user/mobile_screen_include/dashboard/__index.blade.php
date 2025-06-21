<div class="row">
    <div class="col-12">
        @if($user->rank != null)
        <div class="user-ranking-mobile">
            <div class="icon"><img src="{{ asset('assets/'.$user->avatar ?? 'assets/global/materials/user.png') }}" alt=""/></div>
            <div class="name">
                <h4>{{ __('Hi') }}, {{ $user->full_name }}</h4>
                <p>{{ $user->rank->ranking_name }}</p>
            </div>
            <div class="rank-badge"><img src="{{ asset('assets/'.$user->rank->icon) }}" alt=""/></div>
        </div>
        @endif
   <div class="col-12">
        <div class="mobile-ref-url mb-4">
            <div class="all-feature-mobile">
                <div class="title">{{ __('Referral URL') }}</div>
                <div class="mobile-referral-link-form">
                    <input type="text" value="{{ $referral->link }}" id="refLinkmob" readonly />
                    <button type="submit" onclick="copyRefmob()">
                        <span id="copymob">{{ __('Copy') }}</span>
                    </button>
                </div>
                <p class="referral-joined">{{ __('Indicados Diretos') }}: {{ $referral->relationships()->count() }} </p>
            </div>
        </div>
    </div>
        <div class="user-wallets-mobile">
            <img src="{{ asset('assets/frontend/materials/wallet-shadow.png') }}" alt="" class="wallet-shadow">
            <div class="head">{{ __('Saldo Atual') }}</div>
            <div class="one p-wal">
                <div class="balance">

                    <span class="symbol">{{ $currencySymbol }}</span>{{ showAmount($user->balance) }}
                </div>
                <div class="wallet">{{ __('Main Wallet') }}</div>
            </div>

            <div class="info">
                <i icon-name="info"></i>{{ __('You Earned') }}  {{ $currencySymbol }}{{ showAmount($dataCount['profit_last_7_days']) }} {{ __('This Week') }}
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="mob-shortcut-btn">
            <a href="{{ route('user.deposit.amount') }}"><i icon-name="download"></i> {{ __('Deposit') }}</a>
            <a href="{{ route('user.schema') }}"><i icon-name="box"></i> {{ __('Investment') }}</a>
            <a href="{{ route('user.withdraw.view') }}"><i icon-name="send"></i> {{ __('Withdraw') }}</a>
        </div>
    </div>


    <div class="col-12">
        <!-- all navigation -->
        @include('frontend::user.mobile_screen_include.dashboard.__navigations')

        <!-- all Statistic -->
        @include('frontend::user.mobile_screen_include.dashboard.__statistic')

        <!-- Recent Transactions -->
        @include('frontend::user.mobile_screen_include.dashboard.__transactions')
    </div>


</div>
