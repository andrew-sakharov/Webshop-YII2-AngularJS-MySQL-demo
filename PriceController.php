<?php

namespace app\controllers;
//namespace app\repositories;

use Yii;
use app\models\Price;
use app\models\Types;
use app\models\PriceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\repositories\Getglnprice;
use app\repositories\Gettypes;
use app\repositories\Putorders;
use app\repositories\Getsorts;
use app\repositories\Sqlclear;

/**
 * PriceController implements the CRUD actions for Price model.
 */
class PriceController extends Controller
{
    
    public function beforeAction($action){
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $searchModel = new PriceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionFlwr()
    {
        return $this->render ('flwr');
    }
    
    public function actionFlwrlist(){
        $inp_data = json_decode(file_get_contents("php://input"));
        $param ['limit'] = $inp_data->limit;
        $param ['offset'] = $inp_data->offset;
        $param ['mytypes'] = $inp_data->mytypes;
        $param ['mysorts'] = $inp_data->mysorts;
        if ($param ['mytypes'] != 'all') {
            $param ['arraytypes'] = json_encode ($inp_data->arraytypes);
        }
        if ($param ['mysorts'] != 'all') {
            $param ['arraysorts'] = json_encode ($inp_data->arraysorts);
        }
        $param ['sortitems'] = $inp_data->sortitems;
        $param ['sortrules'] = $inp_data->sortrules;
        $data = array();
        $queryPrice = new Getglnprice();
        $data = $queryPrice ($param);
        return json_encode($data);
    }
    
    public function actionFlwrtypes(){
        $data = array();
        $queryTypes = new Gettypes();
        $data = $queryTypes ();
        return json_encode($data);
    }
    
    public function actionFlwrsorts(){
        $data = array();
        $querySorts = new Getsorts();
        $data = $querySorts ();
        return json_encode($data);
    }
    
    public function actionFlwrbuy(){
        $inp_data = json_decode(file_get_contents("php://input"));
        $basket = $inp_data->basket;
        $buyer_name = $inp_data->name;
        $buyer_email = $inp_data->email;
        $basket_json = json_encode ($basket);
        $basket_array = json_decode($basket_json, true);
        $j= 0;
        $basket_array_l = count($basket_array);
        while ($j < $basket_array_l) {
            $order[$j]['sort_name'] = $basket_array[$j]['sort_name'];
            $order[$j]['my_quantity'] = $basket_array[$j]['my_quantity'];
            $order[$j]['cost'] = $basket_array[$j]['cost'];
            $j++;
        }
        $putOrders = new Putorders();
        $data = $putOrders ($order, $buyer_name, $buyer_email);
        return json_encode($data);
        
    }
    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionCreate()
    {
        $model = new Price();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        return $this->redirect(['index']);
    }
    
    protected function findModel($id)
    {
        if (($model = Price::findOne($id)) !== null) {
            return $model;
        }
        
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
}
