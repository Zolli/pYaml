<?php
namespace pYaml\Access;

class pYamlList implements IpYamlArrayAccess {
    
    private $array = null;
    
    public function __construct($array) {
        $this->array = $array;
    }
    
    /**
     * 
     * @return \pYaml\pYamlListIterator
     */
    public function getIterator() {
        return new pYamlListIterator($this->array);
    }
    
    public function getArray() {
        return (array) $this->array;
    }
    
    public function get($key) {
        return $this->array[$key];
    }
    
    public function set($key, $val) {
        $this->array[$key] = $val;
    }
    
    public function getLength() {
        return count($this->array);
    }
    
}
