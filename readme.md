# API HTTP para busca de CEP

- **Linguagem de Programação:** PHP 7.x
- **Framework:** Laravel 5.2.x
- **Servidor:** PHP Built-in web server

## Como funciona a aplicação?

Essa pequena aplicação permite que você consulte um endereço pelo **CEP** ou pelo **Logradouro**.

Existem apenas 2 endpoints na aplicação:

- `/api/v1/cep/busca-por-cep/{cep}` - GET

**Exemplo:** `http://localhost:8000/api/v1/cep/busca-por-cep/38401332`

**Response:**

    {
        "error": false,
        "addresses": [
            {
                "Logradouro/Nome": "Rua Moisés de Freitas ",
                "Bairro/Distrito": "Jardim Brasília ",
                "Localidade/UF": "Uberlândia/MG",
                "CEP": "38401-332"
            }
        ]
    }

- `/api/v1/cep/busca-por-logradouro/{logradouro}` - GET

**Exemplo:** `http://localhost:8000/api/v1/cep/busca-por-logradouro/Rua%20Patrick`

**Response:**

    {
        "error": false,
        "addresses": [
            {
                "Logradouro/Nome": "Rua Patrick Drumont ",
                "Bairro/Distrito": "Parada Amaral ",
                "Localidade/UF": "Nova Iguaçu/RJ",
                "CEP": "26041-088"
            },
            {
                "Logradouro/Nome": "Rua Patrick de Mendonsa ",
                "Bairro/Distrito": "Polícia Rodoviária ",
                "Localidade/UF": "Araranguá/SC",
                "CEP": "88902-382"
            },
            ...


## Como configurar a aplicação?

### Pré-requisitos

- Instalar o PHP 7.x e adicioná-lo no PATH
- Instalar o Composer e adicioná-lo no PATH
- Instalar o Git e... you know :D

## Clone e algumas configurações

Abra o terminal, vá até a pasta onde deseja clonar a aplicação e digite o comando abaixo:

    git clone https://github.com/patrickmaciel/api-http-busca-cep.git

Como retorno, a pasta `api-http-busca-cep` será criada.

Agora instale as dependências necessárias executando o comando abaixo:

    composer update

Copie agora o arquivo `.env.example` na raiz do projeto e renomeie para `.env` (esse arquivo contém informações necessárias para que a API funcione adequadamente):

    cp .env.example .env

Volte para o terminal e digite o comando abaixo para finalizar:

    php artisan key:generate

## Executando a aplicação

Para testar a aplicação de forma mais rápida utilize o próprio PHP como servidor.

Abra o terminal, vá até a pasta onde está a aplicação e já dentro dela digite os comandos abaixo:

    cd public/
    php -S localhost:8000

Agora abra o browser de sua preferência e acesse `http://localhost:8000`.

Pronto :)

---

#### TODO

- [x] Configurar aplicação padrão
- [x] Configurar rota padrão
- [x] Configurar rota para buscar Endereço por CEP
- [x] Configurar rota para buscar CEP por Endereço
- [x] Limitar quantidade de requisições por IP
- [x] Validar parâmetro informado na URL
- [x] Páginas de erro
- [ ] Refatorar usando Repository
- [x] Refatorar usando Services
- [x] Response padrão
- [ ] TDD
