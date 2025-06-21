@extends('frontend::layouts.user')
@section('title')
{{ __('Indicados') }}
@endsection
@section('content')
@php
$IndicadosDiretosAtivos = App\Models\User::where('ref_id', auth()->user()->id)->where('is_active', 1)->count();
@endphp
<style>
/* Base Variables */
:root {
    --pp-primary: #7367f0;
    --pp-secondary: #00cfe8;
    --pp-success: #28c76f;
    --pp-info: #1e9ff2;
    --pp-warning: #ff9f43;
    --pp-danger: #ea5455;
    --pp-dark: #1e1e1e;
    --pp-light: #FFFFFF;
    --pp-text: #6e6b7b;
    --pp-border-radius: 12px;
    --pp-box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
}

/* Main Container */
.pp-referral-dashboard {
   margin: 0 auto;
}

/* Stats Grid */
.pp-referral-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

/* Stat Cards */
.pp-stat-card {
    background: rgba(255, 255, 255, 0.08);
    border-radius: var(--pp-border-radius);
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: var(--pp-box-shadow);
    padding: 20px;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    align-items: center;
}

.pp-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(34, 41, 47, 0.15);
}

.pp-stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 24px;
    color: white;
}

.pp-stat-content {
    flex: 1;
}

.pp-stat-value {
    font-size: 22px;
    font-weight: 600;
    margin: 0;
    line-height: 1;
    color: var(--pp-light);
}

.pp-stat-label {
    font-size: 14px;
    color: var(--pp-light);
    margin: 5px 0 0;
}

.pp-stat-wave {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background-size: contain;
    background-repeat: no-repeat;
    opacity: 0.1;
}

/* Color Variants */
.pp-primary-card .pp-stat-icon { background: var(--pp-primary); }
.pp-primary-card .pp-stat-wave { background-image: radial-gradient(circle, var(--pp-primary) 20%, transparent 70%); }

.pp-secondary-card .pp-stat-icon { background: var(--pp-secondary); }
.pp-secondary-card .pp-stat-wave { background-image: radial-gradient(circle, var(--pp-secondary) 20%, transparent 70%); }

.pp-success-card .pp-stat-icon { background: var(--pp-success); }
.pp-success-card .pp-stat-wave { background-image: radial-gradient(circle, var(--pp-success) 20%, transparent 70%); }

.pp-info-card .pp-stat-icon { background: var(--pp-info); }
.pp-info-card .pp-stat-wave { background-image: radial-gradient(circle, var(--pp-info) 20%, transparent 70%); }

/* Referral Link Card */
.pp-referral-link-card {
    background: rgba(255, 255, 255, 0.08);
    border-radius: var(--pp-border-radius);
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: var(--pp-box-shadow);
    margin-bottom: 30px;
    overflow: hidden;
}

.pp-referral-link-header {
    background: linear-gradient(135deg, #416f0c 0%, #7fb540 100%);
    color: white;
    padding: 15px 20px;
    display: flex;
    align-items: center;
}

.pp-referral-link-header i {
    font-size: 20px;
    margin-right: 10px;
}

.pp-referral-link-header h3 {
    margin: 0;
    font-size: 18px;
}

.pp-referral-link-body {
    padding: 20px;
}

.pp-input-group {
    display: flex;
    margin-bottom: 15px;
}

.pp-referral-input {
    flex: 1;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px 0 0 8px;
    font-size: 14px;
    background: #f9f9f9;
}

.pp-copy-btn {
    background: var(--pp-primary);
    color: white;
    border: none;
    padding: 0 20px;
    border-radius: 0 8px 8px 0;
    cursor: pointer;
    transition: background 0.3s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.pp-copy-btn:hover {
    background: #5f52e8;
}

.pp-referral-count {
    color: var(--pp-text);
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
}

.pp-referral-count i {
    color: var(--pp-success);
}

.pp-referral-social {
    border-top: 1px solid #eee;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.pp-referral-social p {
    margin: 0;
    color: var(--pp-text);
    font-size: 14px;
}

.pp-social-icons {
    display: flex;
    gap: 8px;
}

.pp-social-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    transition: transform 0.3s;
}

.pp-social-btn:hover {
    transform: translateY(-3px);
}

.pp-whatsapp { background: #25D366; }
.pp-telegram { background: #0088cc; }
.pp-facebook { background: #3b5998; }
.pp-twitter { background: #1DA1F2; }

/* Levels Section */
.pp-levels-container {
    margin-top: 30px;
}

.pp-levels-title {
    font-size: 18px;
    color: var(--pp-dark);
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.pp-levels-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
}

.pp-level-card {
    background: white;
    border-radius: var(--pp-border-radius);
    box-shadow: var(--pp-box-shadow);
    padding: 15px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    text-decoration: none;
    color: var(--pp-text);
}

.pp-level-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(34, 41, 47, 0.1);
    color: var(--pp-primary);
}

.pp-level-badge {
    width: 40px;
    height: 40px;
    background: var(--pp-primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-right: 15px;
    flex-shrink: 0;
}

.pp-level-content {
    flex: 1;
}

.pp-level-users {
    display: block;
    font-weight: 600;
    color: var(--pp-dark);
}

.pp-level-label {
    font-size: 12px;
    color: var(--pp-text);
}

.pp-level-arrow {
    margin-left: 10px;
    color: #FFFFFF;
    transition: color 0.3s;
}

.pp-level-card:hover .pp-level-arrow {
    color: var(--pp-primary);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .pp-referral-stats-grid {
        grid-template-columns: 1fr 1fr;
    }

    .pp-levels-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 576px) {
    .pp-referral-stats-grid {
        grid-template-columns: 1fr;
    }

    .pp-levels-grid {
        grid-template-columns: 1fr;
    }

    .pp-input-group {
        flex-direction: column;
    }

    .pp-referral-input {
        border-radius: 8px;
        margin-bottom: 5px;
    }

    .pp-copy-btn {
        border-radius: 8px;
        justify-content: center;
    }
}
</style>
<div class="container-fluid default-page">

<div class="pp-referral-dashboard">
    <!-- Stats Cards -->
    <div class="pp-referral-stats-grid">
        <!-- Direct Active Referrals -->
        <div class="pp-stat-card pp-primary-card">
            <div class="pp-stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="pp-stat-content">
                <h3 class="pp-stat-value">{{ $IndicadosDiretosAtivos }}</h3>
                <p class="pp-stat-label">{{ __('Indicados Diretos Ativos') }}</p>
            </div>
            <div class="pp-stat-wave"></div>
        </div>

        <!-- Total Referrals -->
        <div class="pp-stat-card pp-secondary-card">
            <div class="pp-stat-icon">
                <i class="fas fa-network-wired"></i>
            </div>
            <div class="pp-stat-content">
                <h3 class="pp-stat-value">{{ $IndicadosTotais }}</h3>
                <p class="pp-stat-label">{{ __('Indicados Totais') }}</p>
            </div>
            <div class="pp-stat-wave"></div>
        </div>

        <!-- Total Earnings -->
        <div class="pp-stat-card pp-success-card">
            <div class="pp-stat-icon">
                <i class="fas fa-coins"></i>
            </div>
            <div class="pp-stat-content">
                <h3 class="pp-stat-value"><span style="font-size: small">{{ $currencySymbol }}</span>{{ showamount(Auth::user()->ganhos_totais_de_rede) }}</h3>
                <p class="pp-stat-label">{{ __('Movimentação da Rede') }}</p>
            </div>
            <div class="pp-stat-wave"></div>
        </div>

        <!-- Daily Earnings -->
        <div class="pp-stat-card pp-info-card">
            <div class="pp-stat-icon">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div class="pp-stat-content">
                <h3 class="pp-stat-value"><span style="font-size: small">{{ $currencySymbol }}</span>{{ showamount(Auth::user()->ganhos_de_rede_do_dia) }}</h3>
                <p class="pp-stat-label">{{ __('Movimentação Diária da Rede') }}</p>
            </div>
            <div class="pp-stat-wave"></div>
        </div>
    </div>

    <!-- Referral Link Card -->
    <div class="pp-referral-link-card">
        <div class="pp-referral-link-header">
            <i class="fas fa-link"></i>
            <h3 class="text-white">{{ __('Your Referral Link') }}</h3>
        </div>
        <div class="pp-referral-link-body">
            <div class="pp-input-group">
                <input type="text" class="pp-referral-input" id="ppReferralLink"
                       value="{{ $getReferral->link }}" readonly>
                <button class="pp-copy-btn" id="ppCopyBtn">
                    <i class="far fa-copy"></i> {{ __('Copy') }}
                </button>
            </div>
            <p class="pp-referral-count">
                <i class="fas fa-user-plus"></i>
                {{ $getReferral->relationships()->count() }} {{ __('peoples are joined by using this URL') }}
            </p>
        </div>
        <div class="pp-referral-social">
            <p>{{ __('Share on') }}</p>
            <div class="pp-social-icons">
                <a href="#" class="pp-social-btn pp-whatsapp"><i class="fab fa-whatsapp"></i></a>
                <a href="#" class="pp-social-btn pp-telegram"><i class="fab fa-telegram"></i></a>
                <a href="#" class="pp-social-btn pp-facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="pp-social-btn pp-twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>

    <!-- Levels Navigation -->
    @if($IndicadosTotais > 0)
    <div class="pp-levels-container mb-4">
        <h3 class="pp-levels-title text-white"><i class="fas fa-layer-group"></i> {{ __('Your Network Levels') }}</h3>
        <div class="pp-levels-grid">
            @foreach($porNivel as $nivel => $quantidade)
            <a href="{{ route('user.referrallevel', $nivel) }}" class="pp-level-card">
                <div class="pp-level-badge">{{ $nivel }}º</div>
                <div class="pp-level-content">
                    <span class="pp-level-users">{{ $quantidade }} {{ __('User') }}{{ $quantidade > 1 ? 's' : '' }}</span>
                    <span class="pp-level-label">{{ __('Nível') }}</span>
                </div>
                <i class="fas fa-chevron-right pp-level-arrow"></i>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

    <div class="row gy-30">
        <div class="col-xl-12">
            <div class="rock-referral-area">
                <div class="row gy-24">

                    <div class="col-xxl-12">
                        <div class="rock-referral-logs">
                            <div class="rock-dashboard-card">
                                <div class="rock-dashboard-title-inner">
                                    <h3 class="rock-dashboard-tile">{{ __('All Referral Logs') }}</h3>
                                </div>
                                <div class="rock-referral-logs-table table-responsive">
                                    <div class="rock-referral-logs-tab td-tab">

                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="referral-general-tab-pane"
                                                role="tabpanel" aria-labelledby="referral-general-tab" tabindex="0">
                                                <div class="rock-custom-table">
                                                    <div class="contents">
                                                        <div class="site-table-list site-table-head">
                                                            <div class="site-table-col">{{ __('Description') }}</div>
                                                            <div class="site-table-col">{{ __('Transaction ID') }}</div>
                                                            <div class="site-table-col">{{ __('Amount') }}</div>
                                                            <div class="site-table-col">{{ __('Status') }}</div>
                                                        </div>
                                                        @foreach($generalReferrals as $raw )
                                                        <div class="site-table-list">
                                                            <div class="site-table-col">
                                                                <div class="description">
                                                                    <div class="iocn">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path opacity="0.4"
                                                                                d="M9.41266 4.68911C10.2496 3.85219 11.4055 3.41786 12.5771 3.50011L16.5414 3.77844C18.5209 3.91741 20.0839 5.48041 20.2228 7.45987L20.5011 11.4242C20.5834 12.5958 20.1491 13.7517 19.3122 14.5886L12.7468 21.154C11.1635 22.7373 8.61357 22.7545 7.05148 21.1924L2.80884 16.9498C1.24674 15.3877 1.26396 12.8378 2.8473 11.2545L9.41266 4.68911Z"
                                                                                fill="#86A8FF" />
                                                                            <circle cx="14.8281" cy="9.17218" r="2"
                                                                                transform="rotate(45 14.8281 9.17218)"
                                                                                fill="#86A8FF" />
                                                                        </svg>
                                                                    </div>
                                                                    <div class="content">
                                                                        <h4 class="title kittensEye-text fw-7">{{ $raw->description }}</h4>
                                                                        <p class="description">{{ $raw->created_at }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="site-table-col">
                                                                <span class="white-text">{{ $raw->tnx }}</span>
                                                            </div>

                                                            <div class="site-table-col">
                                                                <span class="success-text">+{{  setting('currency_symbol','global'). showamount($raw->amount) }}
                                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M9.55545 4.55806C9.79953 4.31398 10.1953 4.31398 10.4393 4.55806L13.7727 7.89139C14.0167 8.13547 14.0167 8.5312 13.7727 8.77528C13.5286 9.01935 13.1329 9.01935 12.8888 8.77528L10.6224 6.50888V15C10.6224 15.3452 10.3426 15.625 9.9974 15.625C9.65222 15.625 9.3724 15.3452 9.3724 15V6.50888L7.106 8.77528C6.86193 9.01935 6.4662 9.01935 6.22212 8.77528C5.97804 8.5312 5.97804 8.13547 6.22212 7.89139L9.55545 4.55806Z"
                                                                            fill="#85FFC4" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <div class="site-table-col">
                                                                @if($raw->status->value == App\Enums\TxnStatus::Pending->value)
                                                                <div class="rock-badge warning">{{ __('Pending') }}</div>
                                                                @elseif($raw->status->value == App\Enums\TxnStatus::Success->value)
                                                                <div class="rock-badge badge-success">{{ __('Success') }}</div>
                                                                @elseif($raw->status->value == App\Enums\TxnStatus::Failed->value)
                                                                <div class="rock-badge danger">{{ __('Canceled') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @if(count($generalReferrals) == 0)
                                                    <div class="alert alert-table mt-20 text-center" role="alert">
                                                        {{ __('No Data Found') }}
                                                    </div>
                                                    @endif
                                                </div>
                                                {{ $generalReferrals->links('frontend::include.__pagination') }}
                                            </div>
                                            @foreach($referrals as $target => $referral)
                                            @php
                                            $target = json_decode($target,true);
                                            @endphp
                                            <div class="tab-pane fade" id="referral-{{ $target['id'] }}-tab-pane"
                                                role="tabpanel" aria-labelledby="referral-{{ $target['id'] }}-tab" tabindex="0">
                                                <div class="rock-custom-table">
                                                    <div class="contents">
                                                        <div class="site-table-list site-table-head">
                                                            <div class="site-table-col">{{ __('Description') }}</div>
                                                            <div class="site-table-col">{{ __('Transaction ID') }}</div>
                                                            <div class="site-table-col">{{ __('Amount') }}</div>
                                                            <div class="site-table-col">{{ __('Status') }}</div>
                                                        </div>
                                                        @foreach($referral->sortDesc() as $raw )
                                                        <div class="site-table-list">
                                                            <div class="site-table-col">
                                                                <div class="description">
                                                                    <div class="iocn">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path opacity="0.4"
                                                                                d="M9.41266 4.68911C10.2496 3.85219 11.4055 3.41786 12.5771 3.50011L16.5414 3.77844C18.5209 3.91741 20.0839 5.48041 20.2228 7.45987L20.5011 11.4242C20.5834 12.5958 20.1491 13.7517 19.3122 14.5886L12.7468 21.154C11.1635 22.7373 8.61357 22.7545 7.05148 21.1924L2.80884 16.9498C1.24674 15.3877 1.26396 12.8378 2.8473 11.2545L9.41266 4.68911Z"
                                                                                fill="#86A8FF" />
                                                                            <circle cx="14.8281" cy="9.17218" r="2"
                                                                                transform="rotate(45 14.8281 9.17218)"
                                                                                fill="#86A8FF" />
                                                                        </svg>
                                                                    </div>
                                                                    <div class="content">
                                                                        <h4 class="title kittensEye-text fw-7">{{ $raw->description }}</h4>
                                                                        <p class="description">{{ $raw->created_at }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="site-table-col">
                                                                <span class="white-text">{{ $raw->tnx }}</span>
                                                            </div>
                                                            <div class="site-table-col">
                                                                <span class="success-text">+{{$raw->amount .' '.$currency}}
                                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M9.55545 4.55806C9.79953 4.31398 10.1953 4.31398 10.4393 4.55806L13.7727 7.89139C14.0167 8.13547 14.0167 8.5312 13.7727 8.77528C13.5286 9.01935 13.1329 9.01935 12.8888 8.77528L10.6224 6.50888V15C10.6224 15.3452 10.3426 15.625 9.9974 15.625C9.65222 15.625 9.3724 15.3452 9.3724 15V6.50888L7.106 8.77528C6.86193 9.01935 6.4662 9.01935 6.22212 8.77528C5.97804 8.5312 5.97804 8.13547 6.22212 7.89139L9.55545 4.55806Z"
                                                                            fill="#85FFC4" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <div class="site-table-col">
                                                                @if($raw->status->value == App\Enums\TxnStatus::Pending->value)
                                                                <div class="rock-badge warning">{{ __('Pending') }}</div>
                                                                @elseif($raw->status->value == App\Enums\TxnStatus::Success->value)
                                                                <div class="rock-badge badge-success">{{ __('Success') }}</div>
                                                                @elseif($raw->status->value == App\Enums\TxnStatus::Failed->value)
                                                                <div class="rock-badge danger">{{ __('Canceled') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
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
document.addEventListener('DOMContentLoaded', function() {
    // Copy Referral Link
    const copyBtn = document.getElementById('ppCopyBtn');
    const referralInput = document.getElementById('ppReferralLink');

    if (copyBtn && referralInput) {
        copyBtn.addEventListener('click', function() {
            referralInput.select();
            document.execCommand('copy');

            // Change button text temporarily
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check"></i> {{ __("Copied!") }}';
            copyBtn.style.backgroundColor = '#339933';

            setTimeout(() => {
                copyBtn.innerHTML = originalText;
                copyBtn.style.backgroundColor = '';
            }, 2000);
        });
    }

    // Social share buttons (example for WhatsApp)
    document.querySelector('.pp-whatsapp').addEventListener('click', function(e) {
        e.preventDefault();
        const message = `Join me using my referral link: ${referralInput.value}`;
        window.open(`https://wa.me/?text=${encodeURIComponent(message)}`, '_blank');
    });
});
    </script>
@endsection
