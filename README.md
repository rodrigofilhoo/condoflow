<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# CondoFlow

Plataforma de gerenciamento de condomínios, imóveis e recursos.

## 📚 Documentação da API - Swagger UI

A API CondoFlow possui documentação interativa completa através do Swagger UI.

### Acessar a Documentação

Após iniciar o servidor, acesse:
- **Swagger UI**: [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)
- **Alias curto**: [http://localhost:8000/api/docs](http://localhost:8000/api/docs)

### Recursos da Documentação

A documentação inclui:

- ✅ **Descrição de todos os endpoints** com exemplos de requisição e resposta
- ✅ **Modelos de dados** (schemas) das entidades
- ✅ **Autenticação** com tokens Bearer
- ✅ **Testes interativos** direto na interface
- ✅ **Exportação** em JSON e YAML
- ✅ **Busca e filtro** de endpoints
- ✅ **Modo escuro** habilitado por padrão

### Endpoints Documentados

#### Condomínios
- `GET /api/condominios` - Listar todos os condomínios
- `GET /api/condominios/{id}/imoveis` - Listar imóveis de um condomínio
- `GET /api/sync-status` - Verificar status da sincronização com banco de dados

#### Usuários
- `GET /users` - Listar usuários (Web)
- `POST /users` - Criar usuário (Web)
- `GET /users/{id}` - Ver detalhes do usuário (Web)
- `PUT /users/{id}` - Atualizar usuário (Web)
- `DELETE /users/{id}` - Deletar usuário (Web)

#### Veículos
- CRUD completo de veículos residenciais

#### Imóveis
- CRUD completo de imóveis e propriedades

### Adicionar Documentação a Novos Endpoints

Para documentar um novo endpoint no Swagger, use anotações OpenAPI no controller:

```php
/**
 * Descrição do endpoint
 *
 * @OA\Get(
 *     path="/api/seu-endpoint",
 *     operationId="operacaoUnica",
 *     tags={"NomeDaTag"},
 *     summary="Resumo curto",
 *     description="Descrição detalhada",
 *     @OA\Response(
 *         response=200,
 *         description="Sucesso",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer")
 *         )
 *     )
 * )
 */
public function seu_metodo()
{
    // implementação
}
```

### Gerar Documentação

Para regenerar a documentação após adicionar/modificar endpoints:

```bash
php artisan l5-swagger:generate
```

### Configuração

A configuração do Swagger está em `config/l5-swagger.php` com as seguintes opções:
- `generate_always` - Regenerar docs a cada requisição (development)
- `dark_mode` - Modo escuro habilitado
- `doc_expansion` - Expansão padrão de operações
- `persist_authorization` - Manter tokens entre recarregamentos

---

## Configuração do Projeto

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
