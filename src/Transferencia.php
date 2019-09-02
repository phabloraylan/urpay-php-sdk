<?php
namespace URPay;

class Transferencia {

    private $cliente;
    public function __construct($cliente){
        $this->cliente = $cliente;
    }

    public function executar($id,$valor){

        $consulta = new Consulta($this->cliente);
        try{
            $usuario = $consulta->getUsuario($id);
        }catch(Exception\NaoEncontrado $e){
            echo $e->getMessage();//Mensagem de erro
        }catch(Exception\ErroServidor $e){
            echo $e->getMessage();//Mensagem de erro
        }
        
        $token = $this->cliente->getTokenComum();
        // Create a client with a base URI
        $client = new \GuzzleHttp\Client(['base_uri' => Http\Api::URL_BASE,'verify' => false]);

        try{
            // Send a request to https://foo.com/api/test
            $response = $client->request('POST', '/v1/user-api/finance/new-transfer', [
                'headers' => [
                    'Authorization' => $token
                ],
                [
                    'to_user_id' => $usuario['_id'],
                    'value' => $valor

                ]
            ]);
            $body = json_decode($response->getBody(),true)['transfer'];
            return $body;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new Exception\NaoEncontrado('Transferência ' . $id . ' não encontrada');
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            throw new Exception\ErroServidor('Erro inesperado, tente novamente mais tarde');
        }
    }
}