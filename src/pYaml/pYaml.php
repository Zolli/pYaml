<?php
namespace pYaml;

use \Symfony\Component\Yaml\Yaml as YAML;

class pYaml {
    
    /**
     * A példányt tartalmazó változó
     * 
     * @var pYaml instance
     */
    private static $instance = null;
    
    /**
     * Az értelmezett Yaml fájlt tartalmazza
     * 
     * @var array Egy asszociatív tömb
     */
    public $parseResult = null;
    
    /**
     * Visszaadja az egyetlen létező példányt
     * 
     * @return pYaml instance
     */
    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new pYaml();
        }
        
        return self::$instance;
    }
    
    /**
     * Beolvassa a kapott fájl tartalmát és a Symfony YAML komponense segítségével
     * egy asszociatív tömbbé alakítja
     * 
     * @param string $file A beolvasandó fájl elérési útvonala (abszolút)
     * @return array Asszociatív tömb
     * @throws Exception Amennyiben a fájl nem null
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
     * Visszaad egy stringet a yaml fájlból a bemenet alapján
     * 
     * @param  $path A hely a yaml fájlban ahonna a stringet kérjük
     * @return pYamlSection
     */
    public function get($path) {
        $result = $this->pathToChunk($path);
        $sectionParent = $this->getParentName($path);
        return new pYamlSection($result, $sectionParent);
    }
    
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
     * 
     * @param type $pathString
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
     * Visszaadja azt az asszociatív tömböt amit a Symfony Yaml értelmezője visszaadott
     * 
     * @return array
     */
    public function getRawResult() {
        return $this->parseResult;
    }
    
}
