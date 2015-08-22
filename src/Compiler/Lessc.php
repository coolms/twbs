<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\Compiler;

/**
 * This class provides the part of lessphp API
 *
 * @link https://github.com/Less-PHP/less.php
 *
 * @author Dmitry Popov <d.popov@altgraphic.com>
 */
class Lessc extends \lessc
{
    /**
     * Default compailer options
     * 
     * @var array
     */
    protected $options = ['relativeUrls' => false];

    /**
     * @var array
     */
    protected $libFunctions = [];

    /**
     * @var string
     */
    private $formatterName;

    /**
     * @see lessc::registerFunction()
     */
    public function registerFunction($name, $func)
    {
    	$this->libFunctions[$name] = $func;
    }

    /**
     * @see lessc::unregisterFunction()
     */
    public function unregisterFunction($name)
    {
    	unset($this->libFunctions[$name]);
    }

    /**
     * @see \lessc::setFormatter()
     */
    public function setFormatter($name)
    {
        $this->formatterName = $name;
    }

    /**
     * @see \lessc::parse()
     */
    public function parse($buffer, $presets = [])
    {
        $this->setVariables($presets);
        
        switch($this->formatterName){
            case 'compressed':
                $this->options['compress'] = true;
                break;
        }
        
        $parser = new \Less_Parser($this->options);
        $parser->setImportDirs($this->getImportDirs());
        foreach ($this->libFunctions as $name => $func) {
            $parser->registerFunction($name, $func);
        }
        $parser->parse($buffer);
        if (count($this->registeredVars)) {
            $parser->ModifyVars($this->registeredVars);
        }
        
        return $parser->getCss();
    }

    /**
     * @see \lessc::compile()
     */
    public function compile($string, $name = null)
    {
        $oldImport = $this->importDir;
        $this->importDir = (array)$this->importDir;
        
        $this->allParsedFiles = [];
        
        $parser = new \Less_Parser();
        $parser->SetImportDirs($this->getImportDirs());
        
        foreach ($this->libFunctions as $name => $func) {
            $parser->registerFunction($name, $func);
        }
        $parser->parse($string);
        
        if( count( $this->registeredVars ) ){
            $parser->ModifyVars( $this->registeredVars );
        }
        
        $out = $parser->getCss();
        
        $parsed = \Less_Parser::AllParsedFiles();
        foreach( $parsed as $file ){
            $this->addParsedFile($file);
        }
        
        $this->importDir = $oldImport;
        
        return $out;
    }

    /**
     * @see \lessc::compileFile()
     */
    public function compileFile($fname, $outFname = null)
    {
        if (!is_readable($fname)) {
            throw new \RuntimeException('load error: failed to find '.$fname);
        }
        
        $pi = pathinfo($fname);
        
        $oldImport = $this->importDir;
        
        $this->importDir = (array)$this->importDir;
        $this->importDir[] = realpath($pi['dirname']).'/';
        
        $this->allParsedFiles = [];
        $this->addParsedFile($fname);
        
        $parser = new \Less_Parser();
        $parser->SetImportDirs($this->getImportDirs());
        
        foreach ($this->libFunctions as $name => $func) {
            $parser->registerFunction($name, $func);
        }
        $parser->parseFile($fname);
        
        if( count( $this->registeredVars ) ) $parser->ModifyVars( $this->registeredVars );
        
        $out = $parser->getCss();
        
        $parsed = \Less_Parser::AllParsedFiles();
        foreach ($parsed as $file) {
            $this->addParsedFile($file);
        }
        
        $this->importDir = $oldImport;
        
        if ($outFname !== null) {
            return file_put_contents($outFname, $out);
        }
        
        return $out;
    }

    /**
     * @param mixed $in
     * @param mixed $out
     * @param Lessc $less
     * @return bool
     */
    public function ccompile($in, $out, $less = null)
    {
        if ($less === null) {
            $less = new self;
        }

        return $less->checkedCompile($in, $out);
    }

    /**
     * @param mixed $in
     * @param bool $force
     * @param Lessc $less
     * @return array
     */
    public static function cexecute($in, $force = false, $less = null)
    {
        if ($less === null) {
            $less = new self;
        }

        return $less->cachedCompile($in, $force);
    }
}
