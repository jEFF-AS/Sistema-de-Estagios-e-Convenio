@extends('layouts.app')

@section('conteudo')
    @livewire('cadastro-aluno', ['studentId' => $id ?? null])
@endsection