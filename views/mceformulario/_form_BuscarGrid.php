<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

//http://stackoverflow.com/questions/23260636/update-hidden-field-using-autocomplete-in-yii2
?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="lbl_estado" class="col-sm-1 control-label"><?= Yii::t("formulario", "Search") ?></label>
            <div class="col-sm-7">
                <?=
                 AutoComplete::widget([
                    'name' => 'txt_buscarData',
                    'id' => 'txt_buscarData',
                    'clientOptions' => [
                        'autoFill' => true,
                        'minLength' => '3',
                        'source' => new JsExpression("function( request, response ) {
                            autocompletarBuscarPersona(request, response,'txt_buscarData','COD-NOM');
                     }"),
                        'select' => new JsExpression("function( event, ui ) {
                            //alert(ui.item.id);
                            //actualizaBuscarPersona(ui.item.PER_ID); 
                            $('#txth_ids').val(ui.item.Cedula);
                            //actualizarGrid();
                     }")
                    ],
                    'options' => [
                        'class' => 'form-control',
                        'Onkeyup' => 'clearGrid()',
                        'placeholder' => Yii::t("formulario", "Search by ballot, or Company Name")
                        ],
                ]);                
                ?>
                <?php /* Html::input('text', 'txt_buscarData','' , 
                            ['id' => 'txt_buscarData',
                             'class' => 'form-control',
                             'Onkeyup' => 'actualizarGrid()',
                             'placeholder' => Yii::t("formulario", "Search by ballot, or Company Name")
                            ]) */?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="lbl_estado" class="col-sm-1 control-label"><?= Yii::t("formulario", "Status") ?></label>
            <div class="col-sm-3">
<?= Html::dropDownList("cmb_estado", -1, $estSol, ["class" => "form-control", "id" => "cmb_estado"]) ?>
            </div>
            <label for="lbl_estado" class="col-sm-1 control-label"><?= Yii::t("formulario", "License") ?></label>
            <div class="col-sm-3">
                <?=
                Html::dropDownList(
                        "cmb_usomarca", 0, ['0' => Yii::t('formulario', 'All')] + ArrayHelper::map($usomarca, 'umar_id', 'umar_nombre'), ["class" => "form-control", "id" => "cmb_usomarca"]
                )
                ?>
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="lbl_inicio" class="col-sm-1 control-label"><?= Yii::t("formulario", "Start date") ?></label>
            <div class="col-sm-3">
                <?=
                DatePicker::widget([
                    'id' => 'dtp_f_inicio',
                    'name' => 'dtp_f_inicio',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    //'value' => '23-Feb-1982',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => Yii::$app->params["datePickerDefault"]
                    ],
                    'options' => [
                        'class' => 'form-control',
                        //'Onchange' => 'actualizarGrid()',
                        'readonly' => 'readonly',
                        'placeholder' => Yii::t("formulario", "Enter start date")//'Enter birth date ...'
                    ]
                ]);
                ?>
            </div>
            <label for="lbl_fin" class="col-sm-1 control-label"><?= Yii::t("formulario", "End date") ?></label>
            <div class="col-sm-3">
                <?=
                DatePicker::widget([
                    'id' => 'dtp_f_fin',
                    'name' => 'dtp_f_fin',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    //'value' => '23-Feb-1982',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => Yii::$app->params["datePickerDefault"]
                    ],
                    'options' => [
                        'class' => 'form-control',
                        //'Onchange' => 'actualizarGrid()',
                        'readonly' => 'readonly',
                        'placeholder' => Yii::t("formulario", "Enter end date")//'Enter birth date ...'
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="row"></div>
    <div class="col-md-12">
        <div class="col-sm-1"></div>
        <div class="col-sm-2">                
            <a id="cmd_buscarData" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") ?> <span class="glyphicon glyphicon-search"></span></a>
        </div>
        <div class="col-sm-10"></div>
    </div>
    

</div>