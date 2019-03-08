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
 * Yii Software LLC (http://www.yiisoft.com) Copyright © 2008
 *
 */

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\UploadedFile;
use app\components\CController;
use app\models\MceFormularioTemp;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\models\MceUsoMarca;
use app\models\Utilities;
use app\models\MceOtrosUsos;
use app\models\MceObjetivo;
use app\models\UploadForm;
use app\models\ExportFile;
use mPDF;

class MceformulariotempController extends CController {

    private $id_pais = 56; //Id Pertenece al Pais Ecuador

    public function actionIndex() {
        return $this->render('index', [
                    "model" => MceFormularioTemp::consultarSolicitudTemp()
        ]);
    }

    public function actionCreate() {
        //$model = new MceFormularioTemp;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getcantones"])) {
                $cantones = Canton::getCantonesByProvinciaID($data['prov_id']);
                $message = [
                    "cantones" => $cantones,
                ];
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getobjetivos"])) {
                $subObjetivo = MceObjetivo::getSubObjetivosID($data['obj_id']);
                $message = [
                    "subObjetivo" => $subObjetivo,
                ];
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $paises = Pais::getPaises();
        $objetivos = MceFormularioTemp::getObjetivos();
        $provincias = array();
        $cantones = array();
        $subobjetivos = array();

        if (count($paises) > 0) {
            $provincias = Provincia::getProvinciasByPais($this->id_pais);
        }
        if (count($provincias) > 0) {
            $cantones = Canton::getCantonesByProvincia($provincias[0]["prov_id"]);
        }
        if (count($objetivos) > 0) {
            $subobjetivos = MceObjetivo::getSubObjetivosID($objetivos[0]["obj_id"]);
        }
        //Utilities::putMessageLogFile($message);
        return $this->render('create', [
                    "industria" => MceFormularioTemp::getIndustria(),
                    "porcentaje" => MceOtrosUsos::getPorcentaje(),
                    "usomarca" => MceUsoMarca::getUsoMarca(),
                    "provincias" => $provincias,
                    "pais" => Pais::getPaises(),
                    "objetivos" => $objetivos,
                    "subobjetivos" => $subobjetivos,
                    "tipopyme" => MceFormularioTemp::tamanoEmpresa(),
                    "tab3usomarca" => MceFormularioTemp::tab3UsoMarca(),
                    "origen" => MceFormularioTemp::origen(),
                    "genero" => MceFormularioTemp::genero(),
                    "etnica" => MceFormularioTemp::definicionEtnica(),
                    "personeria" => MceFormularioTemp::personeria(),
                    "trayectoria" => MceFormularioTemp::trayectoriaAnos(),
                    //'detProducto' => $model->detalleProductos(),
                    "cantones" => $cantones]);
    }

    public function actionUpdate($ids) {
        $formulario = new MceFormularioTemp;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getcantones"])) {
                $cantones = Canton::getCantonesByProvinciaID($data['prov_id']);
                $message = [
                    "cantones" => $cantones,
                ];
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getobjetivos"])) {
                $subObjetivo = MceObjetivo::getSubObjetivosID($data['obj_id']);
                $message = [
                    "subObjetivo" => $subObjetivo,
                ];
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
        $solicitud = $formulario->getSolicitudTempID($ids);
        $producto = $formulario->getProductoTempID($ids);
        $nivelInt = Provincia::getNivelDistribucion($ids, "1");
        $nivelNac = Provincia::getNivelDistribucion($ids, "2");
        $cppData = Canton::getCantonProvinciaPaisID($solicitud[0]["can_id"]);
        $otrosUsos = $formulario->getOtrosUsosTempID($ids);

        //$objetivo=MceObjetivo::getObjetivoID($solicitud[0]["obj_id"]);
        $usoMarca = MceUsoMarca::getUsoMarcaDetalle($solicitud[0]["umar_id"]);
        $eventos = $formulario->getEventoTempID($ids);
        $paises = Pais::getPaises();
        $objetivos = MceFormularioTemp::getObjetivos();
        $provincias = array();
        $cantones = array();
        $subobjetivos = array();

        if (count($paises) > 0) {
            $provincias = Provincia::getProvinciasByPais($this->id_pais);
        }
        if (count($provincias) > 0) {
            $cantones = Canton::getCantonesByProvincia($solicitud[0]["prov_id"]);
        }
//        if (count($objetivos) > 0) {
//            $subobjetivos = MceObjetivo::getSubObjetivosID($objetivos[0]["obj_id"]);
//        }
        return $this->render('update', [
                    //"solicitud"=> base64_encode(json_encode($solicitud)),
                    "solicitud" => json_encode($solicitud),
                    'nivelInt' => json_encode($nivelInt),
                    'nivelNac' => json_encode($nivelNac),
                    'otrosUsos' => json_encode($otrosUsos),
                    'eventos' => json_encode($eventos),
                    'producto' => json_encode($producto),
                    "industria" => MceFormularioTemp::getIndustria(),
                    "porcentaje" => MceOtrosUsos::getPorcentaje(),
                    "usomarca" => MceUsoMarca::getUsoMarca(),
                    "provincias" => $provincias,
                    "pais" => Pais::getPaises(),
                    "objetivos" => $objetivos,
                    "tipopyme" => MceFormularioTemp::tamanoEmpresa(),
                    "tab3usomarca" => MceFormularioTemp::tab3UsoMarca(),
                    "genero" => MceFormularioTemp::genero(),
                    "etnica" => MceFormularioTemp::definicionEtnica(),
                    "origen" => MceFormularioTemp::origen(),
                    "personeria" => MceFormularioTemp::personeria(),
                    "trayectoria" => MceFormularioTemp::trayectoriaAnos(),
                    "cantones" => $cantones]);
    }

    public function actionUsomarca() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            //$valor = isset($_POST['valor']) ? $_POST['valor'] : "";
            //Utilities::putMessageLogFile(MceUsoMarca::getUsoMarcaDetalle($data['umar_id']));
            $message = [
                "otrosusos" => MceOtrosUsos::getOtrosUsoMarca(),
                "usomarca" => MceUsoMarca::getUsoMarcaDetalle($data['umar_id']),
            ];
            echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            return;
        }
    }

    public function actionSave() {
        if (Yii::$app->request->isAjax) {
            $model = new MceFormularioTemp;
            $data = Yii::$app->request->post();
            $accion = isset($data['ACCION']) ? $data['ACCION'] : "";
            if ($accion == "Create") {
                if (Yii::$app->params["adminRegister"] && Yii::$app->session->get('PB_iduser') == 1) {
                    // se registra al cliente
                    Yii::$app->session->set('PB_idregister', 0);
                    $data_4 = isset($data['DATA_4']) ? $data['DATA_4'] : array();
                    $persona = new \app\models\Persona();
                    if ($data_4[0]["user_name"] != "" && $data_4[0]["user_lastname"] != "" && $data_4[0]["user_email"] != "") {
                        $persona->per_nombres = $data_4[0]["user_name"];
                        $persona->per_apellidos = $data_4[0]["user_lastname"];
                        $persona->per_correo = $data_4[0]["user_email"];
                        $persona->save();
                        $id_persona = $persona->per_id;
                        // segundo se crea a usuario
                        $usuario = new \app\models\Usuario();
                        $security = new \yii\base\Security();
                        $password = $security->generateRandomString();
                        $usuario->crearUsuario($data_4[0]["user_email"], $password, $id_persona);
                        $usu_id = $usuario->usu_id;
                        // tercero se crea los permisos del usuario creado grupo3 rol3
                        $grupo_rol = new \app\models\GrupoRol();
                        $grupo_rol->gru_id = 2; // Grupo Licenciatario
                        $grupo_rol->rol_id = 2; // Rol Licenciatario
                        $grupo_rol->usu_id = $usu_id;

                        $grupo_rol->save();

                        $grup_id = $grupo_rol->grol_id;
                        // crear grup_obmo_grup_rol
                        $datagmod = array(14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25);
                        for ($i = 0; $i < count($datagmod); $i++) {
                            $grup_obmo = new \app\models\GrupObmoGrupRol();
                            $grup_obmo->grol_id = $grup_id;
                            $grup_obmo->gmod_id = $datagmod[$i];
                            $grup_obmo->save();
                        }
                        $registroMce = new \app\models\MceRegistro();
                        $registroMce->usu_id = $usu_id;
                        $registroMce->save();
                        Yii::$app->session->set('PB_idregister', $registroMce->reg_id);
                    }
                }
                //Nuevo Registro
                $resul = $model->insertarSolicitud($data);
            } else if ($accion == "Update") {
                //Modificar Registro
                $resul = $model->actualizarSolicitud($data);
            }
            if ($resul['status']) {
                if ($accion == "Create") {
                    $source = $_SERVER['DOCUMENT_ROOT'] . Url::base() . Yii::$app->params["documentFolder"] . $resul['cedula'];
                    $target = $_SERVER['DOCUMENT_ROOT'] . Url::base() . Yii::$app->params["documentFolder"] . $resul['cedula'] . '_' . $resul['ids'];
                    rename($source, $target); //Renombrar el Directorio                    
                }

                $message = ["info" => Yii::t('exception', '<strong>Well done!</strong> your information was successfully saved.')];
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message, $resul);
            } else {
                $message = ["info" => Yii::t('exception', 'The above error occurred while the Web server was processing your request.')];
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message);
            }
            return;
        }
    }

    public function actionUploadfile() {
        if (Yii::$app->request->isPost) {
            if (empty($_FILES['file'])) {
                echo json_encode(['error' => 'Ficheiro(s) no encontrado(s).']);
                //Message = "Error in saving file"
                return;
            }
            //Recibe Paramentros
            $files = $_FILES['file'];
            $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : 'default';

            $success = null;
            //$paths = [];
            $filenames = $files['name']; //Nombre Archivo
            $ext = explode('.', basename($filenames)); //Extension del Archivo
            //$folder = md5(uniqid());
            $folder_path = $_SERVER['DOCUMENT_ROOT'] . Url::base() . Yii::$app->params["documentFolder"] . $numero; //Ruta Segun Opciones
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true); //Se Crea la carpeta
                mkdir($folder_path . '/productos', 0777, true); //Se Crea la carpeta
            }
            $producto = ($nombre == 'producto') ? '/productos' : ''; //Si Es producto genera carpeta
            $folder_path = $folder_path . $producto; //Ruta Segun Opciones
            //$nombre=($nombre=='producto')?$numero.'_'.$filenames:$numero.'_'.$nombre;
            $nombre = ($nombre == 'producto') ? $filenames : $nombre . "." . array_pop($ext); //Si Es producto Se guarda con el nombre original
            $target = $folder_path . DIRECTORY_SEPARATOR . $nombre;
            if (move_uploaded_file($files['tmp_name'], $target)) {
                $success = true;
                //$paths[] = $target;
            } else {
                $success = false;
            }
            return $success;
        }
        return true;
    }

    private function downloadFile($dir, $file, $extensions = []) {
        //Si el directorio existe
        //if (is_dir($dir)) {            
        //Ruta absoluta del archivo
        $path = $dir . $file;
        //Si el archivo existe
        //if (is_file($path)) {
        //Obtener información del archivo
        $file_info = pathinfo($path);
        //Obtener la extensión del archivo
        $extension = $file_info["extension"];

        if (is_array($extensions)) {
            //Si el argumento $extensions es un array
            //Comprobar las extensiones permitidas
            foreach ($extensions as $e) {
                //Si la extension es correcta
                if ($e === $extension) {
                    //Procedemos a descargar el archivo
                    // Definir headers
                    //$size = filesize($path);
                    header("Content-Type: application/force-download");
                    header("Content-Disposition: attachment; filename=$file");
                    header("Content-Transfer-Encoding: binary");
                    //header("Content-Length: " . $size);
                    // Descargar archivo
                    readfile($path);
                    //Correcto
                    return true;
                }
            }
        }
        //}
        //}
        //Ha ocurrido un error al descargar el archivo
        return false;
    }

    public function actionDownload() {
        if (Yii::$app->request->get("file")) {
            //Si el archivo no se ha podido descargar
            //downloadFile($dir, $file, $extensions=[])
            if (!$this->downloadFile(Url::base(true) . "/archivos/", Html::encode($_GET["file"]), ["pdf", "txt", "doc"])) {
                //Mensaje flash para mostrar el error
                //Yii::$app->session->setFlash("errordownload");
            }
        }
        return $this->render("download");
    }

    public function actionSolicitudpdf($ids) {

        $pdf = false;
        $formulario = new MceFormularioTemp;
        $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;


        if ($_GET["pdf"] == 1)
            $pdf = true;
        try {
            $solicitud = $formulario->getSolicitudTempID($ids);
            $eventos = $formulario->getEventoTempID($ids);
            $producto = $formulario->getProductoTempID($ids);
            $otrosUsos = $formulario->getOtrosUsosTempID($ids);
            $industria = $formulario->getIndustriaID($solicitud[0]["ind_id"]);
            $arrFotos = $formulario->getFilesProducts($ids, $solicitud[0]["Cedula"]);

            $nivelInt = Provincia::getNivelDistribucion($ids, "1");
            $nivelNac = Provincia::getNivelDistribucion($ids, "2");
            $cppData = Canton::getCantonProvinciaPaisID($solicitud[0]["can_id"]);
            $objetivo = MceObjetivo::getObjetivoID($solicitud[0]["obj_id"]);
            $usoMarca = MceUsoMarca::getUsoMarcaDetalle($solicitud[0]["umar_id"]);

            //$model = Producto::findOne($id);
            $model = \app\models\Usuario::findAll(["usu_estado_logico" => 1]);
            if ($model === null) {
                throw new NotFoundHttpException;
            }
            // cambiar a plantilla diferente
            $this->layout = '@themes/' . Yii::$app->getView()->theme->themeName . '/layouts/pdf_rpt';
            // se exporta a pdf
            if ($pdf) {
                $nameFile = 'Formulario-MP-N°-' . $ids . '-' . date("Ymdhis");
                $report = new ExportFile();
                $filesImages = $arrFotos["productos"]; //array con las rutas de las imagenes
                // se puede enviar una vista tambien o un html
                $report->createReportPdf($this->render('solicitudPdf', [
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
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function actionViewmessage() {
        $formulario = new MceFormularioTemp;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $ids = isset($data['ids']) ? base64_decode($data['ids']) : NULL;
            $message = ["dataComentario" => $formulario->getMensajesTempID($ids)];
            echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            return;
        }
    }

}
