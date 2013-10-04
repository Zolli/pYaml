<?php

namespace pYaml\nodeSelector;

class nodeSelector {
    
    private $selector = null;
    private $parsedYaml = null;
    private $resultNode = null;
    
    public function __construct($selector) {
        $this->selector = $selector;
    }
    
    public function setParsedYaml($array) {
        $this->parsedYaml = $array;
    }
    
    private function getNodeBySelector($selector) {
        $selectorParts = explode(".", $selector);
        
        $result = $this->parsedYaml;
        foreach($selectorParts as $part) {
            if(isset($result["$part"])) {
                $result = $result["$part"];
            } else {
                throw new \pYaml\Exception\nodeNotFoundException($part, $selector);
            }
        }
        
        $this->resultNode = $result;
    }
    
    public function getNode() {
        if($this->isValid()) {
            return $this->resultNode;
        }
    }
    
    public function isRootNode() {
        if($this->getParentName() === "ROOT") {
            return true;
        } else {
            return false;
        }
    }
    
    public function isValid() {
        try {
            $this->getNodeBySelector($this->selector);
            return true;
        } catch(\pYaml\Exception\nodeNotFoundException $e) {
            return false;
        }
    }
    
    public function hasParent() {
        $selectorParts = explode(".", $this->selector);
        $selectorPartsCount = count($selectorParts);
        
        if($selectorPartsCount >= 2) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getParentName() {
        $selectorParts = explode(".", $this->selector);
        $selectorPartsCount = count($selectorParts);
        $result = "ROOT";
        
        if($selectorPartsCount >= 2) {
            $result = $selectorParts[$selectorPartsCount-1];
        }
        
        return $result;
    }
    
}