@extends('frontend::layouts.user')
@section('title')
{{ __('Negociações') }} {{ setting('site_title', 'global') }}
@endsection
@section('content')
<style>
/* Design Premium para Trading */
.trading-card-wrapper {
    perspective: 1000px;
    margin: 0 auto;
}

.trading-card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transform-style: preserve-3d;
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
}

.trading-card:hover {
    transform: translateY(-5px) rotateX(1deg);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
}

.card-header {
    position: relative;
    padding: 20px;
    overflow: hidden;
}

.header-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 120%;
    background: linear-gradient(135deg,
        rgba(75, 192, 192, 0.15) 0%,
        rgba(54, 162, 235, 0.1) 100%);
    transform: skewY(-2deg);
    transform-origin: top left;
    z-index: 1;
}

.active-trade .header-gradient {
    background: linear-gradient(135deg, rgb(241 241 241) 0%, rgb(255 255 255 / 34%) 100%);
}

.completed-trade .header-gradient {
    background: linear-gradient(135deg,
        rgba(16, 185, 129, 0.2) 0%,
        rgba(52, 211, 153, 0.15) 100%);
}

.header-content {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 15px;
}

.trade-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.trade-icon i {
    font-size: 22px;
    color: #3b82f6;
    z-index: 2;
}

.active-trade .trade-icon i {
    color: #3b82f6;
}

.completed-trade .trade-icon i {
    color: #10b981;
}

.icon-pulse2 {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: rgba(59, 130, 246, 0.3);
    animation: pulse2 2s infinite;
    z-index: 1;
}

.active-trade .icon-pulse2 {
    background: rgba(59, 130, 246, 0.3);
}

.completed-trade .icon-pulse2 {
    background: rgba(16, 185, 129, 0.3);
    animation: none;
    transform: scale(1.1);
}

.trade-title h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: #1e293b;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 5px;
    display: inline-block;
}

.badge-operating {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.badge-completed {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.card-body {
    padding: 20px;
}

.metrics-row {
    display: flex;
    gap: 15px;
    margin-bottom: 25px;
}

.metric-box {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px;
    background: #e7e7e7;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.metric-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.metric-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: white;
}

.buy-icon {
    background: linear-gradient(135deg, #f97316 0%, #ef4444 100%);
}

.sell-icon {
    background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
}

.operating-icon {
    background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
}

.metric-info {
    flex: 1;
}

.metric-label {
    display: block;
    font-size: 12px;
    color: #64748b;
    margin-bottom: 4px;
}

.metric-value {
    font-size: 16px;
    font-weight: 700;
    display: block;
}

.buy-value {
    color: #ef4444;
}

.sell-value {
    color: #10b981;
}

.operating-value {
    color: #3b82f6;
}

.blinking-text {
    animation: blink 2s infinite;
    display: inline-block;
}

@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.progress-section {
    margin-bottom: 25px;
}

.time-progress {
    background: #e7e7e7;
    border-radius: 12px;
    padding: 15px;
}

.progress-bar-container {
    height: 20px;
    background: #e2e8f0;
    border-radius: 4px;
    position: relative;
    margin-bottom: 10px;
    overflow: hidden;
}

.progress-bar-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg,
        rgba(59, 130, 246, 0.1) 0%,
        rgba(99, 102, 241, 0.1) 100%);
}

.progress-bar-fill {
    height: 100%;
    border-radius: 4px;
    background: linear-gradient(90deg, #4CAF50 0%, #4CAF50 100%);
    position: relative;
    z-index: 2;
    transition: width 0.5s ease;
}

.completed-trade .progress-bar-fill {
    background: linear-gradient(90deg, #E91E63 0%, #E91E63 100%);
}

.progress-dots {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 3;
}

.dot {
    position: absolute;
    width: 12px;
    height: 12px;
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

.progress-info {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
}

.progress-percent {
    font-weight: 700;
    color: #3b82f6;
}

.completed-trade .progress-percent {
    color: #10b981;
}

.progress-time {
    color: #64748b;
    font-family: 'Courier New', monospace;
    font-weight: 600;
}

.result-section {
    margin-bottom: 15px;
}

.result-box {
    display: flex;
    align-items: center;
    padding: 15px;
    border-radius: 12px;
    background: #e7e7e7;
    gap: 15px;
    transition: all 0.3s ease;
}

.result-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.profit-box {
    border-left: 4px solid #10b981;
}

.loss-box {
    border-left: 4px solid #ef4444;
}

.result-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.profit-box .result-icon {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.loss-box .result-icon {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.result-details {
    flex: 1;
}

.result-label {
    display: block;
    font-size: 12px;
    color: #64748b;
    margin-bottom: 4px;
}

.result-value {
    font-size: 16px;
    font-weight: 700;
    display: block;
}

.profit-box .result-value {
    color: #10b981;
}

.loss-box .result-value {
    color: #ef4444;
}

.result-amount {
    font-size: 14px;
    margin-left: 5px;
}

.result-graph {
    width: 80px;
    height: 40px;
}

.mini-chart {
    width: 100%;
    height: 100%;
}

.card-footer {
    display: flex;
    padding: 15px 20px;
    background: #f8fafc;
    border-top: 1px solid #f1f5f9;
}

.date-info {
    flex: 1;
    text-align: center;
}

.date-info:first-child {
    border-right: 1px solid #e2e8f0;
}

.date-label {
    display: block;
    font-size: 12px;
    color: #64748b;
    margin-bottom: 4px;
}

.date-value {
    font-size: 14px;
    font-weight: 600;
    color: #1e293b;
}

/* Animações */
@keyframes pulse2 {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

@keyframes fa-spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(359deg);
    }
}

/* Responsividade */
@media (max-width: 576px) {
    .metrics-row {
        flex-direction: column;
    }

    .header-content {
        flex-direction: column;
        text-align: center;
    }

    .trade-icon {
        margin: 0 auto;
    }

    .status-badge {
        margin-top: 8px;
    }
}
</style>
<!-- Container-fluid starts-->
<div class="container-fluid default-page">
    <div class="alert rock-alert" style="background-color: #A0522D;">
                <div class="alert-content-inner d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z" fill="#E9D8A6"></path>
                                <circle cx="18" cy="8" r="4" fill="#E9D8A6"></circle>
                            </svg>
                        </div>
                        <strong>
                        @if(count($negociacoes) == 0)
                       {{__('Em breve, você saberá cada detalhe de nossas negociações. Transparência e comprometimento são os nossos lemas!')}}
                       @else
                       {{__('Na Açaí Prime, nossas operações são transparentes. Compramos o fruto com o melhor preço e vendemos sempre procurando a melhor margem de Lucro.')}}
                       @endif
                        </strong>
                    </div>

                </div>
            </div>
    <div class="row gy-30">
        <div class="col-xxl-12">
            <!-- Pricing section srart -->
            <section class="rock-dashboard-pricing-section">
                <div class="row gy-30">
             @foreach($negociacoes as $index => $negociacao)
        <div class="col-xl-4">
            <!-- Show desktop-screen content -->
            <div class="">
                <div class="">
                    <div class="">


<div class="trading-card-wrapper mb-3" id="trade-card-{{ $negociacao->tnx }}">
    <div class="trading-card {{ $negociacao->status == 0 ? 'active-trade' : 'completed-trade' }}">

        <div class="card-header">
            <div class="header-gradient"></div>
            <div class="header-content">
                <div class="trade-icon">
                    <i class="fas {{ $negociacao->status == 0 ? 'fa-chart-line' : 'fa-check-circle' }}"></i>
                    <div class="icon-pulse2"></div>
                </div>
                <div class="trade-title">
                    <h3>{{ $negociacao->status == 0 ?  __('Negociação Ativa') : __('Negociação Finalizada') }}</h3>
                    <div class="status-badge {{ $negociacao->statu ? 'badge-operating' : 'badge-completed' }}">
                        {{ $negociacao->status == 0 ?  __('EM OPERAÇÃO') : __('CONCLUÍDA') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Corpo do card -->
        <div class="card-body" data-background="{{ asset('assets/frontend/theme_base/hardrock/images/bg/ranking-badge.png') }}" style="background-size:cover;">
            <!-- Linha de métricas -->
            <div class="metrics-row">
                <div class="metric-box">
                    <div class="metric-icon buy-icon">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div class="metric-info">
                        <span class="metric-label">{{__('Compra')}}</span>
                        <span class="metric-value buy-value">R$ {{ number_format($negociacao->compra, 2, ',', '.') }}</span>
                    </div>
                </div>

                <div class="metric-box">
                    <div class="metric-icon {{ $negociacao->status == 0 ? 'operating-icon' : 'sell-icon' }}">
                        <i class="fas {{ $negociacao->status == 0 ? 'fa-sync-alt fa-spin' : 'fa-arrow-up' }}"></i>
                    </div>
                    <div class="metric-info">
                        <span class="metric-label">{{__('Venda')}}</span>
                        <span class="metric-value {{ $negociacao->status == 0 ? 'operating-value' : 'sell-value' }}">
                            @if($negociacao->status == 0)
                                <span class="blinking-text">{{__('EM OPERAÇÃO')}}...</span>
                            @else
                                R$ {{ number_format($negociacao->venda ?? 0, 2, ',', '.') }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Progresso e tempo -->
            <div class="progress-section">
                <div class="time-progress">
                    <div class="progress-bar-container">
                        <div class="progress-bar-bg"></div>
                        <div class="progress-bar-fill" id="trade-progress-{{ $negociacao->tnx }}" style="width: {{ $negociacao->status == 1 ? '100%' : '0%' }}"></div>
                    </div>
                    <div class="progress-info">
                        <span class="progress-percent" id="progress-percent-{{ $negociacao->tnx }}">{{ $negociacao->status == 1 ? '100%' : '0%' }}</span>
                        <span class="progress-time" id="trade-duration-{{ $negociacao->tnx }}">
                            @if($negociacao->status == 0)
                                {{ $negociacao->created_at->diffInDays() }}d
                                {{ $negociacao->created_at->diffInHours() % 24 }}h
                                {{ $negociacao->created_at->diffInMinutes() % 60 }}m
                                {{ $negociacao->created_at->diffInSeconds() % 60 }}s
                            @else
                                {{ $negociacao->created_at->diffInDays($negociacao->updated_at) }}d
                                {{ $negociacao->created_at->diffInHours($negociacao->updated_at) % 24 }}h
                                {{ $negociacao->created_at->diffInMinutes($negociacao->updated_at) % 60 }}m
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Resultado -->
            <div class="result-section">
                <div class="result-box {{ $negociacao->status == 1 && $negociacao->lucro_reais >= 0 ? 'profit-box' : 'loss-box' }}">
                    <div class="result-icon">
                        <i class="fas {{ $negociacao->status == 1 && $negociacao->lucro_reais >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                    </div>
                    <div class="result-details">
                        <span class="result-label">{{__('Resultado')}}</span>
                        <span class="result-value">
                            @if($negociacao->status == 0)
                                <span class="blinking-text">{{__('Em andamento')}}</span>
                            @else
                                <span>{{ $negociacao->lucro_porcentagem }}</span>
                                <span class="result-amount">
                                    (R$ {{ number_format($negociacao->lucro_reais, 2, ',', '.') }})
                                </span>
                            @endif
                        </span>
                    </div>
                    <div class="result-graph">
                        <div class="mini-chart" id="mini-chart-{{ $negociacao->tnx }}"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rodapé com datas -->
        <div class="card-footer">
            <div class="date-info">
                <span class="date-label">{{__('Data da Compra')}}</span>
                <span class="date-value">{{ $negociacao->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="date-info">
                <span class="date-label">{{ __('Data da Venda') }}</span>
                <span class="date-value">{{ $negociacao->status == 0 ? __('Em andamento') : $negociacao->updated_at->format('d/m/Y H:i') }}</span>
            </div>
        </div>
    </div>
</div>


                    </div>
                </div>
            </div>
            <!-- Show mobile-screen content -->

        </div>
   @endforeach

                </div>
                                @if(count($negociacoes) == 0)
                                    <div class="alert alert-table mt-20 text-center" role="alert">
                                        {{ __('No Data Found') }}
                                    </div>
                                @endif
                {{ $negociacoes->onEachSide(1)->links('frontend::include.__pagination') }}
            </section>
            <!-- Pricing section end -->
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Objeto para armazenar os intervals
    const tradeIntervals = {};

    // Função para inicializar todas as negociações
    function initializeTrades() {
        @foreach($negociacoes as $negociacao)
            @if($negociacao->status == 0)
            setupTradeTimer(
                '{{ $negociacao->tnx }}',
                '{{ $negociacao->created_at }}',
                'trade-progress-{{ $negociacao->tnx }}',
                'progress-percent-{{ $negociacao->tnx }}',
                'trade-duration-{{ $negociacao->tnx }}',
                'mini-chart-{{ $negociacao->tnx }}'
            );
            @endif
        @endforeach
    }

    // Configura o timer para uma negociação específica
    function setupTradeTimer(tradeId, createdAt, progressBarId, percentId, durationId, chartId) {
        const startTime = new Date(createdAt).getTime();

        function updateTradeProgress() {
            const now = new Date().getTime();
            const totalDuration = 15 * 24 * 60 * 60 * 1000; // 15 dias em ms
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / totalDuration, 1);

            // Atualiza barra de progresso
            document.getElementById(progressBarId).style.width = `${progress * 100}%`;
            document.getElementById(percentId).textContent = `${Math.round(progress * 100)}%`;

            // Atualiza contador de tempo
            updateTimeCounter(tradeId, startTime, durationId);

            // Atualiza mini gráfico
            updateMiniChart(chartId, progress);
        }

        // Armazena o intervalo no objeto
        tradeIntervals[tradeId] = setInterval(updateTradeProgress, 1000);
        updateTradeProgress(); // Executa imediatamente
    }

    // Atualiza o contador de tempo para uma negociação específica
    function updateTimeCounter(tradeId, startTime, durationId) {
        const now = new Date();
        const diff = now - startTime;

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        document.getElementById(durationId).textContent =
            `${days}d ${hours.toString().padStart(2, '0')}h ${minutes.toString().padStart(2, '0')}m ${seconds.toString().padStart(2, '0')}s`;
    }

    // Atualiza o mini gráfico para uma negociação específica
    function updateMiniChart(chartId, progress) {
        const chart = document.getElementById(chartId);
        chart.innerHTML = '';

        const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        svg.setAttribute("viewBox", "0 0 100 40");

        const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
        path.setAttribute("stroke", "#4bc0c0");
        path.setAttribute("stroke-width", "2");
        path.setAttribute("fill", "none");
        path.setAttribute("stroke-linecap", "round");

        const segments = 10;
        let pathData = "M0,30 ";

        for (let i = 1; i <= segments; i++) {
            const x = (i / segments) * 100;
            const y = 30 - (Math.sin((i / segments) * Math.PI * progress * 2) * 15 * progress);
            pathData += `L${x},${y} `;
        }

        path.setAttribute("d", pathData.trim());
        svg.appendChild(path);
        chart.appendChild(svg);
    }

    // Inicializa todas as negociações
    initializeTrades();

    // Função para limpar intervals quando necessário
    window.cleanTradeIntervals = function() {
        Object.values(tradeIntervals).forEach(interval => {
            clearInterval(interval);
        });
    };
});
</script>


@endsection