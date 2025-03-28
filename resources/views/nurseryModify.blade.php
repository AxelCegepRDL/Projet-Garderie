@extends('app')

@section('content')
    <form action="">
        <input type="text" name="name" id="name" value="{{ $nurse }}">
        <input type="text" name="address" id="address"value="">
        <input type="text" name="city" id="city"value="">
        <select name="state" id="">
            @foreach($states as $state)
                <option value="{{ $state->id }}">{{ $state->description }}</option>
            @endforeach
        </select>
        <input type="text" pattern="{0 - 9}" name="phone" id="phone"value="">
    </form>
@endsection