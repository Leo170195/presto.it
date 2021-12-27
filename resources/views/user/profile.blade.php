<x-layout>
    <x-head title="Presto.it"></x-head>
    <header id="profile-page">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 col-md-6 mt-5">
                    <img src="img/sfondo.jpg" alt="" class="img-fluid">
                </div>
                <div id="welcome-box" class="col-12 col-md-6 py-5 pl-5 mt-5">
                    <div>
                    <h2 class="text-purple">Ciao, {{$user->name}} !</h2>
                    <p class="text-purple">Cosa vuoi fare oggi?</p>
                    </div>
                        
                    <a href="#ultimi-annunci" class="btn btn-warning font-weight-bold d-block my-4 w-50">I tuoi annunci</a>
                    <a href="{{route('home', '#categories')}}" class="btn btn-warning font-weight-bold d-block my-4 w-50">Categorie</a>
                </div>
            </div>
        </div>
    </header>
    <section id="ultimi-annunci" class="py-5 mt-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div id="search-bar" class="col-12 col-lg-6  py-5 my-2">
                    @foreach ($ads as $ad)
                    @if (!$ad->is_accepted)
                        <h3 class="text-danger">Annuncio da revisionare</h3>
                    @endif
                        <h2 class="text-white">{{$ad->title}}</h2>  
                        <div class="d-flex">
                            <div class="col-6">
                            @foreach ($ad->images as $image)    
                                <img src="{{$image->getUrl(150 , 150)}}" alt="">
                            @endforeach
                            </div>
                            <div class="col-6">
                                <p class="text-white lead">{{$ad->description}}</p>
                                <p class="text-white lead">{{$ad->created_at->format('d-m-y')}}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between my-4">
                            <a href="{{$ad->url()}}" class="btn btn-info cat">{{__('ui.details')}}</a>

                            <form action="{{route('revisor.delete', $ad)}}" method="POST">
                                @method('delete')
                                @csrf
                                  <button type="submit" class="btn btn-danger my-3">{{__('ui.delete')}}</button>
                            </form>                     
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <span class="d-flex justify-content-center">{{$ads->links()}}</span>
    </section>
    
    @push('scripts')
    <script>
        let category = document.querySelector('#last-ads')
        let navbar = document.querySelector('#navbar')
        let presto = document.querySelector('#presto')
        let btn = document.querySelector('#nav-btn')
        let i = document.querySelector('#i')
        presto.classList.add('cat')
        btn.classList.add('cat')
        i.classList.remove('text-white')

        window.addEventListener('scroll' , () => {
                // console.log('scemo chi legge');
                if(window.pageYOffset > 580){
                    navbar.classList.add('grad')
                    navbar.classList.remove('bg-blur')
                    presto.classList.remove('cat')
                    btn.classList.remove('cat')
                    i.classList.add('text-white')

                }else{
                    navbar.classList.add('bg-blur')
                    navbar.classList.remove('grad')
                    presto.classList.add('cat')
                    btn.classList.add('cat')
                    i.classList.remove('text-white')

                }
        })
    </script>
    @endpush
</x-layout>