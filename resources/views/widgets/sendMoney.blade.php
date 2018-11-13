<div class="billing-method">
    {{--@if(!$isMyself)--}}
    {{--{{Form::open(array('action' => ['PaymentController@sendMoney', Auth::user()->id], 'method'=>'post', 'files' => true))}}--}}
    {{--<ul>--}}
    {{--<li>--}}
    {{--<h2>Send Money:</h2><br>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<h2>Receiver Id:<span>&nbsp;&nbsp;</span></h2><br>--}}
    {{--<input type="text" name="receiver_id" value="{{$person->id}}">--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<h2>Total Money<span>&nbsp;&nbsp;</span></h2><br>--}}
    {{--<input type="text" name="amount" value="0">--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<input type="submit" class="btn btn-success" name="sendMoneyBtn"--}}
    {{--value="Send Money">--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--{{Form::close()}}--}}

    {{--<br><br>--}}

    <table class="table">
        <tr>
            <td>Receiver Name:</td>
            <td>Amount:</td>
        </tr>
        <tr>
            <td>
                <div class="input-group">
                    <input type="text" class="form-control" size="20" placeholder="Enter name here" id="receiverName">
                    <div class="input-group-btn">
                        <button class="btn btn-default" id="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div
                {{--<input type="text" id="receiverName" size="25">--}}
            </td>
            <td>
                <input type="number" class="form-control" id="amount" size="10" min="0", step="0.001" placeholder="Enter amount">
                {{--<input type="text" id="amount" size="10">--}}
            </td>
        </tr>
    </table>

    <table class="table table-hover">
        {{--<thead>--}}
        {{--<tr>--}}
            {{--<th scope="col">#</th>--}}
            {{--<th scope="col">First</th>--}}
            {{--<th scope="col">Last</th>--}}
            {{--<th scope="col">Handle</th>--}}
        {{--</tr>--}}
        {{--</thead>--}}
        <tbody id="userResults">

        </tbody>
    </table>


    {{--@endif--}}
</div><!--billing-method end-->

<script>
    function buildForm(index, user) {
        var ret =  "<tr><td><table><tr> <form action=\"{{Route('sendMoney')}}\" method=\"post\">" +
                "<input type=\"hidden\" name=\"receiver_id\" value=\""+ user.id +"\" >" +
                "<td scope=\"row\">" +
                    " <img src=\"" + user.profile_pic_path + "\" style='width: 50px;height: 50px;object-fit: cover; border-radius: 100px'>" +
                "</td> " +
                "<td>" + user.name + "<br><span class='small' style='color: darkslategray;'>" + user.info.info + "<span></td> " +
                "<td>" +
                "<input type=\"number\" style=\"line-height:2em;width:4em\" placeholder=\"Amount\" value=\""+$('#amount').val()+"\" >"+
                "</td> " +
                "<td>" +
                "<button class=\"btn btn-success\" type=\"submit\">Send</button>"+
                "</td>" +
            "</form> </tr></table></td></tr>";
        // alert(ret);
        return ret;
    }

    $(document).ready(function () {
        $('#searchButton').click(function () {
            var name = $('#receiverName').val();
            if (name === "") return;

            $.get('userByName/' + name, function (data) {
                data = JSON.parse(data);
                $('#userResults').html("");
                var token = '{{ csrf_field() }}';
                $.each(data, function (index, user) {
                    // var htmlData = buildForm(index, user);
                    // $('#userResults').append(htmlData);
                    //////////////////////////////////////////////////////////////

                    $("#userResults").append(
                        // Creating Form Div and Adding <h2> and <p> Paragraph Tag in it.
                        $('<tr/>').append(
                            $('<td/>').append(
                                //////////
                                $("<form/>", {
                                    action: '{{Route('sendMoney')}}',
                                    method: 'post'
                                }).append(
                                    token,
                                    $("<input/>", {
                                        type: 'hidden',
                                        name: 'receiver_id',
                                        value: ''+user.id
                                    }),
                                    $("<table/>").append(
                                        $("<tr/>").append(
                                            $("<td/>").append(
                                                $("<img/>", {
                                                    src: user.profile_pic_path,
                                                    style: 'width: 50px;height: 50px;object-fit: cover; border-radius: 100px'
                                                })
                                            ),
                                            $("<td/>").append(
                                                user.name + "<br><span class='small' style='color: darkslategray;'>" + user.info.info + "</span>"
                                            ),
                                            $("<td/>").append(
                                                $("<input/>", {
                                                    type: 'number',
                                                    step: '0.001',
                                                    min: '0',
                                                    name: 'amount',
                                                    style: 'line-height:2em;width:6em;',
                                                    placeholder: 'Amount',
                                                    value: $('#amount').val()
                                                })
                                            ),
                                            $("<td/>").append(
                                                $("<button/>", {
                                                    class: 'btn btn-success',
                                                    type: 'submit'
                                                }).text('Send')
                                            )
                                        )
                                    )
                                )

                                /////////
                            )
                        )

                    )

                    //////////////////////////////////////////////////////////////
                });

            });
        })
    });
</script>
