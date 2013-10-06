<?php
namespace pYaml\Iterator;

class pYamlArrayIterator implements \Iterator {

    /**
     * The current position in array
     * @var int Position
     */
    private $position = 0;

    /**
     * Full length of the array
     * @var int Length
     */
    private $length = 0;

    /**
     * Holds the array passed in constructor
     * @var array Constructor value
     */
    private $array = array();

    /**
     * Constructor
     * @param array $array tha selected node
     */
    public function __construct(array $array) {
        $this->position = 0;
        $this->reIndex($array);
        $this->length = count($this->array);
    }

    /**
     * Re-indexing the given array, replace named index to numeric
     * @param $array
     */
    private function reIndex($array) {
        foreach($array as $k => $v) {
            array_push($this->array, $v);
        }
    }

    /**
     * Rewind the current position by one
     * @return \pYaml\Iterator\pYamlArrayIterator
     */
    function rewind() {
        if($this->position > 0) {
            $this->position = $this->position - 1;
        }
        
        return $this;
    }

    /**
     * Returns the current element at position
     * @return string The value at this position
     */
    function current() {
        return (string) $this->array[$this->position];
    }

    /**
     * Get the current element key
     * @return (int) Current key
     */
    function key() {
        return (int) $this->position;
    }
    
    /**
     * Moves the iterator to the next element if has next
     * @return \pYaml\Iterator\pYamlArrayIterator
     */
    function next() {
        if($this->position < $this->length) {
            $this->position++;
        }
        
        return $this;
    }

    /**
     * Determines the current position contains a valid element
     * @return bool Result
     */
    function valid() {
        return isset($this->array[$this->position]);
    }
}