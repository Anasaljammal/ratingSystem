<img id="open-sidebar-btn" class="open-sidebar" src="{{asset('SVG/sidebar-right.svg')}}" />
     <section id="sidebar" class="sidebar">
          <div class="main-container">
               <h1 class="title">Rating System <img id="close-sidebar-btn" src="{{asset('SVG/sidebar-left.svg')}}" /></h1>
               <hr />
               <div class="rows-container">
                    <a href="{{url('/users')}}" class="container {{$type == 'users' ? 'active' : ''}}">
                         <img src="{{asset('SVG/users-group.svg')}}" />
                         <span>Users</span>
                    </a>
                    <a href="{{url('/sections')}}" class="container {{$type == 'sections' ? 'active' : ''}}">
                         <img src="{{asset('SVG/sections.svg')}}" />
                         <span>Sections</span>
                    </a>
                    <a href="{{url('/services')}}" class="container {{$type == 'services' ? 'active' : ''}}">
                         <img src="{{asset('SVG/services.svg')}}" />
                         <span>Services</span>
                    </a>
                    <a href="{{url('/service_types')}}" class="container {{$type == 'service_types' ? 'active' : ''}}">
                         <img src="{{asset('SVG/category.svg')}}" />
                         <span>Service Types</span>
                    </a>
                    <a href="{{url('/posts')}}" class="container {{$type == 'posts' ? 'active' : ''}}">
                         <img src="{{asset('SVG/posts.svg')}}" />
                         <span>Posts</span>
                    </a>
                    <a href="{{url('/notifications')}}" class="container {{$type == 'notifications' ? 'active' : ''}}">
                         <img src="{{asset('SVG/notification2.svg')}}" />
                         <span>Notifications</span>
                    </a>
                    <a href="{{url('/about_us')}}" class="container {{$type == 'about_us' ? 'active' : ''}}">
                         <img src="{{asset('SVG/about-us.svg')}}" />
                         <span>About Us</span>
                    </a>
                    <a href="{{url('/reports')}}" class="container {{$type == 'reports' ? 'active' : ''}}">
                         <img src="{{asset('SVG/contract-pending.svg')}}" />
                         <span>Reports</span>
                    </a>
                    <a href="{{url('/supports')}}" class="container {{$type == 'support' ? 'active' : ''}}">
                         <img src="{{asset('SVG/support.svg')}}" />
                         <span>Support</span>
                    </a>
                    <a href="{{url('/questions')}}" class="container {{$type == 'questions' ? 'active' : ''}}">
                         <img src="{{asset('SVG/question.svg')}}" />
                         <span>Questions</span>
                    </a>
                    <a href="{{url('/ai/chatbot')}}" class="container {{$type == 'chatbot' ? 'active' : ''}}">
                         <img src="{{asset('SVG/chat.svg')}}" />
                         <span>Chatbot</span>
                    </a>
                    <a href="{{url('/logout')}}" class="container">
                         <img src="{{asset('SVG/logout.svg')}}" />
                         <span>Logout</span>
                    </a>
               </div>
          </div>
     </section>
     <header>
          <div class="top-section">
               <h1 class="header-title">Rating System</h1>
               <div class="links-container">
                    <a href="{{url('/users')}}" class="{{$type == 'users' ? 'active' : ''}}">Users</a>
                    <a href="{{url('/sections')}}" class="{{$type == 'sections' ? 'active' : ''}}">Sections</a>
                    <a href="{{url('/services')}}" class="{{$type == 'services' ? 'active' : ''}}">Services</a>
                    <a href="{{url('/service_types')}}" class="{{$type == 'service_types' ? 'active' : ''}}">Service Types</a>
                    <a href="{{url('/posts')}}" class="{{$type == 'posts' ? 'active' : ''}}">Posts</a>
                    <a href="{{url('/notifications')}}" class="{{$type == 'notifications' ? 'active' : ''}}">Notifications</a>
                    <a href="{{url('/about_us')}}" class="{{$type == 'about_us' ? 'active' : ''}}">About Us</a>
                    <a href="{{url('/reports')}}" class="{{$type == 'reports' ? 'active' : ''}}">Reports</a>
                    <a href="{{url('/supports')}}" class="{{$type == 'support' ? 'active' : ''}}">Support</a>
                    <a href="{{url('/questions')}}" class="{{$type == 'questions' ? 'active' : ''}}">Question</a>
                    <a href="{{url('/ai/chatbot')}}" class="{{$type == 'chatbot' ? 'active' : ''}}">Chatbot</a>
                    <a href="{{url('/logout')}}">Logout</a>
               </div>
               <a href="{{url('/')}}" class="profile">
                    @if ($user->image)
                         <img src="{{url('/')}}/{{$user->image}}" alt="error" />
                         @else
                         <img src="{{asset('IMAGES/user.jpg')}}" alt="error" />
                    @endif
               </a>
          </div>
          @if ($type == 'sections')
               <form id="form-search" method="GET">
                    <input name="search" id="search-input" type="text" placeholder="sections">
                    <button type="submit">Search</button>
               </form>
               @elseif ($type == 'services')
               <form id="form-search" method="GET">
                    <input name="search" id="search-input" type="text" placeholder="services">
                    <button type="submit">Search</button>
               </form>
               @elseif ($type == 'users')
               <form id="form-search" method="GET">
                    <input name="search" id="search-input" type="text" placeholder="users name, email">
                    <button type="submit">Search</button>
               </form>
          @endif
</header>
