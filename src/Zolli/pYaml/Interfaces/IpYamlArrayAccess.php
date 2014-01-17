<?php namespace Zolli\pYaml\Interfaces;

interface IpYamlArrayAccess {

    public function getIterator();
    public function getArray();
    public function get($key);
    public function set($key, $val);
    public function getLength();
    
}
