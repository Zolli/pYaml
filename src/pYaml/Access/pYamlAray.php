<?php
namespace pYaml\Access;

class pYamlArray implements \pYaml\Interfaces\IpYamlArrayAccess {
    
    private $array = null;
    
    public function __construct($array) {
        $this->array = $array;
    }
    
    public function get($key) {
        if(isset($this->array[$key])) {
            return $this->array[$key];
        }
        return false;
    }
    
    public function set($key, $val) {
        if(isset($this->array[$key])) {
            $this->array[$key] = $val;
            return true;
        }
        return false;
    }
    
    /**
     * 
     * @return \pYaml\pYamlArrayIterator
     */
    public function getIterator() {
        return new pYamlArrayIterator($this->array);
    }
    
    public function getArray() {
        return $this->array;
    }
    
    public function getLength() {
        return count($this->array);
    }
    
}