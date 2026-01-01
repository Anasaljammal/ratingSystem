<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('CSS/modern-design-system.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/about_us.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/slick.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/chatbot.css')}}" />
     <title>Chatbot - Rating System</title>
</head>

<div style="display: none;">@section('page_type') {{$type = 'chatbot'}} @endsection</div>
<body>
     @if ($user->account_type === 'admin')
          @include('constants.admin-header')
          @elseif ($user->account_type === 'service provider')
          @include('constants.service-provider-header')
          @elseif ($user->account_type == 'regular user')
          @include('constants.regular-user-header')
     @endif
     @if (Session::has('success'))
          <div class="success" id="error">{{Session::get('success')}}</div>
     @endif

     <div id="chat-box" class="chat-box">
          <!-- Chat messages will appear here -->
     </div>

     <div class="input-container">
          <input type="text" id="message" placeholder="Message Chatbot">
          <button id="send">send</button>
     </div>

     <script src="{{asset('JS/jquery-3.6.1.min.js')}}"></script>
     <script>
          function typeText(element, text, speed = 50) {
               let i = 0;
               function typing() {
                    if (i < text.length) {
                         element.innerHTML += text.charAt(i);
                         i++;
                         setTimeout(typing, speed);
                    }
               }
               typing();
          }

          $(document).ready(function(){
               $('#send').click(function(){
                    let message = $('#message').val();
                    $('#chat-box').append("<div class='user-msg'><b>You:</b> " + message + "</div>");
                    $('#message').val('');

                    $.ajax({
                         url: "{{ route('send.message') }}",
                         type: "POST",
                         data: {
                         message: message,
                         _token: "{{ csrf_token() }}"
                         },
                         success: function(response){
                         let replyDiv = $("<div class='chatbot-msg'><b>Chatbot:</b> <span class='reply'></span></div>");
                         $('#chat-box').append(replyDiv);

                         typeText(replyDiv.find('.reply')[0], response.reply, 60);
                         }
                    });
               });
          });
     </script>

     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>