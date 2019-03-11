<?php

namespace app\repositories;
use Yii;
use app\models\Price;
use app\models\Types;

class Gettypes
{
    public function __invoke()
    {
        
        /*
        Вариант Yii DAO. Используется чистый SQL.Самый эффективный способ доступа к базам данных.
        Единственный недостаток - так как синтаксис SQL может отличаться для разных баз данных, используя Yii DAO  
        нужно приложить дополнительные усилия, чтобы сделать приложение не зависящим от конкретной базы данных.
         
        $sql = "select * from types where flag = 'NL'";
        $types = Yii::$app->db->createCommand($sql)->queryAll();
        $types_l = count($types);
        $i= 0;
        while ($i < $types_l) {
            $row = $types[$i];
            $types_id = $row['id'];
            $sql_count = "select count(*) from price_list where flag = 'NL' and types_id = '" . $types_id . "'";
            $count = Yii::$app->db->createCommand($sql_count)->queryScalar();
            if ($count > 0)
                $data[] = array("id"=>$row['id'],"name_nl"=>$row['name_nl'], "selected"=>'YES', "count"=>$count);
                $i++;
        }
        */       
        
        /*  Вариант Active Records  */
            
            $types = Types::find()->where(['flag' => 'NL'])->asArray()->all();
            $types_l = count($types);
            $i= 0;
            while ($i < $types_l) {
                $row = $types[$i];
                $types_id = $row['id'];
                $count = Price::find()->where(['types_id' => $types_id])->count();                
                if ($count > 0)
                    $data[] = array("id"=>$row['id'],"name_nl"=>$row['name_nl'], "selected"=>'YES', "count"=>$count);
                $i++;
            }
        
        return $data;
    }
}