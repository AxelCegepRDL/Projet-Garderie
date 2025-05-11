<div id="navbar" class="container p-1 rounded">
    <div class="row row-cols-10 justify-content-center text-center align-items-center">
        <div class="col"><img id="logo" src="{{ asset('img/logo.png') }}" alt="logo"></div>
        <div class="col"><a href="{{ route('List nursery') }}">Garderies</a></div>
        <div class="col"><a href="{{ route('List the expenses') }}">Dépenses</a></div>
        <div class="col"><a href="{{ route('commerce.list') }}">Commerces</a></div>
        <div class="col col-2"><a href="{{ route('List the expense categories') }}">Catégories de dépense</a></div>
        <div class="col"><a href="{{ route('child.list') }}">Enfants</a></div>
        <div class="col"><a href="{{ route('List educator') }}">Éducateurs</a></div>
        <div class="col"><a href="{{ route('presence.list') }}">Présences</a></div>
        <div class="col"><a href="{{ route('show report') }}">Rapport</a></div>
        <div class="col"><a href="{{ route('state list') }}">Provinces</a></div>
    </div>
</div>
