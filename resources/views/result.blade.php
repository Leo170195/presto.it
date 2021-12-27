<x-layout>
    <x-head title="speriamo"></x-head>
    <section id="section">
        <div class="container">
                <h1 class="font-weight-bold title-font text-red">{{__('ui.results-for')}} : {{  $q }}</h1>
            <div class="row">
                @foreach ($ads as $ad)
                    <div class="col-12 col-md-6  my-4">
                        <h3 class="card-title text-center font-weight-bold">{{$ad->title}}</h3>
                        <div class="card shadow p-2" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-lg-4 d-flex align-items-center">
                                    @foreach ($ad->images as $key=>$image)
                                @if($key == 0)
                                <div class="img-bt" style="background-image: url({{$image->getUrl(150 , 150)}})">
                                   
                                </div>
                                @endif
                                @endforeach
                                </div>
                                <div class="col-lg-8">
                                    <div class="card-body py-1 px-3">
                                        <div class="d-flex">
                                            <a href="{{route('category.search', $ad->category)}}" class="category"><h4>{{$ad->category->name}}</h4></a>
                                            <h4 class="ml-auto">{{$ad->price}} € </h4>
                                        </div>
                                            <h4 class="my-4">{{$ad->preview($ad->description)}}</h4>
                                        <div class="d-flex align-items-center">
                                            <a href="{{$ad->url()}}" class="btn btn-primary">Scopri di più</a>
                                            <h5 class="ml-auto">{{$ad->created_at->format('d-m-y')}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>
