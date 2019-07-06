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
try{

    $usuario = $consulta->getUsuario('usuário');
    print_r($usuario);//retorno em array

}catch(\URPay\Exception\NaoEncontrado $e){
    echo $e->getMessage();//Mensagem de erro
}catch(\URPay\Exception\ErroServidor $e){
    echo $e->getMessage();//Mensagem de erro
}
```

Obtenha informações de uma transferência específica:

```php
try{

    $transferencia = $consulta->getTransferencia('id transfência');
    print_r($transferencia);//retorno em array

}catch(\URPay\Exception\NaoEncontrado $e){
    echo $e->getMessage();//Mensagem de erro
}catch(\URPay\Exception\ErroServidor $e){
    echo $e->getMessage();//Mensagem de erro
}
```
