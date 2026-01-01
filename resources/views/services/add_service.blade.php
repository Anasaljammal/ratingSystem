<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('CSS/modern-design-system.css')}}" />
    <link rel="stylesheet" href="{{asset('CSS/add_service.css')}}" />
    <title>Add Service - Rating System</title>
</head>

<body>
    <h1 class="title">Add Service</h1>
    <form action="{{url('/services/add/'.$section->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @error('service_name')
            <div class="error">{{$message}}</div>
        @enderror
        <div class="inputs-container">
            <div>Service Name</div>
            <input type="text" value="{{old('service_name')}}" name="service_name" />
        </div>
        @error('service_price')
            <div class="error">{{$message}}</div>
        @enderror
        <div class="inputs-container">
            <div>Service Price</div>
            <input type="number" value="{{old('service_price')}}" step="0.01" name="service_price" />
        </div>
        @error('service_type')
            <div class="error">{{$message}}</div>
        @enderror
        <div class="inputs-container">
            <div>Service Type</div>
            <select name="service_type">
                @foreach ($service_types as $service_type)
                    <option value="{{$service_type->id}}" {{$service_type->id == old('service_type')? 'selected':''}}>{{$service_type->type}}</option>
                @endforeach
            </select>
        </div>
        @error('images')
            <div class="error">{{$message}}</div>
        @enderror
        <div class="inputs-container">
            <div class="image-input-container">
                <img src="{{asset('SVG/add-image.svg')}}" />
                <input name="images[]" id="imageInput" type="file" multiple accept=".png, .jpg, .jpeg" />
            </div>
            <div id="imageContainer" class="images-container">

            </div>
        </div>
        <button class="create-btn" type="submit">Create</button>
    </form>

    <a class="back-btn" href="{{url('/services/'.$section->id)}}">
        <img src="{{asset('/SVG/back-square.svg')}}" />
    </a>

    <script src="{{asset('JS/show_selected_images.js')}}"></script>
</body>

</html>