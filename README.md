# URPay PHP SDK
> SDK PHP do urpay.com.br (Consulta usuários e transferências).


Futuramente adicionaremos outras funções.

## Instalação

Via composer:

```sh
composer require phabloraylan/urpay-php-sdk
```

## Usando

Inclua o autoload em seu projeto, exemplo:

```php
require_once __DIR__ . '/vendor/autoload.php';
```

Instanciar a classe  de cliente:

```php
//Classe cliente
$cliente = new \URPay\Cliente();

//Set o seu token comum
$cliente->setTokenComum('<TOKEN>');
```

Instanciar a classe de consulta:

```php
//O construtor da classe requer uma instância de cliente
$consulta = new \URPay\Consulta($cliente);
```

Obtenha informações de um usuário específico:

```php
$usuario = $consulta->getUsuario('usuario'); 
print_r($usuario)//retorno em array
```

Obtenha informações de uma transferência específica:

```php
$transf = $consulta->getTransferencia('id-transferência'); 
print_r($transf);//retorno em array
```

Caso aja erro na consulta, token ou de rede, é retornado um Exception, você pode tratar-las com exemplos em:
<http://docs.guzzlephp.org/en/stable/quickstart.html#exceptions>
