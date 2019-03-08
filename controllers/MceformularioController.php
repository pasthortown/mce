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

/**
 * Description of MceformularioController
 *
 * @author Paulvillacis
 */

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\UploadedFile;
use app\components\CController;
use app\models\MceFormularioTemp;
use app\models\MceFormulario;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\models\Usuario;
use app\models\MceUsoMarca;
use app\models\Utilities;
use app\models\MceOtrosUsos;
use app\models\MceObjetivo;
use app\models\UploadForm;
use app\models\ExportFile;
use mPDF;

class MceformularioController extends CController {
    
    private function estadoSolicitud() {
        return [
            '-1' => Yii::t('formulario', 'All'),
            '0' => Yii::t('formulario', 'IN DEVELOPMENT'),
            '1' => Yii::t('formulario', 'SENT'),
            '2' => Yii::t('formulario', 'CORRECTION'),
            //'3' => Yii::t('formulario', 'Pending Approval'),
            '3' => Yii::t('formulario', 'REJECTED'),
            '4' => Yii::t('formulario', 'APPROVED'),
            //'5' => Yii::t('formulario', 'APPROVED'),
        ];
    }

    //put your code here
    public function actionIndex() {
        $data=null;
        if (Yii::$app->request->isAjax) {//
            $data = Yii::$app->request->get();//&& $data["op"]=='1'
            if (isset($data["op"]) && $data["op"]=='1' ) {                
                MceFormulario::consultarSolicitudTemp($data);
            }
        }
        return $this->render('index', [
            "model" => MceFormulario::consultarSolicitudTemp($data),
            "usomarca" => MceUsoMarca::getUsoMarca(),
            "estSol" => $this->estadoSolicitud()
        ]);
    }

    public function actionRechazar() {
        $formulario = new MceFormularioTemp;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $resul = MceFormulario::rechazarSolicitud($data);
            if ($resul) {
                //Datos de Mail
                $ids = isset($data['ids']) ? base64_decode($data['ids']) : NULL;
                $solicitud = $formulario->getSolicitudTempID($ids);
                $userData= Usuario::getUserPersona($solicitud[0]["reg_id"]);
                $correo = ($userData[0]["Usuario"]<>'admin')?$userData[0]["Usuario"]:Yii::$app->params["adminEmail"];
                $nombres = Yii::$app->session->get("PB_nombres");//Utilities::getNombresApellidos($this->firstName);
                $tituloMensaje = Yii::t("formulario","Application Rejected");
                $url=Yii::$app->params["contactoEmail"];
                $asunto = Yii::t("formulario", "Application Rejected") . " " . Yii::$app->params["siteName"];
                $body = Utilities::getMailMessage("rejected", array("[[user]]" => $userData[0]["Nombre"],"[[url]]" => $url, "[[link]]" => Url::base(true)), Yii::$app->language);
                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $userData[0]["Nombres"]], $asunto, $body);
                $message = ["info" => Yii::t('exception', '<strong>Well done!</strong> your information was successfully saved.')];
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }else{
                $message = ["info" => Yii::t('exception', 'The above error occurred while the Web server was processing your request.')];
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message);
            }
            return;
        }
    }
    
    public function actionAutorizar() {
        $model = new MceFormulario();
        $formulario = new MceFormularioTemp;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $resul = $model->autorizarSolicitud($data);
            if ($resul) {
                //Datos de Mail
                $ids = isset($data['ids']) ? base64_decode($data['ids']) : NULL;
                $solicitud = $formulario->getSolicitudTempID($ids);
                $userData = Usuario::getUserPersona($solicitud[0]["reg_id"]);
                $correo = ($userData[0]["Usuario"] <> 'admin') ? $userData[0]["Usuario"] : Yii::$app->params["adminEmail"];
                $nombres = Yii::$app->session->get("PB_nombres"); //Utilities::getNombresApellidos($this->firstName);
                //Datos FILE
                //$zipFile = Yii::$app->basePath . "/mail/layouts/files/contratos/ecuador_ama_la_vida.zip";
                //$zipFile = $_SERVER['DOCUMENT_ROOT'] . "/mce/mail/layouts/files/contratos/ecuador_ama_la_vida.zip";
                $contratoFile = "CONTRATO-Pers-NATURAL-PRODUCTOS.pdf";
                switch ($solicitud[0]["umar_id"]) {
                    case 1:
                        $contratoFile = "CONTRATO-Pers-NATURAL-PRODUCTOS.pdf";
                        break;
                    case 2:
                        $contratoFile = "CONTRATO-Pers-JURIDICA-PRODUCTOS.pdf";
                        break;
                    case 3:
                        $contratoFile = "CONTRATO-Pers-JURIDICA-SERVICIO.pdf";
                        break;
                    case 4:
                        $contratoFile = "CONTRATO-Pers-NATURAL-SERVICIOl.pdf";
                        break;
                }
                //$contratoFile = Yii::$app->basePath . "/mail/layouts/files/contratos/" . $contratoFile;
                //$contratoFile = $_SERVER['DOCUMENT_ROOT'] . "/mce/mail/layouts/files/contratos/" . $contratoFile;
                $contratoFile=Url::base(true)."/archivos/".$contratoFile;
                $rutaFile = array($contratoFile);
                //FIN DATOS FILE

                $tituloMensaje = Yii::t("formulario", "Application Approved");
                //$url = "RUTA DESCARGA ";
                $url = Url::base(true)."/archivos/ecuador_ama_la_vida.zip";
                $asunto = Yii::t("formulario", "Application Approved") . " " . Yii::$app->params["siteName"];
                $body = Utilities::getMailMessage("approve", array("[[user]]" => $userData[0]["Nombre"],"[[url]]" => $url, "[[link]]" => Url::base(true)), Yii::$app->language);
                //$body = Utilities::getMailMessage("contrato", array("[[user]]" => $userData[0]["Nombre"], "[[url]]" => $url, "[[link]]" => Url::base(true)), Yii::$app->language);
                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $userData[0]["Nombres"]], $asunto, $body,$rutaFile);
                //Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $userData[0]["Nombres"]], $asunto, $body,$rutaFile);
                $message = ["info" => Yii::t('exception', '<strong>Well done!</strong> your information was successfully saved.')];
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            } else {
                $message = ["info" => Yii::t('exception', 'The above error occurred while the Web server was processing your request.')];
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message);
            }
            return;
        }
    }

    public function actionView($ids) {
        $formulario = new MceFormularioTemp;
        if (Yii::$app->request->isAjax) {
            
        }
        $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
        $solicitud = $formulario->getSolicitudTempID($ids);
        $eventos = $formulario->getEventoTempID($ids);
        $producto = $formulario->getProductoTempID($ids);
        $otrosUsos = $formulario->getOtrosUsosTempID($ids);
        $industria = $formulario->getIndustriaID($ids);
        $mensaje = $formulario->getMensajesTempID($ids);

        $nivelInt = Provincia::getNivelDistribucion($ids, "1");
        $nivelNac = Provincia::getNivelDistribucion($ids, "2");
        $cppData = Canton::getCantonProvinciaPaisID($solicitud[0]["can_id"]);
        $objetivo = MceObjetivo::getObjetivoID($solicitud[0]["obj_id"]);
        $usoMarca = MceUsoMarca::getUsoMarcaDetalle($solicitud[0]["umar_id"]);
        return $this->render('view', [
                    'solicitud' => $solicitud,
                    'producto' => $producto,
                    'objetivo' => $objetivo,
                    'industria' => $industria,
                    'otrosUsos' => $otrosUsos,
                    'usoMarca' => $usoMarca,
                    'cppData' => $cppData,
                    'nivelInt' => $nivelInt,
                    'nivelNac' => $nivelNac,
                    'mensaje' => $mensaje,
                    'tipopyme' => MceFormularioTemp::tamanoEmpresa(),
                    'tab3usomarca' => MceFormularioTemp::tab3UsoMarca(),
                    'origen' => MceFormularioTemp::origen(),
                    'personeria' => MceFormularioTemp::personeria(),
                    'genero' => MceFormularioTemp::genero(),
                    'etnica' => MceFormularioTemp::definicionEtnica(),
                    'eventos' => $eventos
        ]);
    }
    
    public function actionMessage() {
        $model = new MceFormulario();
        $formulario = new MceFormularioTemp;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $ids = isset($data['ids']) ? $data['ids'] : NULL;
            $message = isset($data['message']) ? $data['message'] : NULL;
            $resul = $model->sendMenssage($data);
            $mensaje = $formulario->getMensajesTempID($ids);
            if ($resul) {
                //Datos de Mail
                $solicitud = $formulario->getSolicitudTempID($ids);
                $userData= Usuario::getUserPersona($solicitud[0]["reg_id"]);
                $correo = ($userData[0]["Usuario"]<>'admin')?$userData[0]["Usuario"]:Yii::$app->params["adminEmail"];
                $nombres = Yii::$app->session->get("PB_nombres");//Utilities::getNombresApellidos($this->firstName);
                $tituloMensaje = Yii::t("formulario","Correction Request");
                $asunto = Yii::t("formulario", "Correction Request") . " " . Yii::$app->params["siteName"];
                $body = Utilities::getMailMessage("review", array("[[user]]" => $userData[0]["Nombre"],"[[mensaje]]" => $message, "[[link]]" => Url::base(true)), Yii::$app->language);
                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $userData[0]["Nombres"]], $asunto, $body);
                $message = ["info" => Yii::t('exception', '<strong>Well done!</strong> your information was successfully saved.'),
                        "dataComentario" =>$mensaje
                    ];
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }else{
                $message = ["info" => Yii::t('exception', 'The above error occurred while the Web server was processing your request.'),
                        "dataComentario" =>$mensaje
                    ];
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message);
            }
            return;
        }
    }
    
    public function actionDeletemessage() {
        $model = new MceFormulario();
        $formulario = new MceFormularioTemp;
        $mensaje = array();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $ids = isset($data['ids']) ? $data['ids'] : NULL;
            $resul = $model->eliminarMenssage($ids);            
            if ($resul) {
                $ftem = isset($data['ftem']) ? $data['ftem'] : NULL;
                $mensaje = $formulario->getMensajesTempID($ftem);
                $message = ["info" => Yii::t('exception', '<strong>Well done!</strong> your information was successfully delete.'),
                        "dataComentario" =>$mensaje
                    ];
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }else{
                $message = ["info" => Yii::t('exception', 'The above error occurred while the Web server was processing your request.'),
                        "dataComentario" =>$mensaje
                    ];
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message);
            }
            return;
        }
    }
    
    public function actionExpexcel(){
        $data["estado"]   = $_GET["estado"];
        $data["licencia"] = $_GET["licencia"];
        $data["f_ini"]    = $_GET["finicio"];
        $data["f_fin"]    = $_GET["ffin"];
        $data["valor"]    = $_GET["valor"];
        
        $arrData = MceFormulario::consultarSolicitud($data);
        ini_set('memory_limit', '256M');
        $nombarch = "LicenciatarioReport-" . date("YmdHis");
        $content_type = Utilities::mimeContentType("xls");
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch . ".xls");
        header('Cache-Control: max-age=0');
        $arrHeader = array("#","Origen","Persona","Dni","Nombres","Tipo Licencia","Giro Empresa","Nombre Producto","Ruc","Cargo Representante","Dirección","Provincia / Ciudad","Teléfono Representante","Correo Representante","Página Web","Contacto","Cargo Contacto","Teléfono Contacto","Correo Contacto","Tamaño Empresa","Estado","Fecha Envío","Fecha Aprobación","Declaración Jurada");
        $nameReport = yii::t("formulario", "Application Reports");
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L","M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        return;
    }
    
    public function actionSolicitudpdf($ids) {
        
        $pdf = false;
        $formulario= new MceFormularioTemp;
        $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
        
        
        if($_GET["pdf"] == 1)
            $pdf = true;
        try{
            ini_set('memory_limit', '256M');
            $solicitud=$formulario->getSolicitudTempID($ids);
            $eventos=$formulario->getEventoTempID($ids);
            $producto=$formulario->getProductoTempID($ids);
            $otrosUsos=$formulario->getOtrosUsosTempID($ids);
            $industria=$formulario->getIndustriaID($ids);
            $arrFotos=$formulario->getFilesProducts($ids, $solicitud[0]["Cedula"]);
            
            /******/
            //$body = Utilities::getMailMessage("contrato", array(), Yii::$app->language);
            //$rutaFile = Utilities::zipFiles($nombreZip, $arr_files);
            //Utilities::sendEmail("titulo mensaje", Yii::$app->params["adminEmail"], ["edu19432@gmail.com" => "Eduardo Cueva"], "asunto", $body, array($rutaFile));
            //Utilities::removeTemporalFile($rutaFile);
            /******/
            

            $nivelInt=Provincia::getNivelDistribucion($ids,"1");
            $nivelNac=Provincia::getNivelDistribucion($ids,"2");
            $cppData=Canton::getCantonProvinciaPaisID($solicitud[0]["can_id"]);
            $objetivo=MceObjetivo::getObjetivoID($solicitud[0]["obj_id"]);
            $usoMarca=MceUsoMarca::getUsoMarcaDetalle($solicitud[0]["umar_id"]);
            
            //$model = Producto::findOne($id);
            $model = \app\models\Usuario::findAll(["usu_estado_logico"=>1]);
            if ($model === null) {
                throw new NotFoundHttpException;
            }
            // cambiar a plantilla diferente
            $this->layout = '@themes/' . Yii::$app->getView()->theme->themeName . '/layouts/pdf_rpt';
            // se exporta a pdf
            if($pdf){
                $nameFile='Formulario-MP-N°-'.$ids.'-'. date("Ymdhis");
                $report = new ExportFile();
                $filesImages = $arrFotos["productos"]; //array con las rutas de las imagenes
                // se puede enviar una vista tambien o un html
                $report->createReportPdf($this->render('@app/views/mceformulariotemp/solicitudPdf',[
                        'solicitud' => $solicitud, 
                        'producto' => $producto,
                        'objetivo' => $objetivo,
                        'industria' => $industria,
                        'otrosUsos' => $otrosUsos,
                        'usoMarca' => $usoMarca,
                        'cppData' => $cppData,
                        'nivelInt' => $nivelInt,
                        'nivelNac' => $nivelNac,
                        'tipopyme' => MceFormularioTemp::tamanoEmpresa(),
                        'tab3usomarca' => MceFormularioTemp::tab3UsoMarca(),
                        'origen' => MceFormularioTemp::origen(),
                        'personeria' => MceFormularioTemp::personeria(),
                        'genero' => MceFormularioTemp::genero(),
                        'etnica' => MceFormularioTemp::definicionEtnica(),
                        'eventos' => $eventos,
                        'filesImages' => $filesImages,
                                ]));
                //$report->createReportPdf($this->renderContent("<h4>Example</h4>"));
                $report->mpdf->Output($nameFile . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
                return;
            }
            //return $this->render('index');
            //exit;
        }catch(Exception $e){
            echo $e;
        }
        
    }
    
    public function actionBuscarpersonas() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $valor = isset($data['valor']) ? $data['valor'] : "";
            $op = isset($data['op']) ? $data['op'] : "";
            $arrayData = array();
            $arrayData = MceFormulario::retornarPersona($valor, $op);
            echo json_encode($arrayData);
        }
    }
    

}
