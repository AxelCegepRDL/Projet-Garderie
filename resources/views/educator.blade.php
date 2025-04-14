@extends('app')

@section('content')
    <h1 class="m-5">Liste des éducateur</h1>
    <div class="container border border-info p-3">
        <div class="row row-cols-12">
            <div class="col col-1 text-info"><b>Prénom</b></div>
            <div class="col text-info"><b>Nom</b></div>
            <div class="col text-info"><b>Date de naissance</b></div>
            <div class="col col-2 text-info"><b>Adresse</b></div>
            <div class="col col-2 text-info"><b>Ville</b></div>
            <div class="col text-info"><b>Province</b></div>
            <div class="col text-info"><b>Telephone</b></div>
            <div class="col"></div>
            <div class="col">
                <form action="{{route('Clear list educator')}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input class="btn btn-danger text-white" value="Vider la liste" type="submit"
                        onclick="alert('Êtes-vous sûr de vouloir vider la liste des éducateurs ?');"></input>
                </form>
            </div>
        </div>
        @if ($nurseries->count() > 0)
            @foreach ($educators as $educator)
                <div class="row row-cols-12 my-4">
                    <div class="col">{{$educator->firstName}}</div>
                    <div class="col">{{$educator->lastName}}</div>
                    <div class="col">{{ $educator->dateOfBirth }}</div>
                    <div class="col col-2">{{$educator->address}}</div>
                    <div class="col col-2">{{$educator->city}}</div>
                    <div class="col">{{$educator->state->description}}</div>
                    <div class="col">{{$educator->phone}}</div>
                    <div class="col">
                        <form action="/Educator/{{$educator->id}}/edit" method="get">
                            @csrf
                            <input class="btn btn-warning text-white" value="Modifier" type="submit"></input>
                        </form>
                    </div>
                    <div class="col">
                        <form action="/Educator/{{$educator->id}}/delete" method="post">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger text-white" value="Supprimer" type="submit"
                                onclick="alert('Êtes-vous sûr de vouloir supprimer cet éducateur ?');"></input>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col "><span>Aucun éducateur...</span></div>
        @endif
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