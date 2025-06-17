<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/questions.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <title>Questions</title>
</head>
<body>
     @if (Session::has('success'))
          <div class="success" id="error">{{Session::get('success')}}</div>
     @endif
     <div style="display: none;">@section('page_type') {{$type = 'questions'}} @endsection</div>
     @if ($user->account_type === 'admin')
          @include('constants.admin-header')
     @elseif ($user->account_type === 'service provider')
          @include('constants.service-provider-header')
     @elseif ($user->account_type === 'regular user')
          @include('constants.regular-user-header')
     @endif

     @foreach ($questions as $question)
          <a href="{{url('/answers/'.$question->id)}}" class="question-container">
               @if ($question->user->image)
                    <img class="profile-image" src="{{url('')}}/{{$question->user->image}}" alt="error" />
               @else
                    <img class="profile-image" src="{{asset('IMAGES/user.jpg')}}" alt="error" />
               @endif
               <div class="information">
                    <div class="title">User: <span>{{$question->user->full_name}}</span></div>
                    <div class="title">Question: <span>{{$question->question}}</span></div>
               </div>
          </a> 
     @endforeach

     @if($user->account_type == 'regular user')
          <button id="add-btn" class="add-btn" onclick="OpenCreateForm()">+</button>
     @endif
     <form id="create-form" class="add-form" action="{{url('/questions')}}" method="POST">
          @csrf
          <div class="container">
               <img src="{{asset('SVG/close.svg')}}" onclick="CloseCreateForm()"/>
               <input type="text" name="question" placeholder="Enter your question here" />
               <button>Send</button>
          </div>
     </form>

     
     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/questions.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>
</html>