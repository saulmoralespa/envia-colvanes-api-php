# envia-colvanes-api-php

## Installation ##

Use composer package manager

```bash
composer require saulmoralespa/envia-colvanes-api-php
```

```php
// ... please, add composer autoloader first
include_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// import webservice class
use EnviaColvanes\Client;

$user = ''; // your user of Envia Colvanes
$password = ''; // your password of Envia Colvanes
$codAccount = ''; // code Account of Envia Colvanes


try{
    $enviaColvanes = new Client($user, $password, $codAccount);
    $enviaColvanes->sandboxMode(true);
}
catch (\Exception $exception){
    echo $exception->getMessage();
}
```

### Liquidation

```php

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
            'ciudad_origen' => '05001', //Code city DANE, Medellín 
            'ciudad_destino' => '11001', //Code city DANE, Bogotá
            'cod_formapago' => 4,
            'cod_servicio' => 12,
            'info_cubicacion' => $cart_prods
        );

try{
    $data = $enviaColvanes->liquidation($params);
}
catch (\Exception $exception){
    echo $exception->getMessage();
}

```

### Generate guide

```php

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
                    'dice_contener' => 'zapatos', // required for generate guide
                    'num_documentos' => '12345-67890',
                ),
        );

try{
    $data = $enviaColvanes->liquidation($params);
}
catch (\Exception $exception){
    echo $exception->getMessage();
}

```

### Guide tracking

```php

try{
    $guide = '016000727591';  // number guide    
    $response = $enviaColvanes->getGuide($guide);
}
catch (\Exception $exception){
    echo $exception->getMessage();
}

```

