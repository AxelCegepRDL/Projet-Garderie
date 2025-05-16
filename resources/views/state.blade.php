@extends('app')

@section('content')
    <style>
        td>form{
            display: inline-block;
        }
    </style>
    <h1 class="m-5">Liste des états</h1>
    <div class="container border border-info p-3">
        <table class="table">
            <tr>
                <th class="text-info">Description</th>
                <th></th>
        </tr>
        @if($states->count() > 0)
            @foreach($states as $state)
                <tr>
                    <td>{{$state->description}}</td>
                    <td>
                        <form action="/state/{{$state->id}}/delete" method="post">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger text-white" value="Supprimer" type="submit"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet état ?');">
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="4"><em>Aucune province à afficher</em></td></tr>
        @endif
        </table>
    </div>
    <h1 class="m-5">Ajouter une province</h1>
    <div class="container">
        <form action="{{ route('add state') }}" method="POST">
            @csrf
            <div class="row my-1">
                <label for="description" class="col">Description</label>
                <input type="text" name="description" id="description" class="col">
            </div>
            <div class="row my-3 justify-content-center">
                <input class="btn btn-success w-auto" type="submit" value="Ajouter">
            </div>
        </form>
    </div>
@endsection
