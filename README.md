# API Rest - Baseado em Laravel com Docker

## Requirements:

- PHP >= 7.2.0
- Composer
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension

Você pode verificar todas as dependências relacionadas ao laravel [aqui](https://laravel.com/docs/10.x/installation#server-requirements).

## Instalação.

1. Clone o repositório e instalação.<br>
`git clone https://github.com/jacksonsns/api-xyz-employe-management.git`<br>
`cp .env.example .env`<br>
3. Instale os pacotes de dependência.<br>
4. Gere a key do projeto e instale as migrates.<br>
`php artisan key:generate`<br>
`php artisan migrate`

2. Rodar as seeds para importar o usuário Admin ao banco
` php artisan db:seed --class=AdministratorSeeder `
