@extends('app')

@section('content')
    <h1 class="m-5">Modifier le commerce</h1>
    <div class="container">
        <form action="/commerce/{{ $commerce->id }}/update" method="POST">
            @method('PUT')
            @csrf
            <div class="row my-1">
                <label for="description" class="col">Description</label>
                <input type="text" value="{{ $commerce->description }}" name="description" id="description" class="col"
                    disabled>
            </div>
            <div class="row my-1">
                <label for="address" class="col">Adresse</label>
                <input type="text" value="{{ $commerce->address }}" name="address" id="address" class="col"
                    required>
            </div>
            <div class="row my-1">
                <label for="phone" class="col">Téléphone</label>
                <input type="text" value="{{ $commerce->phone }}" name="phone" id="phone" class="col"
                    required>
            </div>
            <div class="row my-3">
                <input type="submit" value="Modifier">
            </div>
            <div class="row my-3">
                <input type="button" onclick="history.back();" value="Annuler" />
            </div>
        </form>
    </div>
    <h2 class="m-5">Liste des dépenses</h2>
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
                <tr><td colspan="4"><em>Aucune dépense à afficher pour ce commerce</em></td></tr>
            @endif
        </table>
    </div>
@endsection
