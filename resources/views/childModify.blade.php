@extends('app')

@section('content')
    <h1 class="m-5">Modifier l'enfant</h1>
    <div class="container">
        <form action="/child/{{ $child->id }}/update" method="POST">
            @method('PUT')
            @csrf
            <div class="row my-1">
                <label for="lastName" class="col">Nom</label>
                <input type="text" value="{{ $child->lastName }}" name="lastName" id="lastName" class="col" disabled>
            </div>
            <div class="row my-1">
                <label for="firstName" class="col">Prénom</label>
                <input type="text" value="{{ $child->firstName }}" name="firstName" id="firstName" class="col" disabled>
            </div>
            <div class="row my-1">
                <label for="dateOfBirth" class="col">Date de naissance</label>
                <input type="date" value="{{ $child->dateOfBirth }}" name="dateOfBirth" id="dateOfBirth" class="col" disabled>
            </div>
            <div class="row my-1">
                <label for="address" class="col">Adresse</label>
                <input type="text" value="{{ $child->address }}" name="address" id="address" class="col" required>
            </div>
            <div class="row my-1">
                <label for="city" class="col">Ville</label>
                <input type="text" value="{{ $child->city }}" name="city" id="city" class="col" required>
            </div>
            <div class="row my-1">
                <label for="state" class="col">Province</label>
                <select name="state_id" id="state" class="col" required>
                    @foreach ($states as $state)
                        @if($child->state->id == $state->id)
                            <option value="{{$state->id}}" selected>{{$state->description}}</option>
                        @else
                            <option value="{{$state->id}}">{{$state->description}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="row my-1">
                <label for="phone" class="col">Téléphone</label>
                <input type="text" value="{{ $child->phone }}" pattern="{0 - 9}" name="phone" id="phone" class="col" required>
            </div>
            <div class="row my-3">
                <input type="submit" value="Modifier">
            </div>
            <div class="row my-3">
                <input type="button" onclick="history.back();" value="Annuler" />
            </div>
        </form>
    </div>
@endsection
