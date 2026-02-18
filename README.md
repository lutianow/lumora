# pgAdmin via Docker

Você pode acessar o banco de dados Postgres facilmente pelo navegador usando o pgAdmin em container:

1. Suba o serviço pgAdmin junto com os outros containers:

	```bash
	docker compose up -d pgadmin
	```

2. Acesse http://localhost:5050 no navegador.
	- Login: admin@lumora.local
	- Senha: admin123

3. Para conectar ao banco:
	- Host: db
	- Porta: 5432
	- Usuário: lumora
	- Senha: secret
	- Database: lumora

O host "db" funciona porque os containers estão na mesma rede interna do Docker Compose.

---
# Comandos utilitários via Docker

Scripts prontos para facilitar o uso de ferramentas do projeto sem precisar instalar nada localmente:

- `./bin/php` — roda comandos PHP no container
- `./bin/composer` — roda Composer no container
- `./bin/psql` — acessa o banco Postgres no container

Exemplos:

```bash
./bin/php -v
./bin/composer install
./bin/psql
```

---
# Frontend (Vue 3 + Vite)

## Rodando o frontend em modo desenvolvimento (hot reload)

Para ver as alterações do frontend instantaneamente ao salvar arquivos `.vue` ou `.js`, rode o Vite em modo desenvolvimento usando Docker:

```bash
./bin/npm-dev
```

Isso irá:
- Instalar as dependências do Node (caso necessário)
- Rodar o servidor Vite em modo dev (porta 5173)
- Permitir hot reload no navegador (acesse http://localhost:5173)

> Dica: Deixe esse comando rodando em um terminal separado enquanto desenvolve o frontend.

Se acessar http://localhost:5173 e ver "not found", certifique-se de que o script está rodando.

## Rodando o build de produção

Para gerar os arquivos de produção (que serão servidos pelo Laravel/Nginx):

```bash
docker run --rm -it \
	-v "$PWD":/app \
	-w /app \
	node:18 \
	sh -c "npm install && npm run build"
```

Os arquivos serão gerados em `public/build`.

---
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

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
