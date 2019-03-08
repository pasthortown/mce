<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Url;
use app\models\Rol;
use yii\helpers\Html;
?>
<?= Html::hiddenInput('txth_ftem_id','',['id' =>'txth_ftem_id']); ?>
<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">             
                <a href="#paso1" data-toggle="tab" aria-expanded="true">
                    <img class="" src="<?= Url::home() ?>img/users/n1.png" alt="User Image">
                    <?= Yii::t("formulario", "Registro") ?>
                </a>
            </li>
            <li class=""><a href="#paso2" data-toggle="tab" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n2.png" alt="User Image"><?= Yii::t("formulario", "Objetivo") ?></a></li>
            <li class="disabled"><a href="#paso3" data-toggle="tab" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n3.png" alt="User Image"><?= Yii::t("formulario", "Uso") ?></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="paso1">
                <form class="form-horizontal">
                    <?=
                    $this->render('_form_tab1', [
                        'cantones' => $cantones,
                        'tipopyme' => $tipopyme,
                        'genero' => $genero,
                        'etnica' => $etnica,
                        'origen' => $origen,
                        'personeria' => $personeria,
                        'provincias' => $provincias,
                        'industria' => $industria]);
                    ?>
                </form>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="paso2">
                <form class="form-horizontal">
                    <?= 
                    $this->render('_form_tab2', 
                        ['provincias' => $provincias,
                         'pais' => $pais,
                         'trayectoria' => $trayectoria,
                         'subobjetivos' => $subobjetivos,
                         'objetivos' => $objetivos]); ?>
                </form>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="paso3">
                <form class="form-horizontal">
                    <?= $this->render('_form_tab3', ['usomarca' => $usomarca,
                        'detProducto' => $detProducto,
                        'porcentaje' => $porcentaje]); ?>
                </form>
            </div><!-- /.tab-pane -->

        </div><!-- /.tab-content -->
    </div><!-- /.nav-tabs-custom -->
</div><!-- /.col -->

<script>
    //Datos de Solicitud
    //var varSolicitud=base64_decode('<?= $solicitud ?>');
    var AccionTipo='Update';
    var varSolicitud=<?= $solicitud ?>;
    var varnivelInt=<?= $nivelInt ?>;
    var varnivelNac=<?= $nivelNac ?>;
    var vareventos=<?= $eventos ?>;
    var varotrousos=<?= $otrosUsos ?>;
    var varproducto=<?= $producto ?>;
    //alert(varSolicitud[0].Nombres);
    
</script>