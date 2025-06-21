@extends('frontend::layouts.user')
@section('title')
    {{ __('Withdraw Account Create') }}
@endsection
@section('content')
<style type="text/css">
.input{
color:black;
}
.nice-select{
float:none;
height: 50px;
line-height: 50px;
border-radius: 10px;
}

.gateway-cards {
    display: flex;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 25px;
}

.gateway-card {
    position: relative;
    min-width: 110px;
}

.gateway-card-input {
    position: absolute;
    opacity: 0;
}

.gateway-card-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px 15px;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.gateway-card-input:checked + .gateway-card-label {
    border-color: #21445c;
    box-shadow: 0 5px 15px rgba(74, 108, 247, 0.1);
    background-color: #21445c;
}

.gateway-card-logo {
    max-height: 40px;
    margin-bottom: 15px;
    transition: transform 0.3s;
}

.gateway-card-name {
    font-weight: 500;
    text-align: center;
}

.gateway-card-check {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 20px;
    height: 20px;
    background: #538b12;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transform: scale(0.5);
    transition: all 0.3s;
    font-size: 12px;
}

.gateway-card-input:checked + .gateway-card-label .gateway-card-check {
    opacity: 1;
    transform: scale(1);
}

.gateway-card-input:checked + .gateway-card-label .gateway-card-logo {
    transform: scale(1.1);
}
</style>
    <div class="container-fluid default-page">
          @if(auth()->check() && auth()->user()->cpf === '0')
         <div class="alert rock-alert" style="background-color: #e10041;">
                <div class="alert-content-inner d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z" fill="#E9D8A6"></path>
                                <circle cx="18" cy="8" r="4" fill="#E9D8A6"></circle>
                            </svg>
                        </div>
                        <strong>
                         {{__('Para Sacar via PIX, cadastre seu CPF')}}
                        </strong>
                    </div>
                    <div class="alert-btn-groupe">
                     <button class="site-btn radius-12" data-bs-toggle="modal" data-bs-target="#cpfmodal">
                                <i class="anticon anticon-info-circle"></i>{{ __('CLIQUE AQUI PARA CADASTRAR SEU CPF') }}
                            </button>
                    </div>
                </div>
            </div>

            @endif

         <div class="alert rock-alert" style="background-color: #A0522D;">
                <div class="alert-content-inner d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z" fill="#E9D8A6"></path>
                                <circle cx="18" cy="8" r="4" fill="#E9D8A6"></circle>
                            </svg>
                        </div>
                        <strong>
                         {{__('Para Sacar via USDT_BSC, cadastre uma Carteira pertencente a Rede BEP-20. Caso contrário, os valores serão perdidos e não será possível recuperá-los e tão pouco será feito o reembolso. Por favor, verifique atentamente antes de cadastrar sua carteira.')}}
                        </strong>
                    </div>

                </div>
            </div>
        <div class="row gy-30">
            <div class="col-xl-12">
                <div class="rock-edit-withdraw-account-area">
                    <div class="rock-dashboard-card">
                        <div class="rock-dashboard-title-inner">
                            <div class="content">
                                <h3 class="rock-dashboard-tile">{{ __('Add New Withdraw Account') }}</h3>
                            </div>
                            <a class="site-btn gradient-btn radius-12" href="{{ route('user.withdraw.account.index') }}">{{ __('Withdraw Account') }}</a>
                        </div>
                        <div class="rock-edit-withdraw-account-form">
                                <div class="row gy-50">
                                    <div class="colx-xl-12">
                                        <div class="row g-20 selectMethodRow" style="display: flex;flex-direction: column;align-content: space-around;">
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 selectMethodCol">
                                                <div class="rock-single-input">
                                                    <label class="input-label" for="selectMethod">{{ __('Choice Method') }}</label>

                                                    <div class="gateway-cards">
                                                    @foreach($withdrawMethods as $raw)

                                                    <div class="gateway-card">
                                                        <input type="radio" name="withdraw_method_id"
                                                               id="gateway_{{ $raw->tnx }}"
                                                               value="{{ $raw->tnx }}"
                                                               class="gateway-card-input">

                                                        <label for="gateway_{{ $raw->tnx }}" class="gateway-card-label">
                                                            @if($raw->icon)
                                                            <img src="{{ asset('assets/' . $raw->icon) }}" alt="{{ $raw->name }}" class="gateway-card-logo">
                                                            @endif
                                                            <span class="gateway-card-name">{{ $raw->name }}</span>
                                                            <div class="gateway-card-check"><i class="fas fa-check"></i></div>
                                                        </label>
                                                        <div class="fields-data" style="display:none;">
                                                            {{ json_encode(json_decode($raw->fields, true)) }}
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
    </div>
@endsection
@section('script')

<div class="modal fade" id="withdrawMethodModal" tabindex="-1" aria-labelledby="withdrawMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header">
                <h5 class="modal-title text-black" id="withdrawMethodModalLabel">{{__('Método Escolhido')}}: <span id="methodTitle"></span></h5>
            </div>
            <div class="modal-body">
            <form action="{{ route('user.withdraw.account.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="withdraw_method_id" id="withdraw_method_id" >
                    <div class="row" id="methodFieldsContainer">
                    </div>
                <div class="colx-xl-12">
                <div class="rock-input-btn-wrap justify-content-center">
                    <button type="submit" class="site-btn secondary-btn btn-xxl radius-10 mt-3 mb-3">
                        {{ __('Add New Withdraw Account') }}
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4"
                                d="M19 13C19 17.4183 15.4183 21 11 21C6.58172 21 3 17.4183 3 13C3 8.58172 6.58172 5 11 5C15.4183 5 19 8.58172 19 13Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16 3.75C15.5858 3.75 15.25 3.41421 15.25 3C15.25 2.58579 15.5858 2.25 16 2.25H21C21.4142 2.25 21.75 2.58579 21.75 3V8C21.75 8.41421 21.4142 8.75 21 8.75C20.5858 8.75 20.25 8.41421 20.25 8V4.81066L10.5303 14.5303C10.2374 14.8232 9.76256 14.8232 9.46967 14.5303C9.17678 14.2374 9.17678 13.7626 9.46967 13.4697L19.1893 3.75H16Z"
                                fill="white" />
                        </svg>
                    </button>
                </div>
            </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('Cancelar')}}</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let selectedMethod = null;
    const modal = new bootstrap.Modal(document.getElementById('withdrawMethodModal'));
    const gatewayInputs = document.querySelectorAll('.gateway-card-input');
    $('.gateway-card-input').on('change', function() {
        const methodId = $(this).val();
        const card = $(this).closest('.gateway-card');
        const fieldsData = JSON.parse(card.find('.fields-data').text());
        const methodName = card.find('.gateway-card-name').text();
        $('#withdraw_method_id').val(methodId);

        selectedMethod = {
            id: methodId,
            name: methodName,
            fields: fieldsData
        };

        updateModal(methodName, fieldsData);
        modal.show();
    });

    function updateModal(methodName, fields) {
        $('#methodTitle').text(methodName);
        const container = $('#methodFieldsContainer');
        container.empty();

        Object.values(fields).forEach(field => {
            const fieldHtml = createFieldHtml(field);
            container.append(fieldHtml);
        });

        modal._element.addEventListener('hidden.bs.modal', function() {
        gatewayInputs.forEach(input => {
            if (input.checked) {
                input.checked = false;
            }
        });
    });

    $('select.site-nice-select').niceSelect();
    }

function createFieldHtml(field) {
    const label = field.name.replace(/_/g, ' ');
    let fieldHtml = '';

    // Base HTML structure for all field types
    const baseHtml = `
    <div class="col-xxl-12 col-xl-12 col-lg-12 mb-3">
        <div class="rock-single-input">
            <div class="input">
                <label class="input">${label}</label>`;

    // Common hidden fields for type and validation
    const hiddenFields = `

    `;

    if (field.type === 'select') {
        fieldHtml = baseHtml + `
                        <input type="hidden" name="credentials[${field.name}][type]" value="${field.type}">
                <input type="hidden" name="credentials[${field.name}][validation]" value="${field.validation || ''}">
                <div class="input">
                    <select class="site-nice-select" name="credentials[${field.name}][value]"
                        ${field.validation === 'required' ? 'required' : ''}>
                        <option value="">Selecione</option>
                        ${Object.values(field.options).map(opt =>
                            `<option value="${opt.value}">${opt.label}</option>`
                        ).join('')}
                    </select>
                    ${hiddenFields}
                </div>`;
    }
    else if (field.type === 'textarea') {
        fieldHtml = baseHtml + `
                        <input type="hidden" name="credentials[${field.name}][type]" value="${field.type}">
                <input type="hidden" name="credentials[${field.name}][validation]" value="${field.validation || ''}">
                <textarea class="form-control" name="credentials[${field.name}][value]"
                    ${field.validation === 'required' ? 'required' : ''}></textarea>
                ${hiddenFields}`;
    }
    else {
        fieldHtml = baseHtml + `
                        <input type="hidden" name="credentials[${field.name}][type]" value="${field.type}">
                <input type="hidden" name="credentials[${field.name}][validation]" value="${field.validation || ''}">
                <input type="${field.type || 'text'}" class="form-control form-control-lg"
                    name="credentials[${field.name}][value]"
                    ${field.validation === 'required' ? 'required' : ''}>
                ${hiddenFields}`;
    }

    // Close all divs
    fieldHtml += `
            </div>
        </div>
    </div>`;

    return fieldHtml;
}

});
</script>

@if (auth()->check() && auth()->user()->cpf === '0')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.1/jquery.inputmask.min.js"></script>
    <script>
function fecharModal() {
    var modal = bootstrap.Modal.getInstance(document.getElementById('cpfmodal'));
    modal.hide();
    document.getElementById('cpf').value = '';
}
        document.addEventListener('DOMContentLoaded', function () {
        Inputmask({"mask": "999.999.999-99"}).mask(document.getElementById("cpf"));
    });
    </script>

<div class="modal fade" id="cpfmodal" tabindex="-1" aria-hidden="true">>
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="border: #ffffff solid 1px;">
        <div class="modal-header">
          <h5 class="modal-title text-black">{{__('Informe seu CPF')}}</h5>
        </div>
        <div class="modal-body">
          <p class="text-black">Para sua segurança, informe seu CPF.</p>
          <p><span style="color: #ff2626">{{__('Importante: Informe seu CPF verdadeiro, pois os Saques serão pagos somente para Tipo de Chave Pix Cpf e para o mesmo CPF cadastrado aqui!')}}</span></p>
           <form method="POST" action="{{ route('user.setting.atualizar-phone') }}">
            @csrf
           <div class="progress-steps-form">
            <div class="col-xl-12 col-md-12">
            <label for="phone text-black" class="input">{{__('Seu CPF:')}}</label>
                        <div class="input-group">
                          <input type="tel" class="form-control form-control-lg" name="cpf" id="cpf" placeholder="999.999.999-99" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="site-btn secondary-btn btn-xxl radius-10 mt-4 mb-4 w-100">{{__('Salvar Cpf')}}                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4"
                                d="M19 13C19 17.4183 15.4183 21 11 21C6.58172 21 3 17.4183 3 13C3 8.58172 6.58172 5 11 5C15.4183 5 19 8.58172 19 13Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16 3.75C15.5858 3.75 15.25 3.41421 15.25 3C15.25 2.58579 15.5858 2.25 16 2.25H21C21.4142 2.25 21.75 2.58579 21.75 3V8C21.75 8.41421 21.4142 8.75 21 8.75C20.5858 8.75 20.25 8.41421 20.25 8V4.81066L10.5303 14.5303C10.2374 14.8232 9.76256 14.8232 9.46967 14.5303C9.17678 14.2374 9.17678 13.7626 9.46967 13.4697L19.1893 3.75H16Z"
                                fill="white" />
                        </svg></button>
            </form>
           </div>
           <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="fecharModal()">{{__('Cancelar')}}</button>
      </div>
      </div>
  </div>
</div>

@endif
@endsection
