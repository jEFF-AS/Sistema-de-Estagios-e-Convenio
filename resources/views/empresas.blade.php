@extends('layouts.app')

@section('conteudo')
    @livewire('cadastro-empresa')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cnpjInput = document.getElementById('cnpj_input');
            const phoneInput = document.getElementById('phone_input');

            if (cnpjInput) {
                cnpjInput.addEventListener('input', (e) => {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length > 2) value = value.substring(0, 2) + '.' + value.substring(2);
                    if (value.length > 6) value = value.substring(0, 6) + '.' + value.substring(6);
                    if (value.length > 10) value = value.substring(0, 10) + '/' + value.substring(10);
                    if (value.length > 15) value = value.substring(0, 15) + '-' + value.substring(15, 17);
                    e.target.value = value;
                    cnpjInput.dispatchEvent(new Event('input'));
                });
            }

            if (phoneInput) {
                phoneInput.addEventListener('input', (e) => {
                    let value = e.target.value.replace(/\D/g, '');
                    
                    if (value.length > 0) value = '(' + value;
                    if (value.length > 3) value = value.substring(0, 3) + ') ' + value.substring(3);
                    if (value.length > 10) value = value.substring(0, 10) + '-' + value.substring(10, 14);

                    e.target.value = value;
                    phoneInput.dispatchEvent(new Event('input'));
                });
            }
        });
    </script>
@endsection