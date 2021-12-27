<nav id="navbar" class="navbar-dark navbar-expand-lg grad fixed-top">
<div class="container-fluid">
    <div class="row align-items-center px-5">
        <a id="presto" class="navbar-brand font-weight-bold josefine-font" href="{{ url('/') }}">
            <img src="/img/pacco.ico" style="height: 60px" class="img-fluid" alt="">
            Presto
        </a>
       
        <ul class="navbar-nav ml-auto d-none d-lg-flex">
            <li class="nav-item">
                <x-locale
                    lang="it"
                    nation="it"
                />
            </li>
            <li class="nav-item">
                <x-locale
                    lang="en"
                    nation="gb"
                />
            </li>
            <li class="nav-item">
                <x-locale
                    lang="es"
                    nation="es"
                />
            </li>
            <li class="nav-item">
                <x-locale
                    lang="cn"
                    nation="cn"
                />
            </li>
        </ul>
        <a id="nav-btn" class="d-none d-lg-block ml-4" type="button" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="">
            <i id="i" class="fas fa-bars fa-2x text-white"></i>
        </a>


        {{-- Mobile --}}
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse" id="navbarSupportedContent">
           
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link cat font-weight-bold" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link cat font-weight-bold" href="{{ route('register') }}">{{ __('ui.register') }}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link cat font-weight-bold" href="{{route('ads.form')}}">{{__('ui.new-ad')}}</a>
                    </li>
                @else
                @if (Auth::user()->is_revisor)
                    <li class="nav-item">
                        <a class="nav-link cat font-weight-bold" href="{{ route('revisor.home') }}">{{__('ui.to-be-revised')}}</a>
                    </li>
                @endif
                @if (Auth::user()->is_admin)
                <li class="nav-item">
                    <a class="nav-link cat font-weight-bold" href="{{ route('admin.panel') }}">{{__('ui.admin')}}</a>
                </li>
                @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link cat dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            {{-- <a class="dropdown-item" href="{{ route('profile') }}">Profilo</a> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cat font-weight-bold" href="{{route('ads.form')}}">{{__('ui.new-ad')}}</a>
                    </li>
                    @if (!Auth::user()->is_revisor)
                    <li class="nav-item">
                        <a class="nav-link  font-weight-bold" href="{{route('revisor.form')}}">{{__('ui.become-revisor')}}</a>
                    </li>      
                    @endif
                @endguest
                <li class="nav-item">
                    <x-locale
                        lang="it"
                        nation="it"
                    />
                </li>
                <li class="nav-item">
                    <x-locale
                        lang="en"
                        nation="gb"
                    />
                </li>
                <li class="nav-item">
                    <x-locale
                        lang="es"
                        nation="es"
                    />
                </li>
                <li class="nav-item">
                    <x-locale
                        lang="cn"
                        nation="cn"
                    />
                </li>
                <li class="nav-item">
                    <a class="nav-link cat font-weight-bold d-lg-none" href="{{Route::currentRouteName()=='home' ? '#categorie' : route('home', '#categorie')}} ">Categorie</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row  justify-content-center d-none d-lg-flex text-nowrap">
    @foreach ($categories as $category)
        <div class="navbar-category">
            <a href="{{route('category.search', $category)}}" class="nav-link cat text-center text-decoration-none  font-weight-bold"><i class="{{$category->icon}}"></i> {{$category->name}}</a>
        </div>
    @endforeach    
    </div>
</div>
    
</nav>

<div id="navbarMenu" class="col-md-3 bg-blur d-none">
    <ul class="navbar-nav ml-auto">
                
        <!-- Authentication Links -->
        @guest
            @if (Route::has('login'))
                <li class="nav-item d-flex">
                    <a class="nav-link cat josefine-font lead" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item d-flex">
                    <a class="nav-link  cat josefine-font lead" href="{{ route('register') }}">{{ __('ui.register') }}</a>
                </li>
            @endif
            <li class="nav-item d-flex">
                <a class="nav-link  cat josefine-font lead" href="{{route('ads.form')}}">{{__('ui.new-ad')}}</a>
            </li>
        @else
        @if (Auth::user()->is_revisor)
            <li class="nav-item d-flex">
                <a class="nav-link  cat josefine-font lead" href="{{ route('revisor.home') }}">{{__('ui.to-be-revised')}}</a>
            </li>
        @endif
        @if (Auth::user()->is_admin)
        <li class="nav-item d-flex">
            <a class="nav-link  cat josefine-font lead" href="{{ route('admin.panel') }}">{{__('ui.admin')}}</a>
        </li>
        @endif
            <li class="nav-item d-flex dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-decoration-none cat josefine-font lead" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off"></i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            <li class="nav-item d-flex">
                <a class="nav-link text-decoration-none cat josefine-font lead" href="{{route('ads.form')}}">{{__('ui.new-ad')}}</a>
            </li>
            <li class="nav-item d-flex">
                <a class="nav-link text-decoration-none cat josefine-font lead" href="{{route('revisor.form')}}">{{__('ui.become-revisor')}}</a>
            </li>  
            <li>
                <a class="nav-link text-decoration-none cat josefine-font lead" href="{{route('user.profile')}}">Profilo</a>
            </li>
        @endguest
        <li class="nav-item d-flex">
            <a class="nav-link text-decoration-none cat josefine-font lead d-lg-none" href="{{Route::currentRouteName()=='home' ? '#categorie' : route('home', '#categorie')}} ">Categorie</a>
        </li>
    </ul>
</div>