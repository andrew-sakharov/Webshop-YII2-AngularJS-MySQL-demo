<?php

namespace app\repositories;
use Yii;

class Putorders
{
    public function __invoke($basket_array, $name, $email)
    {                    
        $j= 0;
        $basket_array_l = count($basket_array);
        while ($j < $basket_array_l) {
            $sort_name = $basket_array[$j]['sort_name'];
            $my_quantity = $basket_array[$j]['my_quantity'];
            $cost = $basket_array[$j]['cost'];
            
            // .............................................
            
            $j++;
        }
        $data['order_message'] = $name . ' ваш заказ принят' ;
        return $data; 
    }
}