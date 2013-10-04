<?php
namespace pYaml\Exception;

class nodeNotFoundException extends \Exception {
    
    private $errorNode = null;
    private $completeNode = null;
    
    public function __construct($errorNode, $completeNode) {
        $this->errorNode = $errorNode;
        $this->completeNode = $completeNode;
    }
    
    public function getNotFoundNode() {
        return $this->errorNode;
    }
    
    public function getNodeSelector() {
        return $this->completeNode;
    }
    
}
