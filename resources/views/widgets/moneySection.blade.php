<li id="money-info">
    <small class="text-muted" style="font-size: 12px;">Account Balance:</small>
    <h1>{{$person->info->balance}}$</h1>
    <div id="money-btn-group">
        <a href="{{Route('sendMoney')}}" class="btn btn-light" style="margin-bottom: 7px;">Send Money</a><br>
        <a href="{{Route('deposit')}}" class="btn btn-primary" style="font-size: 12px; margin-right: 5px">Deposit</a>
        <a href="{{Route('withdraw')}}" class="btn btn-primary" style="font-size: 12px; margin-left: 5px">Withdraw</a>
    </div>

</li>
