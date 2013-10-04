<?php
namespace pYaml\Interfaces;

interface IpYamlArrayAccess {
    
    /**
     * Gets iterator for this object
     * 
     */
    public function getIterator();
    
    /**
     * Returns the raw result array
     */
    public function getArray();
    
    /**
     * Get the key value from this object
     * 
     * @param string $key Array Key
     */
    public function get($key);
    
    /**
     * Set a key in the current object
     * 
     * @param int $key The key to be set
     * @param string $val The new value
     */
    public function set($key, $val);
    
    /**
     * Returns the length of the current object
     */
    public function getLength();
    
}
