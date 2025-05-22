@extends('layouts.app')
@section('content')
<div class="container my-4">
    <h1 class="text-center" style="color: white;">Laboratoire Virtuel de Chimie</h1>
    <p class="text-center" style="color: white;">Apprenez, Explorez et Découvre la magie de la chimie !</p>

</div>
    {{-- Barre de recherche --}}
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <form action="{{ route('recherche') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Rechercher une expérience, un cours, etc.">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                </div>
            </form>
        </div>
    </div>

@endsection
