@extends('app')

@section('content')
    <h1 class="m-5">Liste des dépenses</h1>
    <form action="{{ route('List the expenses') }}" method="get" class="mx-5 mb-3">
        <label for="nurseryId">Choisir la garderie :</label>

        @if ($nurseries->count() > 0)
            <select name="nurseryId" id="nurseryId" oninput="submit();">
                @foreach ($nurseries as $nursery)
                    @if(request('nurseryId') == $nursery->id)
                        <option value="{{ $nursery->id }}" selected>{{ $nursery->name }}</option>
                    @else
                        <option value="{{ $nursery->id }}">{{ $nursery->name }}</option>
                    @endif
                @endforeach
            </select>
        @else
            <span>Aucune garderie disponible...</span>
        @endif
    </form>
    <div class="container border border-info p-3">
        <div class="row row-cols-12">
            <div class="col col-2">DateTemps</div>
            <div class="col">Montant</div>
            <div class="col col-2">Montant admissible</div>
            <div class="col col-3">Catégorie de dépense</div>
            <div class="col">Commerce</div>
            <div class="col"></div>
            <div class="col">
                <form action="/Expenses/{{ request('nurseryId', $nurseries[0]->id) }}/clear" method="post">
                    @method('DELETE')
                    @csrf
                    <input class="btn btn-danger" value="Vider la liste" type="submit"
                        onclick="alert('Êtes-vous sûr de vouloir vider la liste des dépenses ?');"></input>
                </form>
            </div>
        </div>
        @if ($expenses->count() > 0)
            @foreach ($expenses as $expense)
                <div class="row row-cols-12 my-4">
                    <div class="col col-2">{{$expense->dateTime}}</div>
                    <div class="col">{{$expense->amount}}</div>
                    <div class="col col-2">{{ $expense->eligibleAmount }}</div>
                    <div class="col col-3">{{$expense->expenseCategories->description}}</div>
                    <div class="col">{{$expense->commerces->description}}</div>
                    <div class="col">
                        <form action="/Expenses/{{$expense->id}}/edit" method="get">
                            @csrf
                            <input class="btn btn-warning text-white" value="Modifier" type="submit"></input>
                        </form>
                    </div>
                    <div class="col">
                        <form action="/Expenses/{{$expense->id}}/delete" method="post">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger" value="Supprimer" type="submit"
                                onclick="alert('Êtes-vous sûr de vouloir supprimer cette dépense ?');"></input>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col "><span>Aucune dépense...</span></div>
        @endif
    </div>
    <h1 class="m-5">Ajouter une dépense</h1>
    <div class="container">
        <form action="{{ route('Add a expense') }}" method="POST">
            @csrf
            <div class="row my-1">
                <label for="amount" class="col">Montant</label>
                <input type="number" step="0.5" name="amount" id="amount" class="col" required>
            </div>
            <div class="row my-1">
                <label for="expense_category_id" class="col">Catégorie de dépense</label>
                @if($expenseCategories->count() > 0)
                    <select type="text" name="expense_category_id" id="expense_category_id" class="col" required>
                        @foreach($expenseCategories as $expenseCategorie)
                            <option value="{{ $expenseCategorie->id }}">{{ $expenseCategorie->description }}</option>
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
                                value="{{ $commerce->id }}" required>
                            <label for="{{ $commerce->description }}">{{ $commerce->description }}</label>
                            <span> | </span>
                        @endforeach
                    </div>
                @else
                    <span class="col">Aucun commerce disponible...</span>
                @endif
            </div>
            <div class="row my-3">
                <input type="submit" value="Ajouter">
            </div>
            <input type="hidden" name="nursery_id" value="{{  request('nurseryId', $nurseries[0]->id) }}">
        </form>
    </div>
@endsection