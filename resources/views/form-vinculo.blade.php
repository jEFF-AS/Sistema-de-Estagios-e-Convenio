@extends('layouts.app')

@section('conteudo')
    @livewire( 'form-vinculo', ['internshipId' => $id ?? null])
@endsection