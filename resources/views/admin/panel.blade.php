<x-layout>
    <x-head title="Pannello admin" />
    <div id="section" class="container mt-5">
        <div class="row ">
            <div class="col-12">
                <h1  class="py-5 text-center mt-5">Tabella utenti registrati</h1>
                <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Revisor</th>
                      </tr>
                    </thead>
                    @foreach ($users as $user)
                    <tbody>
                      <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @if ($user->is_revisor)
                            <td>
                                <form action="{{route('revisor.remove' , $user)}}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Remove</button>    
                                </form>
                            </td>
                        @else
                        <td>
                            <form action="{{route('revisor.set' , $user)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-success">promuovi</button>    
                            </form>
                        </td>
                        @endif
                      </tr>
                    </tbody>
                    @endforeach
                  </table>
            </div>
        </div>
    </div>
</x-layout>