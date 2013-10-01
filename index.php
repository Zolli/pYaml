<?php

include_once('vendor/autoload.php');

$instance = pYaml\pYaml::getInstance();
$instance->init("config.yaml");

$section = $instance->get("nagyon.mely.teszt.elem.ami.meg.melyebb");

/*if($section->isBoolean()) {
    die(var_dump($section->getBoolean()));
} else {
    die("nobool");
}

if($section->isInt()) {
    die(var_dump($section->getInt()));
} else {
    die("noint");
}*/

if($section->isString()) {
    die(var_dump($section->getString()));
} else {
    die("notstring");
}

if($section->isList()) {
    die(var_dump($section->getList()->getIterator()->current()));
} else {
    die("notlist");
}