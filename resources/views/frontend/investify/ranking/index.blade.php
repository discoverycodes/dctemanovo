@extends('frontend::layouts.user')
@section('title')
{{ __('All The Badges') }}
@endsection
@section('content')
<div class="container-fluid default-page">
    <div class="row gy-30">
        <div class="col-xl-12">
            <div class="rock-ranking-badge-area">
                <div class="rock-ranking-badge-grid">
                    @foreach($rankings as $ranking)
                    <div class="rock-ranking-badge-item" data-background="{{ asset('assets/frontend/theme_base/hardrock/images/bg/ranking-badge.png') }}" @if(auth()->user()->ranking_id == $ranking->id) style="border: 10px solid rgb(86 159 0);" @endif>
                        <div class="icon">
                           @if(auth()->user()->ranking_id > 1 && auth()->user()->ranking_id == $ranking->id ) <span class="badge bg-success" style="position: absolute;z-index: 3333;font-size: 15px;top: 60px;background-color: #1a781e !important;">{{__('Seu Ranking')}}</span> @endif
                            <div class="thumb">
                                <img src="{{ asset('assets/'.$ranking->icon) }}" alt="ranking-badge" @if(auth()->user()->ranking_id > 1 && auth()->user()->ranking_id == $ranking->id ) style="border: 10px solid rgb(86, 159, 0);border-radius: 50%;" @endif>
                            </div>
                            <div class="content">
                                <h3 class="title">{{ $ranking->ranking_name }}</h3>
                                <p class="description"  @if(auth()->user()->ranking_id > 1 && auth()->user()->ranking_id == $ranking->id ) style="text-transform: uppercase;border-left: 8px solid rgb(86 159 0);background: rgb(38 71 112);" @endif>
                                  @if(auth()->user()->ranking_id > 1 && auth()->user()->ranking_id == $ranking->id )

                                           <i class="fa-solid fa-party-horn fa-3x mb-3 text-light"></i><br>
                                             <span style="font-size: large">          {{__('PARABÉNS')}}  <br>
                                            {{ strtoupper($user->full_name) }}<br></span><br>
                                            <span style="display: flex;text-align: left;flex-wrap: wrap;">{{__('Agora você irá receber')}}&nbsp; <b>{{ $ranking->bonus }}% </b>{{__('Sobre todos os Investimentos de sua Rede de Indicados, diariamente!')}}  </span>

                                    @else
                                    {{ $ranking->description }}
                                    @endif
                                    </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
