<x-layout>
<x-head title="Home Revisor"/>
<section id="section" style="min-height: 800px">
  <div class="container-fluid">
    <div class="row justify-content-center">
      @if ($ad)
      <div class="col-12 col-lg-8">
        
        @if (session('status'))
        <div id="thankyou" class="alert alert-success text-center">
          {{ session('status') }}
        </div>
        @endif
      </div>
    </div>
    
    <div class="row mt-2">
      <div class="col-12 col-lg-7 mb-5 py-4">
        <h2 class="text-center title-font text-red mb-2">{{__('ui.to-be-revised')}}</h2>
        <hr>
        
        @foreach ($ad->images as $image)
        <div class="col-12" >
          <div>
            <img class="d-block img-fluid" src="{{$image->getUrl(500 , 400)}}" alt="First slide">
          </div>           
          <div class="lead">
            Adult : {{ $image->adult }}
            violence : {{ $image->violence }}
            spoof : {{ $image->spoof }}
            racy : {{ $image->racy }}
            medical : {{ $image->medical }}
            <br><hr>
            <p>Label</p>
            <ul>
              @if ($image->labels)
                @foreach ($image->labels as $label)
                    <li>{{$label}}</li>
                @endforeach   
              @endif
            </ul>
          </div>
          </div>
          @endforeach
              
        
          <hr>
          <h2 class="text-center mb-4">{{$ad->title}}</h2>
          <p class="lead">{{__('ui.category')}} : {{$ad->category->name}}</p>
          <p class="lead">{{__('ui.created-by')}} : {{$ad->user->name}}</p>
          <h4 class=""> {{__('ui.price')}}: € {{$ad->price}}</h4>
          <p class="lead text-custom">{{$ad->description}}</p>
        <div class="d-flex justify-content-between">
          
          <!-- Button rifiuta -->
          <button type="button" class="btn btn-danger lead btn-lg" data-toggle="modal" data-target="#rifiuta">
            {{__('ui.refuse')}}
          </button>
          <!-- Button accetta -->
          <button type="button" class="btn btn-success lead btn-lg" data-toggle="modal" data-target="#accetta">
            {{__('ui.accept')}}
          </button>
        </div>
      </div>


    <!-- Modal rifiuta annuncio -->
    <div class="modal fade" id="rifiuta" tabindex="-1" aria-labelledby="rifiuta" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rifiuta">{{__('ui.sure?')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('ui.cancel')}}</button>
            <form action="{{ route('revisor.reject', $ad) }}" method="POST">
                @method('PUT')
                @csrf
                <button type="submit" class="btn btn-danger">{{__('ui.bin')}}</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  <!-- Modal accetta annuncio -->
  <div class="modal fade" id="accetta" tabindex="-1" aria-labelledby="accetta" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="accetta">{{__('ui.sure-save')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('ui.cancel')}}</button>
          <form action="{{ route('revisor.accept', $ad) }}" method="POST">
            @method('PUT')
            @csrf
          <button type="submit" class="btn btn-success">{{__('ui.save')}}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
    @else

    <div class="col-12 col-lg-6">
      <h1 class="title-font text-red mt-5">{{__('ui.no-announcements-left')}}</h1>
      <img src="/img/rev.png" class="img-fluid" alt="">
    </div>
   
    @endif

    {{-- Cestino --}}
    <div class="col-12 col-lg-4 offset-lg-1 mb-5 restore-section border-custom py-4">
       
      @if (session('status'))
      <div id="thankyou" class="alert alert-success text-center">
        {{ session('status') }}
      </div>
      @endif
      @if($trash)
      <h2 class="text-center">{{__('ui.recently-deleted')}}</h2>
      <hr>
      @foreach ($trash as $t)
        <h4 class="card-title text-center">{{$t->title}}</h4>
        <div class="card shadow p-2" style="max-width: 540px;">
          <div class="row no-gutters">
            <div class="col-lg-4 d-flex align-items-center">
              @foreach ($t->images as $key=>$image)
              @if($key == 0)
              <img src="{{$image->getUrl(150 , 150)}}"  alt="...">
              @endif
              @endforeach
            </div>
            <div class="col-lg-8">
              <div class="card-body py-1 px-3">
                <div class="d-flex">
                  <a href="{{route('category.search', $t->category)}}" class="category"><h4>{{$t->category->name}}</h4></a>
                  <h4 class="ml-auto">{{$t->price}} € </h4>
                </div>
                <p>{{$t->preview($t->description)}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-around">
          <form action="{{route('revisor.undo', $t)}}" method="POST">
            @method('PUT')
            @csrf
              <button type="submit" class="btn btn-primary my-3">{{__('ui.undo')}}</button>
          </form>
          <form action="{{route('revisor.delete', $t)}}" method="POST">
            @method('delete')
            @csrf
              <button type="submit" class="btn btn-danger my-3">{{__('ui.delete')}}</button>
          </form>
        </div>
      @endforeach
      @endif
    </div>
  </div>
  </section>
</x-layout>
