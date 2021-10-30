<?php

namespace Application\Model;

class Liczby 
{
    public function generuj()
	{
        $parzyste=[];
        $nieparzyste=[];

        for ($i = 0; $i< 100;$i++ ){
            $val = rand(0,1000);
            if($val % 2 == 0){
                array_push($parzyste,$val);
            }
            else{
                array_push($nieparzyste,$val);
            }
            
        }
        sort($parzyste);
        sort($nieparzyste);
        $ret_array = [$parzyste, $nieparzyste];
		return $ret_array;
	}
}