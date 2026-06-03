<!DOCTYPE html>
<html>

<head>


    <title>VOXA</title>


    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">



    <link rel="icon" type="image/png" href="{{ asset('images/voxa-logo.png') }}">


    <style>
        * {

            margin: 0;

            padding: 0;

            box-sizing: border-box;

            font-family: 'Poppins', sans-serif;

        }

        body {

            background:

                linear-gradient(135deg,
                    #111827,
                    #1f2937);

            height: 100vh;

            overflow: hidden;

        }

        .chat-container {

            height: 100vh;

            padding: 15px;

        }

        .row {

            height: 100%;

        }

        /* SIDEBAR */

        .sidebar {

            background: rgba(255, 255, 255, .08);

            backdrop-filter: blur(18px);

            border: 1px solid rgba(255,
                    255,
                    255,
                    .08);

            border-radius: 24px 0 0 24px;

            overflow: hidden;

            position: relative;

            height: 100%;

        }

        .sidebar-header {

            height: 75px;

            background: rgba(255, 255, 255, .05);

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 18px;

            border-bottom: 1px solid rgba(255,
                    255,
                    255,
                    .05);

        }

        .sidebar-icons {

            display: flex;

            gap: 20px;

            color: #d1d5db;

        }

        .sidebar-icons i {

            font-size: 22px;

            cursor: pointer;

            transition: .3s;

        }

        .sidebar-icons i:hover {

            color: #ff9f43;

            transform: scale(1.08);

        }

        .search-box {

            padding: 15px;

            background: transparent;

        }

        .search-box input {

            height: 50px;

            border: none;

            border-radius: 15px;

            background: rgba(255, 255, 255, .08);

            color: white;

            padding-left: 18px;

        }

        .search-box input::placeholder {

            color: #cbd5e1;

        }

        .search-box input:focus {

            background: rgba(255, 255, 255, .12);

            box-shadow: none;

            color: white;

        }

        .chat-user {

            display: flex;

            align-items: center;

            padding: 16px;

            transition: .3s ease;

            border-bottom: 1px solid rgba(255,
                    255,
                    255,
                    .04);

        }

        .chat-user:hover {

            background: rgba(255,
                    255,
                    255,
                    .06);

        }

        .chat-user img {

            width: 55px;

            height: 55px;

            border-radius: 50%;

            object-fit: cover;

        }

        .chat-user-info {

            margin-left: 15px;

            flex: 1;

        }

        .chat-user-info h6 {

            margin: 0;

            color: white;

            font-size: 17px;

            font-weight: 500;

        }

        .chat-user-info p {

            margin: 0;

            color: #cbd5e1;

            font-size: 13px;

        }

        .chat-link {

            text-decoration: none;

        }

        /* CHAT AREA */

        .chat-wrapper {

            background: #efeae2;

            border-radius: 0 24px 24px 0;

            overflow: hidden;

            height: 100%;

            display: flex;

            flex-direction: column;

        }

        .chat-header {

            position: relative;

            z-index: 100;

            height: 75px;

            background: rgba(255, 255, 255, .85);

            backdrop-filter: blur(10px);

            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 0 20px;

            border-bottom: 1px solid #e5e7eb;

        }

        .chat-header-left {

            display: flex;

            align-items: center;

            min-width: 0;

        }

        .chat-header img {

            width: 48px;

            height: 48px;

            border-radius: 50%;

            object-fit: cover;

            margin-right: 14px;

        }

        .chat-user-details h6 {

            margin: 0;

            font-size: 18px;

            font-weight: 600;

            color: #111827;

        }

        .user-status {

            font-size: 13px;

            color: #6b7280;

        }

        .chat-icons {

            display: flex;

            gap: 22px;

            color: #4b5563;

        }

        .chat-icons i {

            font-size: 22px;

            cursor: pointer;

            transition: .3s;

        }

        .chat-icons i:hover {

            color: #ff6b00;

        }

        /* CHAT BODY */

        .chat-body {

            flex: 1;

            overflow-y: auto;

            padding: 25px;

            background-image:

                radial-gradient(rgba(0, 0, 0, .03) 1px,
                    transparent 1px);

            background-size: 20px 20px;
            position: relative;
            z-index: 1;

        }

        .message {

            max-width: 75%;

            padding: 12px 15px;

            border-radius: 18px;

            margin-bottom: 18px;

            position: relative;

            word-break: break-word;

            animation: fadeIn .2s ease;

        }

        @keyframes fadeIn {

            from {

                opacity: 0;

                transform: translateY(8px);

            }

            to {

                opacity: 1;

                transform: translateY(0);

            }

        }

        .sent {

            background:

                linear-gradient(45deg,
                    #ff6b00,
                    #ff9f43);

            color: white;

            margin-left: auto;

            border-bottom-right-radius: 6px;

            box-shadow:

                0 5px 15px rgba(255,
                    107,
                    0,
                    .25);

        }

        .received {

            background: white;

            color: #111827;

            border-bottom-left-radius: 6px;

            box-shadow:

                0 3px 10px rgba(0,
                    0,
                    0,
                    .05);

        }

        .message-time {

            font-size: 11px;

            margin-top: 6px;

            opacity: .75;

            text-align: right;

        }

        /* FOOTER */

        .chat-footer {

            min-height: 75px;

            background: rgba(255, 255, 255, .85);

            backdrop-filter: blur(10px);

            padding: 12px 18px;

            border-top: 1px solid #e5e7eb;

        }

        .chat-footer input {

            border: none;

            height: 52px;

            border-radius: 30px;

            padding: 0 20px;

            background: #f3f4f6;

        }

        .chat-footer input:focus {

            outline: none;

            box-shadow: none;

            background: #fff;

        }

        .send-btn {

            width: 52px;

            height: 52px;

            border: none;

            border-radius: 50%;

            background:

                linear-gradient(45deg,
                    #ff6b00,
                    #ff9f43);

            color: white;

            font-size: 20px;

            margin-left: 10px;

            transition: .3s;

        }

        .send-btn:hover {

            transform: scale(1.05);

        }

        /* LOGO */

        .voxa-logo {

            width: 55px;

            height: 55px;

            object-fit: contain;

            border-radius: 18px;

            padding: 5px;

            background: white;

            box-shadow:

                0 5px 18px rgba(255,
                    107,
                    0,
                    .25);

        }

        /* FOOTER */

        .sidebar-footer {

            position: absolute;

            bottom: 15px;

            width: 100%;

            text-align: center;

        }

        .sidebar-footer p {

            color: #d1d5db;

            font-size: 13px;

        }

        .sidebar-footer span {

            color: #ff9f43;

            font-weight: 600;

        }

        /* SCROLLBAR */

        ::-webkit-scrollbar {

            width: 6px;

        }

        ::-webkit-scrollbar-thumb {

            background: #cbd5e1;

            border-radius: 20px;

        }

        /* MOBILE */

        @media(max-width:768px) {

            .chat-container {

                padding: 0;

            }

            .sidebar {

                border-radius: 0;

                height: 100vh;

            }

            .chat-wrapper {

                border-radius: 0;

                height: 100vh;

            }

            .chat-header {

                padding: 0 15px;

            }

            .chat-body {

                padding: 18px;

            }

            .message {

                max-width: 88%;

            }

        }
    </style>


    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <div class="container-fluid p-0 chat-container">

        <div class="row g-0">

            <!-- SIDEBAR -->
            <div
                class="col-12 col-md-4 sidebar

    {{ isset($selectedUser) && $selectedUser ? 'd-none d-md-block' : '' }}

">


                <div class="sidebar-header">

                    <div class="sidebar-left">



                        <img src="{{ asset('images/voxa-logo.png') }}" alt="VOXA" class="voxa-logo">

                        {{-- <h5 class="app-title">

                            VOXA

                        </h5> --}}




                    </div>

                    <div class="sidebar-icons">

                        <i class="bi bi-circle"></i>

                        <i class="bi bi-chat-left-text"></i>

                        <div class="dropdown">

                            <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                style="font-size:22px; cursor:pointer;">
                            </i>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>

                                    <a class="dropdown-item" href="#">

                                        <i class="bi bi-person me-2"></i>

                                        Profile

                                    </a>

                                </li>

                                <li>

                                    <a class="dropdown-item" href="#">

                                        <i class="bi bi-gear me-2"></i>

                                        Settings

                                    </a>

                                </li>

                                <li>

                                    <a class="dropdown-item" href="#">

                                        <i class="bi bi-archive me-2"></i>

                                        Archived

                                    </a>

                                </li>

                                <li>

                                    <a class="dropdown-item" href="#">

                                        <i class="bi bi-star me-2"></i>

                                        Starred

                                    </a>

                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>

                                    <form method="POST" action="{{ route('logout') }}">

                                        @csrf

                                        <button type="submit" class="dropdown-item text-danger">

                                            <i class="bi bi-box-arrow-right me-2"></i>

                                            Logout

                                        </button>

                                    </form>

                                </li>

                            </ul>

                        </div>



                    </div>

                </div>

                <div class="search-box">

                    <input type="text" class="form-control" placeholder="Search or start new chat">

                </div>

                @foreach ($users as $chatUser)
                    <a href="{{ url('chat/' . $chatUser->id) }}" class="chat-link"
                        onclick="resetUnreadCount(
        {{ $chatUser->id }}
    )">


                        <div class="chat-user">

                            <img src="https://i.pravatar.cc/100?img={{ $chatUser->id }}">


                            <div class="chat-user-info">

                                <div class="d-flex justify-content-between align-items-center">

                                    <h6>

                                        {{ $chatUser->name }}

                                    </h6>

                                    <span id="unread-count-{{ $chatUser->id }}" class="badge rounded-pill bg-success"
                                        style="display:none;">

                                        0

                                    </span>

                                </div>

                                <p id="last-message-{{ $chatUser->id }}">

                                    {{ $chatUser->last_message ?? 'Start chatting...' }}

                                </p>

                            </div>



                        </div>

                    </a>
                @endforeach

                <!-- SIDEBAR FOOTER -->

                <div class="sidebar-footer text-center">


                    <p>

                        Built with ❤️ by

                        <span>

                            Sharon Sooraj

                        </span>

                        • VOXA © 2026

                    </p>



                </div>

            </div>




            <!-- CHAT -->

            <div
                class="col-12 col-md-8 chat-wrapper



    {{ !isset($selectedUser) || !$selectedUser ? 'd-none d-md-block' : '' }}

">


                @if ($selectedUser)

                    <div class="chat-header">

                        <div class="chat-header-left">

                            <a href="{{ url('/chat') }}" class="d-md-none me-3 text-dark">

                                <i class="bi bi-arrow-left" style="font-size:22px;"></i>

                            </a>



                            <img src="https://i.pravatar.cc/100?img={{ $selectedUser->id }}">

                            <div class="chat-user-details">

                                <h6>{{ $selectedUser->name }}</h6>



                                <div id="user-status-{{ $selectedUser->id }}" class="user-status">



                                    @if ($selectedUser->is_online == 1)
                                        <span class="text-success">

                                            Online

                                        </span>
                                    @else
                                        <span class="text-muted">


                                            Last seen
                                            {{ $selectedUser->last_seen ? $selectedUser->last_seen->diffForHumans() : 'recently' }}



                                        </span>
                                    @endif

                                </div>



                            </div>

                        </div>

                        <div class="chat-icons">

                            <i class="bi bi-camera-video"></i>

                            <i class="bi bi-telephone"></i>


                            <div class="dropdown">

                                <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                    style="font-size:22px; cursor:pointer;">
                                </i>

                                <ul class="dropdown-menu dropdown-menu-end">

                                    <li>

                                        <a class="dropdown-item" href="#">

                                            <i class="bi bi-person-lines-fill me-2"></i>

                                            Contact info

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item" href="#">

                                            <i class="bi bi-check2-square me-2"></i>

                                            Select messages

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item" href="#">

                                            <i class="bi bi-volume-mute me-2"></i>

                                            Mute notifications

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item" href="#">

                                            <i class="bi bi-image me-2"></i>

                                            Wallpaper

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item" href="#">

                                            <i class="bi bi-trash3 me-2"></i>

                                            Clear chat

                                        </a>

                                    </li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li>


                                        <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteChatModal">

                                            <i class="bi bi-trash me-2"></i>

                                            Delete chat

                                        </button>


                                    </li>

                                    <li>

                                        <a class="dropdown-item text-danger" href="#">

                                            <i class="bi bi-slash-circle me-2"></i>

                                            Block

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item text-danger" href="#">

                                            <i class="bi bi-flag me-2"></i>

                                            Report

                                        </a>

                                    </li>

                                </ul>

                            </div>



                        </div>

                    </div>

                    <div class="chat-body" id="chatBody">

                        @foreach ($messages as $message)
                            @if ($message->sender_id == auth()->id())
                                <div class="message sent">

                                    {{ $message->message }}

                                    <div class="message-time">

                                        {{ $message->created_at->format('h:i A') }}

                                    </div>

                                </div>
                            @else
                                <div class="message received">

                                    {{ $message->message }}

                                    <div class="message-time">

                                        {{ $message->created_at->format('h:i A') }}

                                    </div>

                                </div>
                            @endif
                        @endforeach

                    </div>


                    <div class="chat-footer position-relative">

                        <form id="messageForm" class="w-100 d-flex align-items-center">

                            @csrf

                            <input type="hidden" id="conversation_id" value="{{ $conversation->id }}">

                            <!-- EMOJI BUTTON -->

                            <button type="button" id="emojiBtn" class="btn me-2"
                                style="
                font-size:24px;
                border:none;
                background:none;
            ">

                                😊

                            </button>

                            <!-- MESSAGE INPUT -->

                            <input type="text" id="message" class="form-control" placeholder="Type a message">

                            <!-- SEND -->

                            <button type="submit" class="send-btn">

                                ➤

                            </button>

                        </form>

                        <!-- EMOJI PICKER -->

                        <div id="emojiPickerContainer"
                            style="
            position:absolute;
            bottom:80px;
            left:10px;
            display:none;
            z-index:9999;
        ">

                            <emoji-picker></emoji-picker>

                        </div>

                    </div>


                @endif

            </div>

        </div>

    </div>

    <!-- DELETE CHAT MODAL -->


    @if ($conversation)
        <!-- DELETE CHAT MODAL -->

        <div class="modal fade" id="deleteChatModal" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 shadow-lg"
                    style="border-radius:20px;
            overflow:hidden;">

                    <!-- HEADER -->

                    <div class="modal-header border-0 pb-0">

                        <h5 class="modal-title fw-bold text-danger">

                            Delete Chat

                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">

                        </button>

                    </div>

                    <!-- BODY -->

                    <div class="modal-body text-center px-4">

                        <div class="mb-3">

                            <i class="bi bi-trash-fill"
                                style="font-size:70px;
                        color:#ff3b30;">

                            </i>

                        </div>

                        <h5 class="fw-bold mb-3">

                            Delete this conversation?

                        </h5>

                        <p class="text-muted">

                            This will permanently delete all
                            messages in this chat.

                            This action cannot be undone.

                        </p>

                    </div>

                    <!-- FOOTER -->

                    <div class="modal-footer border-0 pt-0">

                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <form method="POST" action="{{ route('chat.delete', $conversation->id) }}">

                            @csrf

                            @method('DELETE')

                            <button type="submit" class="btn btn-danger px-4">

                                Delete

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>
    @endif




    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script type="module">
        let conversationId = $('#conversation_id').val();

        let authId = {{ auth()->id() }};

        // ==============================
        // REALTIME CHAT LISTENER
        // ==============================

        if (conversationId) {

            window.Echo.private('chat.' + conversationId)

                .listen('MessageSent', (e) => {

                    console.log('chat realtime', e);

                    // prevent duplicate own messages
                    if (e.sender_id == authId) {
                        return;
                    }

                    // append incoming message instantly
                    $('#chatBody').append(`

                <div class="message received">

                    ${e.message}

                    <div class="message-time">

                        ${e.time}

                    </div>

                </div>

            `);

                    // update latest sidebar message
                    $('#last-message-' + e.sender_id)
                        .html(e.message)
                        .addClass('unread-message');

                    // auto scroll
                    $('#chatBody').scrollTop(
                        $('#chatBody')[0].scrollHeight
                    );

                    // reset unread if current chat open
                    resetUnreadCount(e.sender_id);

                });

        }

        // ==============================
        // SIDEBAR REALTIME LISTENER
        // ==============================

        window.Echo.private('user.' + authId)

            .listen('MessageSent', (e) => {

                console.log('sidebar realtime', e);

                // update sidebar latest message
                $('#last-message-' + e.sender_id)
                    .html(e.message)
                    .addClass('unread-message');

                // move active chat to top
                let chatItem = $('#last-message-' + e.sender_id)
                    .closest('.chat-link');

                $('.chat-link').first().before(chatItem);

                // if currently opened chat
                // don't increase unread counter
                if (
                    conversationId &&
                    parseInt(e.conversation_id) === parseInt(conversationId)
                ) {

                    resetUnreadCount(e.sender_id);

                    return;
                }

                // unread counter
                let unreadBadge = $('#unread-count-' + e.sender_id);

                let currentCount = parseInt(
                    unreadBadge.text()
                ) || 0;

                unreadBadge.text(currentCount + 1);

                unreadBadge.show();

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

                        ${response.message.message}

                        <div class="message-time">

                            ${response.message.time}

                        </div>

                    </div>

                `);

                    $('#last-message-{{ $selectedUser->id ?? 0 }}')
                        .html(response.message.message);

                    $('#message').val('');

                    $('#chatBody').scrollTop(
                        $('#chatBody')[0].scrollHeight
                    );

                }

            });

        });
    </script>


    <script>
        window.Echo.channel('status')

            .listen('UserStatusChanged', (e) => {

                console.log('status update', e);

                let userStatus = document.getElementById(
                    'user-status-' + e.userId
                );

                if (userStatus) {

                    if (e.isOnline) {

                        userStatus.innerHTML = `

                    <span class="text-success">

                        Online

                    </span>

                `;

                    } else {

                        userStatus.innerHTML = `

                    <span class="text-muted">

                        Last seen just now

                    </span>

                `;

                    }

                }

            });
    </script>

    <script>
        function resetUnreadCount(userId) {
            $('#unread-count-' + userId)
                .hide()
                .text(0);
        }
    </script>



    <script>
        const emojiBtn = document.getElementById(
            'emojiBtn'
        );

        const pickerContainer = document.getElementById(
            'emojiPickerContainer'
        );

        const messageInput = document.getElementById(
            'message'
        );

        const picker = document.querySelector(
            'emoji-picker'
        );

        // toggle picker
        emojiBtn.addEventListener('click', () => {

            if (
                pickerContainer.style.display === 'none'
            ) {

                pickerContainer.style.display = 'block';

            } else {

                pickerContainer.style.display = 'none';

            }

        });

        // add emoji to input
        picker.addEventListener('emoji-click', event => {

            messageInput.value += event.detail.unicode;

            messageInput.focus();

        });

        // close picker outside click
        document.addEventListener('click', (e) => {

            if (
                !pickerContainer.contains(e.target) &&
                e.target !== emojiBtn
            ) {

                pickerContainer.style.display = 'none';

            }

        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>
