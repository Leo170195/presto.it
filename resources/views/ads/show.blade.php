<x-layout>
<x-head title="{{$ad->title}}"></x-head>
<section id="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($ad->images as $image)

                            <div class="carousel-item {{ $loop->first ? 'active' : ''}} ">
                            <img class="d-block h-100" src="{{$image->getUrl(500 , 400)}}" alt="First slide">
                            </div>

                        @endforeach
                    </div>
                    <a class="carousel-control-prev text-dark" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next text-dark" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
            </div>
            <div class="col-12 col-md-6">
                <h2 class="text-center mb-4">{{$ad->title}}</h2>
                <hr>
                <p class="lead">{{__('ui.category')}} : {{$ad->category->name}}</p>
                <p class="lead">{{__('ui.created-by')}} : {{$ad->user->name}}</p>
                <div class="d-flex">
                <h4 class="">{{__('ui.price')}}: € {{$ad->price}}</h4>
                </div>
            </div>
            <div class="col-12 mt-4">
                <hr>
                <p class="lead text-custom">{{$ad->description}}</p>
            </div>
        </div>
    </div>
</section>
</x-layout>
