<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('xdebug.var_display_max_depth', -1);
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);

include 'app/Mage.php';
Mage::app();


if(!$myfile = fopen("media/any_id.txt", "r")){
    $myfile = fopen("media/any_id.txt", "w");
    fwrite($myfile, 1000);
    fclose($myfile);
}
$myfile = fopen("media/any_id.txt", "r");
echo $index = fgets($myfile);

$collection = Mage::getModel('sales/order')->getCollection()
        ->addAttributeToFilter('entity_id', array('gteq' => $index-1000))
        ->addAttributeToFilter('entity_id', array('lteq' => $index));
    
foreach ($collection as $key => $value) {
    if($value->getData('bis2bis_anymarket_code')){
        $a = Mage::getModel('bis2bis_anymarket/order')->get_market_id($value->getData('bis2bis_anymarket_code'));
        $any_code = explode('-', $a['marketPlaceId'])[1];
        $value->setData('marketplace_order_id', $any_code);
        $value->save();
    }
}

$myfile = fopen("media/any_id.txt", "w");
fwrite($myfile, $index+1000);
fclose($myfile);

var_dump("Importação terminada! :)");

