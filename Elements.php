<?php
//$uri = "http://localhost:2830/Service1.svc/DataElement";
$uri = "http://webservicerestful.cloudapp.net/Service1.svc/DataElement";
$elements = null;
if (isset($_POST["AllElementsButton"])) {

    /*
    $client = new SoapClient("http://webservicesoap.cloudapp.net/Service1.svc?wsdl");
    //$client = new SoapClient("http://localhost:1107/Service1.svc?wsdl");
    $function = $client->__getFunctions();
    //print_r($function);
    $types = $client->__getTypes();
    //print_r($types);
    $parametersToSoap = array();
    $result = $client->GetData($parametersToSoap);
    //print_r($result);
    $elements = $result->GetDataResult->DataElement;
    */

    $elements = file_get_contents($uri);
    //print_r($elements);
    $convertToAssociativeArray = true;
    $elements = json_decode($elements, $convertToAssociativeArray);
    //print_r($elements);

} else
    $text = "Something went wrong ...";

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('Home.twig');

$parametersToTwig = array("collection" => $elements, "text" => "");
echo $template->render($parametersToTwig);