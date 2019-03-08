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
use app\models\Rol;
use yii\helpers\Html;
use branchonline\lightbox\Lightbox;
$utfvar = 'utf-8';
?>
<?= Html::hiddenInput('txth_ftem_id', $solicitud[0]["Ids"],['id' =>'txth_ftem_id']); ?>
<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">             
                <a href="#paso1" data-toggle="tab" aria-expanded="true">
                    <img class="" src="<?= Url::home() ?>img/users/n1.png" alt="User Image">
                    <?= Yii::t("formulario", "Form") ?>
                </a>
            </li>
            <li class=""><a href="#paso2" data-toggle="tab" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n2.png" alt="User Image"><?= Yii::t("formulario", "Observations") ?></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="paso1">
                <form class="form-horizontal">
                    <?=                    
                    $this->render('_form_Paso1', [
                                'solicitud' => $solicitud,
                                'origen' => $origen,
                                'personeria' => $personeria,
                                'cppData' => $cppData,
                                'industria' => $industria,
                                'genero' => $genero,
                                'etnica' => $etnica,
                                'tipopyme' => $tipopyme]);
                    ?>
                    <?= 
                    $this->render('_form_Paso2', [
                                'solicitud' => $solicitud,
                                'nivelInt' => $nivelInt,
                                'nivelNac' => $nivelNac,
                                'utfvar' => $utfvar,
                                'objetivo' => $objetivo]); ?>
                    <?=
                            $this->render('_form_Paso3', [
                                'solicitud' => $solicitud,
                                'usoMarca' => $usoMarca,
                                'otrosUsos' => $otrosUsos,
                                'eventos' => $eventos,
                                'utfvar' => $utfvar,
                                'producto' => $producto]);
                            ?>
                </form>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="paso2">
                <form class="form-horizontal">
                    <?=
                    $this->render('_form_comentario', 
                        ['mensaje' => $mensaje]); ?>
                </form>
            </div><!-- /.tab-pane -->


        </div><!-- /.tab-content -->
    </div><!-- /.nav-tabs-custom -->
</div><!-- /.col -->

