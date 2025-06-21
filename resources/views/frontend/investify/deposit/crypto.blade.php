@extends('frontend::layouts.user')
@section('title')
    {{ __('Efetuar Pagamento') }}
@endsection
@section('content')
 <style>
        .usdt-payment-container {
            max-width: 600px;
            margin: 0 auto;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #dee2e6;
        }

        .usdt-header {
            background: linear-gradient(135deg, #26a17b 0%, #07964c 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .usdt-body {
            padding: 25px;
        }

        .qr-code-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e9ecef;
            text-align: center;
        }

        .qr-code {
            width: 200px;
            height: 200px;
            margin: 0 auto 15px;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }

        .amount-container {
            background: #f1f8ff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #d1e7ff;
        }

        .amount-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #26a17b;
            margin: 10px 0;
        }

        .copy-code-container {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            position: relative;
        }

        .copy-code {
            font-family: 'Courier New', monospace;
            word-break: break-all;
            background: white;
            padding: 10px;
            border-radius: 5px;
            border: 1px dashed #adb5bd;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.5;
            max-height: 3em;
        }

        .copy-code:hover {
            -webkit-line-clamp: unset;
            max-height: none;
        }

        .copy-btn {
            position: absolute;
            right: 20px;
            top: 20px;
            cursor: pointer;
            color: #26a17b;
        }

        .timer-container {
            background: #e9ecef;
            border-radius: 50px;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .timer {
            font-size: 1.2rem;
            font-weight: bold;
            color: #dc3545;
        }

        .instructions {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .instruction-step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .step-number {
            background: #26a17b;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            margin-right: 10px;
            flex-shrink: 0;
        }

        @media (max-width: 576px) {
            .qr-code {
                width: 180px;
                height: 180px;
            }

            .usdt-body {
                padding: 15px;
            }
        }
    </style>
<div class="container-fluid default-page">
<div class="col-xl-12">

                                <div class="rock-recent-transactions-area">

     <div class="usdt-payment-container">
            <div class="usdt-header">
                <h2 class="text-white"><i class="fab fa-ethereum me-2"></i> {{ __('Pagamento via USDT (BSC)') }}</h2>
                <p class="mb-0">{{ __('Envie o valor exato para o endereço abaixo') }}</p>
            </div>

            <div class="usdt-body">
                <div class="timer-container">
                    <p class="mb-1 text-muted">{{ __('Atualizando em:') }}</p>
                    <div class="timer" id="countdown">60 {{ __('segundos') }}</div>
                </div>

                <div class="amount-container">
                    <p class="mb-1 text-muted">{{ __('Valor exato a ser enviado:') }}</p>
                    <div class="amount-value">{{ $valor }} USDT</div>
                    <button class="btn btn-outline-primary btn-sm mt-2" id="copy-amount-btn">
                        <i class="fas fa-copy me-1"></i> {{ __('Copiar Valor') }}
                    </button>
                    <p class="text-muted small mb-0 mt-2">{{ __('O pagamento será verificado automaticamente') }}</p>
                </div>

                <div class="qr-code-container">
                    <h5><i class="fas fa-qrcode me-2"></i> {{ __('QR Code USDT') }}</h5>
                    <div class="qr-code">
                     <img src="{{ $qrcode }}" alt="img">
                    </div>
                    <p class="text-muted">{{ __('Abra sua carteira e escaneie o código') }}</p>
                </div>

                <div class="copy-code-container">
                    <h5><i class="fas fa-wallet me-2"></i> {{ __('Endereço USDT (BSC)') }}</h5>
                    <div class="copy-code" id="usdt-address" title="{{ __('Clique para ver completo ou copie o endereço') }}">
                        {{ $copiaecola }}
                    </div>
                    <div class="copy-btn" id="copy-btn" title="{{ __('Copiar endereço completo') }}">
                        <i class="far fa-copy"></i>
                    </div>
                </div>

                <button class="btn btn-success w-100 mb-3" id="copy-button">
                    <i class="fas fa-copy me-2"></i> {{ __('Copiar Endereço') }}
                </button>

                <div class="instructions">
                    <h6><i class="fas fa-info-circle me-2"></i> {{ __('Como pagar:') }}</h6>
                    <div class="instruction-step">
                        <div class="step-number">1</div>
                        <div class="text-muted">{{ __('Abra sua carteira (Trust Wallet, MetaMask, etc)') }}</div>
                    </div>
                    <div class="instruction-step">
                        <div class="step-number">2</div>
                        <div class="text-muted">{{ __('Selecione USDT na rede Binance Smart Chain (BSC)') }}</div>
                    </div>
                    <div class="instruction-step">
                        <div class="step-number">3</div>
                        <div class="text-muted">{{ __('Envie o valor exato de') }} <strong>{{ $valor }} USDT</strong> {{ __('para o endereço acima') }}</div>
                    </div>
                </div>
            </div>
        </div>


                                </div>
                            </div>
                    </div>
@endsection


@section('script')
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

document.getElementById('copy-amount-btn').addEventListener('click', async function() {
    try {
        const amountToCopy = '{{ $valor }}';
        await copyToClipboard(amountToCopy);

        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check me-1"></i> {{ __("Valor copiado!") }}';
        this.classList.remove('btn-outline-primary');
        this.classList.add('btn-outline-success');

        setTimeout(() => {
            this.innerHTML = originalText;
            this.classList.remove('btn-outline-success');
            this.classList.add('btn-outline-primary');
        }, 2000);
    } catch (err) {
        alert('{{ __("Não foi possível copiar o valor. Tente manualmente.") }}');
        console.error('Erro ao copiar:', err);
    }
});
        let timeLeft = 60;
        const countdownElement = document.getElementById('countdown');

        const countdown = setInterval(() => {
            timeLeft--;
            const secondsText = timeLeft === 1 ? '{{ __("segundo") }}' : '{{ __("segundos") }}';
            countdownElement.textContent = timeLeft + ' ' + secondsText;

            if (timeLeft <= 0) {
                clearInterval(countdown);
                window.location.reload();
            }
        }, 1000);

        // Função para copiar texto para a área de transferência
        function copyToClipboard(text) {
            return new Promise((resolve, reject) => {
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(text).then(resolve).catch(reject);
                } else {
                    // Fallback para navegadores mais antigos
                    const textarea = document.createElement('textarea');
                    textarea.value = text;
                    textarea.style.position = 'fixed';
                    document.body.appendChild(textarea);
                    textarea.select();

                    try {
                        const successful = document.execCommand('copy');
                        document.body.removeChild(textarea);
                        successful ? resolve() : reject();
                    } catch (err) {
                        document.body.removeChild(textarea);
                        reject(err);
                    }
                }
            });
        }

        // Copiar endereço USDT - Botão principal
        document.getElementById('copy-button').addEventListener('click', async function() {
            try {
                const usdtAddress = document.getElementById('usdt-address').innerText.trim();
                await copyToClipboard(usdtAddress);

                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check me-2"></i> {{ __("Endereço copiado!") }}';
                this.classList.remove('btn-success');
                this.classList.add('btn-primary');

                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.classList.remove('btn-primary');
                    this.classList.add('btn-success');
                }, 2000);
            } catch (err) {
                alert('{{ __("Não foi possível copiar o endereço. Tente manualmente.") }}');
                console.error('Erro ao copiar:', err);
            }
        });

        // Copiar endereço USDT - Ícone de cópia
        document.getElementById('copy-btn').addEventListener('click', async function() {
            try {
                const usdtAddress = document.getElementById('usdt-address').innerText.trim();
                await copyToClipboard(usdtAddress);

                const icon = this.querySelector('i');
                icon.classList.replace('fa-copy', 'fa-check');

                setTimeout(() => {
                    icon.classList.replace('fa-check', 'fa-check');
                }, 2000);
            } catch (err) {
                alert('{{ __("Não foi possível copiar o endereço. Tente manualmente.") }}');
                console.error('Erro ao copiar:', err);
            }
        });
    </script>
 @endsection