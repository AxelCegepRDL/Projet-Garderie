@extends('app')

@section('content')
    <h1 class="m-5">Modifier l'éducateur</h1>
    <div class="container">
        <form action="/Educator/{{ $educator->id }}/update" method="POST">
            @method('PUT')
            @csrf
            <div class="row my-1">
                <label for="firstName" class="col">Prénom</label>
                <input type="text" name="firstName" id="firstName" value="{{ $educator->firstName }}" class="col" readonly>
            </div>
            <div class="row my-1">
                <label for="lastName" class="col">Nom</label>
                <input type="text" name="lastName" id="lastName" value="{{ $educator->lastName }}" class="col" readonly>
            </div>
            <div class="row my-1">
                <label for="dateOfBirth" class="col">Date de naissance</label>
                <input type="text" name="dateOfBirth" id="dateOfBirth" value="{{ $educator->dateOfBirth }}" class="col"
                    readonly>
            </div>
            <div class="row my-1">
                <label for="address" class="col">Adresse</label>
                <input type="text" name="address" id="address" value="{{ $educator->address }}" class="col">
            </div>
            <div class="row my-1">
                <label for="city" class="col">Ville</label>
                <input type="text" name="city" id="city" value="{{ $educator->city }}" class="col">
            </div>
            <div class="row my-1">
                <label for="state" class="col">Province</label>
                <select name="state_id" id="state" class="col">
                    @foreach($states as $state)
                        <option value="{{ $state->id }}" {{ $state->id == $educator->state_id ? 'selected' : '' }}>
                            {{ $state->description }}
                        </option>
                    @endforeach

                </select>
            </div>
            <div class="row my-1">
                <label for="phone" class="col">Telephone</label>
                <input type="text" pattern="{0 - 9}" name="phone" id="phone" value="{{ $educator->phone }}" class="col">
            </div>
            <div class="row my-3">
                <input type="submit" value="Modifier">
            </div>
            <div class="row my-3">
                <input type="button" onclick="history.back();" value="Annuler" />
            </div>
        </form>
    </div>
    <h1 class="m-5">Liste des des présence de cet éducateur</h1>
    <div class="container border border-info p-3">
        <div class="row row-cols-12 my-4">
            <div class="col col-2 text-info"><b>Garderie</b></div>
            <div class="col col-2 text-info"><b>Date</b></div>
            <div class="col text-info"><b>Nom enfant</b></div>
            <div class="col text-info"><b>Prénom enfant</b></div>
            <div class="col col-2 text-info"><b>Date naissance enfant</b></div>
            <div class="col text-info"><b>Nom éducateur</b></div>
            <div class="col text-info"><b>Prénom éducateur</b></div>
            <div class="col col-2 text-info"><b>Date naissance éducateur</b></div>
        </div>
        @if ($presences->count() > 0)
            @foreach ($presences as $p)
                <div class="row row-cols-12 my-4">
                    <div class="col col-2">{{$p->nursery}}</div>
                    <div class="col col-2">{{$p->date}}</div>
                    <div class="col">{{$p->childLastName}}</div>
                    <div class="col">{{$p->childFirstName}}</div>
                    <div class="col col-2">{{$p->childBirthDate}}</div>
                    <div class="col">{{$educator->lastName}}</div>
                    <div class="col">{{$educator->firstName}}</div>
                    <div class="col col-2">{{$educator->dateOfBirth}}</div>
                </div>
            @endforeach
        @else
            <div class="col "><span>Aucune présence pour cet éducateur...</span></div>
        @endif
    </div>
@endsection