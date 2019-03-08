<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
?>
<?= Html::hiddenInput('txth_ids','',['id' =>'txth_ids']); ?>
<?=
$this->render('_form_BuscarGrid', [
    'usomarca' => $usomarca,
    'estSol' => $estSol]);
?>
<div>
    <?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'TbG_SOLICITUD',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
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
                'header' => Yii::t("formulario", "Cuenta"),
                //'options' => ['width' => '180'],
                'value' => 'Cuenta',
            ],
            [
                'attribute' => 'Nombres',
                'header' => Yii::t("formulario", "Name"),
                //'options' => ['width' => '200'],
                'value' => 'Nombres',
            ],
            [
                'header' => 'Origen',
                //'options' => ['width' => '100'],
                'value' => function ($model) {
                    return ($model['Origen'] == '1') ? Yii::t("formulario", "National") : Yii::t("formulario", "Foreign");
                },
            ],
            [
                'header' => 'Persona',
                //'options' => ['width' => '100'],
                'value' => function ($model) {
                    return ($model['Personeria'] == '1') ? Yii::t("formulario", "Natural") : Yii::t("formulario", "Legal");
                },
            ],
            [
                //'attribute' => 'Estado',
                'label' => 'Estado',
                //'options' => ['width' => '130'],
                'value' => function ($model) {
                    return \app\models\MceFormularioTemp::getEstadoSolicitud($model['Estado']);
                },
            ],
            [
                'header' => Yii::t("formulario", "Date Send"),
                'format' => ['date', 'php:' . Yii::$app->params["dateTimeByDefault"]],
                'value' => 'F_Creado',
            //'options' => ['width' => '180'],
            ],
            [
                'header' => Yii::t("formulario", "F.Authorization"),
                'value' => function ($model) {
                    return ($model['FechaAuto'] <> '') ? date(Yii::$app->params["dateTimeByDefault"], strtotime($model['FechaAuto'])) : '';
                },
            ],
            [
                'header' => Yii::t("formulario", "Sector"),
                //'options' => ['width' => '200'],
                'value' => 'Sector',
            ],
            [
                'header' => Yii::t("formulario", "Licencia"),
                //'options' => ['width' => '200'],
                'value' => 'Licencia',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                //'header' => 'Action',
                'headerOptions' => ['width' => '30'],
                'template' => '{view} {update} {delete} {autoriza}', //
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['mceformulario/solicitudpdf', 'ids' => base64_encode($model['Ids']), 'pdf' => 1]), ["target" => "_blank", "data-toggle" => "tooltip", "title" => "Descargar", "data-pjax" => 0]);
                        //return  Html::a('Action', Url::to(['mceformulariotemp/solicitudpdf','ids' => 1],['class' => 'btn btn-default',"target" => "_blank"]));
                    },
                            'update' => function ($url, $model) {
                        if ($model['Estado'] < '3') {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['mceformulario/view', 'ids' => base64_encode($model['Ids'])]), ["data-toggle" => "tooltip", "title" => "Corregir"]);
                        }
                    },
                            'delete' => function ($url, $model) {
                        //return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['mceformulariotemp/update', 'ids' => base64_encode($model['Ids'])]));
                        if ($model['Estado'] < '3') {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span>', null, ['href' => 'javascript:rechazarSolicitud(\'' . base64_encode($model['Ids']) . '\');', "data-toggle" => "tooltip", "title" => "Rechazar"]);
                        }
                    },
                            'autoriza' => function ($url, $model) {
                        //return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['mceformulariotemp/update', 'ids' => base64_encode($model['Ids'])]));
                        if ($model['Estado'] < '3') {
                            return Html::a('<span class="glyphicon glyphicon-ok"></span>', null, ['href' => 'javascript:autorizarSolicitud(\'' . base64_encode($model['Ids']) . '\');', "data-toggle" => "tooltip", "title" => "Autorizar"]);
                        }
                    },
                        ],
                    ],
                ],
            ])
            ?>
</div>
