@extends('app')

@section('content')
    <h1 class="m-5">Modifier la catégorie de dépense</h1>
    <div class="container">
        <form action="/ExpenseCategory/{{ $expenseCategory->id }}/update" method="POST">
            @method('PUT')
            @csrf
            <div class="row my-1">
                <label for="description" class="col">Déscription</label>
                <input type="text" name="description" id="description" placeholder="Déscription de la catégorie"
                    value="{{ $expenseCategory->description }}" class="col">
            </div>
            <div class="row my-1">
                <label for="percentage" class="col">Pourcentage</label>
                <input type="number" min="0" max="1" step="0.05" name="percentage" id="percentage"
                    value="{{ $expenseCategory->percentage }}" class="col">
            </div>
            <div class="row my-3">
                <input type="submit" value="Modifier">
            </div>
            <div class="row my-3">
                <input type="button" onclick="history.back();" value="Annuler" />
            </div>
        </form>
    </div>
    <h1 class="m-5">Liste des catégories de dépense</h1>
    <div class="container border border-info p-3">
        <div class="row row-cols-12">
            <div class="col col-5 text-info"><b>Description</b></div>
            <div class="col col-4 text-info"><b>Pourcentage</b></div>
        </div>
        @if ($expenseCategories->count() > 0)
            @foreach ($expenseCategories as $expenseCategory)
                <div class="row row-cols-12 my-4">
                    <div class="col col-5">{{$expenseCategory->description}}</div>
                    <div class="col col-4">{{$expenseCategory->percentage}}</div>
                </div>
            @endforeach
        @else
            <div class="col "><span>Aucune catégorie de dépense...</span></div>
        @endif
    </div>
@endsection