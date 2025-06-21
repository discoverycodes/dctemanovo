@extends('frontend::layouts.user')
 @section('title')
    {{ __('Usuários') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">{{ __('Indicações do ') }}{{ $level }}º Nível</h3>
                               <div class="card-header-links">
                        <a href="{{ route('user.referral') }}" class="card-header-link">← Voltar</a>
                    </div>
             </div>

                <div class="site-card-body">

                    <div class="site-table">
                        @if($users->count())
                     <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Data de Cadastro</th>
                        <th>Status</th>
                        <th>WhastApp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                        <tr>
                            <td>{{ $u->full_name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->created_at->format('d/m/Y H:i') }}</td>
                             <td>@if($u->is_active == 1) <div class="site-badge success">{{__('ATIVO') }}</div> @else <div class="site-badge failed">{{__('INATIVO') }}</div> @endif</td>
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
                            @endphp


                             <td>@if ($formattedPhone !== '+55')
                                <a href="https://wa.me/{{ $formattedPhone }}" target="_blank" class="btn" style="background: #017536;color: white;">
                                   <i class="fa-brands fa-whatsapp"></i> Enviar mensagem
                                </a>
                            @else
                                <span style="color: red;">Ainda não informado</span>
                            @endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }}

            </div>
        @else
            <p>Não há usuários neste nível.</p>
        @endif

                    </div>
                </div>
                </div>
            </div>
        </div>

@endsection
