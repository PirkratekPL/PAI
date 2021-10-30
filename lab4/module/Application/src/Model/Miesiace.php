<?php

namespace Application\Model;

class Miesiace 
{
    public function pobierzWszystkie()
	{
		return  [
            ['blue','Styczeń'], 
            ['red','Luty'],
            ['green','Marzec'],
            ['pink','Kwiecień'],
            ['violet','Maj'],
            ['purple','Czerwiec'],
            ['silver','Lipiec'],
            ['gray','Sierpień'],
            ['lightblue','Wrzesień'],
            ['orange','Październik'],
            ['lime','Listopad'],
            ['aqua','Grudzień']
            ];
		
	}
}