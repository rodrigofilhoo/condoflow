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
 *     name="Imóveis",
 *     description="Gerenciamento de imóveis e propriedades"
 * )
 * @OA\Tag(
 *     name="Veículos",
 *     description="Gerenciamento de veículos residenciais"
 * )
 */
abstract class Controller
{
    //
}
