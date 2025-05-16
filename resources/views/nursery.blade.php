@extends('app')

@section('content')
    <h1 class="m-5">Liste des garderies</h1>
    <div class="container border border-info p-3">
        <table class="table">
            <tr>
                <th class="text-info"><b>Nom</b></th>
                <th class="text-info"><b>Adresse</b></th>
                <th class="text-info"><b>Ville</b></th>
                <th class="text-info"><b>Province</b></th>
                <th class="text-info"><b>Telephone</b></th>
                <th></th>
                <th>
                    <form action="{{route('Clear list nursery')}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input class="btn btn-danger text-white" value="Vider la liste" type="submit"
                               onclick="return confirm('Êtes-vous sûr de vouloir vider la liste des garderies ?');"
                               @if($nurseries->count() == 0) disabled @endif></input>
                    </form>
                </th>
            </tr>
            @if ($nurseries->count() > 0)
                @foreach ($nurseries as $nursery)
                    <tr>
                        <td>{{$nursery->name}}</td>
                        <td>{{$nursery->address}}</td>
                        <td>{{$nursery->city}}</td>
                        <td>{{$nursery->state->description}}</td>
                        <td>{{$nursery->phone}}</td>
                        <td>
                            <form action="/garderies/{{$nursery->id}}/edit" method="get">
                                @csrf
                                <input class="btn btn-warning text-white" value="Modifier" type="submit"></input>
                            </form>
                        </td>
                        <td>
                            <form action="/garderies/{{$nursery->id}}/delete" method="post">
                                @method('DELETE')
                                @csrf
                                <input class="btn btn-danger text-white" value="Supprimer" type="submit"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette garderie ?');"></input>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="7"><em>Aucune garderie à afficher</em></td></tr>
            @endif
        </table>
    </div>
    <h1 class="m-5">Ajouter une garderie</h1>
    <div class="container">
        <form action="{{ route('Add a nursery') }}" method="POST">
            @csrf
            <div class="row my-1">
                <label for="name" class="col">Nom</label>
                <input type="text" name="name" id="name" class="col">
            </div>
            <div class="row my-1">
                <label for="address" class="col">Adresse</label>
                <input type="text" name="address" id="address" class="col">
            </div>
            <div class="row my-1">
                <label for="city" class="col">Ville</label>
                <input type="text" name="city" id="city" class="col">
            </div>
            <div class="row my-1">
                <label for="state" class="col">Province</label>
                <select name="state_id" id="state" class="col">
                    @foreach ($states as $state)
                        <option value="{{$state->id}}">{{$state->description}}</option>
                    @endforeach

                </select>
            </div>
            <div class="row my-1">
                <label for="phone" class="col">Telephone</label>
                <input type="text" pattern="{0 - 9}" name="phone" id="phone" class="col">
            </div>
            <div class="row my-3 justify-content-center">
                <input class="btn btn-success w-auto" type="submit" value="Ajouter">
            </div>
        </form>
    </div>
@endsection
