(ENGLISH VERSION HERE)[README_ENGLISH.md]

# Meu Câmbio

Observações a respeito da atualização de publicações do feed: Foi criado uma estrutura de banco de dados que pode ser vista através do modelo na pasta `database`. Essa estrutura faz o cache de todas as publicações a cada 5 horas (ultima execução), porém mantive a atualização manual (poderia virar um cron) através da implementação das estrutura de Command do próprio Laravel, no item **7** deste tutorial.

## Login e uso da API:

Além da documentação que pode ser importada no **Postman** através do link [https://www.getpostman.com/collections/0f3de4c8c196ddfd5747](https://www.getpostman.com/collections/0f3de4c8c196ddfd5747)
Ou pode ser importado em qualquer cliente compativel com Swagger 2.0, existe um arquivo `api_v1.yml` na raiz do projeto.

O usuário padrão inserido via seed é,
email: **test@meucambio.com.br**
password: **root**

É importante saber que a autenticação dos outros métodos é feita através de um Bearer Token (JWT) conforme o Header a baixo:
Authorization: Bearer <token >

## Tutorial de instalação:

1. Clone o projeto:
```
git clone gabrielanhaia/meu-cambio
```

2. Faça uma cópia do arquivo `.env.example` para `.env` na raiz do seu projeto.

3. Faça a configuração das seguintes variáveis:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=meu_cambio
DB_USERNAME=root
DB_PASSWORD=123123
```

4. Conecte-se ao seu banco de dados MySQL e cria uma base com o nome inserido na variável `DB_DATABASE` do passo anterior.

5. Abra a raiz do projeto no seu terminal e execute os seguintes comandos para atualizar sua aplicação.
```
php artisan key:generate
php artisan jwt:secret
```

6. Execute as `Migrations` e os `Seeders` para atualizar sua base de dados (OBS: É importante ter executado corretamente os passos 3 e 4):
```
php artisan migrate
php artisan db:seed
```

7. Execute o comando para atualizar as publicações do Feed da globo:
```
php artisan update_feed:globo
```

8. Execute o servidor (PHP Build-in com o Artisan):
```
php artisan serve
```
 
9. Basta testar a API.


