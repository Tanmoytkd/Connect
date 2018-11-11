@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
    $senders = $user->getSenderList(3);

    foreach ($senders as $sender) {
        $msg = $user->getLastMessage($sender->id)->content;
        if(strlen($msg)>30) {
            $msg = trim(substr($msg, 0, 30)).'...';
        }
        $currentMessage = $user->getLastMessage($sender->id);
        if($currentMessage->seen_status==0 && $currentMessage->sender_id!=$user->id) {
            $msg = '<b style="color: darkslategrey;">'.$msg.'</b>';
        }
        $name = $sender->name;
        $profile_pic = asset($sender->info->profile_pic_path);

        echo
            '<a href="'.Route('messages.show', [strval($sender->id)]).'">
                <div class="notfication-details">
                <div class="noty-user-img">
                    <img src="'. $profile_pic .'" alt="">
                </div>
                    <div class="notification-info">
                        <h3 style="font-weight:bold;font-size:17px">'. $name .' </h3>
                        <p>'. $msg .'</p>
                        <span></span>
                    </div>
                </div>
            </a>';
    }


@endphp
