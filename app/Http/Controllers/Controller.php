<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="CondoFlow API",
 *     version="1.0.0",
 *     description="API para gerenciamento de condomínios, imóveis e recursos. CondoFlow é uma plataforma completa para administração de condomínios.",
 *     contact={
 *         "name": "CondoFlow Support",
 *         "email": "support@condoflow.com"
 *     }
 * )
 * 
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 * 
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     name="Authorization",
 *     in="header",
 *     securityScheme="sanctum",
 *     description="Token de autenticação (Bearer token)"
 * )
 * 
 * @OA\Tag(
 *     name="Autenticação",
 *     description="Endpoints de autenticação e login"
 * )
 * @OA\Tag(
 *     name="Usuários",
 *     description="Operações com usuários do sistema"
 * )
 * @OA\Tag(
 *     name="Condomínios",
 *     description="Gerenciamento de condomínios"
 * )
 * @OA\Tag(
 *     name="Veículos",
 *     description="Gerenciamento de veículos residenciais"
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/condominios",
 *     operationId="getApiCondominios",
 *     tags={"Condomínios"},
 *     summary="Listar condomínios (API)",
 *     @OA\Response(response=200, description="Lista de condomínios"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/condominios/{id}/imoveis",
 *     operationId="getApiCondominiosImoveis",
 *     tags={"Condomínios"},
 *     summary="Listar imóveis de um condomínio (API)",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Lista de imóveis"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/sync-status",
 *     operationId="getApiSyncStatus",
 *     tags={"Condomínios"},
 *     summary="Status da sincronização (API)",
 *     @OA\Response(response=200, description="Status da sincronização"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/users",
 *     operationId="getUsersList",
 *     tags={"Usuários"},
 *     summary="Listar usuários",
 *     @OA\Response(response=200, description="Lista de usuários"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/users/create",
 *     operationId="getUsersCreate",
 *     tags={"Usuários"},
 *     summary="Formulário de novo usuário",
 *     @OA\Response(response=200, description="Formulário exibido"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Post(
 *     path="/api/v1/users",
 *     operationId="postUsers",
 *     tags={"Usuários"},
 *     summary="Criar novo usuário",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nome", type="string", example="João Silva"),
 *             @OA\Property(property="email", type="string", example="joao@example.com"),
 *             @OA\Property(property="tipo_pessoa", type="string", enum={"FISICA","JURIDICA"}),
 *             @OA\Property(property="tipo_documento", type="string", enum={"CPF","CNPJ","RG"}),
 *             @OA\Property(property="cpf", type="string"),
 *             @OA\Property(property="telefone", type="string"),
 *             @OA\Property(property="data_nascimento", type="string", format="date")
 *         )
 *     ),
 *     @OA\Response(response=201, description="Usuário criado com sucesso"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/users/{id}",
 *     operationId="getUsersShow",
 *     tags={"Usuários"},
 *     summary="Detalhes do usuário",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Usuário encontrado"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/users/{id}/edit",
 *     operationId="getUsersEdit",
 *     tags={"Usuários"},
 *     summary="Formulário de edição de usuário",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Formulário exibido"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Put(
 *     path="/api/v1/users/{id}",
 *     operationId="putUsers",
 *     tags={"Usuários"},
 *     summary="Atualizar usuário",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *     @OA\Response(response=200, description="Usuário atualizado"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Delete(
 *     path="/api/v1/users/{id}",
 *     operationId="deleteUsers",
 *     tags={"Usuários"},
 *     summary="Deletar usuário",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Usuário deletado"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/veiculos",
 *     operationId="getVeiculosList",
 *     tags={"Veículos"},
 *     summary="Listar veículos",
 *     @OA\Response(response=200, description="Lista de veículos"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/veiculos/create",
 *     operationId="getVeiculosCreate",
 *     tags={"Veículos"},
 *     summary="Formulário de novo veículo",
 *     @OA\Response(response=200, description="Formulário exibido"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Post(
 *     path="/api/v1/veiculos",
 *     operationId="postVeiculos",
 *     tags={"Veículos"},
 *     summary="Criar novo veículo",
 *     @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *     @OA\Response(response=201, description="Veículo criado"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/veiculos/{id}",
 *     operationId="getVeiculosShow",
 *     tags={"Veículos"},
 *     summary="Detalhes do veículo",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
 *     @OA\Response(response=200, description="Veículo encontrado"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/veiculos/{id}/edit",
 *     operationId="getVeiculosEdit",
 *     tags={"Veículos"},
 *     summary="Formulário de edição de veículo",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
 *     @OA\Response(response=200, description="Formulário exibido"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Put(
 *     path="/api/v1/veiculos/{id}",
 *     operationId="putVeiculos",
 *     tags={"Veículos"},
 *     summary="Atualizar veículo",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
 *     @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *     @OA\Response(response=200, description="Veículo atualizado"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Delete(
 *     path="/api/v1/veiculos/{id}",
 *     operationId="deleteVeiculos",
 *     tags={"Veículos"},
 *     summary="Deletar veículo",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
 *     @OA\Response(response=200, description="Veículo deletado"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/imoveis",
 *     operationId="getImoveisList",
 *     tags={"Imóveis"},
 *     summary="Listar imóveis",
 *     @OA\Response(response=200, description="Lista de imóveis"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/imoveis/create",
 *     operationId="getImoveisCreate",
 *     tags={"Imóveis"},
 *     summary="Formulário de novo imóvel",
 *     @OA\Response(response=200, description="Formulário exibido"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Post(
 *     path="/api/v1/imoveis",
 *     operationId="postImoveis",
 *     tags={"Imóveis"},
 *     summary="Criar novo imóvel",
 *     @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *     @OA\Response(response=201, description="Imóvel criado"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/imoveis/{id}",
 *     operationId="getImoveisShow",
 *     tags={"Imóveis"},
 *     summary="Detalhes do imóvel",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
 *     @OA\Response(response=200, description="Imóvel encontrado"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Get(
 *     path="/api/v1/imoveis/{id}/edit",
 *     operationId="getImoveisEdit",
 *     tags={"Imóveis"},
 *     summary="Formulário de edição de imóvel",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
 *     @OA\Response(response=200, description="Formulário exibido"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Put(
 *     path="/api/v1/imoveis/{id}",
 *     operationId="putImoveis",
 *     tags={"Imóveis"},
 *     summary="Atualizar imóvel",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
 *     @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *     @OA\Response(response=200, description="Imóvel atualizado"),
 *     security={{"sanctum": {}}}
 * )
 * 
 * @OA\Delete(
 *     path="/api/v1/imoveis/{id}",
 *     operationId="deleteImoveis",
 *     tags={"Imóveis"},
 *     summary="Deletar imóvel",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
 *     @OA\Response(response=200, description="Imóvel deletado"),
 *     security={{"sanctum": {}}}
 * )
 */
abstract class Controller
{
    //
}
