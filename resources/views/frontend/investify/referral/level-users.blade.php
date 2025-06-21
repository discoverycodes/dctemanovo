@extends('frontend::layouts.user')
 @section('title')
   {{ __('Indicações do ') }}{{ $level }}º Nível
@endsection
@section('content')
<div class="container-fluid default-page">

<style>
/* Variáveis CSS */
:root {
    --pp-primary: #7367f0;
    --pp-secondary: #00cfe8;
    --pp-success: #28c76f;
    --pp-danger: #ea5455;
    --pp-dark: #2d2d2d;
    --pp-light: #FFFFFF;
    --pp-text: #FFFFFF;
    --pp-border-radius: 12px;
    --pp-box-shadow: 0 4px 24px rgba(34, 41, 47, 0.1);
}

/* Layout Principal */
.pp-referral-users-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    padding: 10px;
}

/* Card de Usuário */
.pp-user-card {
    background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: var(--pp-border-radius);
    box-shadow: var(--pp-box-shadow);
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.pp-user-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(34, 41, 47, 0.15);
}

/* Cabeçalho */
.pp-user-header {
    display: flex;
    align-items: center;
    padding: 20px;
    background: linear-gradient(135deg, rgba(115, 103, 240, 0.1) 0%, rgba(115, 103, 240, 0.05) 100%);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.pp-user-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 15px;
    border: 3px solid white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.pp-user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.pp-user-info {
    flex: 1;
}

.pp-user-name {
    margin: 0;
    font-size: 1.1rem;
    color: var(--pp-light);
    font-weight: 600;
    line-height: 1.3;
}

.pp-user-status {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-top: 5px;
}

.pp-active {
    background: rgba(40, 199, 111, 0.1);
    color: var(--pp-success);
}

.pp-inactive {
    background: rgba(234, 84, 85, 0.1);
    color: var(--pp-danger);
}

/* Corpo */
.pp-user-body {
    padding: 15px 20px;
    flex-grow: 1;
}

.pp-user-detail {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}

.pp-user-detail:last-child {
    margin-bottom: 0;
}

.pp-detail-icon {
    width: 24px;
    height: 24px;
    background: rgba(115, 103, 240, 0.1);
    color: var(--pp-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    margin-right: 10px;
    flex-shrink: 0;
}

.pp-detail-value {
    font-size: 0.9rem;
    color: var(--pp-text);
    word-break: break-word;
}

/* Rodapé */
.pp-user-footer {
    padding: 15px 20px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    text-align: center;
}

.pp-whatsapp-btn {
    background: #2e784a;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.pp-whatsapp-btn:hover {
    background: #128C7E;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.pp-no-phone {
    font-size: 0.85rem;
    color: var(--pp-danger);
    display: inline-block;
    padding: 8px 0;
}

/* Responsividade */
@media (max-width: 768px) {
    .pp-referral-users-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
}

@media (max-width: 576px) {
    .pp-referral-users-grid {
        grid-template-columns: 1fr;
    }

    .pp-user-header {
        padding: 15px;
    }

    .pp-user-avatar {
        width: 50px;
        height: 50px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Efeito hover nos cards
    const cards = document.querySelectorAll('.pp-user-card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 8px 25px rgba(34, 41, 47, 0.15)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });
});
</script>

    <div class="row gy-30">
        <div class="col-xl-12">
            <div class="rock-all-transactions-area">
                <div class="rock-dashboard-card">
                <div class="rock-dashboard-title-inner">
                            <h3 class="rock-dashboard-tile">{{ __('Indicações do ') }}{{ $level }}º Nível</h3>
                            <div class="card-header-links">
                        <a href="{{ route('user.referral') }}" class="site-btn gradient-btn radius-12">← Voltar</a>
                    </div>
                </div>

                            <div class="pp-referral-users-grid">
                                @foreach($users as $u)
                                 @php
                                $rawPhone = $u->phone;

                                // Remove tudo que não for número
                                $cleanPhone = preg_replace('/\D/', '', $rawPhone);

                                // Verifica se o número tem ao menos 9 dígitos após o DDD
                                if (strlen($cleanPhone) > 4) {
                                    // Extrai os últimos 11 (2 DDD + 9 número), ou apenas os 9 últimos se for mais simples
                                    $cleanNumber = substr($cleanPhone, -11);
                                    $formattedPhone = '+55' . $cleanNumber;
                                } else {
                                    $formattedPhone = '+55';
                                }
                                $patrocinador = \App\Models\User::find($u->ref_id);
                            @endphp

    <div class="pp-user-card">
        <!-- Cabeçalho do Card -->
        <div class="pp-user-header">
            <div class="pp-user-avatar">
                                @if($user->avatar)
                                <img src="{{ asset('assets/'.$user->avatar)  }}" >
                                @else
                                <img src="{{ asset(setting('site_favicon','global')) }}" >
                                @endif
            </div>
            <div class="pp-user-info">
                <h4 class="pp-user-name">{{ $u->full_name }}</h4>
                <div class="pp-user-status ">
 <span class="white-text">@if($u->is_active == 1) <div class="rock-badge success">{{__('ATIVO') }}</div> @else <div class="rock-badge danger">{{__('INATIVO') }}</div> @endif</span>

                </div>
            </div>
        </div>

        <!-- Corpo do Card -->
        <div class="pp-user-body">
             @if($level > 1)
            <div class="pp-user-detail">
                <span class="pp-detail-value">{{__('Patrocinado por')}}:&nbsp;<b>{{$patrocinador->username}}</b></span>
            </div>
             @endif
            <div class="pp-user-detail">
                <i class="fas fa-user pp-detail-icon"></i>
                <span class="pp-detail-value">{{ $u->username }}</span>
            </div>
            <div class="pp-user-detail">
                <i class="fas fa-envelope pp-detail-icon"></i>
                <span class="pp-detail-value">{{ $u->email }}</span>
            </div>

            <div class="pp-user-detail">
                <i class="fas fa-calendar-day pp-detail-icon"></i>
                <span class="pp-detail-value">{{ $u->created_at->format('d/m/Y H:i:s') }}</span>
            </div>
        </div>

        <!-- Rodapé do Card -->
        <div class="pp-user-footer">
            @if($formattedPhone !== '+55')
            <a href="https://wa.me/{{ $formattedPhone }}" target="_blank" class="pp-whatsapp-btn">
                <i class="fab fa-whatsapp"></i> {{ __('Enviar mensagem') }}
            </a>
            @else
            <span class="pp-no-phone">{{ __('Telefone não informado') }}</span>
            @endif
        </div>
    </div>
    @endforeach
</div>


                    <div class="pagination-wrapper">
                        <div class="rock-pagination d-flex justify-content-end">
                           {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
