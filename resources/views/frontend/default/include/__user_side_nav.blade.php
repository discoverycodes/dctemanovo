<div class="side-nav ">
    <div class="side-wallet-box default-wallet mb-0">
        <div class="user-balance-card">
            <div class="wallet-name">
                <div class="name">{{ __('Account Balance') }}</div>
                <div class="default">{{ __('Wallet') }}</div>
            </div>
            <div class="wallet-info">
                <div class="wallet-id"><i icon-name="wallet"></i>{{ __('Main Wallet') }}</div>
                <div class="balance">{{ setting('currency_symbol','global').showamount($user->balance) }}</div>
            </div>
        </div>
        <div class="actions">
            <a href="{{ route('user.deposit.amount') }}" class="user-sidebar-btn site-btn"><i
                    class="anticon anticon-file-add"></i>{{ __('Deposit') }}</a>
            <a href="{{ route('user.schema') }}" class="user-sidebar-btn red-btn site-btn"><i
                    class="anticon anticon-export"></i>{{ __('Invest Now') }}</a>
        </div>
    </div>
    <div class="side-nav-inside">
        <ul class="side-nav-menu">
            <li class="side-nav-item {{ isActive('user.dashboard') }}">
                <a href="{{route('user.dashboard')}}"><i
                        class="anticon anticon-appstore"></i><span>{{ __('Dashboard') }}</span></a>
            </li>

            <li class="side-nav-item {{ isActive('user.invest*') }}">
                <a href="{{ route('user.invest-logs') }}"><i
                        class="anticon anticon-copy"></i><span>{{ __('Schema Logs') }}</span></a>
            </li>

            @if(setting('sign_up_referral','permission'))
                <li class="side-nav-item {{ isActive('user.referral') }}">
                    <a href="{{ route('user.referral') }}"><i
                            class="anticon anticon-usergroup-add"></i><span>{{ __('Referral') }}</span></a>
                </li>
            @endif

            @if(setting('user_reward','permission'))
            <li class="side-nav-item {{ isActive('user.ranking-badge') }}">
                <a href="{{ route('user.ranking-badge') }}"><i
                        class="anticon anticon-star"></i><span>{{ __('Ranking Badge') }}</span></a>
            </li>
            @endif
            <li class="side-nav-item @if( Route::currentRouteName() != 'user.withdraw.log') {{ isActive('user.withdraw*') }} @endif">
                <a href="{{ route('user.withdraw.view') }}"><i
                        class="anticon anticon-bank"></i><span>{{ __('Withdraw') }}</span></a>
            </li>
            <li class="side-nav-item {{ isActive('user.schema*') }}">
                <a href="{{ route('user.schema') }}"><i
                        class="anticon anticon-bank"></i><span>{{ __('Investir com Saldo') }}</span></a>
            </li>
            <li class="side-nav-item {{ isActive('user.withdraw.log') }}">
                <a href="{{ route('user.withdraw.log') }}"><i
                        class="anticon anticon-credit-card"></i><span>{{ __('Withdraw Log') }}</span></a>
            </li>            
            <li class="side-nav-item {{ isActive('user.deposit.log') }}">
                <a href="{{ route('user.deposit.log') }}"><i
                        class="anticon anticon-folder-add"></i><span>{{ __('Add Money Log') }}</span></a>
            </li>

            <li class="side-nav-item {{ isActive('user.transactions*') }}">
                <a href="{{ route('user.transactions') }}"><i
                        class="anticon anticon-inbox"></i><span>{{ __('All Transactions') }}</span></a>
            </li>
           @if(setting('transfer_status','permission'))
            <li class="side-nav-item @if( Route::currentRouteName() != 'user.send-money.log') {{ isActive('user.send-money*') }} @endif">
                <a href="{{ route('user.send-money.view') }}"><i
                        class="anticon anticon-export"></i><span>{{ __('Send Money') }}</span></a>
            </li>

            <li class="side-nav-item {{ isActive('user.send-money.log') }}">
                <a href="{{ route('user.send-money.log') }}"><i
                        class="anticon anticon-cloud"></i><span>{{ __('Send Money Log') }}</span></a>
            </li>
            @endif






            <li class="side-nav-item">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="site-btn red-btn w-100">
                        <i class="anticon anticon-logout"></i><span>{{ __('Logout') }}</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
