@extends('app')

@section('content')
    <h1 class="m-5">Modifier la dépense</h1>
    <div class="container">
        <form action="/Expenses/{{ $expense->id }}/update" method="POST">
            @method('PUT')
            @csrf
            <div class="row my-1">
                <label for="amount" class="col">Montant</label>
                <input type="number" value="{{ $expense->amount }}" step="0.5" name="amount" id="amount" class="col"
                    required>
            </div>
            <div class="row my-1">
                <label for="expense_category_id" class="col">Catégorie de dépense</label>
                @if($expenseCategories->count() > 0)
                    <select type="text" name="expense_category_id" id="expense_category_id" class="col" required>
                        @foreach($expenseCategories as $expenseCategorie)
                            <option value="{{ $expenseCategorie->id }}" {{ $expenseCategorie->id == $expense->expense_category_id ? 'selected' : '' }}>{{ $expenseCategorie->description }}</option>
                        @endforeach
                    </select>
                @else
                    <span class="col">Aucune catégorie disponible...</span>
                @endif
            </div>
            <div class="row my-1">
                <label for="city" class="col">Commerce</label>
                @if($commerces->count() > 0)
                    <div class="col">
                        @foreach($commerces as $commerce)
                            <input type="radio" name="commerce_id" id="{{ $commerce->description }}" class="col"
                                value="{{ $commerce->id }}" {{ $commerce->id == $expense->commerce_id ? 'selected' : '' }} required>
                            <label for="{{ $commerce->description }}">{{ $commerce->description }}</label>
                            <span> | </span>
                        @endforeach
                    </div>
                @else
                    <span class="col">Aucun commerce disponible...</span>
                @endif
            </div>
            <div class="row my-3">
                <input type="submit" value="Modifier">
            </div>
            <input type="hidden" name="nursery_id" value="{{  request('nurseryId', $nurseries[0]->id) }}">
            <div class="row my-3">
                <input type="button" onclick="history.back();" value="Annuler" />
            </div>
        </form>
    </div>
@endsection