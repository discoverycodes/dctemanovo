



@foreach( json_decode($withdrawMethod->fields, true) as $key => $field)

    {{-- Campo tipo file --}}
    @if($field['type'] == 'file')
        <input type="hidden" name="credentials[{{ $field['name'] }}][type]" value="{{ $field['type'] }}">
        <input type="hidden" name="credentials[{{ $field['name'] }}][validation]" value="{{ $field['validation'] }}">

        <div class="col-xl-6 col-md-12">
            <div class="body-title">{{ $field['name'] }}</div>
            <div class="wrap-custom-file">
                <input
                    type="file"
                    name="credentials[{{ $field['name'] }}][value]"
                    id="{{ $key }}"
                    accept=".gif, .jpg, .png"
                    @if($field['validation'] == 'required') required @endif
                />
                <label for="{{ $key }}">
                    <img class="upload-icon" src="{{ asset('assets/global/materials/upload.svg') }}" alt="" />
                    <span>{{ __('Select ') . $field['name'] }}</span>
                </label>
            </div>
        </div>

    {{-- Campo tipo textarea --}}
    @elseif($field['type'] == 'textarea')
        <input type="hidden" name="credentials[{{ $field['name'] }}][type]" value="{{ $field['type'] }}">
        <input type="hidden" name="credentials[{{ $field['name'] }}][validation]" value="{{ $field['validation'] }}">

        <div class="col-xl-6 col-md-12">
            <label class="form-label">{{ $field['name'] }}</label>
            <div class="input-group">
                <textarea class="form-control-textarea" name="credentials[{{ $field['name'] }}][value]"
                          @if($field['validation'] == 'required') required @endif
                          placeholder="Send Money Note"></textarea>
            </div>
        </div>

    {{-- Campo tipo select --}}
    @elseif($field['type'] == 'select' && isset($field['options']) && is_array($field['options']))
        <input type="hidden" name="credentials[{{ $field['name'] }}][type]" value="select">
        <input type="hidden" name="credentials[{{ $field['name'] }}][validation]" value="{{ $field['validation'] }}">

        <div class="col-xl-6 col-md-12 selectMethodCol">
            <label class="form-label">{{ ucwords(str_replace('_',' ',$field['name'])) }}</label>
            <div class="input-group">
                <select class="site-nice-select" id="selectType" name="credentials[{{ $field['name'] }}][value]"
                        @if($field['validation'] == 'required') required @endif>
                    <option selected>Selecione</option>
                    @foreach($field['options'] as $option)
                        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    {{-- Campo tipo input text (default) --}}
    @else
        <input type="hidden" name="credentials[{{ $field['name'] }}][type]" value="{{ $field['type'] }}">
        <input type="hidden" name="credentials[{{ $field['name'] }}][validation]" value="{{ $field['validation'] }}">

        <div class="col-xl-6 col-md-12">
            <label class="form-label">{{ ucwords(str_replace('_',' ',$field['name'])) }}</label>
            <div class="input-group">
                <input type="text" class="form-control" name="credentials[{{ $field['name'] }}][value]"
                       @if($field['validation'] == 'required') required @endif>
            </div>
        </div>
    @endif

@endforeach



