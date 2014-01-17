<?php namespace Zolli\pYaml\Exception;

use \Exception;

class nodeNotFoundException extends Exception {

    /**
     * The selector part caused the problem
     * @var string Selector part
     */
    private $errorNode = null;

    /**
     * The complete selector
     * @var string Complete selector
     */
    private $completeNode = null;

    /**
     * Constructor
     * @param string $errorNode The selector part caused the problem
     * @param string $completeNode The complete selector
     */
    public function __construct($errorNode, $completeNode) {
        $this->errorNode = $errorNode;
        $this->completeNode = $completeNode;
    }

    /**
     * Returns the selector part caused the problem
     * @return string Selector part
     */
    public function getNotFoundNode() {
        return $this->errorNode;
    }

    /**
     * Returns the complete selector
     * @return string Complete selector
     */
    public function getNodeSelector() {
        return $this->completeNode;
    }
    
}
