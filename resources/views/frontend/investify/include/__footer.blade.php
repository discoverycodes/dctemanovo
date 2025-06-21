@php
$footerContent =
json_decode(\App\Models\LandingPage::where('locale',app()->getLocale())->where('status',true)->where('code','footer')->first()->data,true);
@endphp

<!-- Footer area start -->
<footer>
    <div class="footer-section rock-footer p-relative z-11 section-space-top">
        <div class="footer-pattern"
            data-background="{{ asset('assets/frontend/theme_base/hardrock/images/bg/footer-pattern.png') }}">
        </div>
        <div class="container">
            <div class="footer-intro-area">
                <div class="footer-intro-main">
                    <div class="footer-intro-log">
                        <img src="{{ asset(setting('site_logo','global')) }}" alt="logo not found">
                    </div>
                    <div class="footer-intro-content">
                        <h4 class="text-white mb-2">{{ $footerContent['widget_left_title'] }}</h4>
                        <p class="description">
                            {{ $footerContent['widget_left_description'] }}
                        </p>
                    </div>
                </div>
            </div>
        
            <div class="rock-footer-bottom">
                <div class="rock-footer-copyright">
                    <p class="description">{{ $footerContent['copyright_text'] }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer area end -->