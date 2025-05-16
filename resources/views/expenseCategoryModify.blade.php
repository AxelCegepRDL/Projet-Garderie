@extends('app')

@section('content')
    <h1 class="m-5">Modifier la catégorie de dépense</h1>
    <div class="container">
        <form action="/ExpenseCategory/{{ $expenseCategory->id }}/update" method="POST">
            @method('PUT')
            @csrf
            <div class="row my-1">
                <label for="description" class="col">Description</label>
                <input type="text" name="description" id="description" placeholder="Description de la catégorie"
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
        <table class="table">
            <tr>
                <th class="text-info">Garderie</th>
                <th class="text-info">DateTemps</th>
                <th class="text-info">Montant</th>
                <th class="text-info">Montant admissible</th>
                <th class="text-info">Catégorie de dépense</th>
                <th class="text-info">Commerce</th>
            </tr>
            @if($expenses->count() > 0)
                @foreach($expenses as $expense)
                    <tr>
                        <td>{{$expense->nursery->name}}</td>
                        <td>{{$expense->dateTime}}</td>
                        <td>{{ number_format($expense->amount, 2, ",", " ") }} $</td>
                        <td>{{ number_format($expense->eligibleAmount, 2, ",", " ") }} $</td>
                        <td>{{$expense->expenseCategory->description}}</td>
                        <td>{{$expense->commerce->description}}</td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="4"><em>Aucune dépense à afficher pour cette catégorie</em></td></tr>
            @endif
        </table>
    </div>
@endsection
