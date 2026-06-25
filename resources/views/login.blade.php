<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Estágios e Convênios Atenas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center font-sans">

    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-2xl p-6 shadow-xl">
        <div class="text-center mb-6">
            <h2 class="text-xl font-black text-[#1e40af] tracking-wide uppercase">Atenas Estágios</h2>
            <p class="text-xs text-gray-400 font-medium mt-1">Acesso restrito a funcionários</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase">E-mail Corporativo</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-xl text-xs shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-50/50 text-gray-600 font-medium" placeholder="exemplo@atenas.edu.br">
                @error('email') <span class="text-red-500 text-[11px] mt-1 block font-semibold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase">Senha</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-xl text-xs shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-50/50 text-gray-600 font-medium" placeholder="••••••••">
                @error('password') <span class="text-red-500 text-[11px] mt-1 block font-semibold">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 text-xs text-gray-500 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="rounded text-blue-600 focus:ring-blue-500 border-gray-300">
                    Lembrar-me
                </label>
            </div>

            <button type="submit" class="w-full bg-[#1e40af] hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-md transition uppercase tracking-wider mt-2">
                🔒 Entrar no Sistema
            </button>
        </form>
    </div>

</body>
</html>