<?php namespace Zolli\pYaml\Access;

use Zolli\pYaml\Interfaces\IpYamlArrayAccess;
use Zolli\pYaml\Iterator\pYamlArrayIterator;

class pYamlArray implements IpYamlArrayAccess {
    
    /**
     * Hold the constructor value
     * @var type 
     */
    private $array = null;
    
    /**
     * Constructor
     * @param array $array Constructor value
     */
    public function __construct($array) {
        $this->array = $array;
    }
    
    /**
     * Get the key value from this object
     * 
     * @param string $key Array Key
     * @return mixed The key value, false otherwise
     */
    public function get($key) {
        if(isset($this->array[$key])) {
            return $this->array[$key];
        }
        return false;
    }
    
    /**
     * Set a key in the current object
     * 
     * @param int $key The key to be set
     * @param string $val The new value
     * @return mixed Return this object if its success, false otherwise
     */
    public function set($key, $val) {
        if(isset($this->array[$key])) {
            $this->array[$key] = $val;
            return this;
        }
        return false;
    }
    
    /**
     * Gets iterator for this object
     * 
     * @return Zolli\pYaml\Iterator\pYamlArrayIterator
     */
    public function getIterator() {
        return new pYamlArrayIterator($this->array);
    }
    
    /**
     * Returns the raw result array
     * 
     * @return array Raw data
     */
    public function getArray() {
        return (array) $this->array;
    }
    
    /**
     * Returns the length of the current object
     * 
     * @return int Object length
     */
    public function getLength() {
        return (int) count($this->array);
    }
    
}