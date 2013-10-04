<?php
namespace pYaml;

use \Symfony\Component\Yaml\Yaml as YAML;

/**
 * 
 */
class pYaml {
    
    /**
     * Construct data holder
     * @var pYaml instance
     */
    private static $instance = null;
    
    /**
     * Contains the parsed result of the YAML file
     * @var array Egy asszociatív tömb
     */
    public $parseResult = null;
    
    /**
     * Singletin getter
     * @return pYaml instance
     */
    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new pYaml();
        }
        
        return self::$instance;
    }
    
    /**
     * Reads the given file and, parse this
     * with Symfony Yaml component
     * 
     * @param string $file The file to be parsed
     * @return array Assoc array
     * @throws Exception If the file is not provided
     */
    public function init($file = null) {
        if($file == null) {
            throw new Exception("File not found " . $file, 404);
        }
        
        $stream = fopen($file, "r");
        $content = fread($stream, filesize($file));
        $this->parseResult = YAML::parse($content);
    }
    
    /**
     * Returns a pYamlSection by the path tree
     * 
     * @param  $path The node location
     * @return pYamlSection
     */
    public function get($path) {
        $result = $this->pathToChunk($path);
        $sectionParent = $this->getParentName($path);
        return new pYamlSection($result, $sectionParent);
    }
    
    /**
     * Returns the parent of this selector
     * //TODO: NODE SELECTOR
     * 
     * @param string $path Node path
     * @return string The parent name, if this is a rott element, returns "ROOT"
     */
    private function getParentName($path) {
        $pathParts = explode(".", $path);
        $partsCount = count($pathParts);
        $result = null;
        
        if($partsCount >= 2) {
            $result = $pathParts[$partsCount-1];
        } else {
            $result = 'ROOT';
        }
        
        return $result;
    }
    
    /**
     * Return the mapped result
     * 
     * @param string $pathString
     * @return mixed
     */
    private function pathToChunk($pathString) {
        $pathParts = explode(".", $pathString);
        
        $result = $this->parseResult;
        foreach($pathParts as $part) {
            if(isset($result["$part"])) {
                $result = $result["$part"];
            } else {
                throw Exception\nodeNotFoundException($part, $pathString);
            }
        }
        
        return $result;
    }
    
    /**
     * Returns the result from Symfony's Yaml parser component
     * 
     * @return array Assoc result array
     */
    public function getRawResult() {
        return $this->parseResult;
    }
    
}
