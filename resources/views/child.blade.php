@extends('app')

@section('content')
    <style>
        td>form{
            display: inline-block;
        }
    </style>
    <h1 class="m-5">Liste des enfants</h1>
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
                    <form action="{{route('child.clear')}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input class="btn btn-danger text-white" value="Vider la liste" type="submit"
                            onclick="comfirm('Êtes-vous sûr de vouloir vider la liste des enfants ?');"
                            @if($children->count() == 0) disabled @endif ></input>
                    </form>
            </th>
        </tr>
        @if($children->count() > 0)
            @foreach($children as $child)
                <tr>
                    <td>{{$child->lastName}}</td>
                    <td>{{$child->firstName}}</td>
                    <td>{{$child->dateOfBirth}}</td>
                    <td>{{$child->address}}</td>
                    <td>{{$child->city}}</td>
                    <td>{{$child->state->description}}</td>
                    <td>{{$child->phone}}</td>
                    <td>
                        <form action="/child/{{$child->id}}/edit" method="get">
                            @csrf
                            <input class="btn btn-warning text-white" value="Modifier" type="submit"></input>
                        </form></td>
                    <td>
                        <form action="/child/{{$child->id}}/delete" method="post">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger text-white" value="Supprimer" type="submit"
                                onclick="confirm('Êtes-vous sûr de vouloir supprimer cet enfant ?');"></input>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="9"><em>Aucun enfant à afficher</em></td></tr>
        @endif
        </table>
    </div>
    <h1 class="m-5">Ajouter un enfant</h1>
    <div class="container">
        <form action="{{ route('child.add') }}" method="POST">
            @csrf
            <div class="row my-1">
                <label for="lastName" class="col">Nom</label>
                <input type="text" name="lastName" id="lastName" class="col">
            </div>
            <div class="row my-1">
                <label for="firstName" class="col">Prénom</label>
                <input type="text" name="firstName" id="firstName" class="col">
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
                <label for="phone" class="col">Téléphone</label>
                <input type="text" pattern="{0 - 9}" name="phone" id="phone" class="col">
            </div>
            <div class="row my-3">
                <input type="submit" value="Ajouter">
            </div>
        </form>
    </div>
@endsection
