# Redação 1000

![Tests](https://github.com/studos-software/st-bundle-redacao1000/workflows/Tests/badge.svg)
![Lint](https://github.com/studos-software/st-bundle-redacao1000/workflows/Lint/badge.svg)
[![codecov](https://codecov.io/gh/studos-software/st-bundle-redacao1000/branch/master/graph/badge.svg?token=GMQ3QGLQQ7)](https://codecov.io/gh/studos-software/st-bundle-redacao1000)

### Instalação

```console
composer require "studossoftware/redacao1000"
```

### Configuração

### Cliente HTTP

```php
use Studos\Redacao1000\HttpClient;

$token = getenv('REDACAO1000_TOKEN');
$ambiente = getenv('REDACAO1000_ENV');

$client = new HttpClient($token, $ambiente); 
```

### Autenticação

Para utilizar os demais endpoints, é necessário um token de acesso (a ser passado para o Cliente HTTP).

```php
/* @global $client */
use Studos\Redacao1000\Authentication;

$usuario = getenv('REDACAO1000_USERNAME');
$senha = getenv('REDACAO1000_PASSWORD');

$auth = new Authentication($client);
$response = $auth->login($usuario, $senha);
```

## Licença

Proprietary :(
