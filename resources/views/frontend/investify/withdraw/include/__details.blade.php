<li>
    <span class="title">{{ __('Withdraw Fee') }}</span>
    <span class="info"><span class="withdrawFee">{{ setting('currency_symbol','global') }} {{ $charge }}</span></span>
</li>

@if($conversionRate != null)
    <li style="background: #dc3545;color: white;">
        <span class="title">{{ __('Você deve ter em Sua Carteira') }}</span>
        <span class="">{{ setting('currency_symbol','global') }}<span class="pay-amount" style="font-size: 20px;font-weight: bold;"></span></span>
    </li>

@endif

<li>
    <span class="title">{{ __('Withdraw Account') }}</span>
    <span class="info">{{ $name }}</span>
</li>

@foreach($credentials as $name => $data)
    <li>
        <span class="title">{{ $name }}</span>
        <span class="info">
            @if( $data['type'] == 'file' )
            <img src="{{ asset(data_get($data, 'value')) }}" alt=""/>
            @else
                <strong>{{ data_get($data, 'value') }}</strong>
            @endif
        </span>
    </li>
@endforeach

