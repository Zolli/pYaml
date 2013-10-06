<?php
namespace pYaml;

class pYamlSection implements \pYaml\Interfaces\IYamlSection {
    /**
     * Holds the current section array
     * @var array Object
     */
    private $object = null;

    /**
     * Holds the current section name
     * @var string Section name (Last piece of the selector)
     */
    private $sectionName = null;

    /**
     * Constructor
     * @param array $object Parsed section
     * @param string $section Section name
     */
    public function __construct($object, $section) {
        $this->object = $object;
        $this->sectionName = $section;
    }

    /**
     * Return true if the current section is a string
     * @return bool Result
     */
    public function isString() {
        if(is_string($this->object)) {
            return true;
        }
        return false;
    }

    /**
     * Returns a string object from the section
     * @return string Result
     */
    public function getString() {
        return (string) $this->object;
    }

    /**
     * Return true if the current section is an integer
     * @return bool Result
     */
    public function isInt() {
        if(is_int($this->object)) {
            return true;
        }
        return false;
    }

    /**
     * Returns a integer object from the section
     * @return int Result
     */
    public function getInt() {
        return (int) $this->object;
    }

    /**
     * Returns true if the current section is a boolean
     * @return bool Result
     */
    public function isBoolean() {
        if(is_bool($this->object)) {
            return true;
        }
        
        return false;
    }

    /**
     * Returns a boolean object from the section
     * @return bool Result
     */
    public function getBoolean() {
        return (boolean) $this->object;
    }

    /**
     * Return true if the current section is a list
     * @return bool Result
     */
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
     * Return a pYamlList object based on the current object
     * @return \pYaml\Access\pYamlList
     */
    public function getList() {
        return new \pYaml\Access\pYamlList($this->object);
    }

    /**
     * Return true if the current section is an array
     * @return bool Result
     */
    public function isArray() {
        if(is_array($this->object)) {
            return true;
        }
        return false;
    }

    /**
     * Return a pYamlArray object based on current object
     * @return \pYaml\Access\pYamlArray
     */
    public function getArray() {
        return new \pYaml\Access\pYamlArray($this->object);
    }

    /**
     * Return the keys of the current section
     */
    public function getKeys() {
        throw new \Exception("Not yet implemented");
    }

    /**
     * Returns the name of the current section
     * @return string Section name
     */
    public function getName() {
        return $this->sectionName;
    }

    /**
     * Determines the current selector has a child node
     * @return int 0 if no child, otherwise the number of child's
     */
    public function hasChilds() {
        $result = 0;
        foreach($this->object as $childrens) {
            if($childrens instanceof ArrayObject) {
                $result++;
            }
        }
        
        return $result;
    }

    /**
     * Returns the raw array
     * @return array Raw result
     */
    public function getRaw() {
        return $this->object;
    }
    
}
