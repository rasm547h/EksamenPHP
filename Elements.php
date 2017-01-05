<?php
$Elements = null;
if (isset($_POST["AllElementsButton"])) {
    $client = new SoapClient("http://webservicesoap.cloudapp.net/Service1.svc?wsdl");
    $function = $client->__getFunctions();
    //print_r($function);
    $types = $client->__getTypes();
    //print_r($types);
    $parametersToSoap = array();
    $result = $client->GetData($parametersToSoap);
    //print_r($result);
    $Elements = $result->GetDataResult->DataElement;
} else
    $text = "Something went wrong ...";

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('Home.twig');

$parametersToTwig = array("collection" => $Elements, "text" => "");
echo $template->render($parametersToTwig);