<?php namespace Zolli\pYaml\Iterator;

use \Iterator;

class pYamlListIterator implements Iterator {

    /**
     * The current position in list
     * @var int Position
     */
    private $position = 0;

    /**
     * Full length of the list
     * @var int Length
     */
    private $length = 0;

    /**
     * Holds the array passed in constructor
     * @var array Constructor value
     */
    private $array = null;

    /**
    * Constructor
    * @param array $array tha selected node
    */
    public function __construct($array) {
        $this->position = 0;
        $this->array = $array;
        $this->length = count($this->array);
    }

    /**
     * Rewind the current position by one
     * @return Zolli\pYaml\Iterator\pYamlListIterator
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
        return $this->array[$this->position];
    }

    /**
     * Get the current element key
     * @return (int) Current key
     */
    function key() {
        return $this->position;
    }

    /**
     * Moves the iterator to the next element if has next
     * @return Zolli\pYaml\Iterator\pYamlListIterator
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