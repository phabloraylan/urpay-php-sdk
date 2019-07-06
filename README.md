# urpay-php-sdk
SDK PHP do urpay.com.br (Consulta usuários e transferências)


$cliente  = new \URPay\Cliente();
$cliente->setTokenComum('<token>');

$consulta = new \URPay\Consulta($cliente);

$usuario = $consulta->getUsuario('usuario');
print_r($usuario);

$transf = $consulta->getTransferencia('id-transferência');
print_r($transf);
