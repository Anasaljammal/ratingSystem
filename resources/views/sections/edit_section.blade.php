<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('CSS/modern-design-system.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/edit_section.css')}}" />
     <title>Edit Section - Rating System</title>
</head>

<body>
     <h1 class="title">Edit Section</h1>
     <form action="{{url('/sections/update/'.$section->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="image-container">
               <img id="image" src="{{url('')}}/{{$section->image}}" alt="error" />
               <input name="image" id="file" class="input-image" type="file" accept=".png, .jpg, .jpeg" />
          </div>
          @error('section_name')
               <div class="error">{{$message}}</div>
          @enderror
          <input value="{{$section->section_name}}" placeholder="Section Name" class="section-name-input" type="text" name="section_name" />
          <div class="buttons-container">
               <button class="btn edit-btn" type="submit">Edit</button>
               <a class="btn delete-btn" href="{{url('/sections/delete/'.$section->id)}}">Delete</a>
          </div>
     </form>
     <a href="{{url('/sections')}}" class="back-btn">
          <img src="{{asset('SVG/back-square.svg')}}" />
     </a>
     <script src="{{asset('JS/selected_image_view.js')}}"></script>
</body>

</html>