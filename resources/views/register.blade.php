@extends('layouts.tarefas')

@section('title', 'Cadastro')
    
@section('content')

    @if ($errors->any())

        @alert
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endalert
        
    @endif

    <form method="POST">
        @csrf
        <input type="text" name="name" placeholder="Digite seu nome" value="{{old('name')}}"/><br/>
        <input type="email" name="email" placeholder="Digite seu email"value="{{old('email')}}"/><br/>
        <input type="password" name="password" placeholder="Digite sua senha"/><br/>
        <input type="password" name="password_confirmation" placeholder="Confirme sua senha"/><br/>
        
        <input type="submit" value="Cadastrar"/>

    </form>

@endsection