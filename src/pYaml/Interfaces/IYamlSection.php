<?php
namespace pYaml\Interfaces;

interface IYamlSection {
    
    public function isString();
    public function getString();
    public function isInt();
    public function getInt();
    public function isBoolean();
    public function getBoolean();
    public function isArray();
    public function getArray();
    public function isList();
    public function getList();
    
    /**
     * Get all keys containing this node
     * 
     * @return array Contains the keys
     */
    public function getKeys();
    
    /**
     * Get the section parent name
     * 
     * @return The name of the section parent
     */
    public function getName();
    
    /**
     * Get child for a YamSection, return 0 if the object has no childs
     * otherwise returns the number of childrens
     * 
     * @return int The number of childrens
     */
    public function hasChilds();
    
    /**
     * Returns the object contained object
     * 
     * @return mixed
     */
    public function getRaw();
    
}