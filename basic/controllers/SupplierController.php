<?php

namespace app\controllers;


use app\models\Supplier;
use app\models\SupplierSearch;
use yii\web\Controller;
use Yii;

class SupplierController extends Controller
{
    const PAGESIZE = 12;

    public function actionIndex()
    {
      //  $query = Supplier::find()->orderBy('id desc')->asArray();

        $searchModel = new Supplier();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('supplier_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
