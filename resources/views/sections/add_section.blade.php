<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('CSS/modern-design-system.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/add_section.css')}}" />
     <title>Add Section - Rating System</title>
</head>

<body>
     <h1 class="title">Add Section</h1>
     <form action="{{url('sections/add')}}" method="POST" enctype="multipart/form-data">
          @csrf
          @error('image')
               <div class="error">{{$message}}</div>
          @enderror
          <div class="image-container">
               <img id="image" src="{{asset('SVG/add-image.svg')}}" alt="error" />
               <input name="image" id="file" class="input-image" type="file" accept=".png, .jpg, .jpeg" />
          </div>
          @error('section_name')
               <div class="error">{{$message}}</div>
          @enderror
          <input placeholder="Section Name" class="section-name-input" type="text" name="section_name" />
          <div class="buttons-container">
               <button class="btn" type="submit">Add</button>
          </div>
     </form>
     <a href="{{url('/sections')}}" class="back-btn">
          <img src="{{asset('SVG/back-square.svg')}}" />
     </a>
     <script src="{{asset('JS/selected_image_view.js')}}"></script>
</body>

</html>