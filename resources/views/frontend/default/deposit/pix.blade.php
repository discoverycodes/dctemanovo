@extends('frontend::layouts.user')
@section('title')
    {{ __('Deposit Now') }}
@endsection
@section('content')
 <style type="text/css">
      #progressBar {
            width: 90%;
            margin: 10px auto;
            height: 22px;
            background-color: #B8C3C3;
            border-radius: 8px;
      }

      #progressBar div {
            height: 100%;
            text-align: center;
            width: 0;
            background-color: #E91E63;
            box-sizing: border-box;
            border-radius: 8px;
      }
</style>
<div class="container-fluid default-page">
        <div class="row gy-30">
            <div class="col-xl-12">
                <div class="site-card">
                    <div class="site-card-header">
                    <h3 class="title">{{ __('Pagamento via Pix') }}</h3>
                </div>
                    <div class="site-card-body">

<div class="card card-style overflow-visible" style="background-color: #ffe4c400 !important;!i;!;">
    <div class="content mx-auto mb-3">
				<div class="d-flex ">
					<div style="min-width: 150px;">

						<h6 class="rock-dashboard-tile">Atualizando... </h6>
					</div>
					<div class="align-self-end ms-auto">
						<h6 class="rock-dashboard-tile" id='timer'></h6>
					</div>
				</div>
				<div id="progressBar" class="progress rounded-xs bg-theme border border-green-light" style="height:15px">
					<div class="progress gradient-green text-start ps-3 font-600 font-10" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
				</div>

			</div>

           <img src="data:image/png;base64,{{ $qrcode }}" alt="img" width="360" class="mx-auto  mt-n5 shadow-l" style="border-radius: 10px;">
           <h2 class="rock-dashboard-tile text-center pt-3 mb-3">Escaneie o QrCode Acima</h2>

          <div class="form-custom form-label form-icon mb-3 mx-auto">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mx-auto">
            <div class="referral-link">
                        <div class="referral-link-form" style="">
                            <input type="text" value="{{ $copiaecola }}" id="copyURL">
                            <button type="submit" onclick="COPIA()" style="min-width: 175px;">
                                <span id="copyBoardcopyURL"><i class="fas fa-copy fs-16"></i>&nbsp;Ou Copie o Código</span>
                            </button>
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
<script>
      function progress(timeleft, timetotal, $element) {
            var progressBarWidth = timeleft * $element.width() / timetotal;
            $element.find('div.progress').animate({
                  width: progressBarWidth
            }, timeleft == timetotal ? 0 : 1000, "linear");
            if (timeleft > 0) {
                  setTimeout(function() {
                        progress(timeleft - 1, timetotal, $element);
                  }, 1000);
            } else {
                  window.location.reload();
            }
            var date = new Date(null);
            date.setSeconds(timeleft);
            var timeString = date.toISOString().substr(11, 8);
            var newtimeleft = timeString
            $('#timer').text(newtimeleft)
      };
      progress(30, 30, $('#progressBar'));
</script>

<script>
        function COPIA() {
            const textToCopy = document.getElementById('copyURL').value;

            if (navigator.clipboard) {
                navigator.clipboard.writeText(textToCopy).then(function () {
                    document.getElementById('copyBoardcopyURL').innerHTML = '<i class="fas fa-check fs-16"></i>&nbsp;Código Copiado';
                }, function (err) {
                    console.error('Erro ao copiar: ', err);
                });
                setTimeout(() => {
            document.getElementById('copyBoardcopyURL').innerHTML = '<i class="fas fa-copy fs-16"></i>&nbsp;Ou Copie o Código';
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
                document.getElementById('copyBoardcopyURL').innerHTML = '<i class="fas fa-check fs-16"></i>&nbsp;Código Copiado';
            }
        }

</script>

 @endsection