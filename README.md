# URPay PHP SDK #

Essa biblioteca permite você se conectar com https://apidocs.urpay.com.br/ através do seu sistema.

Essa biblioteca não é oficial. Contudo, a considero funcional, pois sempre adiciono novas ferramentas.

**NOTA** Foi testada com  PHP 7.1.8 e superior, não garanto funcionar bem em versões anterioes.

## Documentação da API

A documentação oficial da API Rest se encontra aqui: https://apidocs.urpay.com.br/

## Instalação

Você pode usar **Composer**

### Composer

O metodo mais conveniente é via [composer](https://getcomposer.org/). Se ainda não possui o composer instalado, [siga as instruções](https://getcomposer.org/doc/00-intro.md).

Execute o seguinte comando na raiz do seu projeto para instalar a biblioteca:

```sh
composer require phabloraylan/urpay-php-sdk
```

Inclua o autoloader em seu projeto:

```php
require_once 'vendor/autoload.php';
```

### Consultar Saldo ###

Recupere informações de saldo da conta:

```php
use URPay\Client;
use URPay\Services\Balance\BalanceService;

$client = new Client();
$client->setTokenCommon("TOKEN_COMUM");

$balanceResponse = BalanceService::getBalance($client);
echo $balanceResponse->getBalance();//saldo
echo $balanceResponse->getBlocked();//saldo bloqueado
echo $balanceResponse->getFuture();//saldo futuro
echo $balanceResponse->getGiftcard();//saldo de vale-presente
```

### Consultar Transação ###

Recupere informações de transação:

```php
use URPay\Client;
use URPay\Services\InternalTransfer\InternalTransferService;

$client = new Client();
$client->setTokenCommon("TOKEN_COMUM");

$transf = "ID_TRANSFERÊNCIA";
$transfResponse = InternalTransferService::getInternalTransfer($client, $transf);

echo $transfResponse->getValue();//valor (resultado em decimal ex.: 10.00)

echo $transfResponse->getId();

$cryptoCoins = $transfResponse->getCryptoCoins();
echo $cryptoCoins->getTransactionHash();

echo $transfResponse->getUpdated();
echo $transfResponse->isPayment();
echo $transfResponse->getStatus();
echo $transfResponse->getContested();
echo $transfResponse->isReversed();
echo $transfResponse->isReversal();
echo $transfResponse->isCryptoCoins();

// De quem saiu a transação
$sendFrom = $transfResponse->getSendFrom();
echo $sendFrom->getId();
echo $sendFrom->getUser();
echo $sendFrom->getName();

$sendFromDocument = $sendFrom->getDocument();
echo $sendFromDocument->getDocument();
echo $sendFromDocument->getType();

// Para quem foi a transação
$sendTo = $transfResponse->getSendTo();
echo $sendTo->getId();
echo $sendTo->getUser();
echo $sendTo->getName();

$sendToDocument = $sendTo->getDocument();
echo $sendToDocument->getDocument();
echo $sendToDocument->getType();

echo $transfResponse->getRegistered();

//retorma uma instancia de Carbon\Carbon usuando a biblioteca composer require nesbot/carbon
$regiteredCarbon = $transfResponse->getRegisteredCarbon();

// Verificar se a hash tem sua transferência 100% confirmada e sem contestação:
if($transfResponse->isPaymentSuccess()){
    //confirmada
}
```
### Consultar Usuário ###

Recupere informações do usuário:

```php
use URPay\Client;
use URPay\Services\User\UserService;

$client = new Client();
$client->setTokenCommon("TOKEN_COMMON");

$user_id = "@fulanodetal" // Exemplo: @fulanodetal ou fulanodetal
$userResponse = UserService::getUser($client, $user_id);

echo $userResponse->getId();//_id do usuário
echo $userResponse->getUser();
echo $userResponse->getName();
echo $userResponse->getGender();

// Documento do usuário
$userDocument = $userResponse->getDocument();
echo $userDocument->getDocument();
echo $userDocument->getType();

// Endereço do usuário
$userAddress = $userResponse->getAddress();
echo $userAddress->getCity();
echo $userAddress->getState();
echo $userAddress->getCountry();

// Caso deseje consultar usuário por documento, use o terceiro parametro com a constante UserService::DOCUMENT, exemplo: 

$client = new Client();
// O token precisa ser de consulta a documento
$client->setTokenDoc("TOKEN_DOC");

$doc = "12345678900" // Exemplo: 12345678900 ou 123.456.789-00 (Com máscara também aceito)
$userResponse = UserService::getUser($client, $doc,UserService::DOCUMENT);

// Todos os metódos de consulta por usuário pode ser usado e tambem o de e-mail, que só retorna quando está com true
echo $userResponse->getEmail();
```

No momento API de transferência está enfrentrando estabilidades, quando se normalizar adiciono aqui e tambem termino de documentar todas os metódos.