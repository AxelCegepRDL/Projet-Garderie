@extends('app')

@section('content')
    <div class="container border border-info p-3 bg-">
        <div class="row row-cols-7">
            <div class="col">Nom</div>
            <div class="col">Adresse</div>
            <div class="col">Ville</div>
            <div class="col">Province</div>
            <div class="col">Telephone</div>
            <div class="col"></div>
            <div class="col">
                <input class="bg-danger border border-danger rounded text-white p-2" value="Vider la liste"
                    onclick="this.form.action='{{route('Clear list nursery')}} this.form.method='delete'; submit();"
                    type="button"></input>
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
                        <intput class="bg-warning border border-warning rounded text-white p-2" value="Modifier"
                            onclick="this.form.action='/garderies/{{$nursery->id}}/edit'; this.form.method='get'; submit();"
                            type="button"></intput>
                    </div>
                    <div class="col">
                        <intput class="bg-warning border border-warning rounded text-white p-2" value="Supprimer"
                            onclick="this.form.action='/garderies/{{$nursery->id}}/delete'; this.form.method='delete'; submit();"
                            type="button"></intput>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col "><span>Aucune garderie...</span></div>
        @endif
    </div>
@endsection