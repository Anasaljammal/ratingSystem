<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('CSS/modern-design-system.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/answers.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <title>Answers - Rating System</title>
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

     <div class="question">Question: <span>{{$question->question}}</span></div>
     <hr />
     @if ($user->account_type == 'regular user' && $question->user_id == $user->id)
          <div class="btns-container">
               <button onclick="OpenCreateForm()" class="btn edit-btn">Edit Your Question</button>
               <a class="btn delete-btn" href="{{url('/questions/delete/'.$question->id)}}">Delete</a>
          </div>
     @endif
     @foreach ($answers as $answer)
          <a class="answer-container">
               @if ($question->user->image)
                    <img class="profile-image" src="{{url('')}}/{{$answer->user->image}}" alt="error" />
               @else
                    <img class="profile-image" src="{{asset('IMAGES/user.jpg')}}" alt="error" />
               @endif
               <div class="information">
                    <div class="title">User: <span>{{$answer->user->full_name}}</span></div>
                    <div class="title">Answer: <span>{{$answer->answer}}</span></div>
               </div>
               @if ($user->id == $answer->id)
                    <div class="delete-btn-container" href="">
                         <img onclick="location.assign('{{url('/answers/delete/'.$answer->id)}}')" class="delete-btn" src="{{asset('SVG/delete.svg')}}" />
                    </div>
               @endif
          </a> 
     @endforeach

     @if($user->account_type == 'service provider')
          <button id="add-btn" class="add-btn" onclick="OpenAnswerForm()">+</button>
     @endif
     <form id="create-form" class="add-form" action="{{url('/questions/'.$question->id)}}" method="POST">
          @csrf
          <div class="container">
               <img src="{{asset('SVG/close.svg')}}" onclick="CloseCreateForm()"/>
               <input value="{{$question->question}}" type="text" name="question" placeholder="Enter your question here" />
               <button>Update</button>
          </div>
     </form>

     <form id="answer-form" class="add-form" action="{{url('/answers/'.$question->id)}}" method="POST">
          @csrf
          <div class="container">
               <img src="{{asset('SVG/close.svg')}}" onclick="CloseAnswerForm()"/>
               <input type="text" name="answer" placeholder="Enter your answer here" />
               <button>Send</button>
          </div>
     </form>

     
     <script src="{{asset('JS/sidebar.js')}}"></script>
     <script src="{{asset('JS/questions.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>
</html>