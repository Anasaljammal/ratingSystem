<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/supports.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <title>Reports</title>
</head>
<body>
     @if (Session::has('success'))
          <div class="success" id="error">{{Session::get('success')}}</div>
     @endif
     <div style="display: none;">@section('page_type') {{$type = 'support'}} @endsection</div>
     @if ($user->account_type === 'admin')
          @include('constants.admin-header')
     @endif

     @foreach ($supports as $support)
          <a href="{{url('/users/update/'.$support->user_id)}}" class="report-container">
               @if ($support->user->image)
                    <img src="{{url('')}}/{{$support->user->image}}" alt="error" />
               @else
                    <img src="{{asset('IMAGES/user.jpg')}}" alt="error" />
               @endif
               <div class="information">
                    <div class="title">User Name: <span>{{$support->user->full_name}}</span></div>
                    <div class="title">Request: <span>{{$support->support}}</span></div>
               </div>
          </a> 
     @endforeach

     <script src="{{asset('JS/sidebar.js')}}"></script>
</body>
</html>