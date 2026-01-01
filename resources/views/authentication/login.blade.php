<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('CSS/modern-design-system.css')}}" />
     <link rel="stylesheet" href="{{asset('CSS/login.css')}}" />
     <title>Login - Rating System</title>
</head>

<body class="login-page">
     @if (Session::has('error'))
          <div class="alert alert-error" id="error">{{Session::get('error')}}</div>
     @endif
     
     <div class="login-wrapper">
          <div class="login-container">
               <div class="login-left">
                    <div class="login-brand">
                         <h1 class="brand-title">Welcome Back!</h1>
                         <p class="brand-subtitle">Sign in to continue to Rating System</p>
                    </div>
                    <div class="login-image">
                         <img src="{{asset('IMAGES/login.png')}}" alt="Login Illustration" />
                    </div>
               </div>
               
               <div class="login-right">
                    <div class="login-card">
                         <div class="login-header">
                              <h2 class="login-title">Sign In</h2>
                              <p class="login-description">Enter your credentials to access your account</p>
                         </div>
                         
                         <form method="POST" action="{{url('/login')}}" class="login-form">
                              @csrf
                              
                              @error('email')
                                   <div class="alert alert-error">{{$message}}</div>
                              @enderror
                              
                              <div class="form-group">
                                   <div class="input-with-icon">
                                        <img src="{{asset('IMAGES/email.png')}}" alt="Email" />
                                        <input class="form-input" placeholder="Enter Your Email" value="{{old('email')}}" type="email" name="email" required>
                                   </div>
                              </div>
                              
                              @error('password')
                                   <div class="alert alert-error">{{$message}}</div>
                              @enderror
                              
                              <div class="form-group">
                                   <div class="input-with-icon">
                                        <img src="{{asset('IMAGES/password.png')}}" alt="Password" />
                                        <input class="form-input" placeholder="Enter Your Password" type="password" name="password" required>
                                   </div>
                              </div>
                              
                              <div class="form-group">
                                   <a href="{{url('/forgot-password')}}" class="forgot-link">Forgot Password?</a>
                              </div>
                              
                              <button type="submit" class="btn btn-primary btn-lg btn-full">Sign In</button>
                              
                              <div class="login-footer">
                                   <p>Don't have an account? <a href="{{url('/register')}}" class="register-link">Sign Up</a></p>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>

     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>