<?php

class BonitaCaseVariable extends BonitaRestAPI {

    public function __construct() {
        $this->setEndpoint('bpm/caseVariable');
    }

    public function get($caseId, $variableName) {
        if (is_null($id)) {
            throw new Exception('You must inform the id of the case.');
        }
        if (is_null($variableName)) {
            throw new Exception('You must inform the variable name.');
        }
        return parent::get("{$caseId}/{$variableName}");
    }

    public function updateCaseVariable($caseId, $variableName, $variableType, $variableValue) {
        if (!$this->existsVariableInCase($caseId, $variableName)) {
            return FALSE;
        }
        
        $javaTypeClassName = $this->getJavaTypeClassName($variableType);
        if ( $javaTypeClassName == 'java.lang.Boolean' && $this->getBooleanValue($variableValue) ) {
            $variableValue = 'true';
        }
        
        if ( $javaTypeClassName == 'java.util.Date' ) {
            if ( strlen($variableValue) == 10 ) {
                // BONITA DATE CONVERTER: SimpleDateFormat formatter = new SimpleDateFormat("EEE MMM dd HH:mm:ss z yyyy", DateFormatSymbols.getInstance(Locale.ENGLISH));            
                $dateObj = DateTime::createFromFormat("d/m/Y", $variableValue);
                $variableValue = substr_replace($dateObj->format('D M d 00:00:00 Y'), 'GMT ', 20, 0);
            } else {
                $variableValue = NULL;
            }
        }
        
        $data = array('type' => $javaTypeClassName, 'value' => $variableValue);
        return parent::put("{$caseId}/{$variableName}", $data);
    }

    public function getVariablesList($caseId) {
        $this->setFilters(array('case_id' => $caseId));
        return parent::get();
    }

    public function existsVariableInCase($caseId, $variableName) {
        $existVariable = FALSE;
        $variables = $this->getVariablesList($caseId);
        
        if ( count($variables) > 0 ) {
            foreach ($variables as $variable) {
                if ($variable->name == $variableName) {
                    $existVariable = TRUE;
                    break;
                }
            }
        }
        return $existVariable;
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
