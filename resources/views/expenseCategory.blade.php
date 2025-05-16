@extends('app')

@section('content')
    <h1 class="m-5">Liste des catégories de dépense</h1>
    <div class="container border border-info p-3">
        <table class="table">
            <tr>
                <th class="text-info"><b>Description</b></th>
                <th class="text-info"><b>Pourcentage</b></th>
                <th></th>
                <th>
                    <form action="{{route('Clear list expense categories')}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input class="btn btn-danger text-white" value="Vider la liste" type="submit"
                               onclick="return confirm('Êtes-vous sûr de vouloir vider la liste des catégories de dépense ?');"
                               @if($expenseCategories->count() == 0) disabled @endif>
                    </form>
                </th>
            </tr>
            @if ($expenseCategories->count() > 0)
                @foreach ($expenseCategories as $expenseCategory)
                    <tr>
                        <td>{{$expenseCategory->description}}</td>
                        <td>{{$expenseCategory->percentage * 100}} %</td>
                        <td>
                            <form action="/ExpenseCategory/{{$expenseCategory->id}}/edit" method="get">
                                @csrf
                                <input class="btn btn-warning text-white" value="Modifier" type="submit">
                            </form>
                        </td>
                        <td>
                            <form action="/ExpenseCategory/{{$expenseCategory->id}}/delete" method="post">
                                @method('DELETE')
                                @csrf
                                <input class="btn btn-danger text-white" value="Supprimer" type="submit"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie de dépense ?');">
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="4"><em>Aucune catégorie de dépense à afficher</em></td></tr>
            @endif
        </table>
        </div>
    <h1 class="m-5">Ajouter une catégorie de dépense</h1>
    <div class="container">
        <form action="{{ route('Add an expense category') }}" method="POST">
            @csrf
            <div class="row my-1">
                <label for="description" class="col">Description</label>
                <input type="text" name="description" id="description" placeholder="Description de la catégorie" class="col">
            </div>
            <div class="row my-1">
                <label for="percentage" class="col">Pourcentage (en %)</label>
                <input type="number" step="1" min="0" max="100" name="percentage" id="percentage" class="col" placeholder="100">
            </div>
            <div class="row my-3 justify-content-center">
                <input class="btn btn-success w-auto " type="submit" value="Ajouter">
            </div>
        </form>
    </div>
@endsection
