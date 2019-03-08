<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
?>
<h1>email/index</h1>
<?php

// home page URL: /index.php?r=site/index
echo Url::home() . "<br />";

// the base URL, useful if the application is deployed in a sub-folder of the Web root
echo Url::base() . "<br />";
echo Url::base(true) . "<br />";
echo Yii::$app->basePath . "<br />";

echo Yii::$app->controller->route ."<br />";
echo "Controller: ". Yii::$app->controller->id ."<br />";
echo "Action: ". Yii::$app->controller->action->id ."<br />";
echo "Module: ". Yii::$app->controller->module->id ."<br />";

// the canonical URL of the currently requested URL
// see https://en.wikipedia.org/wiki/Canonical_link_element
echo Url::canonical() . "<br />";

// remember the currently requested URL and retrieve it back in later requests
Url::remember();
echo Url::previous() . "<br />";

 ?>
<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
<?=
\odaialali\yii2toastr\Toastr::widget([
    'toastType' => 'error',
    'message' => 'This is an error.',
    'customStyle' => false,
    'options' => [
        "closeButton" => true,
        "debug" => false,
        "newestOnTop" => false,
        "progressBar" => true,
        "positionClass" => "toast-top-right",
        "preventDuplicates" => false,
        "onclick" => null,
        "showDuration" => "300",
        "hideDuration" => "1000",
        "timeOut" => "5000",
        "extendedTimeOut" => "2000",
        "showEasing" => "swing",
        "hideEasing" => "linear",
        "showMethod" => "fadeIn",
        "hideMethod" => "fadeOut"
    ],
]);app\models\Utilities::putMessageLogFile("example de log");
?>

<button onclick="createToastrNotification('test', 'esto es un mensaje', 'info')">toastr</button>
<button onclick="showLoadingPopup()">loading</button>
<button class="pbpopup" href="http://localhost/mce/usuario/index?popup=true">popup</button>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalPB">
    Launch demo modal
</button>
<button type="button" class="btn btn-default" onclick="showAlert()">onclick alert</button>
<?php 
$query = array();
if(isset($_REQUEST['PBgetFilter']) && $_REQUEST['PBgetFilter'] == true){
    $query = \app\models\Usuario::findByCondition(["usu_username" => $_REQUEST['usu_username']]);
}else{
    $query = \app\models\Usuario::find();
}

?>
<?=
PbGridView::widget([
    //'dataProvider' => new yii\data\ArrayDataProvider(array()),
    'id' => 'gridPB',
    //'autoUpdate' => true,
    //'timepajax' => 10000,
    //'summary' => "",
    'showExport' => true,
    'dataProvider' => new yii\data\ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 1,
        ],
        'sort' => [
            'attributes' => [
                'usu_username',
                'usu_fecha_creacion',
            ],
        ],
            ]),
    //'filterModel' => $model, // para que aparezcan los filtros
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        // format one
        [
            'attribute' => 'usu_username',
            'label' => 'Username',
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
        ],
        // format two
        [
            'attribute' => 'usu_sha',
            'contentOptions' => ['class' => 'table_class', 'style' => 'display:block;'],
            'content' => function($data) {
                return "value";
            }
        ],
        [
            'attribute' => 'usu_estado_activo',
            'label' => 'Es activo',
            'filter' => array("1" => "Active", "2" => "Inactive"),
        ],
        'usu_fecha_creacion',
        [
            'label' => 'Custom Link',
            'format' => 'raw', //raw, html, text
            'value' => function($data) {
                //$url = "http://www.bsourcecode.com";
                $urlReporte = Url::to(['email/reporte', 'pdf' => "1"]);
                return Html::a('Get Reporte', $urlReporte, ["data-pjax"=>0]);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {link}',
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-user"></span>', $url);
                },
                'link' => function ($url, $model, $key) {
                    return Html::a('link', $url);
                },
            ],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Action',
            'headerOptions' => ['width' => '80'],
            'template' => '{view} {update} {delete} {link}',
        ],
    ],
])
?>
