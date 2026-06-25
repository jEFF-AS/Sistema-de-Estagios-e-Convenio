<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function mostrarLogin()
    {
        // Se o funcionário já estiver logado, joga direto para a página de relatórios
        if (Auth::check()) {
            return redirect()->intended('/relatorios');
        }
        return view('login');
    }

    public function logar(Request $request)
    {
        // Validação visual dos campos
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Insira um e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
        ]);

        // Tenta autenticar o usuário (o Laravel usará automaticamente o Argon2id configurado)
        if (Auth::attempt($credenciais, $request->remember)) {
            $request->session()->regenerate(); // Evita ataques de fixação de sessão

            return redirect()->intended('/relatorios');
        }

        // Se errar o e-mail ou a senha, retorna para a tela com o erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        // Invalida e limpa os tokens da sessão atual por segurança
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}