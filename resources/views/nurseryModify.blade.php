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
            <div class="row my-3">
                <input type="button" onclick="history.back();" value="Annuler" />
            </div>
        </form>
    </div>
    <h1 class="m-5">Liste des dépenses de cette garderie</h1>
    <div class="container border border-info p-3">
        <div class="row row-cols-12 text-info">
            <div class="col col-2"><b>DateTemps</b></div>
            <div class="col"><b>Montant</b></div>
            <div class="col col-2"><b>Montant admissible</b></div>
            <div class="col col-3"><b>Catégorie de dépense</b></div>
            <div class="col"><b>Commerce</b></div>
        </div>
        @if ($expenses->count() > 0)
            @foreach ($expenses as $expense)
                <div class="row row-cols-12 my-1">
                    <div class="col col-2">{{$expense->dateTime}}</div>
                    <div class="col">{{$expense->amount}}$</div>
                    <div class="col col-2">{{ $expense->eligibleAmount}}$</div>
                    <div class="col col-3">{{$expense->expenseCategory->description}}</div>
                    <div class="col">{{$expense->commerce->description}}</div>
                </div>
            @endforeach
        @else
            <div class="col "><span>Aucune dépense pour cette garderie...</span></div>
        @endif
    </div>
    </div>
@endsection