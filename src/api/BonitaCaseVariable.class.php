<?php

class BonitaCaseVariable extends BonitaRestAPI {
    
    public function __construct() {
        $this->setEndpoint('bpm/caseVariable');
    }
    
    public function get($caseId, $variableName) {
        if ( is_null($id) ) {
            throw new Exception('You must inform the id of the case.');
        }
        if ( is_null($variableName) ) {
            throw new Exception('You must inform the variable name.');
        }
        return parent::get("{$caseId}/{$variableName}");
    }
    
    public function updateCaseVariable($caseId, $variableName, $variableType, $variableValue) {
        $data = array('type' => $this->getJavaTypeClassName($variableType), 'value' => $variableValue);
        return parent::put("{$caseId}/{$variableName}", $data);
    }
    
    private function getJavaTypeClassName($variableType) {
        $javaTypeClassName = '';
        
        switch ($variableType) {
            case 'int':
            case 'integer':
                $javaTypeClassName = 'java.lang.Integer';
                break;
            
            case 'double':
            case 'float':
            case 'number':
                $javaTypeClassName = 'java.lang.Double';
                break;
            
            case 'long':
                $javaTypeClassName = 'java.lang.Long';
                break;
            
            case 'boolean':
            case 'bool':
                $javaTypeClassName = 'java.lang.Boolean';
                break;
            
            case 'date':
            case 'datetime':
                $javaTypeClassName = 'java.util.Date';
                break;
            
            default:
                $javaTypeClassName = 'java.lang.String';
                break;
        }
        
        return $javaTypeClassName;
    }
    
}