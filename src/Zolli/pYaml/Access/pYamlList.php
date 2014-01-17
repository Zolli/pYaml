<?php namespace Zolli\pYaml\Access;

use Zolli\pYaml\Interfaces\IpYamlArrayAccess;
use Zolli\pYaml\Iterator\pYamlListIterator;

class pYamlList implements IpYamlArrayAccess {
    
    /**
     * Holds the constructed data
     * @var array constructor data
     */
    private $array = null;
    
    /**
     * Constructor
     * @param array $array Input
     */
    public function __construct($array) {
        $this->array = $array;
    }
    
    /**
     * Return the iterator for this object
     * 
     * @return Zolli\pYaml\Iterator\pYamlListIterator
     */
    public function getIterator() {
        return new pYamlListIterator($this->array);
    }
    
    /**
     * Return the raw parsed array
     * 
     * @return array Raw result
     */
    public function getArray() {
        return (array) $this->array;
    }
    
    /**
     * Returns a numeric key from array
     * 
     * @param int $key The numerical key of the array
     * @return string
     */
    public function get($key) {
        return (string) $this->array[$key];
    }
    
    /**
     * Set a numeric key value on this array
     * 
     * @param int $key The key to be set
     * @param string $val The key new value
     */
    public function set($key, $val) {
        $this->array[$key] = $val;
        return this;
    }
    
    /**
     * Returns the length of this array
     * 
     * @return int The array object length
     */
    public function getLength() {
        return (int) count($this->array);
    }
    
}
