<div class="comment-send-area" >
    <form method="post" action="{{Route('messages.store')}}">
        @csrf
        <div class="mf-field" style="padding: 10px;">
            {{--<input type="hidden" name="receiver_id" value="{{$aeSender->id}}">--}}
            <input type="text" style="width: auto; width: 78%;" name="content" placeholder="Type a comment here" required>
            <button type="submit" class="btn btn-sm" style="font-size: 12px">Comment</button>
        </div>
    </form>
</div>
