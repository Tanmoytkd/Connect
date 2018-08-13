@extends('layouts.main')

@section('title')Messages @endsection

@section('content')

    @php
        $user = Auth::user();
        use App\User;
        use Carbon\Carbon;
    @endphp

    <section class="messages-page">
        <div class="container">
            <div class="messages-sec">
                <div class="row">
                    <div class="col-lg-4 col-md-12 no-pdd">
                        <div class="msgs-list">
                            <div class="msg-title">
                                <h3>Messages</h3>
                                <ul>
                                    <li><a href="#" title=""><i class="fa fa-cog"></i></a></li>
                                    <li><a href="#" title=""><i class="fa fa-ellipsis-v"></i></a></li>
                                </ul>
                            </div><!--msg-title end-->
                            <div class="messages-list">
                                <ul>
                                    @php


                                        $activeSender = User::find($userId);
                                        $msg =  $user->getLastMessage($activeSender->id);
                                        $msgContent = $msg->content;
                                        if(strlen($msgContent)>40) {
                                            $msgContent = trim(substr($msgContent, 0, 20)).'...';
                                        }
                                        $name = $activeSender->name;
                                        $profile_pic = asset($activeSender->info->profile_pic_path);
                                        $timeText = Carbon::parse($msg->created_at);

                                        echo
                                        '<li class="active">
                                            <a href="'.Route('messages.show', [strval($activeSender->id)]).'">
                                                <div class="usr-msg-details">
                                                    <div class="usr-ms-img">
                                                        <img src="'.asset($profile_pic).'" alt="">
                                                        <!--<span class="msg-status"></span>-->
                                                    </div>
                                                    <div class="usr-mg-info">
                                                        <h3>'.$name.'</h3>
                                                        <p>'. $msgContent .'</p>
                                                    </div><!--usr-mg-info end-->
                                                    <!--<span class="posted_time">'.$timeText.'</span> -->
                                                    <!-- <span class="msg-notifc">1</span> -->

                                                </div>
                                            </a><!--usr-msg-details end-->
                                        </li>';

                                    $senders = $user->getSenderList();


                                    foreach ($senders as $sender) {
                                        if($sender->id==$activeSender->id) continue;
                                        $msg =  $user->getLastMessage($sender->id);
                                        $msgContent = $msg->content;
                                        if(strlen($msgContent)>40) {
                                            $msgContent = trim(substr($msgContent, 0, 20)).'...';
                                        }
                                        if($msg->seen_status==0 && $msg->sender_id!=$user->id) {
                                            $msgContent = '<b style="color: darkslategrey; font-weight:bold">'.$msgContent.'</b>';
                                        }
                                        $name = $sender->name;
                                        $profile_pic = asset($sender->info->profile_pic_path);

                                         echo
                                        '<li>
                                            <a href="'.Route('messages.show', [strval($sender->id)]).'">
                                                <div class="usr-msg-details">
                                                    <div class="usr-ms-img">
                                                        <img src="'.asset($profile_pic).'" alt="">
                                                        <!--<span class="msg-status"></span>-->
                                                    </div>
                                                    <div class="usr-mg-info">
                                                        <h3>'.$name.'</h3>
                                                        <p>'. $msgContent .'</p>
                                                    </div><!--usr-mg-info end-->
                                                    <!--<span class="posted_time">'.$timeText.'</span> -->
                                                    <!-- <span class="msg-notifc">1</span> -->
                                                </div><!--usr-msg-details end-->
                                            </a>
                                        </li>';
                                    }

                                    //resetting name and profile pic and name to active sender
                                    $name = $activeSender->name;
                                    $profile_pic = asset($activeSender->info->profile_pic_path);

                                    @endphp
                                </ul>
                            </div><!--messages-list end-->
                        </div><!--msgs-list end-->
                    </div>
                    <div class="col-lg-8 col-md-12 pd-right-none pd-left-none">
                        <div class="main-conversation-box">
                            <div class="message-bar-head">
                                <div class="usr-msg-details">
                                    <div class="usr-ms-img">
                                        <img src="{{$profile_pic}}" alt="">
                                    </div>
                                    <div class="usr-mg-info">
                                        <h3>&nbsp</h3>
                                        <h3>{{$name}}</h3>
                                        {{--<p>Online</p>--}}
                                    </div><!--usr-mg-info end-->
                                </div>
                                <a href="#" title=""><i class="fa fa-ellipsis-v"></i></a>
                            </div><!--message-bar-head end-->
                            <div class="message-line" id="message-line" tabindex="0">
                                <div class="spacer">
                                    &nbsp;
                                </div>
                                <div class="spacer">
                                    &nbsp;
                                </div>

                                @php
                                    $activeMessages = $user->getMessages($activeSender->id);

                                    foreach ($activeMessages as $currentMessage) {
                                        if($currentMessage->seen_status==0 && $currentMessage->sender_id!=$user->id) {
                                            $currentMessage->seen_status = 1;
                                            $currentMessage->save();
                                        }

                                        if($currentMessage->sender_id!=$user->id) {
                                            echo '<div class="main-message-box st3">
                                                    <div class="message-dt st3">
                                                        <div class="message-inner-dt">
                                                            <p>'.$currentMessage->content.'</p>
                                                        </div><!--message-inner-dt end-->
                                                        <span>'.$currentMessage->created_at->diffForHumans().'</span>
                                                    </div><!--message-dt end-->
                                                    <div class="messg-usr-img">
                                                        <img src="'.asset($activeSender->info->profile_pic_path).'" alt="" class="mCS_img_loaded">
                                                    </div><!--messg-usr-img end-->
                                                </div><!--main-message-box end-->';
                                        } else {
                                            echo
                                            '<div class="main-message-box ta-right">
                                                <div class="message-dt" style="float:right;">
                                                    <div class="message-inner-dt">
                                                        <p>'.$currentMessage->content.'</p>
                                                    </div><!--message-inner-dt end-->
                                                    <span>'.$currentMessage->created_at->diffForHumans().'</span>
                                                </div><!--message-dt end-->
                                                <div class="messg-usr-img">
                                                    <img src="'.asset($user->info->profile_pic_path).'" alt="" class="mCS_img_loaded">
                                                </div><!--messg-usr-img end-->
                                            </div>';
                                        }
                                    }
                                @endphp

                                <div class="spacer" style="float:left;widows: 100%;">
                                    &nbsp;
                                </div>
                                <div class="spacer" style="float:left;width: 100%;">
                                    &nbsp;
                                </div>
                            </div><!--messages-line end-->
                            <div class="message-send-area">
                                <form method="post" action="{{Route('messages.store')}}">
                                    @csrf
                                    <div class="mf-field">
                                        <input type="hidden" name="receiver_id" value="{{$activeSender->id}}">
                                        <input type="text" name="content" placeholder="Type a message here" required>
                                        <button type="submit">Send</button>
                                    </div>
                                </form>
                            </div><!--message-send-area end-->
                        </div><!--main-conversation-box end-->
                    </div>
                </div>
            </div><!--messages-sec end-->
        </div>
    </section>

    @parent
@endsection
