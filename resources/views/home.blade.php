<x-layout>
<x-head title="Presto.it"></x-head>
<header class="masthead" id="home-header">
    <div class="container-fluid h-100 ">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12 col-lg-6">
                <form action="{{ route('search') }}" method="GET">
                    <div id="search-bar" class="input-group p-4 mt-5">
                        <input type="text" class="form-control" name="q" placeholder="Cerca" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary bd-radius" type="submit" id="button-addon2">{{__('ui.search')}}</button>
                        </div>
                        <div class="col-12 d-flex align-items-center josefine-font py-3">
                            <h4 id="last-ads-title" class="font-weight-bold  text-white">{{__('ui.add?')}}
                                <a href="{{route('ads.form')}}" class="font-weight-bold  text-orange text-decoration-none ml-3">{{__('ui.click-here')}}</a>
                            </h4>   
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>
<section>
    {{-- Ultimi Annunci  --}}
    <main class="grad pb-5">
    <div class="container">
        <div class="row">
        <div id="last-ads-title" class="col-12 col-lg-6 offset-lg-3 mt-5">
            <h1 class="text-center font-weight-bold title-font text-white py-3">{{__('ui.last-ads')}}</h1>
            {{-- <hr class="line-white mb-5 w-75"> --}}
        </div>
        </div>
    </div>
    </main>
    <div class="container">
        <div class="row last-ads-box py-5 my-3">

            @foreach ($ads as $ad)
                @if ($ad->is_accepted)
                    <div class="col-12 col-md-6">
                        <h3 class="card-title text-center font-weight-bold text-dark">{{$ad->title}}</h3>
                        <div class="d-lg-flex">
                            <div class="col-12 col-lg-4 d-flex align-items-center my-4">
                                @foreach ($ad->images as $key=>$image)
                                @if($key == 0)
                                <div class="img-bt" style="background-image: url({{$image->getUrl(150 , 150)}})">
                                    {{-- <img src="{{$image->getUrl(150 , 150)}}" alt="..."> --}}
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <div class="col-12 col-lg-8 card card-style shadow my-4 my-4" style="max-width: 540px;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <a href="{{route('category.search', $ad->category)}}" class="category">
                                            <h5>{{$ad->category->name}}</h5>
                                        </a>
                                        <h4 class="ml-auto">{{$ad->price}} €</h4>
                                    </div>
                                    <p class="">{{$ad->preview($ad->description)}}</p>
                                    <div class="d-flex justify-content-between">
                                        <p class="">{{$ad->created_at->format('d-m-y')}}</p>
                                        <a href="{{$ad->url()}}" class="btn btn-info cat">{{__('ui.more')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if (Auth::user() && Auth::user()->is_revisor)
                        <div class="d-flex align-items-center justify-content-end">
                            <form action="{{ route('revisor.reject', $ad) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-danger mb-2">{{__('ui.bin')}}</button>
                            </form>
                        </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <span class="d-flex justify-content-center">{{$ads->links()}}</span>
</section>
<section class="bg-tr">
<div class="container pt-5" id="categorie">
    <div class="row justify-content-center mt-5 pt-5">
        <div id="category" class="col-12 text-center pt-5 mb-5 text-red title-font"><h1>{{__('ui.categories')}}</h1></div>
        @foreach ($categories as $key => $category)
            <div class="col-6 col-md-4 col-lg-3 my-3">
                <a href="{{route('category.search', $category)}}" class="text-light cat-link">
                    <div class="card bg-{{$c[$key]}} shadow">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <div class="text-center"><i class="{{$category->icon}} fa-2x"></i>
                                <h5 class="card-title mt-2">{{$category->name}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
</section>
<style>
.w-5{
    display: none;
}
</style>
@push('scripts')
<script>
    let category = document.querySelector('#last-ads')
    let navbar = document.querySelector('#navbar')

    window.addEventListener('scroll' , () => {
            // console.log('scemo chi legge');
            if(window.pageYOffset > 580){
                navbar.classList.add('grad')
                navbar.classList.remove('bg-blur')

            }else{
                navbar.classList.add('bg-blur')
                navbar.classList.remove('grad')
            }
    })
</script>
@endpush
</x-layout>
