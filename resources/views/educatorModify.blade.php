@extends('app')

@section('content')
    <h1 class="m-5">Modifier l'éducateur</h1>
    <div class="container">
        <form action="/Educator/{{ $educator->id }}/update" method="POST">
            @method('PUT')
            @csrf
            <div class="row my-1">
                <label for="firstName" class="col">Prénom</label>
                <input type="text" name="firstName" id="firstName" value="{{ $educator->firstName }}" class="col" disabled>
            </div>
            <div class="row my-1">
                <label for="lastName" class="col">Nom</label>
                <input type="text" name="lastName" id="lastName" value="{{ $educator->lastName }}" class="col" disabled>
            </div>
            <div class="row my-1">
                <label for="dateOfBirth" class="col">Date de naissance</label>
                <input type="text" name="dateOfBirth" id="dateOfBirth" value="{{ $educator->dateOfBirth }}" class="col"
                    disabled>
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
        <table class="table">
            <tr>
                <th class="text-info"><b>Garderie</b></th>
                <th class="text-info"><b>Date</b></th>
                <th class="text-info"><b>Nom enfant</b></th>
                <th class="text-info"><b>Prénom enfant</b></th>
                <th class="text-info"><b>Date naissance enfant</b></th>
                <th class="text-info"><b>Nom éducateur</b></th>
                <th class="text-info"><b>Prénom éducateur</b></th>
                <th class="text-info"><b>Date naissance éducateur</b></th>
            </tr>
            @if ($presences->count() > 0)
                @foreach ($presences as $p)
                    <tr>
                        <td>{{$p->nursery}}</td>
                        <td>{{$p->date}}</td>
                        <td>{{$p->childLastName}}</td>
                        <td>{{$p->childFirstName}}</td>
                        <td>{{$p->childBirthDate}}</td>
                        <td>{{$educator->lastName}}</td>
                        <td>{{$educator->firstName}}</td>
                        <td>{{$educator->dateOfBirth}}</td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="8"><em>Aucune présence à afficher pour cet éducateur</em></td></tr>
            @endif
        </table>
    </div>
@endsection
