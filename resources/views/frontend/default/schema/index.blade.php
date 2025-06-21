@extends('frontend::layouts.user')
@section('title')
    {{ __('All Schema') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">{{ __('All The Schemas') }}</h3>
                </div>
                <div class="site-card-body">
                     <div class="alert site-alert alert-dismissible fade show d-flex justify-content-between align-items-center mb-1" role="alert">
                        <div class="content d-flex align-items-center">
                            <div class="icon me-2"><i class="anticon anticon-warning"></i></div>
                            <span> Para Liberar o Próximo Ciclo, é necessário Investir <b>nos 3 Planos</b> do Ciclo Anterior e aguardar sua finalização.</span>
                        </div>

                    </div>
                    <div class="row">
                    @php
                    use App\Models\Invest;
                    use App\Models\Schema;

                    // 1. Configuração dos ciclos
                    $planosPorCiclo = [
                        1 => [5, 6, 7],   // IDs dos planos do Ciclo 1
                        2 => [8, 9, 10],  // IDs dos planos do Ciclo 2
                        3 => [11, 12, 13] // IDs dos planos do Ciclo 3
                    ];

                    // 2. Determinar o ciclo master ATUAL (baseado no último investimento)
                    $ultimoInvestimento = Invest::where('user_id', auth()->user()->id)
                                             ->orderBy('ciclo_master', 'desc')
                                             ->first();

                    $currentMasterCycle = $ultimoInvestimento ? $ultimoInvestimento->ciclo_master : 1;

                    // 3. Verificar quais ciclos estão completos no master atual
                    $ciclosCompletos = [
                        1 => Invest::where('user_id', auth()->user()->id)
                                ->where('ciclo_master', $currentMasterCycle)
                                ->whereIn('schema_id', $planosPorCiclo[1])
                                ->where('status', 'completed')
                                ->count() === 3,

                        2 => Invest::where('user_id', auth()->user()->id)
                                ->where('ciclo_master', $currentMasterCycle)
                                ->whereIn('schema_id', $planosPorCiclo[2])
                                ->where('status', 'completed')
                                ->count() === 3,

                        3 => Invest::where('user_id', auth()->user()->id)
                                ->where('ciclo_master', $currentMasterCycle)
                                ->whereIn('schema_id', $planosPorCiclo[3])
                                ->where('status', 'completed')
                                ->count() === 3
                    ];

                    // 4. Determinar qual ciclo está ativo
                    $activeCycle = 1;
                    if ($ciclosCompletos[1] && !$ciclosCompletos[2]) {
                        $activeCycle = 2;
                    } elseif ($ciclosCompletos[2] && !$ciclosCompletos[3]) {
                        $activeCycle = 3;
                    } elseif ($ciclosCompletos[3]) {
                        $activeCycle = 1;
                        $currentMasterCycle++; // Avança para o próximo ciclo master
                    }

                    // 5. Verificar planos já investidos no ciclo atual
                    $planosInvestidos = Invest::where('user_id', auth()->user()->id)
                                           ->where('ciclo_master', $currentMasterCycle)
                                           ->pluck('schema_id')
                                           ->toArray();

                    // 6. Obter todos os planos
                    $schemas0 = Schema::whereIn('id', array_merge($planosPorCiclo[1], $planosPorCiclo[2], $planosPorCiclo[3]))
                                  ->orderBy('id')
                                  ->get();
                    @endphp

                    

                        @foreach($schemas as $index => $schema)
                        @php
                        // Verificar se o plano pertence ao ciclo ativo
                        $planoNoCicloAtivo = in_array($schema->id, $planosPorCiclo[$activeCycle]);

                        // Verificar se já foi investido no ciclo atual
                        $planoJaInvestido = in_array($schema->id, $planosInvestidos);

                        // Determinar se pode investir
                        $podeInvestir = $planoNoCicloAtivo && !$planoJaInvestido;
                        @endphp

                        @if($index % 3 == 0)
                            <h3 class="text-xl font-bold mb-2 mt-4 text-center">CICLO {{ intdiv($index, 3) + 1 }}</h3>
                        @endif
                            <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="single-investment-plan">
                                    <img
                                        class="investment-plan-icon"
                                        src="{{ asset('assets/'.$schema->icon) }}"
                                        alt=""
                                    />


                                    <h3>{{$schema->name}}</h3>
                                    @if($schema->interest_type == 'fixed')
                                        <h5><span style="color: #FFCC00">{{ $schema->fixed_roi }}% {{ __('em') }} {{ $schema->schedule->name }}</span></h5>

                                    @else
                                        <p>{{ $schema->schedule->name . ' ' . $schema->min_roi . '-' . $schema->max_roi .' '. ($schema->roi_interest_type == 'percentage' ? '%' : '$') }}</p>
                                    @endif
                                    <ul>
                                        <li>{{ __('Investment') }} <span class="special">
                                            {{ $schema->type == 'range' ? $currencySymbol . showAmount($schema->min_amount) . '-' . $currencySymbol . showAmount($schema->max_amount) : $currencySymbol . showAmount($schema->fixed_amount) }}
                                        </span></li>
                                        

                                        <li>{{ __('Saque') }} <span>{{ __('Anytime') }}</span></li>

                                    </ul>

                                @if($podeInvestir)
                                    <a href="{{ route('user.schema.preview', $schema->id) }}"
                                       class="site-btn blue-btn w-100 centered">
                                       <i class="anticon anticon-check"></i>{{ __('Invest Now') }}
                                    </a>
                                @else
                                <div class="title w-100 centered mt-5 mb-3" disabled>
                                    <i class="anticon anticon-lock"></i> {{ __('BLOQUEADO') }}
                                </div>

                                @endif

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
