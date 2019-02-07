<?php

namespace app\repositories;
use Yii;

class Getsorts
{
    public function __invoke()
    {
        /*
         Здесь и далее используем Yii DAO. При использовании Yii DAO в основном используется чистый SQL и массивы PHP.
         Как результат, это самый эффективный способ доступа к базам данных.
         Единственный недостаток - так как синтаксис SQL может отличаться для разных баз данных,
         используя Yii DAO  нужно приложить дополнительные усилия,
         чтобы сделать приложение не зависящим от конкретной базы данных.
         Достоинства. Их гораздо больше:
         - Гарантированная миграция на новое поколение Фреймворка без переписывания программ.
         - Нам можем показывать только те позиции справочника, которым есть соответсвие в таблице фактов. 
         - В качестве бонуса мы получаем и показываем на странице количество позиций в таблице фактов соответствующих каждой позиции из справочника.
         */ 
        
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
                $data[] = array("id"=>$row['id'],"name"=>$row['name'], "selected"=>'YES', "count"=>$count
                );
                $i++;
        }
        return $data;
    }
}

