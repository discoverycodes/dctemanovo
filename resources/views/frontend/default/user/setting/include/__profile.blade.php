<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="site-card">
            <div class="site-card-header">
                <h3 class="title">{{ __('Profile Settings') }}</h3>
            </div>
            <div class="site-card-body">
                <form action="{{ route('user.setting.profile-update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="mb-3">
                                <div class="body-title">{{ __('Avatar:') }}</div>
                                <div class="wrap-custom-file">
                                    <input
                                        type="file"
                                        name="avatar"
                                        id="avatar"
                                        accept=".gif, .jpg, .png"
                                    />


                                    <label for="avatar"
                                           @if($user->avatar && file_exists('assets/'.$user->avatar)) class="file-ok"
                                           style="background-image: url(/assets/{{ $user->avatar }})" @endif>
                                        <img
                                            class="upload-icon"
                                            src="{{ asset('assets/global/materials/upload.svg') }}"
                                            alt=""
                                        />
                                        <span>{{ __('Update Avatar') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress-steps-form">
                        <div class="row">
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">{{ __('First Name') }}</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="first_name"
                                        value="{{ $user->first_name }}"
                                        placeholder="First Name"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">{{ __('Last Name') }}</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="last_name"
                                        value="{{ $user->last_name }}"
                                        placeholder="Last Name"
                                    />
                                </div>
                            </div>
                            @if($user->cpf != '0')
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">{{ __('CPF') }}</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        value="{{ $user->cpf }}"
                                        disabled
                                    />
                                </div>
                            </div>
                            @endif

                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1"
                                       class="form-label">{{ __('Date of Birth') }}</label>
                                <div class="input-group">
                                    <input
                                        type="date"
                                        name="date_of_birth"
                                        class="form-control"
                                        value="{{ $user->date_of_birth }}"
                                        placeholder="Data de Nascimento"
                                    />
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1"
                                       class="form-label">{{ __('Email Address') }}</label>
                                <div class="input-group">
                                    <input type="email" disabled class="form-control disabled"
                                           value="{{ $user->email }}" placeholder="Email Address"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">{{ __('Phone') }}</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="phone"
                                        value="{{ $user->phone }}"
                                        placeholder="Phone"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">{{ __('Country') }}</label
                                >
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control disabled"
                                        value="{{ $user->country }}"
                                        placeholder="{{ __('Country') }}"
                                        disabled
                                    />
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">{{ __('City') }}</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="city"
                                        value="{{ $user->city }}"
                                        placeholder="{{ __('City') }}"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">{{ __('Zip') }}</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="zip_code"
                                        value="{{ $user->zip_code }}"
                                        placeholder="{{ __('Zip') }}"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">{{ __('Address') }}</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="address"
                                        value="{{ $user->address }}"
                                        placeholder="{{ __('Address') }}"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1"
                                       class="form-label">{{ __('Joining Date') }}</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control disabled"
                                        value="{{ carbonInstance($user->created_at)->toDayDateTimeString() }}"
                                        placeholder="{{ __('Joining Date') }}"
                                        disabled
                                    />
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <button type="submit" class="site-btn blue-btn">{{ __('Save Changes') }}</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
