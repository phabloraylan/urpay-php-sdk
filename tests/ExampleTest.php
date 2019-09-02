<?php
namespace URPay;

class ExampleTest extends TestCase
{
    public function testExample()
    {
        //Classe cliente
        $cliente = new Cliente();

        //Set o seu token comum
        $cliente->setTokenComum('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjVjM2U5MjA5NDdjMTczN2MzM2UwNzVjNSIsImlkS2V5IjoiJDJiJDEwJGgzUFJGa2EzWDNYaGNaRTkzcFZuSXVBRlN5WFA4WnJDNjhEelV1NGJ3ODNsU2owNWQzTFAyIiwidHlwZUxvZ2luIjoidXNlcl90b2tlbiIsInR5cGVMb2dpbktleSI6IiQyYiQxMCR6ZmZGWERwbi5icDIwRXVVVkZIQkgueFkvd2hMOUs0Y1dRTEFkTVNXdU8yNWVtRTUxNTZ2cSIsInR5cGVUb2tlbiI6ImdlbmVyYWwiLCJ0eXBlVG9rZW5LZXkiOiIkMmIkMTAkRTFpL0xTZXY0UGtVVTdyRXFJdE1ZT1VtUHNkRlR3Mmg5bzQ2VmdEMWtMSjFlUmtOMGJSZjYiLCJpYXQiOjE1NDc2MDU3Nzh9.jadZRxC0SBcX1xexGECT9B_J-gRkp19A0tmfDL9Z00k');

        $consulta = new Consulta($cliente);
        $transferencia = $consulta->getTransferencia('5c482be20c9e6e0b017f026f');
        
        //print_r($transferencia);
        $this->assertTrue(true);
    }
}