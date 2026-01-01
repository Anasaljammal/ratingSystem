<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('CSS/modern-design-system.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/reports.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/header.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/sidebar.css')}}" />
     <title>Reports - Rating System</title>
</head>
<body>
     @if (Session::has('success'))
          <div class="success" id="error">{{Session::get('success')}}</div>
     @endif
     <div style="display: none;">@section('page_type') {{$type = 'reports'}} @endsection</div>
     @if ($user->account_type === 'admin')
          @include('constants.admin-header')
     @endif

     @foreach ($reports as $report)
          <a href="{{url('/services/details/'.$report->service_id)}}" class="report-container">
               <img src="{{url('')}}/{{$report->service->images[0]->image}}" />
               <div class="information">
                    <div class="title">Report Provider: <span>{{$report->user->full_name}}</span></div>
                    <div class="title">Service Name: <span>{{$report->service->service_name}}</span></div>
                    <div class="title">Report: <span>{{$report->report}}</span></div>
               </div>
          </a> 
     @endforeach

     <script src="{{asset('JS/sidebar.js')}}"></script>
</body>
</html>