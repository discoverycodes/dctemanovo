<div class="row user-cards ">

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
            <div class="icon"><i class="anticon anticon-file-add"></i></div>
            <div class="content">
                <h4><b>{{ $currencySymbol }}</b><span class="count">{{ $dataCount['total_deposit'] }}</span></h4>
                <p>{{ __('Total Deposit') }}</p>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
            <div class="icon"><i class="anticon anticon-check-square"></i></div>
            <div class="content">
                <h4><b>{{ $currencySymbol }}</b><span class="count">{{ $dataCount['total_investment'] }}</span></h4>
                <p>{{ __('Total Investment') }}</p>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
            <div class="icon"><i class="anticon anticon-credit-card"></i></div>
            <div class="content">
                <h4><b>{{ $currencySymbol }}</b><span class="count">{{ $dataCount['total_profit'] }}</span></h4>
                <p>{{ __('Total Profit') }}</p>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
            <div class="icon"><i class="anticon anticon-money-collect"></i></div>
            <div class="content">
                <h4><b>{{ $currencySymbol }}</b><span class="count">{{ $dataCount['total_withdraw'] }}</span></h4>
                <p>{{ __('Total Withdraw') }}</p>
            </div>
        </div>
    </div>

</div>
