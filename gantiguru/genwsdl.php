<?php

require "vendor/autoload.php";

require "Guru.php";

$gen = new \PHP2WSDL\PHPClass2WSDL("Guru", "http://localhost/gantiguru/server.php");

$gen->generateWSDL();
file_put_contents("guru.wsdl", $gen->dump());

echo "Done";
