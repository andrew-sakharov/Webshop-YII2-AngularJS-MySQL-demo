<?php

namespace app\repositories;
use Yii;
use app\models\Price;
use app\models\Sorts;

class Getsorts
{
    public function __invoke()
    {

        /*
        Вариант Yii DAO. Используется чистый SQL.Самый эффективный способ доступа к базам данных.
        Единственный недостаток - так как синтаксис SQL может отличаться для разных баз данных, используя Yii DAO  
        нужно приложить дополнительные усилия, чтобы сделать приложение не зависящим от конкретной базы данных.
        
        $sql = "select * from sorts where flag = 'NL'";
        $sorts = Yii::$app->db->createCommand($sql)->queryAll();
        $sorts_l = count($sorts);
        $i= 0;
        while ($i < $sorts_l) {
            $row = $sorts[$i];
            $sorts_id = $row['id'];
            $sql_count = "select count(*) from price_list where flag = 'NL' and sorts_id = '" . $sorts_id . "'";
            $count = Yii::$app->db->createCommand($sql_count)->queryScalar();
            if ($count > 0)
                $data[] = array("id"=>$row['id'],"name"=>$row['name'], "selected"=>'YES', "count"=>$count);
                $i++;
        }
        */
        
        $sorts = Sorts::find()->where(['flag' => 'NL'])->asArray()->all();
        $sorts_l = count($sorts);
        $i= 0;
        while ($i < $sorts_l) {
            $row = $sorts[$i];
            $sorts_id = $row['id'];
            $count = Price::find()->where(['sorts_id' => $sorts_id])->count();
            if ($count > 0)
                $data[] = array("id"=>$row['id'],"name"=>$row['name'], "selected"=>'YES', "count"=>$count);
                $i++;
        }
                
        return $data;
    }
}

