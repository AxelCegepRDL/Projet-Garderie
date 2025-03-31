@extends('app')

@section('content')
    <h1 class="m-5">Liste des dépenses</h1>
    <form action="{{ route('List the expenses') }}" method="get">
        <label for="nurseryId">Choisir la garderie :</label>

        @if ($nurseryName->count() > 0)
            <select name="nurseryId" id="nurseryId" oninput="submit();">
                @foreach ($nurseryName as $nurseryName)
                    <option value="{{ $nurseryName->id }}">{{ $nurseryName->name }}</option>
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
                <form action="{{route('Clear list expenses')}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input class="bg-danger border border-danger rounded text-white p-2" value="Vider la liste"
                        type="submit" onclick="alert('Êtes-vous sûr de vouloir vider la liste des dépenses ?');"></input>
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
                            <input class="bg-warning border border-warning rounded text-white p-2" value="Modifier"
                                type="submit"></input>
                        </form>
                    </div>
                    <div class="col">
                        <form action="/Expenses/{{$expense->id}}/delete" method="post">
                            @method('DELETE')
                            @csrf
                            <input class="bg-danger border border-danger rounded text-white p-2" value="Supprimer" type="submit"
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
                <input type="text" name="amount" id="amount" class="col">
            </div>
            <div class="row my-1">
                <label for="expenseCategorie" class="col">Catégorie de dépense</label>
                @if($expensesCategories->cont() > 0)
                    <select type="text" name="expenseCategorie" id="expenseCategorie" class="col">
                        @foreach($expensesCategories as $expensesCategorie)
                            <option value="{{ $expensesCategorie->id }}">{{ $expensesCategorie->description }}</option>
                        @endforeach
                    </select>
                @else
                    <span>Aucune catégorie disponible...</span>
                @endif
            </div>
            <div class="row my-1">
                <label for="city" class="col">Commerce</label>
                @if($commerces->cont() > 0)
                    @foreach($commerces as $commerce)
                        <input type="radio" name="commerce" id="{{ $commerce->description }}" class="col"
                            value="{{ $commerce->id }}">
                        <span> | </span>
                        <label for="{{ $commerce->description }}">{{ $commerce->description }}</label>
                    @endforeach
                    </select>
                @else
                    <span>Aucun commerce disponible...</span>
                @endif
            </div>
        </form>
    </div>
@endsection