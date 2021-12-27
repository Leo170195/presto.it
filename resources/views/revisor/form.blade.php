<x-layout>
    <x-head title="Candidatura revisore" />
    <section id="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session('status'))
                        <div id="thankyou" class="alert alert-success text-center">
                            {{ session('status') }}
                        </div>
                    @endif
                        <h1 class="text-center">{{__('ui.application-submit')}}</h1>
                <div class="col-12 form-img d-flex justify-content-center">
                    <form action="{{route('revisor.submit')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn font-weight-bold mt-3 px-4 py-2 btn-success">{{__('ui.apply')}}</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>


