<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('CSS/modern-design-system.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/register.css')}}" />
     <title>Register - Rating System</title>
</head>

<body class="register-page">
     @if (Session::has('error'))
          <div class="alert alert-error" id="error">{{Session::get('error')}}</div>
     @endif
     
     <div class="register-wrapper">
          <div class="register-container">
               <div class="register-left">
                    <div class="register-brand">
                         <h1 class="brand-title">Join Us!</h1>
                         <p class="brand-subtitle">Create your account and start rating services</p>
                    </div>
                    <div class="register-image">
                         <img src="{{asset('IMAGES/register.png')}}" alt="Register Illustration" />
                    </div>
               </div>
               
               <div class="register-right">
                    <div class="register-card">
                         <div class="register-header">
                              <h2 class="register-title">Create Account</h2>
                              <p class="register-description">Fill in your details to get started</p>
                         </div>
                         
                         <form action="{{url('/register')}}" method="POST" enctype="multipart/form-data" class="register-form">
                              @csrf
                              
                              <div class="form-group profile-upload">
                                   <label class="form-label">Profile Picture</label>
                                   <div class="image-upload-wrapper">
                                        <div class="image-preview">
                                             <img id="image-preview" src="{{asset('IMAGES/user.jpg')}}" alt="Profile Preview" />
                                             <label for="file-input" class="upload-overlay">
                                                  <span>Change Photo</span>
                                             </label>
                                        </div>
                                        <input id="file-input" type="file" accept=".png,.jpg,.jpeg" name="image" style="display: none;" />
                                   </div>
                              </div>
                              
                              <div class="form-row">
                                   @error('full_name')
                                        <div class="alert alert-error">{{$message}}</div>
                                   @enderror
                                   <div class="form-group">
                                        <label class="form-label">Full Name</label>
                                        <input class="form-input" value="{{old('full_name')}}" type="text" name="full_name" required />
                                   </div>
                                   
                                   @error('birth_date')
                                        <div class="alert alert-error">{{$message}}</div>
                                   @enderror
                                   <div class="form-group">
                                        <label class="form-label">Birth Date</label>
                                        <input class="form-input" value="{{old('birth_date')}}" type="date" name="birth_date" required />
                                   </div>
                              </div>
                              
                              <div class="form-row">
                                   @error('phone_number')
                                        <div class="alert alert-error">{{$message}}</div>
                                   @enderror
                                   <div class="form-group">
                                        <label class="form-label">Phone Number</label>
                                        <input class="form-input" value="{{old('phone_number')}}" type="tel" name="phone_number" required />
                                   </div>
                                   
                                   @error('account_type')
                                        <div class="alert alert-error">{{$message}}</div>
                                   @enderror
                                   <div class="form-group">
                                        <label class="form-label">Account Type</label>
                                        <select class="form-select" name="account_type" required>
                                             <option value="regular user" {{old('account_type') == 'regular user'? 'selected':''}}>Regular User</option>
                                             <option value="service provider" {{old('account_type') == 'service provider'? 'selected':''}}>Service Provider</option>
                                        </select>
                                   </div>
                              </div>
                              
                              <div class="form-row">
                                   @error('email')
                                        <div class="alert alert-error">{{$message}}</div>
                                   @enderror
                                   <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input class="form-input" type="email" name="email" value="{{old('email')}}" required />
                                   </div>
                                   
                                   @error('password')
                                        <div class="alert alert-error">{{$message}}</div>
                                   @enderror
                                   <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input class="form-input" type="password" name="password" required />
                                   </div>
                              </div>
                              
                              <div class="form-row">
                                   @error('confirm_password')
                                        <div class="alert alert-error">{{$message}}</div>
                                   @enderror
                                   <div class="form-group">
                                        <label class="form-label">Confirm Password</label>
                                        <input class="form-input" type="password" name="confirm_password" required />
                                   </div>
                                   
                                   @error('gender')
                                        <div class="alert alert-error">{{$message}}</div>
                                   @enderror
                                   <div class="form-group">
                                        <label class="form-label">Gender</label>
                                        <select class="form-select" name="gender" required>
                                             <option value="male" {{old('gender') == 'male'? 'selected':''}}>Male</option>
                                             <option value="female" {{old('gender') == 'female'? 'selected':''}}>Female</option>
                                        </select>
                                   </div>
                              </div>
                              
                              <button type="submit" class="btn btn-primary btn-lg btn-full">Create Account</button>
                              
                              <div class="register-footer">
                                   <p>Already have an account? <a href="{{url('/login')}}" class="login-link">Sign In</a></p>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>

     <script src="{{asset('JS/selected_image_view.js')}}"></script>
     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>
