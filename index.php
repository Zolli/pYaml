<?php

include_once('vendor/autoload.php');

$instance = pYaml\pYaml::getInstance();
$instance->init("config.yaml");
$selector = new \pYaml\nodeSelector\nodeSelector("updater.updateChannels");
$section = $instance->get($selector);

if($section->isArray()) {
    die(var_dump($section->getArray()->getIterator()->next()->current()));
}

if($section->isBoolean()) {
    die(var_dump($section->getBoolean()));
}

if($section->isInt()) {
    die(var_dump($section->getInt()));
}

if($section->isString()) {
    die(var_dump($section->getString()));
}

if($section->isList()) {
    die(var_dump($section->getList()->getIterator()->current()));
}