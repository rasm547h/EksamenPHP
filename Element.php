<?php
$element = null;
if (isset($_POST["param"])) {
    $input = $_POST['param'];
    $client = new SoapClient("http://webservicesoap.cloudapp.net/Service1.svc?wsdl");
    $function = $client->__getFunctions();
    //print_r($function);
    $types = $client->__getTypes();
    //print_r($types);
    $parametersToSoap = array("identity" => $input);
    $result = $client->GetSpecificDataElement($parametersToSoap);
    //print_r($result);
    $element = $result->GetSpecificDataElementResult;
    //echo $element->String1;
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