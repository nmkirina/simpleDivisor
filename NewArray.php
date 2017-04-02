<?php
require 'SimpleDivisor.php';

const MIN_ARRAY_SIZE = 4;
const MAX_ARRAY_SIZE = 7;
const MAX_ITEM_VALUE = 100;
const MIN_ITEM_VALUE = 1;

Class NewArray {
    
    public $rowCount;
    public $columnCount;
    public $array;
    public $maxItem;
    public $maxItemInfo;

    public function __construct() {
        $this->rowCount = random_int(MIN_ARRAY_SIZE, MAX_ARRAY_SIZE);
        $this->columnCount = random_int(MIN_ARRAY_SIZE, MAX_ARRAY_SIZE);
        $this->array = array();
        $this->maxItem = 0;
        $this->maxItemInfo = array();
        
    }

    public function generate() {
      
        $this->array = array();
        
        for($i = 0; $i < $this->columnCount; $i++){
            for($j = 0; $j < $this->rowCount; $j++){
                $this->array[$i][$j] = random_int(MIN_ITEM_VALUE, MAX_ITEM_VALUE);
            }    
        }
        return $this->array;
    }
    
    public function getConst(){
        $this->rowCount = 7;
        $this->columnCount = 4;
        $this->array = [
            [109, 12, 3, 6 , 45, 125, 23],
            [3, 5, 1, 113, 23, 76, 18],
            [43, 6, 9, 15, 226, 4, 2],
            [34, 5, 67, 230, 150, 3, 15],
            [43, 6, 9, 15, 113, 4, 150],
        ];
        return $this->array;
    }
    
    public function printArray(){
        
        for ($i = 0; $i < $this->columnCount; $i++) {
            echo '<pre>';
            for($j = 0; $j < $this->rowCount; $j++) {

                echo $this->array[$i][$j].' ';
            }
            echo '</pre>';
        }
    }
   
    public function findMaxSimpleDivisorItem(){
        
        $maxDivisor = 0;
        $simpleDivisor = new SimpleDivisor();

        for ($i = 0; $i < $this->columnCount; $i++) {

            for($j = 0; $j < $this->rowCount; $j++) {
                if ($this->array[$i][$j] > $maxDivisor) {

                    $divisor = $simpleDivisor->find($this->array[$i][$j]);

                    if ($divisor > $maxDivisor) {
                        $maxDivisor = $divisor;
                        $this->setMax($i, $j, $divisor);
                        
                    } elseif($divisor == $maxDivisor){
                        if ($this->array[$i][$j] > $this->maxItem) {
                            $this->setMax($i, $j, $divisor);
                        }
                    }

                }
            }
        }
        return $this->maxItemInfo;
    }
     
    private function setMax($i, $j, $divisor){
        $this->maxItem = $this->array[$i][$j];
        $this->maxItemInfo = ['column' => $i, 'row' => $j, 'value' => $this->maxItem, 'divisor' => $divisor];
    }
}

