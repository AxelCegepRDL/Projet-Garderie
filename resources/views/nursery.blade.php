@extends('app')

@section('content')
<h1 class="m-5">Liste des garderies</h1>
    <div class="container border border-info p-3 bg-">
        <div class="row row-cols-12">
            <div class="col col-2">Nom</div>
            <div class="col col-3">Adresse</div>
            <div class="col col-2">Ville</div>
            <div class="col">Province</div>
            <div class="col">Telephone</div>
            <div class="col"></div>
            <div class="col">
                <form action="{{route('Clear list nursery')}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input class="bg-danger border border-danger rounded text-white p-2" value="Vider la liste"
                        type="submit"></input>
                </form>
            </div>
        </div>
        @if ($nurseries->count() > 0)
            @foreach ($nurseries as $nursery)
                <div class="row row-cols-12 my-4">
                    <div class="col col-2">{{$nursery->name}}</div>
                    <div class="col col-3">{{$nursery->address}}</div>
                    <div class="col col-2">{{$nursery->city}}</div>
                    <div class="col">{{$nursery->state->description}}</div>
                    <div class="col">{{$nursery->phone}}</div>
                    <div class="col">
                        <form action="/garderies/{{$nursery->id}}/edit" method="get">
                            @csrf
                            <input class="bg-warning border border-warning rounded text-white p-2" value="Modifier"
                                type="submit"></input>
                        </form>
                    </div>
                    <div class="col">
                        <form action="/garderies/{{$nursery->id}}/delete" method="post">
                            @method('DELETE')
                            @csrf
                            <input class="bg-danger border border-danger rounded text-white p-2" value="Supprimer"
                                type="submit"></input>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col "><span>Aucune garderie...</span></div>
        @endif
    </div>
@endsection