@extends('frontend::layouts.user')
@section('title')
    {{ __('Withdraw Account Edit') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">{{ __('Edit Withdraw Account') }}</h3>
                    <div class="card-header-links">
                        <a href="{{ route('user.withdraw.account.index') }}"
                           class="card-header-link">{{ __('Withdraw Account') }}</a>
                    </div>
                </div>
                <div class="site-card-body">
                    <div class="progress-steps-form">
                        <form action="{{ route('user.withdraw.account.update',$withdrawAccount->tnx) }}" method="post"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <input type="hidden" name="withdraw_method_id"
                                   value="{{$withdrawAccount->withdraw_method_id}}">
                            <div class="row selectMethodRow">
                                <div class="col-xl-6 col-md-12">
                                    <label for="exampleFormControlInput1"
                                           class="form-label">{{ __('Method Name:') }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                               value="{{ $withdrawAccount->method_name }}" readonly disabled>
                                    </div>
                                </div>


@php
    use App\Models\WithdrawMethod;

    $method = WithdrawMethod::find($withdrawAccount->withdraw_method_id);
    $fields = json_decode($method->fields ?? '{}', true);
    $credentials = json_decode($withdrawAccount->credentials ?? '{}', true);
@endphp

@foreach($credentials as $key => $field)
    @php
        $fieldName = $key;
        $fieldType = $field['type'];
        $fieldValue = $field['value'] ?? '';
        $fieldValidation = $field['validation'] ?? '';

        // Encontra o campo original com base no name (como "Tipo da Chave")
        $originalField = collect($fields)->firstWhere('name', $fieldName);
    @endphp

    @if($fieldType === 'select' && $originalField && isset($originalField['options']))
        <input type="hidden" name="credentials[{{ $fieldName }}][type]" value="select">
        <input type="hidden" name="credentials[{{ $fieldName }}][validation]" value="{{ $fieldValidation }}">

        <div class="col-xl-6 col-md-12">
            <label class="form-label">{{ $fieldName }}</label>
            <div class="input-group">
                <select class="site-nice-select" name="credentials[{{ $fieldName }}][value]"
                        @if($fieldValidation === 'required') required @endif>
                    <option value="">Selecione</option>
                    @foreach($originalField['options'] as $option)
                        @php
                            $optionValue = $option['value'];
                            $optionLabel = $option['label'];
                        @endphp
                        <option value="{{ $optionValue }}"
                            {{ $optionValue === $fieldValue ? 'selected' : '' }}>
                            {{ $optionLabel }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @elseif($fieldType === 'textarea')
        <input type="hidden" name="credentials[{{ $fieldName }}][type]" value="textarea">
        <input type="hidden" name="credentials[{{ $fieldName }}][validation]" value="{{ $fieldValidation }}">

        <div class="col-xl-6 col-md-12">
            <label class="form-label">{{ $fieldName }}</label>
            <div class="input-group">
                <textarea class="form-control-textarea" name="credentials[{{ $fieldName }}][value]"
                    @if($fieldValidation === 'required') required @endif>{{ $fieldValue }}</textarea>
            </div>
        </div>
    @elseif($fieldType === 'file')
        <input type="hidden" name="credentials[{{ $fieldName }}][type]" value="file">
        <input type="hidden" name="credentials[{{ $fieldName }}][validation]" value="{{ $fieldValidation }}">

        <div class="col-xl-6 col-md-12">
            <div class="body-title">{{ $fieldName }}</div>
            <div class="wrap-custom-file">
                <input type="file" name="credentials[{{ $fieldName }}][value]" id="{{ Str::slug($fieldName) }}"
                       accept=".gif, .jpg, .png"
                       @if(empty($fieldValue) && $fieldValidation === 'required') required @endif />
                <label for="{{ Str::slug($fieldName) }}" class="file-ok"
                       style="background-image: url({{ asset($fieldValue) }})">
                    <img class="upload-icon" src="{{ asset('assets/global/materials/upload.svg') }}" alt="">
                    <span>{{ __('Update Icon') }}</span>
                </label>
            </div>
        </div>
    @else
        <input type="hidden" name="credentials[{{ $fieldName }}][type]" value="{{ $fieldType }}">
        <input type="hidden" name="credentials[{{ $fieldName }}][validation]" value="{{ $fieldValidation }}">

        <div class="col-xl-6 col-md-12">
            <label class="form-label">{{ $fieldName }}</label>
            <div class="input-group">
                <input type="text" class="form-control" name="credentials[{{ $fieldName }}][value]"
                       value="{{ $fieldValue }}"
                       @if($fieldValidation === 'required') required @endif />
            </div>
        </div>
    @endif
@endforeach



                            </div>
                            <div class="buttons">
                                <button type="submit" class="site-btn blue-btn">
                                    {{ __('Update Withdraw Account') }}<i class="anticon anticon-double-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
            setTimeout(function () {
            $('#selectType').niceSelect(); // ou $('select.site-nice-select').niceSelect();
        }, 200);

    </script>
@endsection
