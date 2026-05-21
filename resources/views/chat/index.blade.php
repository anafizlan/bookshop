<!DOCTYPE html>
<html>

<head>

    <title>Chat</title>

    <link href="https://fonts.googleapis.com/css2?family=Sofia&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Sofia', cursive;
            background: linear-gradient(135deg, #ffe0f0, #d9fff2);
            padding: 30px;
        }

        .chat-box {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 25px;
            padding: 25px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .messages {
            height: 500px;
            overflow-y: auto;
            padding: 20px;
            background: #fff8fb;
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .message {
            padding: 12px 18px;
            border-radius: 20px;
            margin: 10px 0;
            width: fit-content;
            max-width: 70%;
        }

        .mine {
            background: #7de3a8;
            margin-left: auto;
        }

        .theirs {
            background: #ffb6d9;
        }

        textarea {
            width: 100%;
            padding: 15px;
            border-radius: 15px;
            border: none;
            background: #f5f5f5;
            resize: none;
            font-family: 'Sofia', cursive;
        }

        button {
            margin-top: 15px;
            background: #ff9ec7;
            border: none;
            padding: 12px 25px;
            border-radius: 15px;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background: #ff7eb5;
        }
    </style>

</head>

<body>

    <a href="{{ route('home') }}" style="
        position: absolute;
        top: 20px;
        left: 20px;
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: white;
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        text-decoration: none;
        color: #ff4d6d;
        font-size: 20px;
   ">
        🏠
    </a>
    <div class="chat-box">

        <h1>
            💬 Chat with {{ $friend->name }}
        </h1>

        <hr>

        <div class="messages" id="messages">

            @foreach ($messages as $msg)
                <div class="message
                {{ $msg->sender_id == Auth::id() ? 'mine' : 'theirs' }}">

                    {{ $msg->message }}

                    <br>

                    <small style="
                    font-size:11px;
                    opacity:0.6;
                ">

                        {{ \Carbon\Carbon::parse($msg->created_at)->format('h:i A') }}

                    </small>

                </div>
            @endforeach

        </div>

        <form method="POST" action="{{ url('/chat/' . $friend->id) }}">

            @csrf

            <textarea name="message" rows="3" placeholder="Type your message..." style= "width: 93%;"></textarea>

            <button type="submit">

                Send 🌸

            </button>

        </form>

    </div>

<script>

function loadMessages() {

    fetch('/chat/messages/{{ $friend->id }}')
    .then(response => response.json())
    .then(data => {

        let html = '';

        data.forEach(msg => {

            let mine = msg.sender_id == {{ Auth::id() }}
                ? 'mine'
                : 'theirs';

            html += `
                <div class="message ${mine}">
                    ${msg.message}
                    <br>

                    <small style="
                        font-size:11px;
                        opacity:0.6;
                    ">
                        ${new Date(msg.created_at)
                            .toLocaleTimeString([], {
                                hour: '2-digit',
                                minute:'2-digit'
                            })}
                    </small>
                </div>
            `;
        });

        document.getElementById('messages').innerHTML = html;

        // auto scroll bawah
        let box = document.getElementById('messages');
        box.scrollTop = box.scrollHeight;

    });

}

// refresh every 2 sec
setInterval(loadMessages, 2000);

</script>

</body>

</html>
