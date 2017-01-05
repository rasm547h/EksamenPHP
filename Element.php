<?php
//$uri = "http://localhost:2830/Service1.svc/DataElement/?identity=";
$uri = "http://webservicerestful.cloudapp.net/Service1.svc/DataElement/?identity=";
$element = null;
if (isset($_POST["param"])) {

    $input = $_POST['param'];

    /*
    //$client = new SoapClient("http://webservicesoap.cloudapp.net/Service1.svc?wsdl");
    $client = new SoapClient("http://localhost:1107/Service1.svc?wsdl");
    $function = $client->__getFunctions();
    //print_r($function);
    $types = $client->__getTypes();
    //print_r($types);
    $parametersToSoap = array("identity" => $input);
    $result = $client->GetSpecificDataElement($parametersToSoap);
    //print_r($result);
    $element = $result->GetSpecificDataElementResult;
    //echo $element->String1;
    */

    $uri = $uri.$input;
    $result = file_get_contents($uri);
    //print_r($result);
    $convertToAssociativeArray = true;
    $element = json_decode($result, $convertToAssociativeArray);
    //print_r($element);

} else
    $text = "Something went wrong ...";

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('Home.twig');

$parametersToTwig = array("element" => $element, "text" => "");
echo $template->render($parametersToTwig);