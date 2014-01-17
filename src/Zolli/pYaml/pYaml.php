<?php namespace Zolli\pYaml;

use Symfony\Component\Yaml\Dumper as Dumper;
use \Symfony\Component\Yaml\Yaml as YAML;
use Zolli\pYaml\nodeSelector\nodeSelector;
use Zolli\pYaml\pYamlSection;

class pYaml {
    
    /**
     * Contains the parsed result of the YAML file
     * @var array Assoc array
     */
    public $parseResult = null;

    /**
     * Holds the parsed file name
     * @var string The input file name
     */
    public $fileName = null;

    /**
     * Reads the given file and, parse this
     * with Symfony Yaml component
     * @param string $file The file to be parsed
     * @throws Exception If the file is not provided
     */
    public function __construct($file = null) {
        if($file == null) {
            throw new Exception("File not found " . $file);
        }

        $this->fileName = $file;
        $stream = fopen($file, "r");
        $content = fread($stream, filesize($file));
        $this->parseResult = YAML::parse($content);
    }
    
    /**
     * Returns a pYamlSection by the path tree
     * @param Zolli\pYaml\nodeSelector\nodeSelector $path The node location
     * @return Zolli\pYaml\pYamlSection
     */
    public function get(nodeSelector $selector) {
        $selector->setParsedYaml($this->parseResult);
        $result = $selector->getNode();
        $sectionParent = $selector->getParentName();
        return new pYamlSection($result[0], $sectionParent);
    }

    /**
     * Set a key in parsed array by the passed selector
     * @param string $selector Selector string
     * @param mixed $value The key value
     * @return Zolli\pYaml\pYaml
     */
    public function set($selector, $value) {
        $selectorParts = explode(".", $selector);
        $current = &$this->parseResult;
        foreach($selectorParts as $selectorPart) {
            $current = &$current[$selectorPart];
        }
        $current = $value;

        return $this;
    }

    /**
     * Save the file array content in yaml format
     * Must be call after finishing with set() methods
     * @param null $saveFile If the file is null overwrite the existing file, if its provided create a new file
     */
    public function save($saveFile = null) {
        if($saveFile == null) {
            $outFile = $this->getFilename();
        } else {
            $outFile = $saveFile;
        }

        $yamlDumper = new Dumper();
        $fileContent = $yamlDumper->dump($this->getRawResult(), 100, 0, false, true);
        file_put_contents($outFile, $fileContent);
    }
    
    /**
     * Returns the result from Symfony's Yaml parser component
     * @return array Assoc result array
     */
    public function getRawResult() {
        return $this->parseResult;
    }

    /**
     * Returns the parsed file name
     * @return string File name
     */
    public function getFilename() {
        return (string) $this->fileName;
    }
    
}
