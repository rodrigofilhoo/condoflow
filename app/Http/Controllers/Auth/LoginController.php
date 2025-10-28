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
     * Formulário de login
     *
     * @OA\Get(
     *     path="/login",
     *     operationId="showLoginForm",
     *     tags={"Autenticação"},
     *     summary="Formulário de login",
     *     @OA\Response(response=200, description="Formulário exibido")
     * )
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Realizar login
     *
     * @OA\Post(
     *     path="/login",
     *     operationId="login",
     *     tags={"Autenticação"},
     *     summary="Efetuar login",
     *     description="Envia código de 2FA por email",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", example="user@example.com")
     *         )
     *     ),
     *     @OA\Response(response=302, description="Redireciona para 2FA"),
     *     @OA\Response(response=422, description="Email inválido")
     * )
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
     * Formulário de 2FA
     *
     * @OA\Get(
     *     path="/2fa",
     *     operationId="show2faForm",
     *     tags={"Autenticação"},
     *     summary="Formulário de código 2FA",
     *     @OA\Response(response=200, description="Formulário exibido")
     * )
     */
    public function show2faForm()
    {
        return view('auth.2fa');
    }

    /**
     * Verificar código 2FA
     *
     * @OA\Post(
     *     path="/2fa",
     *     operationId="verify2fa",
     *     tags={"Autenticação"},
     *     summary="Verificar código 2FA",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="two_factor_code", type="string", example="123456")
     *         )
     *     ),
     *     @OA\Response(response=302, description="Redireciona para dashboard"),
     *     @OA\Response(response=422, description="Código inválido")
     * )
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
     * Reenviar código 2FA
     *
     * @OA\Get(
     *     path="/2fa/resend",
     *     operationId="resend2fa",
     *     tags={"Autenticação"},
     *     summary="Reenviar código 2FA",
     *     @OA\Response(response=302, description="Código reenviado")
     * )
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
     * Logout
     *
     * @OA\Post(
     *     path="/logout",
     *     operationId="logout",
     *     tags={"Autenticação"},
     *     summary="Fazer logout",
     *     @OA\Response(response=302, description="Redirecionado para login"),
     *     security={{"sanctum": {}}}
     * )
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
