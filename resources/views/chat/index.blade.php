<!DOCTYPE html>
<html>

<head>
    <title>NANApp</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #d9dbd5;
            height: 100vh;
            overflow: hidden;
        }

        .chat-container {
            height: 100vh;
        }

        /* LEFT SIDE */
        .sidebar {
            background: #fff;
            height: 100vh;
            border-right: 1px solid #ddd;
        }

        .sidebar-header {
            background: #f0f2f5;
            height: 70px;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .profile-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
        }

        .search-box {
            padding: 10px;
            background: #fff;
        }

        .chat-user {
            display: flex;
            align-items: center;
            padding: 12px;
            cursor: pointer;
            border-bottom: 1px solid #f1f1f1;
        }

        .chat-user:hover {
            background: #f5f5f5;
        }

        .chat-user img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .chat-user-info {
            margin-left: 15px;
            flex: 1;
        }

        .chat-user-info h6 {
            margin: 0;
        }

        .chat-user-info p {
            margin: 0;
            color: gray;
            font-size: 13px;
        }

        /* RIGHT SIDE */

        .chat-header {
            background: #f0f2f5;
            height: 70px;
            display: flex;
            align-items: center;
            padding: 15px;
            border-left: 1px solid #ddd;
        }

        .chat-header img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chat-body {
            height: calc(100vh - 140px);
            overflow-y: auto;
            padding: 20px;
            background: #efeae2;
        }

        .message {
            max-width: 60%;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            display: inline-block;
        }

        .received {
            background: white;
            float: left;
            clear: both;
        }

        .sent {
            background: #d9fdd3;
            float: right;
            clear: both;
        }

        .chat-footer {
            height: 70px;
            background: #f0f2f5;
            display: flex;
            align-items: center;
            padding: 10px;
            gap: 10px;
        }

        .chat-footer input {
            flex: 1;
            border: none;
            padding: 12px;
            border-radius: 8px;
        }

        .chat-footer input:focus {
            outline: none;
        }

        .send-btn {
            width: 50px;
            height: 50px;
            border: none;
            border-radius: 50%;
            background: #00a884;
            color: white;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="container-fluid chat-container">
        <div class="row">

            <!-- LEFT PANEL -->
            <div class="col-md-4 p-0 sidebar">

                <div class="sidebar-header">
                    <img src="https://i.pravatar.cc/100?img=1" class="profile-img">

                    <div>
                        <i class="bi bi-chat-left-text"></i>
                        <h6>{{ auth()->user()->name }}</h6>
                    </div>
                </div>

                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Search or start new chat">
                </div>


                @foreach ($users as $chatUser)
                    <a href="{{ url('chat/' . $chatUser->id) }}">
                        <div class="chat-user">
                            <img src="https://i.pravatar.cc/100?img={{ $chatUser->id }}">

                            <div class="chat-user-info">
                                <h6>{{ $chatUser->name }}</h6>
                                <p>Click to start chatting</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- RIGHT PANEL -->
            <div class="col-md-8 p-0">

                <div class="chat-header">

                    <img src="https://i.pravatar.cc/100?img={{ $selectedUser->id }}">

                    <div>
                        <h6 class="mb-0">{{ $selectedUser->name }}</h6>
                        <small class="text-success">Online</small>
                    </div>

                </div>

                <div class="chat-body" id="chatBody">

                    @foreach ($messages as $message)
                        @if ($message->sender_id == auth()->id())
                            <div class="message sent">
                                {{ $message->message }}
                            </div>
                        @else
                            <div class="message received">
                                {{ $message->message }}
                            </div>
                        @endif
                    @endforeach

                </div>

                <div class="chat-footer">

                    <form id="messageForm" class="w-100 d-flex">

                        @csrf

                        <input type="hidden" id="conversation_id" value="{{ $conversation->id ?? '' }}">

                        <input type="text" id="message" class="form-control me-2" placeholder="Type a message">

                        <button type="submit" class="send-btn">
                            ➤
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script type="module">

    window.Echo.channel(
        'chat.' + $('#conversation_id').val()
    )
    .listen('MessageSent', (e) => {

        console.log(e);

        $('#chatBody').append(`
            <div class="message received">
                ${e.message.message}
            </div>
        `);

    });

</script>

    <script>
        $('#messageForm').submit(function(e) {

            e.preventDefault();

            let message = $('#message').val();

            if (message.trim() == '') {
                return;
            }

            $.ajax({

                url: '/send-message',

                type: 'POST',

                data: {
                    _token: '{{ csrf_token() }}',
                    conversation_id: $('#conversation_id').val(),
                    message: message
                },

                success: function(response) {

                    $('#chatBody').append(`
                <div class="message sent">
                    ${message}
                </div>
            `);

                    $('#message').val('');

                    $('#chatBody').scrollTop(
                        $('#chatBody')[0].scrollHeight
                    );

                }

            });

        });
    </script>

</body>

</html>
