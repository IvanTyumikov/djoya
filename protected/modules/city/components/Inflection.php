<?php

use morphos\Russian\GeographicalNamesInflection;

/**
 * Class Inflection
 *
 */
class Inflection extends CApplicationComponent{
        
    public function wordInCase($word, $caseRus){

        $wordCase = GeographicalNamesInflection::getCase($word, $caseRus);
        return $wordCase;
    }
    
}