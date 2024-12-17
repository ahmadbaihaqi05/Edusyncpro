<?php

require "Guru.php";

$server = new SoapServer("guru.wsdl");
$server->setClass("Guru");
$server->handle();