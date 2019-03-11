<?php

namespace app\repositories;
use Yii;
use app\repositories\Sqlclear;

class Getglnprice
{
    public function __invoke($param)
    {       
                     
        $sql = "create or replace view price_view AS SELECT 
                price_list.id AS id,
                price_list.sorts_id AS sorts_id,
                price_list.nl_id AS nl_id,
                price_list.types_id AS types_id,
                price_list.plantations_id AS plantations_id,
                price_list.price_chargeamount AS price_chargeamount,
                price_list.minimum_length AS minimum_length,
                price_list.quantity AS quantity,
                price_list.maturity_stage AS maturity_stage,
                plantations.name AS plantation_name,
                types.name_nl AS types_name,
                sorts.name AS sorts_name
                FROM  price_list
                LEFT JOIN sorts ON (sorts.id = price_list.sorts_id)
                LEFT JOIN plantations ON (plantations.id = price_list.plantations_id)
                LEFT JOIN types ON (types.id = price_list.types_id)";
        Yii::$app->db->createCommand($sql)->execute();        
        $sql = " from price_view where quantity > '0'";   
               
        if ($param ['mysorts'] != 'all' and $param ['mysorts'] != 'none') {
            $arraysorts_array = json_decode($param ['arraysorts'], true);
            $j= 0;
            $fl = 0;            
            $arraysorts_array_l = count($arraysorts_array);            
            while ($j < $arraysorts_array_l) {
                if ($fl == 0 and $arraysorts_array [$j]['selected'] == 'YES') {
                    $sql = $sql . " and (sorts_id = '" . Sqlclear::strip_data($arraysorts_array [$j]['id']) . "'";
                    $fl = 1;
                    $j++;
                    continue;
                }
                if ($fl == 1 and $arraysorts_array [$j]['selected'] == 'YES') {
                    $sql = $sql . " or sorts_id = '" . Sqlclear::strip_data($arraysorts_array [$j]['id']) . "'";
                }
                $j++;
            } 
            $sql = $sql . ") ";
        }
        
        if ($param ['mytypes'] != 'all' and $param ['mytypes'] != 'none') {
            $arraytypes_array = json_decode($param ['arraytypes'], true);           
            $j= 0;
            $fl = 0;         
            $arraytypes_array_l = count($arraytypes_array);            
            while ($j < $arraytypes_array_l) {                  
                if ($fl == 0 and $arraytypes_array [$j]['selected'] == 'YES') {                    
                    $sql = $sql . " and (types_id = '" . Sqlclear::strip_data($arraytypes_array [$j]['id']) . "'";
                    $fl = 1;
                    $j++;
                    continue;                   
                }               
                if ($fl == 1 and $arraytypes_array [$j]['selected'] == 'YES') {
                    $sql = $sql . " or types_id = '" . Sqlclear::strip_data($arraytypes_array [$j]['id']) . "'";
                }                   
                $j++;
            }           
            $sql = $sql . ") ";
        }    
        
        $sql_count = "select count(*)" . $sql;
        $count = Yii::$app->db->createCommand($sql_count)->queryScalar();           
        if ($param ['sortitems'] != 'NOT') { // ORDER BY 'xxxx'  [ ASC | DESC ]            
            $sname = $param ['sortitems'];
            $svar = $param ['sortrules'];             
            $sql = $sql . " ORDER BY " . $sname . " " . $svar;
        }
    
        $sql = $sql . " LIMIT " . $param ['offset']*$param ['limit'] . ", " . $param ['limit'];            
        $sql = "select *" . $sql;  
        
        $gln_price = Yii::$app->db->createCommand($sql)->queryAll();
        $gln_price_l = count($gln_price);       
        foreach ($gln_price as $row) {                      
            $nl_id = $row['nl_id'];
            $referenceddocument_uriid = Yii::$app->db->createCommand("select referenceddocument_uriid from gln_supply where product_id = '$nl_id'")->queryScalar();                       
            $data[] = array("id"=>$row['id'],"sort_id"=>$row['sorts_id'],"price"=>$row['price_chargeamount']/10000,"size"=>$row['minimum_length'],
                "quantity"=>$row['quantity'], "upd_date"=>mktime(), "count_all"=>$count, "sort_name"=>$row['sorts_name'],
                "plantation_name"=>$row['plantation_name'], "plantation_id"=>$row['plantations_id'], "type_name_nl"=>$row['types_name'], "type_id"=>$row['types_id'], 
                "sort_id"=>$row['sorts_id'], "nl_id"=>$row['nl_id'], "referenceddocument_uriid"=>$referenceddocument_uriid, 
                "maturity_stage"=>$row['maturity_stage']
            );
        }          
        return $data; 
    }
}