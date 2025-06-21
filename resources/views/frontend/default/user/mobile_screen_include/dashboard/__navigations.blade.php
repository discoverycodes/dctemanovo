<div class="all-feature-mobile mb-3 mobile-screen-show">
    <div class="title">{{ __('All Navigations') }}</div>
    <div class="contents row">

        <div class="col-4">
            <div class="single">
                <a href="{{ route('user.invest-logs') }}">
                    <div class="icon"><img src="{{ asset('assets/frontend/materials/schema-log.png') }}" alt="">
                    </div>
                    <div class="name">{{ __('Investimentos') }}</div>
                </a>
            </div>
        </div>


            <div class="col-4">
                <div class="single">
                    <a href="{{ route('user.referral') }}">
                        <div class="icon"><img src="{{ asset('assets/frontend/materials/referral.png') }}"
                                               alt="">
                        </div>
                        <div class="name">{{ __('Referral') }}</div>
                    </a>
                </div>
            </div>
            <div class="col-4">
                <div class="single">
                    <a href="{{ route('user.ranking-badge') }}">
                        <div class="icon"><img src="{{ asset('assets/frontend/materials/ranking.png') }}"
                                               alt="">
                        </div>
                        <div class="name">{{ __('Ranking Badge') }}</div>
                    </a>
                </div>
            </div>

        <div class="col-4">
            <div class="single">
                <a href="{{ route('user.transactions') }}">
                    <div class="icon"><img src="{{ asset('assets/frontend/materials/transactions.png') }}" alt="">
                    </div>
                    <div class="name">{{ __('Transactions') }}</div>
                </a>
            </div>
        </div>
        <div class="col-4">
            <div class="single">
                <a href="{{ route('user.deposit.log') }}">
                    <div class="icon"><img src="{{ asset('assets/frontend/materials/deposit-log.png') }}" alt="">
                    </div>
                    <div class="name">{{ __('Deposit Log') }}</div>
                </a>
            </div>
        </div>
            <div class="col-4">
                <div class="single">
                    <a href="{{ route('user.withdraw.log') }}">
                        <div class="icon"><img src="{{ asset('assets/frontend/materials/withdraw-log.png') }}"
                                               alt="">
                        </div>
                        <div class="name">{{ __('Withdraw Log') }}</div>
                    </a>
                </div>
            </div>


    </div>
    <div class="moretext">
        <div class="row contents">
            @if(setting('transfer_status','permission'))
            <div class="col-4">
                <div class="single">
                    <a href="{{ route('user.send-money.view') }}">
                        <div class="icon"><img src="{{ asset('assets/frontend/materials/transfer.png') }}"
                                               alt="">
                        </div>
                        <div class="name">{{ __('Transfer') }}</div>
                    </a>
                </div>
            </div>
            <div class="col-4">
                <div class="single">
                    <a href="{{ route('user.send-money.log') }}">
                        <div class="icon"><img src="{{ asset('assets/frontend/materials/transfer-log.png') }}"
                                               alt="">
                        </div>
                        <div class="name">{{ __('Transfer Log') }}</div>
                    </a>
                </div>
            </div>
            @endif


            <div class="col-4">
                <div class="single">
                    <a href="{{ route('user.setting.show') }}">
                        <div class="icon"><img src="{{ asset('assets/frontend/materials/settings.png') }}"
                                               alt="">
                        </div>
                        <div class="name">{{ __('Settings') }}</div>
                    </a>
                </div>
            </div>
            <div class="col-4">
                <div class="single">
                    <a href="{{ route('user.ticket.index') }}">
                        <div class="icon"><img src="{{ asset('assets/frontend/materials/support-ticket.png') }}"
                                               alt="">
                        </div>
                        <div class="name">{{ __('Support Ticket') }}</div>
                    </a>
                </div>
            </div>

        </div>
    </div>
    <div class="centered">
        <button class="moreless-button site-btn-sm grad-btn">{{ __('Load more') }}</button>
    </div>
</div>
