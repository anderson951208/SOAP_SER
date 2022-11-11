<?php
require_once "vendor/econea/nusoap/src/nusoap.php";

$namespace = "RegistroProductoSOAP";
$server = new soap_server();
$server->configureWSDL("insertProducto", $namespace);

$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'InsertProducto',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'prod_nombre' => array('name'=> 'prod_nombre','type'=> 'xsd:string'),
        'prod_cantidad' => array('name'=> 'prod_cantidad','type'=> 'xsd:int'),
        'prod_precio' => array('name'=> 'prod_precio','type'=> 'xsd:int'),
    )
); 

$server->wsdl->addComplexType(
    'response',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'Resultado' => array('name'=> 'Resultado','type'=> 'xsd:boolean'),
        
    )
); 

$server->register(
    "InsertProductService",
    array( "InsertProducto" => "tns:InsertProducto"),
    array( "InsertProducto" => "tns:response"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Inserta un Producto"
); 

function InsertProductService($request){
    require_once "config/conexion.php";
    require_once "models/Producto.php";

    $producto = new Producto();
    $producto->insert_producto($request["prod_nombre"],$request["prod_cantidad"],$request["prod_precio"]);  

    return array(
        "Resultado" => true 
    );
}

$POST_DATA = file_get_contents("php://input");
$server->service($POST_DATA);
exit();
?>
