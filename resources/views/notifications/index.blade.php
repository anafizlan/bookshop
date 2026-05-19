<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
</head>
<body>

<h1>🔔 Notifications</h1>

@forelse($notifications as $n)

    @if($n->type == 'message')

        <a href="{{ url('/notification/read/' . $n->id) }}"
           style="display:block;padding:12px;text-decoration:none;color:black;border-bottom:1px solid #eee;">
            💬 <b>{{ $n->name }}</b> sent you a message
        </a>

    @elseif($n->type == 'friend_request')

        <div style="padding:12px;border-bottom:1px solid #eee;">

            👤 <b>{{ $n->name }}</b> sent you friend request

            <div style="margin-top:10px;display:flex;gap:10px;">

                <a href="{{ url('/friend/accept/' . $n->from_user_id) }}"
                   style="background:green;color:white;padding:6px 10px;border-radius:10px;">
                    Accept
                </a>

                <a href="{{ url('/friend/reject/' . $n->from_user_id) }}"
                   style="background:red;color:white;padding:6px 10px;border-radius:10px;">
                    Reject
                </a>

            </div>

        </div>

    @endif

@empty

    <p style="padding:10px;text-align:center;">
        No notifications 🌸
    </p>

@endforelse

</body>
</html>