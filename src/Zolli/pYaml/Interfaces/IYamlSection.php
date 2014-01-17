<?php namespace Zolli\pYaml\Interfaces;

interface IYamlSection {
    
    public function isString();
    public function getString();
    public function isInt();
    public function getInt();
    public function isBoolean();
    public function getBoolean();
    public function isArray();
    public function getArray();
    public function isList();
    public function getList();
    public function getKeys();
    public function getName();
    public function hasChilds();
    public function getRaw();
    
}