<tr>
    <td><strong>{{ __('Withdraw Fee') }}</strong></td>
    <td>{{ setting('currency_symbol','global') }} <span class="withdrawFee">{{ $charge }}</span> </td>
</tr>

@if($conversionRate != null)
    <tr class="conversion" style="background: #dc3545;color: white;">
        <td><strong>{{ __('Você deve ter em Sua Carteira') }}</strong></td>
        <td class="">{{ setting('currency_symbol','global') }} <span class="pay-amount" style="font-size: 20px;font-weight: bold;"></span></td>
    </tr>
@endif

<tr>
    <td><strong>{{ __('Withdraw Account') }}</strong></td>
    <td>{{ $name }}</td>
</tr>

@foreach($credentials as $name => $data)
    <tr>
        <td><strong>{{$name}}</strong></td>
        <td>
            @if( $data['type'] == 'file' )
            <img src="{{ asset(data_get($data, 'value')) }}" alt=""/>
            @else
                <strong>{{ data_get($data, 'value') }}</strong>
            @endif
        </td>
    </tr>
@endforeach

