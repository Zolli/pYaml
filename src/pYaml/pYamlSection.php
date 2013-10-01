<?php
namespace pYaml;

class pYamlSection implements IYamlSection {
    
    private $object = null;
    private $sectionName = null;
    
    public function __construct($object, $section) {
        $this->object = $object;
        $this->sectionName = $section;
    }
    
    public function isString() {
        if(is_string($this->object)) {
            return true;
        }
        return false;
    }
    
    public function getString() {
        return (string) $this->object;
    }
    
    public function isInt() {
        if(is_int($this->object)) {
            return true;
        }
        return false;
    }
    
    public function getInt() {
        return (int) $this->object;
    }
    
    public function isBoolean() {
        if(is_bool($this->object)) {
            return true;
        }
        
        return false;
    }
    
    public function getBoolean() {
        return (boolean) $this->object;
    }
    
    public function isList() {
        $scanForArrays = false;
        foreach ($this->object as $key) {
            if(is_array($key)) {
                $scanForArrays = true;
            }
        }
        
        if((is_array($this->object)) && !$scanForArrays) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @return \pYaml\pYamlList
     */
    public function getList() {
        return new pYamlList($this->object);
    }
    
    public function getKeys() {
        
    }
    
    public function getName() {
        return $this->sectionName;
    }
    
    public function hasChilds() {
        $result = 0;
        foreach($this->object as $childrens) {
            if($childrens instanceof ArrayObject) {
                $result++;
            }
        }
        
        return $result;
    }
    
}
