@extends('app')

@section('content')
    <style>
        td>form{
            display: inline-block;
        }
    </style>
    <h1 class="m-5">Liste des présences</h1>
    <form action="{{ route('presence.list') }}" method="get" class="mx-5 mb-3">
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
        <table class="table">
            <tr>
                <th class="text-info">Date</th>
                <th class="text-info">Nom enfant</th>
                <th class="text-info">Prénom enfant</th>
                <th class="text-info">Date naissance enfant</th>
                <th class="text-info">Nom éducateur</th>
                <th class="text-info">Prénom éducateur</th>
                <th class="text-info">Date naissance éducateur</th>
                <th>
                    <form action="{{route('presence.clear', ["id" => request('nurseryId', $nurseries[0]->id)])}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input class="btn btn-danger text-white" value="Vider la liste" type="submit"
                            onclick="return confirm('Êtes-vous sûr de vouloir vider la liste des présences ?');"
                            @if($presences->count() == 0) disabled @endif >
                    </form>
            </th>
        </tr>
        @if($presences->count() > 0)
            @foreach($presences as $presence)
                <tr>
                    <td>{{$presence->date}}</td>
                    <td>{{$presence->child->lastName}}</td>
                    <td>{{$presence->child->firstName}}</td>
                    <td>{{$presence->child->dateOfBirth}}</td>
                    <td>{{$presence->educator->lastName}}</td>
                    <td>{{$presence->educator->firstName}}</td>
                    <td>{{$presence->educator->dateOfBirth}}</td>
                    <td>
                        <form action="/presence/{{$presence->id}}/delete" method="post">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger text-white" value="Supprimer" type="submit"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette présence ?');">
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="9"><em>Aucune présence à afficher</em></td></tr>
        @endif
        </table>
    </div>
    <h1 class="m-5">Ajouter une présence</h1>
    <div class="container">
        <form action="{{ route('presence.add') }}" method="POST">
            @csrf
            <div class="row my-1">
                <label for="date" class="col">Date :</label>
                <input type="date" name="date" id="date" class="col">
            </div>
            <div class="row my-1">
                <label for="child_id" class="col">Enfant  :</label>
            @if($children->count() > 0)
                    <select name="child_id" id="child_id" class="col" required>
                    @foreach($children as $child)
                            <option value="{{ $child->id }}">{{ $child->lastName }} | {{ $child->firstName }} | {{ $child->dateOfBirth }}</option>
                        @endforeach
                    </select>
                @else
                    <span class="col">Aucun enfant disponible...</span>
                @endif
            </div>
            <div class="row my-1">
                <label for="educator_id" class="col">Éducateur :</label>
                @if($educators->count() > 0)
                    <select name="educator_id" id="educator_id" class="col" required>
                        @foreach($educators as $educator)
                            <option value="{{ $educator->id }}">{{ $educator->lastName }} | {{ $educator->firstName }} | {{ $educator->dateOfBirth }}</option>
                        @endforeach
                    </select>
                @else
                    <span class="col">Aucun éducateur disponible...</span>
                @endif
            </div>
            <div class="row my-3">
                <input type="submit" value="Ajouter"
                @if($educators->count() == 0 || $children->count() == 0 || $nurseries->count() == 0) disabled @endif>
                <input type="hidden" name="nursery_id" value="{{  request('nurseryId', $nurseries[0]->id) }}">
            </div>
        </form>
    </div>
@endsection
