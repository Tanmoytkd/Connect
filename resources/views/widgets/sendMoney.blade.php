<div class="billing-method">
    {{--@if(!$isMyself)--}}
    {{Form::open(array('action' => ['PaymentController@sendMoney', Auth::user()->id], 'method'=>'post', 'files' => true))}}
    <ul>
        <li>
            <h2>Send Money:</h2><br>
        </li>
        <li>
            <h2>Receiver Id:<span>&nbsp;&nbsp;</span></h2><br>
            <input type="text" name="receiver_id" value="{{$person->id}}">
        </li>
        <li>
            <h2>Total Money<span>&nbsp;&nbsp;</span></h2><br>
            <input type="text" name="amount" value="0">
        </li>
        <li>
            <input type="submit" class="btn btn-success" name="sendMoneyBtn"
                   value="Send Money">
        </li>
    </ul>
    {{Form::close()}}
    {{--@endif--}}
</div><!--billing-method end-->
