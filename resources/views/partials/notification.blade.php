<div style="position:relative; display:inline-block; margin-left:15px;">

    <button onclick="toggleNotif()"
        style="
        background:#ff9ec7;
        border:none;
        padding:10px 15px;
        border-radius:12px;
        cursor:pointer;
        font-size:16px;
        position:relative;
        ">

        🔔

        @if($notifCount > 0)
        <span style="
            position:absolute;
            top:-5px;
            right:-5px;
            background:red;
            color:white;
            font-size:10px;
            padding:3px 6px;
            border-radius:50%;
        ">
            {{ $notifCount }}
        </span>
        @endif

    </button>

    <div id="notifBox"
    style="
    display:none;
    position:absolute;
    right:0;
    top:50px;
    width:320px;
    background:white;
    border-radius:15px;
    box-shadow:0 10px 20px rgba(0,0,0,0.2);
    max-height:400px;
    overflow-y:auto;
    z-index:999;
    ">

    <h4 style="padding:12px; margin:0; border-bottom:1px solid #eee;">
        🔔 Notifications
    </h4>

    @forelse($notifications as $n)

    @if($n->is_read == false)

        @if($n->type == 'message')

            <a href="{{ url('/notification/read/' . $n->id) }}"
               style="display:block;padding:12px;text-decoration:none;color:black;">
                💬 <b>{{ $n->name }}</b> sent you a message
            </a>

        @elseif($n->type == 'friend_request')

            <div style="padding:12px;">

                👤 <b>{{ $n->name }}</b> sent you friend request

                <div style="margin-top:10px; display:flex; gap:10px;">

                    <a href="{{ url('/friend/accept/' . $n->from_user_id) }}"
                       style="background:green;color:white;padding:6px 10px;border-radius:10px;text-decoration:none;">
                        Accept
                    </a>

                    <a href="{{ url('/friend/reject/' . $n->from_user_id) }}"
                       style="background:red;color:white;padding:6px 10px;border-radius:10px;text-decoration:none;">
                        Reject
                    </a>

                </div>

            </div>

        @endif

    @endif

    @empty

        <p style="padding:10px;">
            No notifications 🌸
        </p>

    @endforelse

    </div>

</div>

<script>

function toggleNotif() {

    let box = document.getElementById('notifBox');

    if (box.style.display === 'none') {
        box.style.display = 'block';
    } else {
        box.style.display = 'none';
    }

}

document.addEventListener('click', function(event) {

    let box = document.getElementById('notifBox');

    if (!event.target.closest('#notifBox') &&
        !event.target.closest('button')) {

        box.style.display = 'none';
    }

});

</script>