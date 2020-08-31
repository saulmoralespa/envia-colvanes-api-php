<?php

use PHPUnit\Framework\TestCase;
use EnviaColvanes\Client;

class EnviaColvanesTest extends TestCase
{
    public $enviaColvanes;

    protected function setUp()
    {
        $dotenv = Dotenv\Dotenv::createMutable(__DIR__ . '/../');
        $dotenv->load();

        $user = $_ENV['USERENVIA'];
        $password = $_ENV['PASSWORDENVIA'];
        $codAccount = $_ENV['CODCUENTAENVIA'];

        $this->enviaColvanes = new Client($user, $password, $codAccount);
        $this->enviaColvanes->sandboxMode(true);

    }

    public function testLiquidation()
    {

        $cart_prods = [];
        $cart_prods[] = array(
            'cantidad' => 1,
            'largo' => 10.0,
            'ancho' => 10.0,
            'alto' => 10.0,
            'peso' => 10,
            'declarado' => 10000
        );

        $params = array (
            'ciudad_origen' => '05001',
            'ciudad_destino' => '11001',
            'cod_formapago' => 4,
            'cod_servicio' => 12,
            'info_cubicacion' => $cart_prods
        );
        $response = $this->enviaColvanes->liquidation($params);
        var_dump($response);
        $this->assertAttributeEmpty('respuesta', $response);
    }

    public function testGenerateGuide()
    {

        $cart_prods = [];
        $cart_prods[] = array(
            'cantidad' => 1,
            'largo' => 10.0,
            'ancho' => 10.0,
            'alto' => 10.0,
            'peso' => 10,
            'declarado' => 10000
        );

        $cart_prods[] = array (
            'cantidad' => 1,
            'largo' => 20.0,
            'ancho' => 20.0,
            'alto' => 20.0,
            'peso' => 20,
            'declarado' => 20000
        );

        $params = array (
            'ciudad_origen' => '1',
            'ciudad_destino' => '1',
            'cod_formapago' => 4,
            'cod_servicio' => 3,
            'info_cubicacion' => $cart_prods,
            'mca_nosabado' => 0,
            'mca_docinternacional' => 0,
            'cod_regional_cta' => 1,
            'cod_oficina_cta' => 1,
            'con_cartaporte' => '0',
            'info_origen' =>
                array (
                    "nom_remitente" => "JORGE GOMEZ",
                    "dir_remitente" =>  "CALLE 13 84 60",
                    "tel_remitente" =>  "2020202",
                    "ced_remitente" => "79123456"
                ),
            'info_destino' =>
                array (
                    'nom_destinatario' => 'JUAN PEREZ',
                    'dir_destinatario' => 'CARRERA 15 # 15 15',
                    'tel_destinatario' => '3030303',
                ),
            'info_contenido' =>
                array (
                    'dice_contener' => 'zapatos',
                    'num_documentos' => '12345-67890',
                ),
        );
        $response = $this->enviaColvanes->generateGuide($params);
        var_dump($response);
        $this->assertAttributeEmpty('respuesta', $response);
        $this->assertAttributeNotEmpty('urlguia', $response);
    }

    public function testGetGuide()
    {
        $guide = '016000727591';
        $response = $this->enviaColvanes->getGuide($guide);
        var_dump($response);
    }
}