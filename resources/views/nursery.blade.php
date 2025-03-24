@extends('app')

@section('content')
    <div class="container border border-info">
        <div class="row row-cols-7">
            <div class="col">Nom</div>
            <div class="col">Adresse</div>
            <div class="col">Ville</div>
            <div class="col">Province</div>
            <div class="col">Telephone</div>
            <div class="col"></div>
            <div class="col">
                <intput class="deleteButton" type="button">Vider la liste</intput>
            </div>
        </div>
        @if ($nurseries->count() > 0)
            @foreach ($nurseries as $nursery)
                <div class="row row-cols-7">
                    <div class="col">{{$nursery->name}}</div>
                    <div class="col">{{$nursery->address}}</div>
                    <div class="col">{{$nursery->city}}</div>
                    <div class="col">{{$nursery->state}}</div>
                    <div class="col">{{$nursery->phone}}</div>
                    <div class="col">
                        <intput class="modifyButton" type="button">Modifier</intput>
                    </div>
                    <div class="col">
                        <intput class="deleteButton" type="button">Supprimer</intput>
                    </div>
                </div>
            @endforeach
            <span>Aucune garderie...</span>
        @endif
    </div>
@endsection
