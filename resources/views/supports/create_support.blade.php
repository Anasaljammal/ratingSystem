<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('CSS/modern-design-system.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/create_support.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <title>Create Support - Rating System</title>
</head>

<div style="display: none;">@section('page_type') {{$type = 'support'}} @endsection</div>
<body>
     @if (Session::has('success'))
          <div class="success" id="error">{{Session::get('success')}}</div>
     @endif
     @if ($user->account_type == 'regular user')
          @include('constants.regular-user-header')
     @elseif ($user->account_type == 'service provider')
          @include('constants.service-provider-header')
     @endif
     <h1 class="main-title">Support</h1>

     <form method="post" action="{{url('/supports/create')}}">
          @csrf
          <textarea id="support-input" name="support"></textarea>
          <button id="send-btn" disabled>Send</button>
     </form>

     <script>
          var input = document.getElementById('support-input');
          var btn = document.getElementById('send-btn');

          input.addEventListener('input', () => {
               if(!input.value){
                    btn.setAttribute('disabled',true);
               }else{
                    btn.removeAttribute('disabled');
               }
          });
     </script>
     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>