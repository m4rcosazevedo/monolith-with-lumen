# Accound Documentation
Monolito criado para criar uma api que contenha uma documentação do o swagger.

## Comandos

### Rodar os containers
#### Ligar
`docker-compose up -d`
#### Desligar
`docker-compose down`

---
### Acessar o container docker
`docker exec -it NOME_DO_CONTAINER`

### Conexão com o banco de dados
`jdbc:mysql://localhost:8000/customer`

---
### comandos dentro do container docker
#### instalar os pacotes do composer
`composer install -o -vvv`

#### limpar cache do composer
`composer clearcache`

#### refazer o autoload do composer
`composer dump-autoload -o`

#### instalar um pacote
`composer require NOME_DO_PACOTE`

#### Rodar as migrations juntos com os seeders
`php artisan migrate:fresh --seed`

#### Gerar secret para o jwt no env
`php artisan jwt:secret`

#### Gerar a documentação do swagger
`php artisan swagger-lume:generate`
