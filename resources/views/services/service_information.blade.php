<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('CSS/modern-design-system.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/service_information.css')}}" />
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
     <title>{{$service->service_name}} - Rating System</title>
</head>

<body>
     @if (Session::has('success'))
          <div class="success" id="error">{{Session::get('success')}}</div>
     @endif
     <a href="{{url('/services/'.$service->section_id)}}"><button class="prev-btn"></button></a>
     <section class="total-stars">
          @for ($i=0;$i<floor($total_rates);$i++)
               <img src="{{asset('SVG/fill-star.svg')}}" />
          @endfor
          @for ($i=0;$i<5-floor($total_rates);$i++)
               <img src="{{asset('SVG/star.svg')}}" />
          @endfor
          <h2>{{$total_rates}}</h2>
     </section>
     <section class="service-image">
          <div class="main-image-container">
               <img id="main_image" src="{{url('')}}/{{$service->images[0]->image}}" alt="error">
          </div>
          <div class="images-container">
               @foreach ($service->images as $image)
                    <img class="images" src="{{url('')}}/{{$image->image}}" alt="error">
               @endforeach
          </div>
     </section>
     <section class="service-information">
          <h1>Service Name: <span>{{$service->service_name}}</span></h1>
          <h1>Service Type: <span>{{$service->type->type}}</span></h1>
          <h1>Service Price: <span>{{$service->service_price}}</span></h1>
          <div class="buttons">
               <button id="open-service-provider-section" class="service-provider-information">Service Provider
                    Information</button>
               @if ($user->account_type == 'regular user')
                    <button id="open-rating-section" class="rating">Rating</button>
               @endif
          </div>
          <div class="buttons">
               @if ($user->account_type == 'regular user')
                    <button onclick="OpenReportingWindow()" id="open-reporting-section" class="reporting">Reporting</button>
               @endif
          </div>
          <section class="rates-section">
               @foreach ($service->rates as $rate)
               <div class="rate">
                         <div class="container">
                              @if ($rate->user->image)
                                   <img class="profile-image" src="{{url('')}}/{{$rate->user->image}}" alt="error">
                                   @else
                                   <img class="profile-image" src="{{asset('IMAGES/user.jpg')}}" alt="error">
                              @endif
                              <div class="username">{{$rate->user->full_name}}</div>
                              <div class="date">{{$rate->user->created_at->format('Y-m-d')}}</div>
                              @if ($user->account_type == 'service provider' || $user->account_type == 'admin')
                                   <div class="delete-btn">
                                        <a href="{{url('/rating/delete/'.$rate->id)}}"><img src="{{asset('SVG/delete.svg')}}" /></a>
                                   </div>
                              @endif
                              <div class="stars">
                                   @for ($i=0;$i<$rate->stars;$i++)
                                        <img src="{{asset('SVG/fill-star.svg')}}" />
                                   @endfor
                                   @for ($i=0;$i<5-$rate->stars;$i++)
                                        <img src="{{asset('SVG/star.svg')}}" />
                                   @endfor
                              </div>
                              @if ($rate->analyze['class'] == 'pos')
                              🙂 
                              @elseif ($rate->analyze['class'] == 'neg')
                              ☹️
                              @else
                              😐
                              @endif
                              <button class="sound-btn" onclick="speakThis({{$rate->id}})">🔊</button>
                         </div>
                         <div id="comment-{{$rate->id}}" class="comment">{{$rate->comment}}</div>
                         <button id="btn-{{$rate->id}}" class="summorize-btn" onclick="updateText({{ $rate->id }})">
                              <span id="btn-text-{{$rate->id}}">Summorize</span>
                              <div id="spinner-{{$rate->id}}" class="spinner spinner-border text-light" style="display: none;" role="status">
                                   <span class="visually-hidden">Loading...</span>
                              </div>
                         </button>
                         </div>
                         <hr />
                    @endforeach
               </div>
          </section>
     </section>
     <section id="background" class="background"></section>
     <section id="service-provider-section" class="service-provider-information-section">
          <div class="container">
               <img src="{{url('')}}/{{$service->section->user->image? $service->section->user->image: asset('IMAGES/user.jpg')}}" alt="error" />
               <div class="details">
                    <div>Name: <span>{{$service->section->user->full_name}}</span></div>
                    <div>Birthday: <span>{{$service->section->user->birth_date}}</span></div>
                    <div>Age: <span>{{Illuminate\Support\Carbon::now()->year - explode('-',$service->section->user->birth_date)[0]}}</span></div>
                    <div>Phone Number: <span>{{$service->section->user->phone_number}}</span></div>
               </div>
               <img id="close-service-provider-section" src="{{asset('SVG/close.svg')}}" class="close" />
          </div>
     </section>
     <section class="rating-section" id="rating-section">
          <div class="stars">
               <img class="stars-rates" src="{{asset('SVG/star.svg')}}" />
               <img class="stars-rates" src="{{asset('SVG/star.svg')}}" />
               <img class="stars-rates" src="{{asset('SVG/star.svg')}}" />
               <img class="stars-rates" src="{{asset('SVG/star.svg')}}" />
               <img class="stars-rates" src="{{asset('SVG/star.svg')}}" />
          </div>
          <form action="{{url('/rating/'.$service->id)}}" method="POST">
               @csrf
               <div class="inputs-container">
                    <input name="stars" class="inputs-rates" id="input" type="radio" value="1">
                    <input name="stars" class="inputs-rates" id="input" type="radio" value="2">
                    <input name="stars" class="inputs-rates" id="input" type="radio" value="3">
                    <input name="stars" class="inputs-rates" id="input" type="radio" value="4">
                    <input name="stars" class="inputs-rates" id="input" type="radio" value="5">
               </div>
               <textarea id="comments" name="comment" placeholder="Leave Comment"></textarea>
               <button disabled id="rating-btn" type="submit">Send</button>
          </form>
          <img id="close-rating-section" src="{{asset('SVG/close.svg')}}" class="close" />
     </section>
     <section id="reporting-window" class="reporting-section">
          <div class="reporting-container">
               <img onclick="CloseReportingWindow()" class="close-btn" src="{{asset('SVG/close.svg')}}" />
               <h1 class="title">Reporting</h1>
               <form method="POST" action="{{url('/reports/' . $service->id)}}">
                    @csrf
                    <textarea placeholder="Enter Your Report" name="report"></textarea>
                    <button type="submit">Send</button>
               </form>
          </div>
     </section>
     <script>
          var url = "{{url('')}}";
     </script>
     <script>
          function updateText(id) {
               var btnText = document.getElementById(`btn-text-${id}`);
               var spinner = document.getElementById(`spinner-${id}`);
               var btn = document.getElementById(`btn-${id}`);

               btnText.style.display = 'none';
               spinner.style.display = 'inline-block';
               btn.disabled = true;
               fetch(`/ai/summorize-comment/${id}`, {
                    method: 'POST',
                    headers: {
                         'Content-Type': 'application/json',
                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
               })
               .then(response => response.json())
               .then(data => {
                    document.getElementById(`comment-${id}`).innerText = data.text.data.summary;
                    btn.style.display = 'none';
               })
               .catch(error => console.error('Error:', error));
          }
     </script>
     <script src="https://code.responsivevoice.org/responsivevoice.js?key=PLUgIcGB"></script>
     <script>
          function speakThis(id) {
               const text = document.getElementById(`comment-${id}`).innerText.replace('🔊', '').trim();
               responsiveVoice.speak(text, 'UK English Female');
          }
     </script>
     <script src="{{asset('JS/imag_view.js')}}"></script>
     <script src="{{asset('JS/reporting.js')}}"></script>
     <script src="{{asset('JS/service_information_windows.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>