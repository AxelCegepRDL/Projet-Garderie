@extends('app')

@section('content')
    <style>
        td>form{
            display: inline-block;
        }
    </style>
    <h1 class="m-5">Liste des commerces</h1>
    <div class="container border border-info p-3">
        <table class="table">
            <tr>
                <th class="text-info">Description</th>
                <th class="text-info">Adresse</th>
                <th class="text-info">Téléphone</th>
                <th></th>
                <th>
                    <form action="{{route('commerce.clear')}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input class="btn btn-danger text-white" value="Vider la liste" type="submit"
                            onclick="return confirm('Êtes-vous sûr de vouloir vider la liste des commerces ?');"
                            @if($commerces->count() == 0) disabled @endif ></input>
                    </form>
            </th>
        </tr>
        @if($commerces->count() > 0)
            @foreach($commerces as $commerce)
                <tr>
                    <td>{{$commerce->description}}</td>
                    <td>{{$commerce->address}}</td>
                    <td>{{$commerce->phone}}</td>
                    <td>
                        <form action="/commerce/{{$commerce->id}}/edit" method="get">
                            @csrf
                            <input class="btn btn-warning text-white" value="Modifier" type="submit"></input>
                        </form></td>
                    <td>
                        <form action="/commerce/{{$commerce->id}}/delete" method="post">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger text-white" value="Supprimer" type="submit"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette garderie ?');"></input>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="5"><em>Aucun commerce à afficher</em></td></tr>
        @endif
        </table>
    </div>
    <h1 class="m-5">Ajouter un commerce</h1>
    <div class="container">
        <form action="{{ route('commerce.add') }}" method="POST">
            @csrf
            <div class="row my-1">
                <label for="description" class="col">Description</label>
                <input type="text" name="description" id="description" class="col">
            </div>
            <div class="row my-1">
                <label for="address" class="col">Adresse</label>
                <input type="text" name="address" id="address" class="col">
            </div>
            <div class="row my-1">
                <label for="phone" class="col">Téléphone</label>
                <input type="text" pattern="{0 - 9}" name="phone" id="phone" class="col">
            </div>
            <div class="row my-3">
                <input type="submit" value="Ajouter">
            </div>
        </form>
    </div>
@endsection
