@section('scripts-2')
    
    <script>
        function HolaMundo(){
            console.log("Hola Mundo");
        }
    </script>

@endsection

@section('main')
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, magni reprehenderit ullam explicabo 
        necessitatibus labore voluptatem sit. Mollitia, modi rem facilis praesentium cum quo inventore minima, 
        sed ipsa atque at.
    </p>
    <button class="btn" onclick="HolaMundo()">
        <i class="bi bi-list"></i>
    </button>
@endsection



@section('styles')
    
    <style>
        .btn i {
            color: red;

        }
    </style>

@endsection
<!-- *********************************************************************  -->

@extends('templates.base')

@section('title', 'Inicio')