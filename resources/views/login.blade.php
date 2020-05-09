@extends('layouts.tarefas')

@section('title', 'Login')
    
@section('content')

    @if (session('Warning'))

        @alert
            {{session('Warning')}}
        @endalert
        
    @endif

    <form method="POST">
        @csrf
        <input type="email" name="email" placeholder="Digite seu email"/><br/>
        <input type="password" name="password" placeholder="Digite sua senha"/><br/>
        
        <input type="submit" value="Entrar"/>

    </form>
    <br/>
    
    <a href="/register">Registrar-se clique aqui</a>

@endsection