@extends('app')

@section('content')
    <h1 class="m-5">Modifier la garderie</h1>
    <div class="container">
        <form action="/garderies/{{ $nursery->id }}/update" method="POST">
            @method('PUT')
            @csrf
            <div class="row my-1">
                <label for="name" class="col">Nom</label>
                <input type="text" name="name" id="name" value="{{ $nursery->name }}" class="col">
            </div>
            <div class="row my-1">
                <label for="address" class="col">Adresse</label>
                <input type="text" name="address" id="address" value="{{ $nursery->address }}" class="col">
            </div>
            <div class="row my-1">
                <label for="city" class="col">Ville</label>
                <input type="text" name="city" id="city" value="{{ $nursery->city }}" class="col">
            </div>
            <div class="row my-1">
                <label for="state" class="col">Province</label>
                <select name="state_id" id="state" class="col">
                    @foreach($states as $state)
                        <option value="{{ $state->id }}" {{ $state->id == $nursery->state_id ? 'selected' : '' }}>
                            {{ $state->description }}
                        </option>
                    @endforeach

                </select>
            </div>
            <div class="row my-1">
                <label for="phone" class="col">Telephone</label>
                <input type="text" pattern="{0 - 9}" name="phone" id="phone" value="{{ $nursery->phone }}" class="col">
            </div>
            <div class="row my-3">
                <input type="submit" value="Modifier">
            </div>
        </form>
    </div>
@endsection