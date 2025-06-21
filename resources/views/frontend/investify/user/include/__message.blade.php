<div class="col-xxl-12">
    <!-- Show desktop-screen content -->
    @foreach ($messages as $message)
        <div class="rock-desktop-screen-show">
            <div class="alert rock-alert fade show customAlert" role="alert">
                <div class="alert-content-inner d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                    d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z"
                                    fill="#E9D8A6" />
                                <circle cx="18" cy="8" r="4" fill="#E9D8A6" />
                            </svg>
                        </div>
                        <strong>
                            {{ $message->notice }}
                        </strong>
                    </div>
                    <div class="alert-btn-groupe">
                        <a class="site-btn btn-xxs gradient-btn radius-10"
                            href="{{ route('user.read-notification', $message->id) }}">
                            {{ __('Mark as read') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Show mobile-screen content -->
    @foreach ($messages as $message)
        <div class="rock-mobile-screen-show">
            <div class="alert rock-alert-mobile mb-0 fade show customAlert" role="alert">
                <div class="alert-content-inner">
                    <div class="alert-content">
                        <div class="icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                    d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z"
                                    fill="#E9D8A6" />
                                <circle cx="18" cy="8" r="4" fill="#E9D8A6" />
                            </svg>
                        </div>
                        <strong>
                            {{ $message->notice }}
                        </strong>
                    </div>
                    <div class="alert-btn-groupe">
                        <a class="site-btn btn-xxs gradient-btn radius-10"
                            href="{{ route('user.read-notification', $message->id) }}">
                            {{ __('Mark as read') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
