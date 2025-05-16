@extends('app')

@section('content')
    <h1 class="m-5">Liste des éducateur</h1>
    <div class="container border border-info p-3">
        <table class="table">
            <tr>
                <th class="text-info">Nom</th>
                <th class="text-info">Prénom</th>
                <th class="text-info">Date de naissance</th>
                <th class="text-info">Adresse</th>
                <th class="text-info">Ville</th>
                <th class="text-info">Province</th>
                <th class="text-info">Téléphone</th>
                <th></th>
                <th>
                    <form action="{{route('Clear list educator')}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input class="btn btn-danger text-white" value="Vider la liste" type="submit"
                               onclick="alert('Êtes-vous sûr de vouloir vider la liste des éducateurs ?');"
                               @if($educators->count() == 0) disabled @endif></input>
                    </form>
                </th>
            </tr>
            @if ($educators->count() > 0)
                @foreach ($educators as $educator)
                    <tr>
                        <td>{{$educator->lastName}}</td>
                        <td>{{$educator->firstName}}</td>
                        <td>{{$educator->dateOfBirth}}</td>
                        <td>{{$educator->address}}</td>
                        <td>{{$educator->city}}</td>
                        <td>{{$educator->state->description}}</td>
                        <td>{{$educator->phone}}</td>
                        <td>
                            <form action="/Educator/{{$educator->id}}/edit" method="get">
                                @csrf
                                <input class="btn btn-warning text-white" value="Modifier" type="submit"></input>
                            </form>
                        </td>
                        <td>
                            <form action="/Educator/{{$educator->id}}/delete" method="post">
                                @method('DELETE')
                                @csrf
                                <input class="btn btn-danger text-white" value="Supprimer" type="submit"
                                       onclick="alert('Êtes-vous sûr de vouloir supprimer cet éducateur ?');"></input>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="9"><em>Aucun éducateur à afficher</em></td></tr>
            @endif
        </table>
    </div>
    <h1 class="m-5">Ajouter un éducateur</h1>
    <div class="container">
        <form action="{{ route('Add an educator') }}" method="POST">
            @csrf
            <div class="row my-1">
                <label for="firstName" class="col">Prénom</label>
                <input type="text" name="firstName" id="firstName" class="col">
            </div>
            <div class="row my-1">
                <label for="lastName" class="col">Nom</label>
                <input type="text" name="lastName" id="lastName" class="col">
            </div>
            <div class="row my-1">
                <label for="dateOfBirth" class="col">Date de naissance</label>
                <input type="date" name="dateOfBirth" id="dateOfBirth" class="col">
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
            <div class="row my-3">
                <input type="submit" value="Ajouter">
            </div>
        </form>
    </div>
@endsection
