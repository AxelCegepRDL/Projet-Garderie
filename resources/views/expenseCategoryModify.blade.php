@extends('app')

@section('content')
    <h1 class="m-5">Modifier la catégorie de dépense</h1>
    <div class="container">
        <form action="/ExpenseCategory/{{ $expenseCategory->id }}/update" method="POST">
            @method('PUT')
            @csrf
            <div class="row my-1">
                <label for="description" class="col">Description</label>
                <input type="text" name="description" id="description" placeholder="Déscription de la catégorie"
                    value="{{ $expenseCategory->description }}" class="col">
            </div>
            <div class="row my-1">
                <label for="percentage" class="col">Pourcentage (en %)</label>
                <input type="number" min="0" max="100" step="1" name="percentage" id="percentage"
                    value="{{ $expenseCategory->percentage*100 }}" class="col">
            </div>
            <div class="row my-3">
                <input type="submit" value="Modifier">
            </div>
            <div class="row my-3">
                <input type="button" onclick="history.back();" value="Annuler" />
            </div>
        </form>
    </div>
    <h1 class="m-5">Liste des dépenses de cette catégorie</h1>
    <div class="container border border-info p-3">
        <div class="row row-cols-12 my-4">
            <div class="col col text-info"><b>Garderie</b></div>
            <div class="col col-2 text-info"><b>DateTemps</b></div>
            <div class="col text-info"><b>Montant</b></div>
            <div class="col col-2 text-info"><b>Montant admissible</b></div>
            <div class="col col-3 text-info"><b>Catégorie de dépense</b></div>
            <div class="col text-info"><b>Commerce</b></div>
            <div class="col text-info"></div>
        </div>
        @if ($expenses->count() > 0)
            @foreach ($expenses as $expense)
                <div class="row row-cols-12 my-4">
                    <div class="col col">{{$expense->nursery->name}}</div>
                    <div class="col col-2">{{$expense->dateTime}}</div>
                    <div class="col">{{ number_format($expense->amount, 2, ",", " ") }} $</div>
                    <div class="col col-2">{{ number_format($expense->eligibleAmount, 2, ",", " ") }} $</div>
                    <div class="col col-3">{{$expense->expenseCategory->description}}</div>
                    <div class="col">{{$expense->commerce->description}}</div>
                    <div class="col"></div>
                </div>
            @endforeach
        @else
            <div class="col "><span>Aucune dépense pour cette catégorie...</span></div>
        @endif
    </div>
@endsection
