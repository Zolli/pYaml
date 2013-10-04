<?php
namespace pYaml\Iterator;

class pYamlArrayIterator implements \Iterator {
    private $position = 0;
    private $length = 0;
    private $array = array();

    public function __construct($array) {
        $this->position = 0;
        $this->reIndex($array);
        $this->length = count($this->array);
    }
    
    private function reIndex($array) {
        foreach($array as $k => $v) {
            array_push($this->array, $v);
        }
    }
    
    function rewind() {
        if($this->position > 0) {
            $this->position = $this->position - 1;
        }
        
        return $this;
    }

    function current() {
        return $this->array[$this->position];
    }

    function key() {
        return $this->position;
    }
    
    /**
     * 
     * @return \pYaml\Iterator\pYamlArrayIterator
     */
    function next() {
        if($this->position < $this->length) {
            $this->position++;
        }
        
        return $this;
    }

    function valid() {
        return isset($this->array[$this->position]);
    }
}