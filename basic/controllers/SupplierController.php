<?php
namespace app\controllers;


use app\models\Supplier;
use app\models\SupplierSearch;
use yii\web\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;

class SupplierController extends Controller
{
    const PAGESIZE = 12;

    public function actionIndex()
    {

        $searchModel = new Supplier();
        $dataProvider = $searchModel->getSearchDataProvider(Yii::$app->request->queryParams);

        return $this->render('supplier_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * 根据查询条件进行导出.
     */
    public function actionExportAll()
    {
        ini_set("memory_limit", -1);
        ini_set("max_execution_time", 3600);
        $searchModel = new Supplier();
        $params = Yii::$app->request->queryParams;

        $record = $searchModel->getSearchRecord($params);

        $fileName = "supplierExportAllPage".date("YmdHis").".csv";
        $this->exportCsv($record, $fileName);
        exit();
    }


    /**
     * 依据id 进行导出
     */
    public function actionExportByIds()
    {
        if (!isset($_REQUEST['id']) || !$_REQUEST['id']) {
            Yii::info("actionExportByIds:params:abnormal:".json_encode($_REQUEST), "error");
            exit("参数异常，无法导出");
        }
        $ids = $_REQUEST['id'];

        $sql = "select * from ".(new Supplier)::tableName()." where id in ($ids) ";
        $records =  (new Supplier)::findBySql($sql)->all();
        $fileName = "supplierExportOnePage".date("YmdHis").".csv";
        $this->exportCsv($records, $fileName);
        exit();
    }


    private function exportCsv($records, $fileName)
    {
        //遍历数据
        $fileData = "id,name,code,status\n";
        foreach ($records as $key => $item) {
            $fileData.= $item->id . "," . $item->name . "," . $item->code . "," . $item->t_status . "\n";
        }

        // 头信息设置
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=" . $fileName);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        echo $fileData;
    }



}
