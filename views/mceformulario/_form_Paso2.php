<?php
/*
 * The PenBlu framework is free software. It is released under the terms of
 * the following BSD License.
 *
 * Copyright (C) 2015 by PenBlu Software (http://www.penblu.com)
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *  - Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in
 *    the documentation and/or other materials provided with the
 *    distribution.
 *  - Neither the name of PenBlu Software nor the names of its
 *    contributors may be used to endorse or promote products derived
 *    from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * PenBlu is based on code by
 * Yii Software LLC (http://www.yiisoft.com) Copyright Â© 2008
 *
 * Authors:
 *
 * Eduardo Cueva <edu19432@gmail.com>
 * Byron Villacreses <byronvillacreses@gmail.com>
 */
use yii\helpers\Url;
use yii\helpers\Html;
?>
<h3><?= Yii::t("formulario", "Objective Using the Brand") ?></h3>
<div class="col-md-6">
    <div class="form-group">
        <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Objective") ?></label>
        <div class="col-sm-9">
            <?= Html::input('text', 'obj_nombre',mb_strtoupper($objetivo[0]["obj_nombre"],$utfvar), ['class' => 'form-control','readonly' => true]) ?>
        </div>
    </div>
</div>
<div class="row"></div>
<div class="col-md-12">
    <div class="form-group">
        <label for="lbl_origen" ><?= Yii::t("formulario", "Because you want to use the country brand Ecuador loves life?") ?></label>
        <div>
            <?= Html::textarea('DetalleObjetivo',mb_strtoupper($solicitud[0]["DetalleObjetivo"]), ['class' => 'form-control','readonly' => true]) ?>
        </div>
    </div>
</div>
<h3><?= Yii::t("formulario", "Business commitment with Ecuador") ?></h3> 
<div class="col-md-12">
    <div class="form-group">
        <label for="lbl_origen" ><?= Yii::t("formulario", "Activity") ?></label>
        <div>
            <?= Html::textarea('Actividad',mb_strtoupper($solicitud[0]["Actividad"]), ['class' => 'form-control','readonly' => true]) ?>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="lbl_origen" ><?= Yii::t("formulario", "Mission") ?></label>
        <div>
            <?= Html::textarea('Mision',mb_strtoupper($solicitud[0]["Mision"]), ['class' => 'form-control','readonly' => true]) ?>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="lbl_origen" ><?= Yii::t("formulario", "Reference") ?></label>
        <div>
                <?= Html::textarea('Referencia',mb_strtoupper($solicitud[0]["Referencia"]), ['class' => 'form-control','readonly' => true]) ?>

        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="lbl_origen" ><?= Yii::t("formulario", "Trajectory") ?></label>
        <div>
            <?= Html::input('text', 'Referencia',mb_strtoupper($solicitud[0]["Trayectoria"],$utfvar), ['class' => 'form-control','readonly' => true]) ?>
        </div>
    </div>
</div>
<div class="row"></div>
<?php
if ($nivelInt !== null or $nivelNac !== null) {
    ?>
    <h3><?= Yii::t("formulario", "Ability to raise the countrys image") ?></h3>
    <h5><?= Yii::t("formulario", "Where the Country Brand is sold") ?></h5>
    <?php
    if ($nivelNac !== null) {
        $textNac = "";
        for ($i = 0; $i < sizeof($nivelNac); $i++) {
            $textNac .=($i == 0) ? $nivelNac[$i]["Provincia"] : ", " . $nivelNac[$i]["Provincia"];
        }
        ?>
        <div class="col-md-6">
            <div class="form-group">
                <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Level National") ?></label>
                <div class="col-sm-9">
                    <?= Html::input('text', 'Provincia',mb_strtoupper($textNac,$utfvar), ['class' => 'form-control','readonly' => true]) ?>
                </div>
            </div>
        </div>

    <?php } ?>

    <?php
    if ($nivelInt !== null) {
        $textInt = "";
        for ($i = 0; $i < sizeof($nivelInt); $i++) {
            $textInt .=($i == 0) ? $nivelInt[$i]["Pais"] : ", " . $nivelInt[$i]["Pais"];
        }
        ?>
        <div class="col-md-6">
            <div class="form-group">
                <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Level International") ?></label>
                <div class="col-sm-9">
                    <?= Html::input('text', 'Pais',mb_strtoupper($textInt,$utfvar), ['class' => 'form-control','readonly' => true]) ?>
                </div>
            </div>
        </div>

    <?php } ?>

<?php } ?>
<div class="row"></div>

