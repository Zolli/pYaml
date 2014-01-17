<?php namespace Zolli\pYaml\nodeSelector;

use Zolli\pYaml\Exception\nodeNotFoundException;

class nodeSelector {

    /**
     * Holds the complete selector give in constructor
     * @var string Selector string
     */
    private $selector = null;

    /**
     * Holds the parsed YAML file content
     * @var array File content
     */
    private $parsedYaml = null;

    /**
     * Holds the result of this selector
     * @var array Result
     */
    private $resultNode = null;

    /**
     * Hold the selector part caused the error
     * @var null
     */
    private $errorNode = null;

    /**
     * Constructor
     *
     * @param string $selector The selector
     */
    public function __construct($selector) {
        $this->selector = $selector;
    }

    /**
     * Pass the parsed YAML object in this function
     * This needed for detecting selector errors and validation
     * @param array $array
     */
    public function setParsedYaml(array $array) {
        $this->parsedYaml = $array;
    }

    /**
     * Returns the node array, based on selector
     * @param string $selector The selector, passed in constructor
     * @throws Zolli\pYaml\Exception\nodeNotFoundException
     */
    private function getNodeBySelector($selector) {
        $selectorParts = explode(".", $selector);
        
        $result = $this->parsedYaml;
        foreach($selectorParts as $part) {
            if(isset($result["$part"])) {
                $result = $result["$part"];
            } else {
                $this->errorNode = $part;
                throw new nodeNotFoundException($part, $selector);
            }
        }
        
        $this->resultNode = $result;
    }

    /**
     * Returns the selected node if the selector is valid
     * @return array The node
     */
    public function getNode() {
        if($this->isValid()) {
            return (array) $this->resultNode;
        }
    }

    /**
     * Detect the selector is on the root of the tree
     * @return bool Result
     */
    public function isRootNode() {
        if($this->getParentName() === "ROOT") {
            return (boolean) true;
        } else {
            return (boolean) false;
        }
    }

    /**
     * Detect the node is valid or not
     * @return bool Result
     */
    public function isValid($selector = null) {
        if($selector == null) {
            $select = $this->selector;
        } else {
            $select = $selector;
        }

        try {
            $this->getNodeBySelector($select);
            return (boolean) true;
        } catch(nodeNotFoundException $e) {
            return (boolean) false;
        }
    }

    /**
     * Detect if the selected node has a parent or not
     * @return bool Result
     */
    public function hasParent() {
        $selectorParts = explode(".", $this->selector);
        $selectorPartsCount = count($selectorParts);
        
        if($selectorPartsCount >= 2) {
            return (boolean) true;
        } else {
            return (boolean) false;
        }
    }

    /**
     * Returns the parent name if it has one, or "ROOT" if not
     * @return string
     */
    public function getParentName() {
        $selectorParts = explode(".", $this->selector);
        $selectorPartsCount = count($selectorParts);
        $result = "ROOT";
        
        if($selectorPartsCount >= 2) {
            $result = $selectorParts[$selectorPartsCount-2];
        }
        
        return (string) $result;
    }

    /**
     * Returns the selector is passed on the constructor
     * @return string The selector
     */
    public function getSelectorString() {
        return (string) $this->selector;
    }

    /**
     * Returns the selector part caused the error
     * @return string The first part of the selector who caused the error
     */
    public function getErrorNode() {
        return (string) $this->errorNode;
    }
    
}