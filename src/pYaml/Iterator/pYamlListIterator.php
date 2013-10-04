<?php
namespace pYaml\Iterator;

class pYamlListIterator implements \Iterator {
    private $position = 0;
    private $length = 0;
    private $array = null; 

    public function __construct($array) {
        $this->position = 0;
        $this->array = $array;
        $this->length = count($this->array);
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