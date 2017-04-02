<?php

class SimpleDivisor {
    
    const FIRST_SIMPLE = 2;
    
    private $sieve;
    private $sieveArray;
    private $maxSimpleDivisor;
    private $isSimple;
    private $sieveStartPoint;
    private $sieveLastPoint;

    public function  __construct(){
        
        $this->sieve = array(0, 1, 1);
        $this->sieveArray[self::FIRST_SIMPLE] = $this->sieve;
        $this->sieveStartPoint = self::FIRST_SIMPLE;
        $this->maxSimpleDivisor = self::FIRST_SIMPLE;
        $this->sieveLastPoint = self::FIRST_SIMPLE;
        
    }
    
    public function find ($num) {
        
        if ($num == 1) {
            return $num;
        }
        
        $find = false;

        for ($i = $this->sieveLastPoint; $i > self::FIRST_SIMPLE, !$find; $i--){
            
            if (isset($this->sieveArray[$i])) {
                if ($num >= $i) {
                    $find = true;
                    $this->sieveStartPoint = $i;
                }
            }
        }
        $this->sieveStartPoint = self::FIRST_SIMPLE;
        
        $this->setNewIteration($num);
        
        return $this->buildSieve($num);
    }
    
    private function buildSieve($num) {
        
        for ($j = self::FIRST_SIMPLE; $j < $num; $j++){
            if($this->sieve[$j]){
                
                $divisor = $j;
                if ($j > $this->sieveStartPoint) {
                    $start = 2 * $j;
                } else {
                    $start = $this->sieveStartPoint - ($this->sieveStartPoint % $j) + $j;
                }
                
                for ($i = $start; $i <= $num; $i += $divisor){
                    if ($this->sieve[$i]) {

                        if ($i != $num){
                            $this->sieve[$i] = 0;
                        } else {
                            $this->isSimple = false;
                            if($this->maxSimpleDivisor < $divisor) {
                                $this->maxSimpleDivisor = $divisor;
                            }
                        }

                    }
                }
            }
        }
        
        if(!$this->isSimple){
            $this->sieve[$num] = 0;
        } else {
            $this->maxSimpleDivisor = $num;
        }
        
        $this->sieveStartPoint = $num;
        $this->sieveArray[$num] = $this->sieve;
        return $this->maxSimpleDivisor;
    }
    
    private function fillByOnes($num){
        
        for($i = $this->sieveStartPoint + 1; $i <= $num; $i++  ){
            $this->sieve[] = 1;
        }
        
    }
    
    private function setNewIteration($num){
        
        $this->sieve = $this->sieveArray[self::FIRST_SIMPLE];
        $this->fillByOnes($num);
        $this->isSimple = true;
        $this->maxSimpleDivisor = self::FIRST_SIMPLE;
        $this->sieveLastPoint = $num;
        
        
    }
    
}


