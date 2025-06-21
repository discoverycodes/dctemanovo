@php use App\Enums\TxnStatus; @endphp
@extends('frontend::layouts.user')
@section('title')
    {{ __('Schema Logs') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12 desktop-screen-show">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">{{ __('All Transactions') }}</h3>
                </div>
                <div class="site-card-body">
                    <div class="site-table">
                        <div class="table-filter">
                            <div class="filter">
                                <form action="{{ route('user.transactions') }}" method="get">
                                    <div class="search">
                                        <input type="text" id="search" placeholder="{{__('Search')}}"
                                               value="{{ request('query') }}"
                                               name="query"/>
                                        <input type="date" name="date" value="{{ request()->get('date') }}"/>
                                        <button type="submit" class="apply-btn"><i
                                                icon-name="search"></i>{{ __('Search') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Transactions ID') }}</th>

                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Fee') }}</th>
                                    <th>{{ __('Status') }}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>
                                            <div class="table-description">
                                                <div class="icon">
                                                    <i icon-name="@switch($transaction->type->value)
                                                                            @case('send_money')arrow-right
                                                                            @break
                                                                            @case('receive_money')arrow-left
                                                                            @break
                                                                            @case('deposit')arrow-down-left
                                                                            @break
                                                                            @case('manual_deposit')arrow-down-left
                                                                            @break
                                                                            @case('investment')arrow-left-right
                                                                            @break

                                                                            @case('withdraw')arrow-up-left
                                                                            @break
                                                                            @default()backpack
                                                                        @endswitch">
                                                    </i>
                                                </div>
                                                <div class="description">
                                                    <strong>{{$transaction->description}}</strong>@if(!in_array($transaction->approval_cause,['none',""]))
                                                        <span class="optional-msg" data-bs-toggle="tooltip" title=""
                                                              data-bs-original-title="{{ $transaction->approval_cause }}"><i
                                                                icon-name="mail"></i></span>
                                                    @endif
                                                    <div class="date">{{ formatar_data_brasileira($transaction->created_at) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><strong>{{ $transaction->tnx }}</strong></td>

                                        <td><strong class="{{ txn_type($transaction->type->value,['green-color','red-color']) }}">{{ txn_type($transaction->type->value,['+','-']) . setting('currency_symbol','global'). showamount($transaction->amount)}}</strong></td>

                                        <td><strong>{{  setting('currency_symbol','global'). showamount($transaction->charge) }}</strong></td>
                                        <td>
                                             @if($transaction->status->value == \App\Enums\TxnStatus::Pending->value)
                                        <div class="site-badge warnning">{{ __('Pendente') }}</div>
                                    @elseif($transaction->status->value ==  \App\Enums\TxnStatus::Success->value)
                                        <div class="site-badge success">{{ __('Sucesso') }}</div>
                                    @elseif($transaction->status->value ==  \App\Enums\TxnStatus::Failed->value)
                                        <div class="site-badge primary-bg">{{ __('Cancelado') }}</div>
                                     @elseif($transaction->status->value ==  \App\Enums\TxnStatus::Estornado->value)
                                        <div class="site-badge failed">{{ __('Estornado') }}</div>
                                    @endif
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{  $transactions->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 mobile-screen-show">
            <!-- Transactions -->
            <div class="all-feature-mobile mobile-transactions mb-3">
                <div class="title">{{ __('All Transactions') }}</div>
                <div class="mobile-transaction-filter">
                    <div class="filter">
                        <form action="{{ route('user.transactions') }}" method="get">
                            <div class="search">

                                <input type="text" placeholder="{{__('Buscar')}}" value="{{ request('query') }}"
                                       name="query"/>
                                <input type="date" name="date" value="{{ request()->get('date') }}"/>
                                <button type="submit" class="apply-btn"><i icon-name="search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="contents">
                    @foreach($transactions as $transaction )
                        <div class="single-transaction">
                            <div class="transaction-left">
                                <div class="transaction-des">
                                    <div class="transaction-title">{{ $transaction->description }}
                                    </div>
                                    <div class="transaction-id">{{ $transaction->tnx }}</div>
                                    <div class="transaction-date">{{ formatar_data_brasileira($transaction->created_at) }}</div>
                                </div>
                            </div>
                            <div class="transaction-right">
                                <div
                                    class="transaction-amount {{ txn_type($transaction->type->value,['add','sub']) }}">
                                    {{ txn_type($transaction->type->value,['+','-']) . setting('currency_symbol','global'). showamount($transaction->amount) }}</div>
                                    @if($transaction->charge > 0)
                                <div class="transaction-fee sub">
                                    -{{ setting('currency_symbol','global') . showamount($transaction->charge)}}</div>
                                    @endif



                                @if($transaction->status->value == App\Enums\TxnStatus::Pending->value)
                                    <div class="transaction-status pending">{{ __('Pending') }}</div>
                                @elseif($transaction->status->value ==  App\Enums\TxnStatus::Success->value)
                                    <div class="transaction-status success">{{ __('Success') }}</div>
                                @elseif($transaction->status->value ==  App\Enums\TxnStatus::Failed->value)
                                    <div class="transaction-status canceled">{{ __('canceled') }}</div>
                                 @elseif($transaction->status->value ==  App\Enums\TxnStatus::Estornado->value)
                                    <div class="transaction-status canceled">{{ __('Estornado') }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                {{  $transactions->onEachSide(1)->links() }}
            </div>

        </div>
    </div>
@endsection
