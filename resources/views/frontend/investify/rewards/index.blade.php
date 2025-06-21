@extends('frontend::layouts.user')
@section('title')
    {{ __('Rewards') }}
@endsection
@section('content')
    <div class="container-fluid default-page">
        <div class="row gy-30">
            <div class="col-xl-12">
                <div class="rock-all-transactions-area">
                    <div class="rock-dashboard-card">
                        <div class="row">
                            <div class="col-xl-4 col-lg-12 col-md-12 col-12">
                                <div class="site-card rewards-card" style="border-radius: 12px; overflow: hidden; border: .5px solid white; background-color: rgba(255, 255, 255, 0.1); padding: 20px; margin-bottom: 20px;">
                                    <div class="site-card-header text-center">
                                        <h4 class="title" style="color: white; display: inline-block;">{{ __('My Reward Points') }}</h4>
                                    </div>
                                    <div class="site-card-body text-center">
                                        <h3 class="acc-balance" style="color: white;">{{ auth()->user()->points }}</h3>
                                        <a href="{{ route('user.rewards.redeem.now') }}" class="site-btn gradient-btn mt-3">
                                            <span>
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4"
                                                          d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z"
                                                          fill="white" />
                                                    <circle cx="18" cy="8" r="4" fill="white" />
                                                </svg>
                                            </span>
                                            {{ __('Redeem Now') }}
                                        </a>
                                        @if($myRanking)
                                            <div class="last-login mt-3">{{ __("Every :points reward points are :amount", ['points' => $myRanking->point, 'amount' => $currencySymbol.$myRanking->amount]) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="rock-custom-table" style="margin-bottom: 20px;">
                                    <div class="rock-table-title">
                                        <h4 class="title" style="color: white;">{{ __('Reward Points Earnings:') }}</h4>
                                    </div>
                                    <div class="contents">
                                        <div class="site-table-list site-table-head">
                                            <div class="site-table-col">{{ __('Ranking List') }}</div>
                                            <div class="site-table-col">{{ __('Amount Of Transactions') }}</div>
                                            <div class="site-table-col">{{ __('Reward') }}</div>
                                        </div>
                                        @forelse ($earnings as $earning)
                                            <div class="site-table-list">
                                                <div class="site-table-col">
                                                    <div class="transactions-description">
                                                        <div class="content">
                                                            {{ $earning->ranking->ranking }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="site-table-col">
                                                    <span>{{ $earning->amount_of_transactions.' '.$currency }}</span>
                                                </div>
                                                <div class="site-table-col">
                                                    <span class="kittensEye-text">{{ $earning->point }} {{ __('Points') }}</span>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="site-table-list">
                                                <div class="site-table-col" colspan="4" style="text-align: center; padding: 12px; color: white;">{{ __('No Data Found') }}</div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="rock-custom-table" style="margin-bottom: 20px;">
                                    <div class="rock-table-title">
                                        <h4 class="title" style="color: white;">{{ __('Reward Points Redeem:') }}</h4>
                                    </div>
                                    <div class="contents">
                                        <div class="site-table-list site-table-head">
                                            <div class="site-table-col">{{ __('Ranking List') }}</div>
                                            <div class="site-table-col">{{ __('Per Points') }}</div>
                                            <div class="site-table-col">{{ __('Redeem Amount') }}</div>
                                        </div>
                                        @forelse ($redeems as $redeem)
                                            <div class="site-table-list">
                                                <div class="site-table-col">
                                                    <div class="transactions-description">
                                                        <div class="content">
                                                            {{ $redeem->ranking->ranking }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="site-table-col">
                                                    <span>{{ $redeem->point }} {{ __('Points') }}</span>
                                                </div>
                                                <div class="site-table-col">
                                                    <span class="kittensEye-text">{{ $redeem->amount.' '.$currency }}</span>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="site-table-list">
                                                <div class="site-table-col" colspan="4" style="text-align: center; padding: 12px; color: white;">{{ __('No Data Found') }}</div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="rock-recent-transactions-table mt-4">
                            <div class="rock-custom-table">
                                <div class="rock-table-title">
                                    <h4 class="title" style="color: white;">{{ __('Redeem Summary:') }}</h4>
                                </div>
                                <div class="contents">
                                    <div class="site-table-list site-table-head">
                                        <div class="site-table-col">{{ __('Description') }}</div>
                                        <div class="site-table-col">{{ __('Amount') }}</div>
                                        <div class="site-table-col">{{ __('Redeemed Date') }}</div>
                                        <div class="site-table-col">{{ __('Transaction Type') }}</div>
                                    </div>
                                    @forelse ($transactions as $transaction)
                                        <div class="site-table-list">
                                            <div class="site-table-col">
                                                <div class="transactions-description">
                                                    <div class="content">
                                                        {{ $transaction->description }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="site-table-col">
                                                <span @class([ "fw-bold", "green-color" => isPlusTransaction($transaction->type), "red-color" => !isPlusTransaction($transaction->type) ])>
                                                {{ isPlusTransaction($transaction->type) ? '+' : '-' }}{{ $transaction->amount.' '.$currency }}
                                                </span>
                                            </div>
                                            <div class="site-table-col">
                                                <span class="kittensEye-text">{{ $transaction->created_at }}</span>
                                            </div>

                                            <div class="site-table-col">
                                                <span @class([
                                                "fw-bold",
                                                "green-color" => isPlusTransaction($transaction->type),
                                                "red-color" => !isPlusTransaction($transaction->type)
                                                ])>
                                                {{ ucfirst(str_replace('_',' ',$transaction->type->value)) }}
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="site-table-list">
                                            <div class="site-table-col" colspan="4" style="text-align: center; padding: 12px; color: white;">{{ __('No Data Found') }}</div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            {{ $transactions->links() }}
                        </div>
                        <div class="pagination-wrapper">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
