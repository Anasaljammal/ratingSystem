<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('CSS/modern-design-system.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/edit_service_type.css')}}" />
     <title>Edit Service Type - Rating System</title>
</head>

<body>
     <h1 class="title">Edit Service Type</h1>
     <form action="{{url('/service_types/update/'.$serviceType->id)}}" method="POST">
          @csrf
          <input value="{{$serviceType->type}}" type="text" name="type" placeholder="Service Type" />
          <div class="buttons-container">
               <button type="submit">Edit</button>
               <a href="{{url('/service_types/delete/'.$serviceType->id)}}">Delete</a>
          </div>
     </form>
     <a class="back-btn" href="{{url('/service_types')}}">
          <img src="{{asset('SVG/back-square.svg')}}" />
     </a>
</body>

</html>