<div class="panel-header">
    <div class="logo">
        <a href="{{route('home')}}">
            <img class="logo-unfold" src="{{ asset(setting('site_logo','global')) }}" alt="Logo"/>
            <img class="logo-unfold-dark" src="{{ asset(setting('site_logo_dark','global')) }}" alt="Logo"/>
        </a>
    </div>
    <div class="nav-wrap">
        <div class="nav-left">
            <button class="sidebar-toggle">
                <i class="anticon anticon-arrow-left"></i>
            </button>
            <div class="mob-logo">
                <a href="{{route('home')}}">
                    <img src="{{ asset(setting('site_favicon','global')) }}" alt="Site Name"/>
                </a>
            </div>
        </div>
        <div class="nav-right">
            <div class="single-nav-right">
                 <div class="single-right">
                    <a  href="https://chat.whatsapp.com/BnOkqiK3hF23F6Wb3gqWkt" target="blank"
                            type="button"
                            class="btn"
                    style="background: #017536;color: white;line-height: 1.1;">
                        <i class="fa-brands fa-whatsapp"></i> Grupo Oficial
                    </a>
                </div>
                <div class="single-right">
                    <div class="color-switcher">
                        <i icon-name="moon" class="dark-icon" data-mode="dark"></i>
                        <i icon-name="sun" class="light-icon" data-mode="light"></i>
                    </div>
                </div>

                {{--  Push Notificataion--}}
                @auth
                    @php
                        $userId = auth()->id();
                        $notifications = App\Models\Notification::where('for','user')->where('user_id', $userId)->latest()->take(10)->get();
                        $totalUnread = App\Models\Notification::where('for','user')->where('user_id', $userId)->where('read', 0)->count();
                        $totalCount = App\Models\Notification::where('for','user')->where('user_id', $userId)->get()->count();
                    @endphp
                    <div class="single-nav-right user-notifications{{ $userId }}">
                        @include('global.__notification_data',['notifications'=>$notifications,'totalUnread'=>$totalUnread,'totalCount'=>$totalCount])
                    </div>
                @endauth
                {{-- End Push Notificataion--}}
                <div class="single-right">
                    <button type="button" class="item" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="anticon anticon-user"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="{{ route('user.setting.show') }}" class="dropdown-item" type="button"><i class="anticon anticon-setting"></i>Configurações</a>
                        </li>
                        <li>
                            <a href="{{ route('user.change.password') }}" class="dropdown-item" type="button">
                                <i class="anticon anticon-lock"></i>Alterar Senha
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.ticket.index') }}" class="dropdown-item" type="button">
                                <i class="anticon anticon-customer-service"></i>Suporte
                            </a>
                        </li>
                        <li class="logout">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                               @csrf
                               <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); localStorage.clear();  $('#logout-form').submit();">
                                   <i class="anticon anticon-logout"></i>Sair</a>
                            </form>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        // Color Switcher
        $(".color-switcher").on('click', function () {
            "use strict"
            $("body").toggleClass("dark-theme");
            var url = '{{ route("mode-theme") }}';
            $.get(url)
        });
    </script>
@endpush
