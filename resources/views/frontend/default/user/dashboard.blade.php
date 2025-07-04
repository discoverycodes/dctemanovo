@extends('frontend::layouts.user')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('content')

    <div class="desktop-screen-show">
        {{--Referral and Ranking --}}
        @include('frontend::user.include.__referral_ranking')

        {{-- User Card--}}
        @include('frontend::user.include.__user_card')

        {{--Recent Transactions--}}
        @include('frontend::user.include.__recent_transaction')
    </div>

    {{--for mobile--}}
    <div class="mobile-screen-show">
        @include('frontend::user.mobile_screen_include.dashboard.__index')
    </div>

@endsection
@section('script')
    <script>
        function copyRef() {
            /* Get the text field */
            var textToCopy = $('#refLink').val();
            // Create a temporary input element
            var tempInput = $('<input>');
            $('body').append(tempInput);
            tempInput.val(textToCopy).select();
            // Copy the text from the temporary input
            document.execCommand('copy');
            // Remove the temporary input element
            tempInput.remove();
            $('#copy').text('Copiado');
            var copyApi = document.getElementById("refLink");
            /* Select the text field */
            copyApi.select();
            copyApi.setSelectionRange(0, 999999999); /* For mobile devices */
            /* Copy the text inside the text field */
            document.execCommand('copy');
            $('#copy').text('Copiado')

        }
        function copyRefmob() {
            const textToCopy = document.getElementById('refLinkmob').value;

            if (navigator.clipboard) {
                navigator.clipboard.writeText(textToCopy).then(function () {
                    document.getElementById('copymob').innerText = 'Copiado!';
                }, function (err) {
                    console.error('Erro ao copiar: ', err);
                });
                setTimeout(() => {
            document.getElementById('copymob').innerText = 'Copiar';
        }, 3000);
            } else {
                // Fallback para navegadores antigos
                const tempInput = document.createElement('input');
                tempInput.style.position = 'absolute';
                tempInput.style.left = '-9999px';
                tempInput.value = textToCopy;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                document.getElementById('copymob').innerText = 'Copiado!';
            }
        }

        // Load More
        $('.moreless-button').click(function () {
            $('.moretext').slideToggle();
            if ($('.moreless-button').text() == "Load more") {
                $(this).text("Load less")
            } else {
                $(this).text("Load more")
            }
        });

        $('.moreless-button-2').click(function () {
            $('.moretext-2').slideToggle();
            if ($('.moreless-button-2').text() == "Load more") {
                $(this).text("Load less")
            } else {
                $(this).text("Load more")
            }
        });
    </script>
@endsection
