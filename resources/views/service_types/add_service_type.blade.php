<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('CSS/modern-design-system.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/add_service_type.css')}}" />
     <title>Add Service Type - Rating System</title>
</head>

<body>
     <h1 class="title">Add Service Type</h1>
     <form action="{{url('/service_types/add')}}" method="POST">
          @csrf
          @error('type')
               <div class="error">{{$message}}</div>
          @enderror
          <input name="type" type="text" name="#" placeholder="Service Type" />
          <button type="submit">Create</button>
     </form>
     <a href="{{url('/service_types')}}">
          <img src="{{asset('SVG/back-square.svg')}}" />
     </a>
</body>

</html>