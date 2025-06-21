@extends('frontend::layouts.user')
@section('title')
    {{ __('Efetuar Pagamento') }}
@endsection
@section('content')
    <style>
        .pix-payment-container {
            max-width: 600px;
            margin: 0 auto;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #dee2e6;
        }

        .pix-header {
            background: linear-gradient(135deg, #20c997 0%, #198754 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .pix-body {
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
            width: 250px;
            height: 250px;
            margin: 0 auto 15px;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }

        .copy-code-container {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            position: relative;
        }

        .copy-code {
font-family: 'Courier New', monospace;
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
    max-height: 62px;
        }

        .copy-btn {
            position: absolute;
            right: 20px;
            top: 20px;
            cursor: pointer;
            color: #20c997;
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
            background: #20c997;
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

            .pix-body {
                padding: 15px;
            }
        }
    </style>
<div class="container-fluid default-page">
<div class="col-xl-12">

                                <div class="rock-recent-transactions-area">

                                    <div class="pix-payment-container">
                                        <div class="pix-header">
                                            <h2 class="text-white"><i class="fas fa-qrcode me-2"></i> Pagamento via PIX</h2>
                                            <p class="mb-0">Escaneie o QR Code ou copie o código</p>
                                        </div>

                                        <div class="pix-body">
                                            <div class="timer-container">
                                                <p class="mb-1 text-muted">Atualizando em:</p>
                                                <div class="timer" id="countdown">30 segundos</div>
                                            </div>

                                            <div class="qr-code-container">
                                                <h5><i class="fas fa-qrcode me-2"></i> QR Code PIX</h5>
                                                <div class="qr-code">
                                                <img src="data:image/png;base64,{{ $qrcode }}" alt="img" >
                                                </div>
                                                <p class="text-muted">Abra seu app de pagamentos e escaneie o código</p>
                                            </div>

                                            <div class="copy-code-container">
                                                <h5><i class="fas fa-paste me-2"></i> Código PIX</h5>
                                                <div class="copy-code" id="pix-code">
                                               {{ $copiaecola }}
                                                </div>
                                                <div class="copy-btn" id="copy-btn" title="Copiar código">
                                                    <i class="far fa-copy"></i>
                                                </div>
                                            </div>

                                            <button class="btn btn-success w-100 mb-3" id="copy-button">
                                                <i class="fas fa-copy me-2"></i> Copiar Código
                                            </button>

                                            <div class="instructions">
                                                <h6><i class="fas fa-info-circle me-2"></i> Como pagar:</h6>
                                                <div class="instruction-step">
                                                    <div class="step-number">1</div>
                                                    <div class="text-muted">Abra seu app de banco ou carteira digital</div>
                                                </div>
                                                <div class="instruction-step">
                                                    <div class="step-number">2</div>
                                                    <div class="text-muted">Selecione a opção PIX e escolha "Pagar com QR Code" ou "Copiar e Colar"</div>
                                                </div>
                                                <div class="instruction-step">
                                                    <div class="step-number">3</div>
                                                    <div class="text-muted">Confirme os dados e finalize o pagamento</div>
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
    let timeLeft = 30;
    const countdownElement = document.getElementById('countdown');

    const countdown = setInterval(() => {
        timeLeft--;
        countdownElement.textContent = timeLeft + ' segundos';

        if (timeLeft <= 0) {
            clearInterval(countdown);
            window.location.reload();
        }
    }, 1000);

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

    document.getElementById('copy-button').addEventListener('click', async function() {
        try {
            const pixCode = document.getElementById('pix-code').innerText.trim();
            await copyToClipboard(pixCode);

            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Código copiado!';
            this.classList.remove('btn-success');
            this.classList.add('btn-primary');

            setTimeout(() => {
                this.innerHTML = originalText;
                this.classList.remove('btn-primary');
                this.classList.add('btn-success');
            }, 2000);
        } catch (err) {
            alert('Não foi possível copiar o código. Tente manualmente.');
            console.error('Erro ao copiar:', err);
        }
    });

    document.getElementById('copy-btn').addEventListener('click', async function() {
        try {
            const pixCode = document.getElementById('pix-code').innerText.trim();
            await copyToClipboard(pixCode);

            const icon = this.querySelector('i');
            icon.classList.replace('fa-copy', 'fa-check');

            setTimeout(() => {
                icon.classList.replace('fa-check', 'fa-copy');
            }, 2000);
        } catch (err) {
            alert('Não foi possível copiar o código. Tente manualmente.');
            console.error('Erro ao copiar:', err);
        }
    });
</script>

 @endsection