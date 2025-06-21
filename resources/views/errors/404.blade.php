@extends('errors.layout')
@section('title')
    {{ __('Not Found') }}
@endsection
@section('content')
    <img src="/assets/global/materials/404.svg" class="unusual-page-img" alt="">
    <p class="description">{{ __('NOT FOUND') }}</p>
    <a href="{{route('home')}}" class="site-btn gradient-btn">{{ __('Back to Home') }}</a>
@endsection
