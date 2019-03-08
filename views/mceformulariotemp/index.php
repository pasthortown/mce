<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;
?>
<div class="row">
    <div class="col-md-2">
        <p><?= Html::a('<span class="glyphicon glyphicon-file"></span>' . Yii::t("formulario", "New Form"), ['mceformulariotemp/create'], ['class' => 'btn btn-primary btn-block']); ?> </p>
    </div>

</div>
<div>
    <?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'TbG_SOLICITUD',
        'dataProvider' => $model,
        //'summary' => false,
        //'pajax' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
            // format one
            //[
            //'attribute' => 'Ids',
            //'label' => 'Idst',
            //],
            // format two
            [
                'header' => Yii::t("formulario", "Licencia"),
                //'options' => ['width' => '200'],
                'value' => 'Licencia',
            ],
            [
                //'attribute' => 'Observacion',
                'label' => 'Observacion',
                //'contentOptions' => ['class' => 'table_class', 'style' => 'display:block;'],
                'options' => ['width' => '400'],
                'format' => 'raw',
                'value' => function ($model) {
                    $urlReporte = Html::a((strlen($model['Observacion']) < 30) ? $model['Observacion'] : substr($model['Observacion'], 0, 30) . ' (Ver Mas..)', null, ['href' => 'javascript:verCorrecciones(\'' . base64_encode($model['Ids']) . '\')', "data-toggle" => "tooltip", "title" => "Ver Correcciones"]);
                    return ($model['Observacion'] != '') ? Html::decode($urlReporte) : Yii::t("formulario", "Without comments");
                },
            ],
            [
                //'attribute' => 'Estado',
                'label' => 'Estado',
                'options' => ['width' => '130'],
                'value' => function ($model) {
                    return \app\models\MceFormularioTemp::getEstadoSolicitud($model['Estado']);
                },
            ],
            [
                'attribute' => 'FechaEnvio',
                'label' => Yii::t("formulario", "Date Send"),
                'format' => ['date', 'php:' . Yii::$app->params["dateTimeByDefault"]],
                'options' => ['width' => '180'],
            ],
            [
                'header' => Yii::t("formulario", "F.Authorization"),
                'value' => function ($model) {
                    return ($model['FechaAuto'] <> '') ? date(Yii::$app->params["dateTimeByDefault"], strtotime($model['FechaAuto'])) : '';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                //'header' => 'Action',
                'headerOptions' => ['width' => '40'],
                'template' => '{view} {update}', //{delete}
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['mceformulariotemp/solicitudpdf', 'ids' => base64_encode($model['Ids']), 'pdf' => 1]), ["target" => "_blank", "data-toggle" => "tooltip", "title" => "Descargar", "data-pjax" => "0"]);
                        //return  Html::a('Action', Url::to(['mceformulariotemp/solicitudpdf','ids' => 1],['class' => 'btn btn-default',"target" => "_blank"]));
                    },
                    'update' => function ($url, $model) {
                        //if ($model['Estado'] >= '0' && $model['Estado'] <= '3') {
                        if ($model['Estado'] == '2' ) {
                            return ($model['Observacion'] != '')?Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['mceformulariotemp/update', 'ids' => base64_encode($model['Ids'])]), ["data-toggle" => "tooltip", "title" => "Corregir", "data-pjax" => "0"]):'';
                        }
                    },
                        ],
                    ],
                ],
            ])
            ?>
</div>
<script>
    var AccionTipo = 'Index';
</script>
