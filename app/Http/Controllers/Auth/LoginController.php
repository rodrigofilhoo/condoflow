<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\TwoFactorCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Mostrar o formulário de login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Processar solicitação de login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:usuarios,email',
        ]);

        // Buscar o usuário pelo e-mail
        $user = User::where('email', $request->email)->first();

        // Gerar e enviar o código de 2FA
        $user->generateTwoFactorCode();
        Mail::to($user->email)->send(new TwoFactorCode($user));

        // Armazenar o e-mail na sessão
        Session::put('login_email', $request->email);

        return redirect()->route('2fa.show')
            ->with('success', 'Enviamos um código de verificação para o seu e-mail.');
    }

    /**
     * Mostrar o formulário para digitar o código de verificação.
     *
     * @return \Illuminate\View\View
     */
    public function show2faForm()
    {
        return view('auth.2fa');
    }

    /**
     * Verificar o código de 2FA.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify2fa(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required|numeric|digits:6',
        ]);

        // Obter o e-mail da sessão
        $email = Session::get('login_email');

        if (!$email) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Sessão de login expirada. Por favor, tente novamente.']);
        }

        $user = User::where('email', $email)->first();

        // Verificar se o código é válido e não expirou
        if ($user->two_factor_code !== $request->two_factor_code) {
            return redirect()->back()
                ->withErrors(['two_factor_code' => 'O código informado é inválido.']);
        }

        if ($user->two_factor_expires_at->lt(now())) {
            return redirect()->route('login')
                ->withErrors(['email' => 'O código de verificação expirou. Por favor, solicite um novo código.']);
        }

        // Criar ou atualizar remember_token
        $user->setRememberToken(Str::random(60));
        
        // Autenticar o usuário
        \Illuminate\Support\Facades\Auth::login($user);

        // Limpar o código 2FA e a sessão
        $user->resetTwoFactorCode();
        Session::forget('login_email');

        // Atualizar último login
        $user->ultimo_login = Carbon::now();
        $user->save();

        return redirect()->route('dashboard')
            ->with('status', 'Você está logado!');
    }

    /**
     * Reenviar o código de verificação.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend()
    {
        $email = Session::get('login_email');

        if (!$email) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Sessão de login expirada. Por favor, tente novamente.']);
        }

        $user = User::where('email', $email)->first();
        $user->generateTwoFactorCode();
        Mail::to($user->email)->send(new TwoFactorCode($user));

        return redirect()->route('2fa.show')
            ->with('success', 'Enviamos um novo código de verificação para o seu e-mail.');
    }

    /**
     * Logout do usuário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        auth()->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')
            ->with('status', 'Você saiu com sucesso!');
    }
}
