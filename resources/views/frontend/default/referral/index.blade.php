@extends('frontend::layouts.user')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">{{ __('Sistema de Indicados') }} @if(setting('site_referral','global') == 'level')
                        @endif</h3>
                </div>
                <div class="site-card-body">
                    <div class="referral-link">
                        <div class="referral-link-form">
                            <input type="text" value="{{ $getReferral->link }}" id="refLink"/>
                            <button type="submit" onclick="copyRef()">
                                <i class="anticon anticon-copy"></i>
                                <span id="copy">{{ __('Copy Url') }}</span>
                                <input id="copied" hidden value="{{ __('Copiado') }}">
                            </button>
                        </div>

                     @if($IndicadosTotais > 0)
                    <div class="site-tab-bars mt-3">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        @foreach($porNivel as $nivel => $quantidade)


                        <li class="nav-item" role="presentation" style="margin: 0px 5px 5px 0px;">
                        <a href="{{ route('user.referrallevel', $nivel) }}" class="nav-link active" >
                        <i icon-name="boxes"></i> {{ $nivel }}º Nível: {{ $quantidade }} Usuário{{ $quantidade > 1 ? 's' : '' }}
                        </a>
                        </li>

                        @endforeach
                    </ul>
                    </div>
                    @endif
                    </div>

                    <div class="row user-cards mt-3" style="margin-bottom: -10px;">
                      @php
                        $IndicadosDiretosAtivos = App\Models\User::where('ref_id', auth()->user()->id)->where('is_active', 1)->count();
                      @endphp
                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" >
                            <div class="single" style="background: #017536;border: 2px solid #017536;">
                                <div class="icon"><i class="anticon anticon-user"></i></div>
                                <div class="content">
                                    <h4><span class="count"> {{ $IndicadosDiretosAtivos  }} </span></h4>
                                    <p>{{ __('Indicados Diretos Ativos') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="single">
                                <div class="icon"><i class="anticon anticon-user"></i></div>
                                <div class="content">
                                    <h4><span class="count"> {{ $IndicadosTotais  }} </span></h4>
                                    <p>{{ __('Indicados Totais') }}</p>
                                </div>
                            </div>
                        </div>

                       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="single">
                                <div class="icon"><i class="anticon anticon-user-add"></i></div>
                                <div class="content">
                                    <h4><span class="count"> {{ $ativosTotais }} </span></h4>
                                    <p>{{ __('Indicados Ativos') }}</p>
                                </div>
                            </div>
                        </div>

                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="single">
                                <div class="icon"><i class="anticon anticon-dollar"></i></div>
                                <div class="content">
                                    <h4><b>{{ $currencySymbol }}</b><span class="count">{{ Auth::user()->ganhos_totais_de_rede }}</span></h4>
                                    <p>{{ __('Movimentação Total da Rede') }}</p>
                                </div>
                            </div>
                        </div>

                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="single">
                                <div class="icon"><i class="anticon anticon-dollar"></i></div>
                                <div class="content">
                                    <h4><b>{{ $currencySymbol }}</b><span class="count">{{ Auth::user()->ganhos_de_rede_do_dia }}</span></h4>
                                    <p>{{ __('Movimentação Diária da Rede') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">{{ __('All Referral Logs') }}</h3>
                </div>
                <div class="site-card-body table-responsive">
                    <div class="tab-content" id="pills-tabContent">

                        <div
                            class="tab-pane fade show active"
                            id="generalTarget"
                            role="tabpanel"
                            aria-labelledby="generalTarget-tab"
                        >

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 desktop-screen-show">
                                    <div class="site-datatable">
                                        <div class="row table-responsive">
                                            <div class="col-xl-12">
                                                <table class="display data-table">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('Description') }}</th>
                                                        <th>{{ __('Transactions ID') }}</th>
                                                        <th>{{ __('Amount') }}</th>
                                                        <th>{{ __('Status') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>


                                                    @foreach($generalReferrals as $raw)
                                                        <tr>
                                                            <td>
                                                                <div class="table-description">
                                                                    <div class="icon">
                                                                        <i icon-name="arrow-down-left"></i>
                                                                    </div>
                                                                    <div class="description">
                                                                        <strong>{{ $raw->description }}</strong>
                                                                        <div
                                                                            class="date mt-1">{{ formatar_data_brasileira($raw->created_at) }}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><strong>{{$raw->tnx}}</strong></td>
                                                            <td><strong
                                                                    class="green-color">+{{ setting('currency_symbol','global').showAmount($raw->amount)}} </strong>
                                                            </td>
                                                            <td>
                                                                @if($raw->status->value == \App\Enums\TxnStatus::Pending->value)
                                        <div class="site-badge warnning">{{ __('Pendente') }}</div>
                                    @elseif($raw->status->value ==  \App\Enums\TxnStatus::Success->value)
                                        <div class="site-badge success">{{ __('Sucesso') }}</div>
                                    @elseif($raw->status->value ==  \App\Enums\TxnStatus::Failed->value)
                                        <div class="site-badge primary-bg">{{ __('Cancelado') }}</div>
                                    @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach


                                                    </tbody>
                                                </table>

                                                @if($generalReferrals->isEmpty())
                                                    <p class="centered">{{ __('No Data Found') }}</p>
                                                @endif

                                                {{ $generalReferrals->links() }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 mobile-screen-show">
                                    <!-- Transactions -->
                                    <div class="all-feature-mobile mobile-transactions mb-3">
                                        <div class="contents">
                                            @foreach($generalReferrals as $raw )
                                                <div class="single-transaction">
                                                    <div class="transaction-left">
                                                        <div class="transaction-des">
                                                            <div
                                                                class="transaction-title">{{ $raw->description }}</div>
                                                            <div class="transaction-id">{{ $raw->tnx }}</div>
                                                            <div
                                                                class="transaction-date">{{ formatar_data_brasileira($raw->created_at) }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="transaction-right">
                                                        <div
                                                            class="transaction-amount add">
                                                            + {{ setting('currency_symbol','global').showAmount($raw->amount)}}</div>

                                                        @if($raw->status->value == App\Enums\TxnStatus::Pending->value)
                                                            <div
                                                                class="transaction-status pending">{{ __('Pending') }}</div>
                                                        @elseif($raw->status->value ==  App\Enums\TxnStatus::Success->value)
                                                            <div
                                                                class="transaction-status success">{{ __('Success') }}</div>
                                                        @elseif($raw->status->value ==  App\Enums\TxnStatus::Failed->value)
                                                            <div
                                                                class="transaction-status canceled">{{ __('Canceled') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{  $generalReferrals->onEachSide(1)->links() }}
                                    </div>

                                </div>
                            </div>


                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function copyRef() {
            /* Get the text field */
            var copyApi = document.getElementById("refLink");
            /* Select the text field */
            copyApi.select();
            copyApi.setSelectionRange(0, 999999999); /* For mobile devices */
            /* Copy the text inside the text field */
            document.execCommand('copy');
            $('#copy').text($('#copied').val())
        }
    </script>
@endsection
