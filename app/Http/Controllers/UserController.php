<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Listar usuários
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Exibir formulário de criação
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Criar usuário
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'tipo_pessoa' => 'required|in:FISICA,JURIDICA',
            'tipo_documento' => 'required|in:CPF,CNPJ,RG',
            'telefone' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'cpf' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'tipo_pessoa' => $request->tipo_pessoa,
            'tipo_documento' => $request->tipo_documento,
            'telefone' => $request->telefone,
            'data_nascimento' => $request->data_nascimento,
            'cpf' => $request->cpf,
            'ativo' => true,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Exibir usuário
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Exibir formulário de edição
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Atualizar usuário
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . $user->id,
            'tipo_pessoa' => 'required|in:FISICA,JURIDICA',
            'tipo_documento' => 'required|in:CPF,CNPJ,RG',
            'telefone' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'cpf' => 'nullable|string|max:255',
            'ativo' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $userData = [
            'nome' => $request->nome,
            'email' => $request->email,
            'tipo_pessoa' => $request->tipo_pessoa,
            'tipo_documento' => $request->tipo_documento,
            'telefone' => $request->telefone,
            'data_nascimento' => $request->data_nascimento,
            'cpf' => $request->cpf,
            'ativo' => $request->ativo,
        ];

        $user->update($userData);

        return redirect()->route('users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Deletar usuário
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuário excluído com sucesso!');
    }
}
