@extends('frontend::layouts.user')
@section('title')
    {{ __('Schema Logs') }}
@endsection
@section('content')
<style>
:root {
    --pp-primary: #6c5ce7;
    --pp-secondary: #a29bfe;
    --pp-success: #00b894;
    --pp-profit: #55efc4;
    --pp-warning: #fdcb6e;
    --pp-danger: #ff7675;
    --pp-dark: #2d3436;
    --pp-light: #f5f6fa;
    --pp-text: #2d3436;
    --pp-text-light: #636e72;
    --pp-card-bg: #ffffff;
    --pp-border-radius: 12px;
    --pp-box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.pp-investments-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 25px;
    padding: 20px;
}

.pp-investment-card {
    background: var(--pp-card-bg);
    border-radius: var(--pp-border-radius);
    box-shadow: var(--pp-box-shadow);
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    border: 1px solid rgba(0, 0, 0, 0.03);
    display: flex;
    flex-direction: column;
}

.pp-investment-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
}

.pp-investment-header {
    padding: 20px;
    background: linear-gradient(135deg, #4b2948 0%, #1e0939 100%);
    color: white;
    position: relative;
}

.pp-investment-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(5px);
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.pp-investment-badge .pp-icon {
    font-size: 0.9rem;
}

.pp-investment-amount {
    margin-top: 15px;
}

.pp-amount {
    font-size: 1.8rem;
    font-weight: 700;
    display: block;
    line-height: 1.2;
}

.pp-date {
    font-size: 0.85rem;
    opacity: 0.9;
    display: block;
    margin-top: 5px;
}

.pp-investment-body {
    padding: 20px;
    flex-grow: 1;
}

.pp-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-bottom: 25px;
}

.pp-stat-item {
    background: #9f9f9f4f;
    padding: 15px;
    border-radius: 10px;
    border-left: 5px solid #4CAF50;
}

.pp-stat-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.8rem;
    color: var(--pp-text-light);
    margin-bottom: 8px;
    font-weight: 500;
}

.pp-stat-icon {
    color: var(--pp-primary);
    font-size: 0.9rem;
}

.pp-stat-value {
    font-weight: 600;
    font-size: 1.1rem;
    color: var(--pp-text);
}

.pp-stat-value.pp-profit {
    color: var(--pp-success);
}

.pp-stat-value.pp-percentage {
    color: var(--pp-primary);
}

.pp-stat-value.pp-total-return {
    color: var(--pp-secondary);
}

.pp-period {
    font-size: 0.8rem;
    color: var(--pp-text-light);
    margin-left: 3px;
}

/* Timeline */
.pp-timeline-container {
    margin-top: 25px;
}

.pp-timeline-title {
    font-size: 1.1rem;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--pp-text);
}

.pp-timeline-item {
    margin-bottom: 15px;
}

.pp-timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.pp-timeline-date {
    font-size: 0.85rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--pp-text);
}

.pp-timeline-days {
    background: rgba(108, 92, 231, 0.1);
    color: var(--pp-primary);
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.pp-progress-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

.pp-progress-bar {
    flex-grow: 1;
    height: 14px;
    background: rgba(108, 92, 231, 0.1);
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

.pp-progress-fill {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: #229d27;
    border-radius: 10px;
    transform-origin: left;
    animation: pp-progress-animation 1.5s ease-out forwards;
}

.pp-progress-text {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--pp-text-light);
    min-width: 45px;
    text-align: right;
}

@keyframes pp-progress-animation {
    from { transform: scaleX(0); }
    to { transform: scaleX(1); }
}

/* Rodapé */
.pp-investment-footer {
    padding: 15px 20px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    text-align: center;
}

.pp-details-button {
    background: transparent;
    border: none;
    color: var(--pp-primary);
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    padding: 5px 15px;
    border-radius: 20px;
}

.pp-details-button:hover {
    background: rgba(108, 92, 231, 0.1);
}

/* Responsividade */
@media (max-width: 768px) {
    .pp-investments-grid {
        grid-template-columns: 1fr;
        padding: 15px;
    }

    .pp-investment-header {
        padding: 15px;
    }

    .pp-stat-item {
        padding: 12px;
    }
}

@media (max-width: 480px) {
    .pp-stats-grid {
        grid-template-columns: 1fr;
    }

    .pp-amount {
        font-size: 1.5rem;
    }
}
</style>
    <div class="container-fluid default-page">
        <div class="row gy-30">
            <div class="col-xl-12">
                <div class="rock-schema-logs-area">
                          @php
                            $logs = $data->when(request('query'),function($query){
                                $query->whereHas('schema',function($schemaQuery){
                                    $schemaQuery->where('name','LIKE','%'.request('query').'%');
                                });
                            })->paginate(request()->integer('limit',6))->withQueryString();
                        @endphp
                                <div class="pp-investments-grid">
                                @foreach ($logs as $invest)

                                @php
                                // Configuração inicial com proteção contra valores negativos
                                $createdAt = Carbon\Carbon::parse($invest->created_at)->addHours(3);
                                $now = Carbon\Carbon::now();

                                // Calcula os períodos de forma segura
                                $periods = [
                                    '10' => $createdAt->copy()->addDays(10),
                                    '20' => $createdAt->copy()->addDays(20),
                                    '30' => $createdAt->copy()->addDays(30)
                                ];

                                // Cálculo do progresso com proteção completa
                                foreach ($periods as $days => $date) {
                                    $totalSeconds = $date->diffInSeconds($createdAt);
                                    $elapsedSeconds = $now->diffInSeconds($createdAt);

                                    // Cálculo seguro que evita valores negativos
                                    $progress[$days] = max(0, min(100, ($elapsedSeconds / $totalSeconds) * 100));

                                    // Ajuste para quando o tempo já passou
                                    if ($now >= $date) {
                                        $progress[$days] = 100;
                                    }
                                }
                                @endphp

                <div class="pp-investment-card">
                    <!-- Cabeçalho -->
                    <div class="pp-investment-header">
                        <div class="pp-investment-badge">
                            <i class="fas fa-chart-line pp-icon"></i>
                            <span>{{ $invest->schema->name }}</span>
                        </div>
                        <div class="pp-investment-amount">
                            <span class="pp-amount"><span style="font-size: small">{{ $currencySymbol }}</span>{{ showamount($invest->invest_amount) }}</span>
                            <span class="pp-date">{{ $invest->created_at}}</span>
                        </div>
                    </div>

                    <!-- Corpo -->
                    <div class="pp-investment-body">
                        <!-- Estatísticas -->
                        <div class="pp-stats-grid">
                            <div class="pp-stat-item">
                                <div class="pp-stat-label">
                                    <i class="fas fa-percentage pp-stat-icon"></i>
                                    <span>{{ __('Rentabilidade') }}</span>
                                </div>
                                <div class="pp-stat-value {{ $invest->interest_type == 'percentage' ? 'pp-percentage' : 'pp-fixed' }}">
                                   @if($invest->interest_type == 'percentage')
                                    {{ $invest->interest }}% @else <span style="font-size: small">{{ $currencySymbol }}</span>{{showamount($invest->interest)}} @endif
                                    <span class="pp-period">/ {{ $invest->schema_name }}</span>
                                </div>
                            </div>

                            <div class="pp-stat-item">
                                <div class="pp-stat-label">
                                    <i class="fas fa-coins pp-stat-icon"></i>
                                    <span>{{ __('Lucro Acumulado') }}</span>
                                </div>
                                <div class="pp-stat-value pp-profit">
                                    <span style="font-size: small">{{ $currencySymbol }}</span>{{ showamount($invest->total_profit_amount) }}
                                </div>
                            </div>

                                                            @php
                                                            $calculateInterest = $invest->schema->number_of_period * $invest->interest;
                                                            $interest = $invest->interest_type != 'percentage' ? $invest->interest : $calculateInterest;
                                                        @endphp
                            <div class="pp-stat-item">
                                <div class="pp-stat-label">
                                    <i class="fas fa-piggy-bank pp-stat-icon"></i>
                                    <span>{{ __('Retorno Total') }}</span>
                                </div>
                                <div class="pp-stat-value pp-total-return">
                                    <span style="font-size: small">{{ setting('currency_symbol','global') }}</span>{{ showamount($calculateInterest) }}
                                </div>
                            </div>


                            <div class="pp-stat-item">
                                <div class="pp-stat-label">
                                    <i class="fas fa-check pp-stat-icon"></i>
                                    <span>{{ __('Status') }}</span>
                                </div>
                                <div class="pp-stat-value pp-total-return">
                                  @if($invest->number_of_period > 0) <span style="color: #229d27">{{__('Ativo')}}</span> @else <span style="color: #E91E63">{{__('Concluído')}} </span>@endif
                                </div>
                            </div>
                        </div>

                        <!-- Timeline de Rendimentos -->
                        <div class="pp-timeline-container">
                            <h4 class="pp-timeline-title">
                                <i class="far fa-clock pp-icon"></i>
                                {{ __('Próximos Rendimentos') }}
                            </h4>

                            @foreach($periods as $days => $date)
                            <div class="pp-timeline-item">
                                <div class="pp-timeline-header">
                                    <div class="pp-timeline-date">
                                        <i class="far fa-calendar-alt pp-icon"></i>
                                       ~ {{ $date->format('d/m/Y H:i') }}
                                    </div>
                                    <span class="pp-timeline-days">{{ $days }} {{ __('dias') }}</span>
                                </div>

                            <div class="pp-progress-container">
                                    <div class="pp-progress-bar"
                                         data-pp-progress="{{ $progress[$days] }}"
                                         data-start-time="{{ $createdAt->toIso8601String() }}"
                                         data-end-time="{{ $date->toIso8601String() }}">
                                        <div class="pp-progress-fill" @if($progress[$days] == 100) style="width: 100%;background:#E91E63" @endif></div>
                                    </div>
                                    <span class="pp-progress-text">
                                        @if($progress[$days] == 100)
                                            100%
                                        @else
                                            {{ number_format($progress[$days], 1) }}%
                                        @endif
                                    </span>
                                </div>
                                                        </div>
                                                        @endforeach

                                                        <span style="color: #009900;text-align:center"><b>{{__('Horário de Rendimento. Após ás: ')}} {{ $date->format('H:i') }}</b> </span>
                                                    </div>
                                                </div>

                                            </div>

                                            @endforeach

                                        </div>
                                @if(count($logs) == 0)
                                    <div class="alert alert-table mt-20 text-center" role="alert">
                                        {{ __('No Data Found') }}
                                    </div>
                                @endif
                                {{ $logs->links('frontend::include.__pagination') }}

                </div>
            </div>
        </div>
    </div>
@endsection
 @section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateProgress() {
        const now = new Date();

        document.querySelectorAll('.pp-progress-bar').forEach(bar => {
            const startTime = new Date(bar.dataset.startTime);
            const endTime = new Date(bar.dataset.endTime);

            const totalMs = endTime - startTime;
            const elapsedMs = now - startTime;

            let percent = Math.max(0, Math.min(100, (elapsedMs / totalMs) * 100));

            if (percent > 99.99 && now < endTime) {
                percent = 99.99;
            }

            const fill = bar.querySelector('.pp-progress-fill');
            const textElement = bar.nextElementSibling;

            fill.style.width = `${percent}%`;

            if (percent >= 99.99) {
                textElement.textContent = '100%';
                fill.style.backgroundColor = "#E91E63";
                fill.style.width = "100%";
            } else {
                textElement.textContent = `${percent.toFixed(1)}%`;
                fill.style.backgroundColor = "";
            }
        });
    }

    updateProgress();
    setInterval(updateProgress, 30000);
});
</script>
@endsection