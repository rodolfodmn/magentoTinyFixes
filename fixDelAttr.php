<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('xdebug.var_display_max_depth', -1);
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);
include 'app/Mage.php';
Mage::app();
$attr = "moveisbdoisw";
$data =  Mage::helper('gtd')->product()->attribute()->getAttributes();
foreach ($data as $key => $value) {
    if ($value->getAttributeCode() == $attr) {
        $value->delete();
    }
}
