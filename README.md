# App nano

## Rodando via Docker

Primeiramente devemos ciar o arquivo `.env` e preenche-lo as informações da conexão do banco de dados. A úniva informação que não é livre é o *DB_HOST* que deve ser correspondente ao nome do container do mysql contido no arquivo `docker-compose.yml`.

Faça uma cópia do arquivo de exemplo e verifique as informações preenchidas:

> $ cp .env.example .env

Execute o docker-compose para levantar o ambiente:

> $ docker-compose up -d --build

Agora que já temos os serviços rodando, iremos configurar a key do laravel e rodar a migração do banco de dados dentro do container da aplicação:

> $ docker exec -it nano-app bash

Rode o composer para instalar as bibliotecas:

> $ composer install

> $ npm install

> $ npm run dev

Rode o artisan para configurar o ambiente:
> $ php artisan key:generate

> $ php artisan migrate --seed

Para testar, acesse http://localhost:8080


## Qualidade de código

Rode o artisan para verificar a qualidade do código:
> $ php artisan insights



