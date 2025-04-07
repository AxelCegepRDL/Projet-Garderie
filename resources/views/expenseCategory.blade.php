@extends('app')

@section('content')
    <h1 class="m-5">Liste des catégories de dépense</h1>
    <div class="container border border-info p-3">
        <div class="row row-cols-12">
            <div class="col col-5 text-info"><b>Description</b></div>
            <div class="col col-4 text-info"><b>Pourcentage</b></div>
            <div class="col"></div>
            <div class="col">
                <form action="{{route('Clear list expense categories')}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input class="btn btn-danger text-white" value="Vider la liste" type="submit"
                        onclick="alert('Êtes-vous sûr de vouloir vider la liste des catégories de dépense ?');"></input>
                </form>
            </div>
        </div>
        @if ($expenseCategories->count() > 0)
            @foreach ($expenseCategories as $expenseCategory)
                <div class="row row-cols-12 my-4">
                    <div class="col col-5">{{$expenseCategory->description}}</div>
                    <div class="col col-4">{{$expenseCategory->percentage}}</div>
                    <div class="col">
                        <form action="/ExpenseCategory/{{$expenseCategory->id}}/edit" method="get">
                            @csrf
                            <input class="btn btn-warning text-white" value="Modifier" type="submit"></input>
                        </form>
                    </div>
                    <div class="col">
                        <form action="/ExpenseCategory/{{$expenseCategory->id}}/delete" method="post">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger text-white" value="Supprimer" type="submit"
                                onclick="alert('Êtes-vous sûr de vouloir supprimer cette catégorie de dépense ?');"></input>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col "><span>Aucune catégorie de dépense...</span></div>
        @endif
    </div>
    <h1 class="m-5">Ajouter une catégorie de dépense</h1>
    <div class="container">
        <form action="{{ route('Add an expense category') }}" method="POST">
            @csrf
            <div class="row my-1">
                <label for="description" class="col">Description</label>
                <input type="text" name="description" id="description" placeholder="Déscription de la catégorie" class="col">
            </div>
            <div class="row my-1">
                <label for="percentage" class="col">Pourcentage</label>
                <input type="number" step="0.05" min="0" max="1" name="percentage" id="percentage" class="col">
            </div>
            <div class="row my-3">
                <input type="submit" value="Ajouter">
            </div>
        </form>
    </div>
@endsection