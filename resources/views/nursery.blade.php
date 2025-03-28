@extends('app')

@section('content')
    <div class="border border-info m-3 p-4">
        <div class="row row-cols-10">
            <div class="col col-2">Nom</div>
            <div class="col col-3">Adresse</div>
            <div class="col">Ville</div>
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
            <div class="row row-cols-10 my-4">
                <div class="col col-2">{{$nursery->name}}</div>
                <div class="col col-3">{{$nursery->address}}</div>
                    <div class="col">{{$nursery->city}}</div>
                    <div class="col">{{$nursery->state->description}}</div>
                    <div class="col">{{$nursery->phone}}</div>
                    <div class="col">
                        <form action="/garderies/{{$nursery->id}}/edit" method="get">
                            @csrf
                            <input class="bg-warning border border-warning rounded text-white p-2" value="Modifier"
                                type="submit"></input>
                        </form>
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
    <form class="p-3" action="/garderies/add" method="post">
        @csrf
        <table>
            <tr>
                <td><label for="name">Nom :</label></td>
                <td><input type="text" name="name" id="name"></td>
            </tr>
            <tr>
                <td><label for="address">Adresse :</label></td>
                <td><input type="text" name="address" id="address"></td>
            </tr>
            <tr>
                <td><label for="city">Ville :</label></td>
                <td><input type="text" name="city" id="city"></td>
            </tr>
            <tr>
                <td><label for="state_id">Province :</label></td>
                <td><select name="state_id" id="state_id">
                    @foreach ($states as $state)
                        <option value="{{$state->id}}">{{$state->description}}</option>
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <td><label for="phone">Téléphone :</label></td>
                <td><input type="text" name="phone" id="phone"></td>
            </tr>
            <tr>
                <td></td>
                <td><button class="bg-success border border-success rounded text-white p-2" type="submit">Créer</button></td>
            </tr>
        </table>
    </form>
@endsection
