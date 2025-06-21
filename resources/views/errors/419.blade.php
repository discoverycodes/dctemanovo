@extends('errors.layout')
@section('title')
    {{ __('Page Expired') }}
@endsection
@section('content')
    <img src="/assets/global/materials/500.svg" class="unusual-page-img" alt="">
    <h2 class="title">😓 Sessão Expirada</h2>
    <p class="description">Você ficou um tempo sem interagir. Por segurança, sua sessão foi encerrada.</p>
    <a href="{{route('home')}}" class="site-btn gradient-btn">{{ __('Fazer Login novamente') }}</a>

@endsection
