@extends('app')

@section('content')
    <style>
        td>form{
            display: inline-block;
        }
    </style>
    <h1 class="m-5">Rapport</h1>
    <form action="{{ route('show report') }}" method="get" class="mx-5 mb-3">
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
        <p>Total des revenus : {{$numberOfPresences}} présences X 48$ = {{$earnings}}$</p>
        <p>Total des dépenses : Dépenses admissibles : {{$totalEligibleAmountOfExpense}}$ + Total des salaires : {{$totalAmountOfSalary}}$ = {{$totalAmountOfExpenses}}$</p>
        <p>Profits : Revenus ({{$earnings}}$) - Dépenses ({{$totalAmountOfExpenses}}$) = {{$profit}}$</p>
    </div>
@endsection
