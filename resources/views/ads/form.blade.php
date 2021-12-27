<x-layout>
    <x-head title="Homepage"></x-head>
    <section id="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 mb-4">
                @if (session('status'))
                    <div id="thankyou" class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @endif
                    <h1 class="text-center">{{__('ui.ad-here')}}</h1>
                </div>

                <div class="col-12 col-md-4">
                    <form action="{{route('ads.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div>
                            <label class="mt-3" for="title"><h4>{{__('ui.title')}}</h4></label>
                        <input class="form-control my-2" type="text" name="title" value="{{old('title')}}">
                        </div>
                        <div>
                            <label  class="mt-3" for="description"><h4>{{__('ui.description')}}</h4></label>
                            <textarea class="form-control my-2 custom-size" name="description" cols="30" rows="10">{{old('description')}}</textarea>
                        </div>
                        <label  class="mt-3" for="name"><h4>{{__('ui.category')}}</h4></label>
                        <select class="my-2 form-control" name="name">
                            @foreach ($categories as $category)

                            <option class="lead" value="{{$category->id}}"> {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div>
                            <label class="mt-3" for="price"><h4>{{__('ui.price')}}</h4></label>
                            <input class="form-control my-2" type="number" name="price" value="{{old('price')}}">
                        </div>
                     
                        <button type="submit" class="btn font-weight-bold mt-3 btn-success">{{__('ui.submit')}}</button>
                    </form>
                    
                </div>
                <div class="col-12 col-md-8 d-flex ">
                    <img src="/img/Take_a_Survey.png" class="img-fluid" alt="sfondo">
                </div>

            </div>
        </div>
    </section>
 
</x-layout>
