@extends('layouts.app')

@section('conteudo')
    @livewire( 'form-vinculo', ['internship' => $id ?? null])
@endsection