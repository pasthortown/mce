<?php

namespace app\models;

use yii\db\mssql\PDO;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use Yii;

/**
 * This is the model class for table "mce_formulario_temp".
 *
 * @property integer $ftem_id
 * @property integer $can_id
 * @property integer $reg_id
 * @property integer $ind_id
 * @property integer $ftem_origen
 * @property integer $ftem_personeria
 * @property string $ftem_nombre
 * @property string $ftem_cedula_ruc
 * @property string $ftem_representante
 * @property string $ftem_cargo_repre
 * @property string $ftem_ced_ruc_repre
 * @property string $ftem_direccion
 * @property string $ftem_sitio_web
 * @property string $ftem_contacto
 * @property string $ftem_cargo
 * @property string $ftem_correo
 * @property string $ftem_telefono
 * @property string $ftem_cedula_file
 * @property string $ftem_ruc_file
 * @property string $ftem_cert_file
 * @property string $ftem_reg_sanitario_file
 * @property string $ftem_cert_votacion_file
 * @property string $ftem_decl_jurada_file
 * @property string $ftem_trayectoria_file
 * @property string $ftem_motivo
 * @property string $ftem_giroprincipal
 * @property string $ftem_vision
 * @property string $ftem_mision
 * @property string $ftem_referencia
 * @property integer $ftem_participa
 * @property string $ftem_detalle
 * @property integer $ftem_nacional
 * @property integer $ftem_extranjero
 * @property integer $ftem_estado
 * @property string $ftem_fecha_creacion
 * @property string $ftem_fecha_modificacion
 * @property integer $ftem_estado_logico
 *
 * @property MceFormularioObjetivoTemp[] $mceFormularioObjetivoTemps
 * @property Canton $can
 * @property MceRegistro $reg
 * @property MceIndustria $ind
 * @property MceMarcaLugarTemp[] $mceMarcaLugarTemps
 * @property MceUsoMarcaFormularioTemp[] $mceUsoMarcaFormularioTemps
 * 
    ESTADO DE FORMULARIO
   -1=TODOS
    0=EN ELABORACIÓN
    1=ENVIADO
    2=CORRECCIÓN
    //3=PENDIENTE DE APROBACIÓN
    3=RECHAZADO
    4=APROBADO
 * 
 */
class MceFormularioTemp extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'mce_formulario_temp';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['can_id', 'reg_id', 'ind_id', 'ftem_estado_logico'], 'required'],
            [['can_id', 'reg_id', 'ind_id', 'ftem_origen', 'ftem_personeria', 'ftem_participa', 'ftem_nacional', 'ftem_extranjero', 'ftem_estado', 'ftem_estado_logico'], 'integer'],
            [['ftem_motivo', 'ftem_giroprincipal', 'ftem_vision', 'ftem_mision', 'ftem_referencia', 'ftem_detalle'], 'string'],
            [['ftem_fecha_creacion', 'ftem_fecha_modificacion'], 'safe'],
            [['ftem_nombre', 'ftem_representante', 'ftem_cargo_repre', 'ftem_direccion', 'ftem_cargo', 'ftem_correo'], 'string', 'max' => 60],
            [['ftem_cedula_ruc', 'ftem_ced_ruc_repre', 'ftem_telefono'], 'string', 'max' => 15],
            [['ftem_sitio_web'], 'string', 'max' => 80],
            [['ftem_contacto', 'ftem_cedula_file', 'ftem_ruc_file', 'ftem_cert_file', 'ftem_reg_sanitario_file', 'ftem_cert_votacion_file', 'ftem_decl_jurada_file', 'ftem_trayectoria_file'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ftem_id' => Yii::t('mce_formulario_temp', 'Ftem ID'),
            'can_id' => Yii::t('mce_formulario_temp', 'Can ID'),
            'reg_id' => Yii::t('mce_formulario_temp', 'Reg ID'),
            'ind_id' => Yii::t('mce_formulario_temp', 'Ind ID'),
            'ftem_origen' => Yii::t('mce_formulario_temp', 'Ftem Origen'),
            'ftem_personeria' => Yii::t('mce_formulario_temp', 'Ftem Personeria'),
            'ftem_nombre' => Yii::t('mce_formulario_temp', 'Ftem Nombre'),
            'ftem_cedula_ruc' => Yii::t('mce_formulario_temp', 'Ftem Cedula Ruc'),
            'ftem_representante' => Yii::t('mce_formulario_temp', 'Ftem Representante'),
            'ftem_cargo_repre' => Yii::t('mce_formulario_temp', 'Ftem Cargo Repre'),
            'ftem_ced_ruc_repre' => Yii::t('mce_formulario_temp', 'Ftem Ced Ruc Repre'),
            'ftem_direccion' => Yii::t('mce_formulario_temp', 'Ftem Direccion'),
            'ftem_sitio_web' => Yii::t('mce_formulario_temp', 'Ftem Sitio Web'),
            'ftem_contacto' => Yii::t('mce_formulario_temp', 'Ftem Contacto'),
            'ftem_cargo' => Yii::t('mce_formulario_temp', 'Ftem Cargo'),
            'ftem_correo' => Yii::t('mce_formulario_temp', 'Ftem Correo'),
            'ftem_telefono' => Yii::t('mce_formulario_temp', 'Ftem Telefono'),
            'ftem_cedula_file' => Yii::t('mce_formulario_temp', 'Ftem Cedula File'),
            'ftem_ruc_file' => Yii::t('mce_formulario_temp', 'Ftem Ruc File'),
            'ftem_cert_file' => Yii::t('mce_formulario_temp', 'Ftem Cert File'),
            'ftem_reg_sanitario_file' => Yii::t('mce_formulario_temp', 'Ftem Reg Sanitario File'),
            'ftem_cert_votacion_file' => Yii::t('mce_formulario_temp', 'Ftem Cert Votacion File'),
            'ftem_decl_jurada_file' => Yii::t('mce_formulario_temp', 'Ftem Decl Jurada File'),
            'ftem_trayectoria_file' => Yii::t('mce_formulario_temp', 'Ftem Trayectoria File'),
            'ftem_motivo' => Yii::t('mce_formulario_temp', 'Ftem Motivo'),
            'ftem_giroprincipal' => Yii::t('mce_formulario_temp', 'Ftem Giroprincipal'),
            'ftem_vision' => Yii::t('mce_formulario_temp', 'Ftem Vision'),
            'ftem_mision' => Yii::t('mce_formulario_temp', 'Ftem Mision'),
            'ftem_referencia' => Yii::t('mce_formulario_temp', 'Ftem Referencia'),
            'ftem_participa' => Yii::t('mce_formulario_temp', 'Ftem Participa'),
            'ftem_detalle' => Yii::t('mce_formulario_temp', 'Ftem Detalle'),
            'ftem_nacional' => Yii::t('mce_formulario_temp', 'Ftem Nacional'),
            'ftem_extranjero' => Yii::t('mce_formulario_temp', 'Ftem Extranjero'),
            'ftem_estado' => Yii::t('mce_formulario_temp', 'Ftem Estado'),
            'ftem_fecha_creacion' => Yii::t('mce_formulario_temp', 'Ftem Fecha Creacion'),
            'ftem_fecha_modificacion' => Yii::t('mce_formulario_temp', 'Ftem Fecha Modificacion'),
            'ftem_estado_logico' => Yii::t('mce_formulario_temp', 'Ftem Estado Logico'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceFormularioObjetivoTemps() {
        return $this->hasMany(MceFormularioObjetivoTemp::className(), ['ftem_id' => 'ftem_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCan() {
        return $this->hasOne(Canton::className(), ['can_id' => 'can_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReg() {
        return $this->hasOne(MceRegistro::className(), ['reg_id' => 'reg_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInd() {
        return $this->hasOne(MceIndustria::className(), ['ind_id' => 'ind_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceMarcaLugarTemps() {
        return $this->hasMany(MceMarcaLugarTemp::className(), ['ftem_id' => 'ftem_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceUsoMarcaFormularioTemps() {
        return $this->hasMany(MceUsoMarcaFormularioTemp::className(), ['ftem_id' => 'ftem_id']);
    }

    public static function getIndustria() {
        $sql = "SELECT ind_id,ind_giro FROM mce_industria where ind_estado_logico=1;";
        $comando = Yii::$app->db->createCommand($sql);
        return $comando->queryAll();
    }
    
    public static function getIndustriaID($ids) {
        $con = \Yii::$app->db;
        $sql="SELECT ind_giro Sector FROM " . $con->dbname . ".mce_industria WHERE ind_estado_logico=1 AND ind_id=:ind_id";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":ind_id", $ids, PDO::PARAM_INT);
        return $comando->queryAll();
    }

    public static function getObjetivos() {
        $sql = "SELECT obj_id,obj_nombre FROM mce_base.mce_objetivo where obj_estado_logico=1;";
        $comando = Yii::$app->db->createCommand($sql);
        return $comando->queryAll();
    }

    /* Imformacion de Productos */

    public function detalleProductos() {
        $rawData = array();
        $rawData[] = $this->rowDetalleProductos();
        return new ArrayDataProvider($rawData, [
            'keyField' => 'pro_id',
            'sort' => [
                'attributes' => [
                //'pro_id', 'pro_id', 
                ],
            ],
            'pagination' => [
                'pageSize' => 10, //Yii::app()->params['pageSize']
            ],
        ]);
    }

    public function rowDetalleProductos() {
        return [
            "pro_id" => '', //0
            "pro_id" => '',
            "pro_foto" => '',
        ];
    }
    
    /*public function insertarSolicitud($data) {
        $arroout = array();
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            $data_1 = isset($data['DATA_1']) ? $data['DATA_1'] : array();
            $usu_id= Yii::$app->session->get('PB_idregister', FALSE);
            $doc_numero='00001';
            $this->insertarDataSolicitud($con,$data_1,$doc_numero,$usu_id);
            $ftem_id=$con->getLastInsertID();//IDS Formulario Temp
            Utilities::putMessageLogFile($ftem_id);
            $trans->commit();
            $con->close();
            //RETORNA DATOS 
            $arroout["ids"]= $ftem_id;
            $arroout["status"]= true;
            $arroout["secuencial"]= $doc_numero;
            $arroout["accion"]= 'Update';
            return $arroout;
            //return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            $arroout["status"]= false;
            return $arroout;
            //return false;
        }
    }
    
    
    
    private function insertarDataSolicitud($con,$data_1,$doc_numero,$usu_id) { 
        $sql = "INSERT INTO " . $con->dbname . ".mce_formulario_temp
            (doc_numero,can_id,reg_id,ind_id,ftem_origen,ftem_personeria,ftem_nombre,ftem_apellido,ftem_cedula,ftem_ruc,
             ftem_direccion,ftem_sitio_web,ftem_contacto,ftem_cargo,
             ftem_correo,ftem_telefono,ftem_tipo_pyme,ftem_cedula_file,ftem_ruc_file,ftem_cert_file,                      
             ftem_registro_sanitario_file,ftem_perm_func_mitur_file,ftem_cert_super_compania_file,             
             ftem_cert_obligaciones_file,ftem_razon_social,ftem_estado,ftem_estado_logico,sobj_id,umar_id)VALUES
            (:doc_numero,:can_id,:reg_id,:ind_id,:ftem_origen,:ftem_personeria,:ftem_nombre,:ftem_apellido,:ftem_cedula,:ftem_ruc,
             :ftem_direccion,:ftem_sitio_web,:ftem_contacto,:ftem_cargo,
             :ftem_correo,:ftem_telefono,:ftem_tipo_pyme,:ftem_cedula_file,:ftem_ruc_file,:ftem_cert_file,             
             :ftem_registro_sanitario_file,:ftem_perm_func_mitur_file,:ftem_cert_super_compania_file,             
             :ftem_cert_obligaciones_file,:ftem_razon_social,0,1,1,1)";     
        //PASO 1
        $command = $con->createCommand($sql);
        $command->bindParam(":doc_numero",$doc_numero, \PDO::PARAM_STR);
        $command->bindParam(":can_id", $data_1[0]['can_id'], \PDO::PARAM_INT);
        $command->bindParam(":reg_id", $usu_id, \PDO::PARAM_INT);//ID REGISTRO SESION
        $command->bindParam(":ind_id", $data_1[0]['ind_id'], \PDO::PARAM_INT);//ID SECTOR
        $command->bindParam(":ftem_origen", $data_1[0]['ftem_origen'], \PDO::PARAM_INT);
        $command->bindParam(":ftem_personeria", $data_1[0]['ftem_personeria'], \PDO::PARAM_INT);
        $command->bindParam(":ftem_nombre", $data_1[0]['ftem_nombre'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_apellido", $data_1[0]['ftem_apellido'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_cedula", $data_1[0]['ftem_cedula'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_ruc", $data_1[0]['ftem_ruc'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_direccion", $data_1[0]['ftem_direccion'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_sitio_web", $data_1[0]['ftem_sitio_web'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_contacto", $data_1[0]['ftem_contacto'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_cargo", $data_1[0]['ftem_cargo'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_correo", $data_1[0]['ftem_correo'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_telefono", $data_1[0]['ftem_telefono'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_tipo_pyme", $data_1[0]['ftem_tipo_pyme'], \PDO::PARAM_INT);
        $command->bindParam(":ftem_cedula_file", $data_1[0]['ftem_cedula_file'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_ruc_file", $data_1[0]['ftem_ruc_file'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_cert_file", $data_1[0]['ftem_cert_file'], \PDO::PARAM_STR);        
        $command->bindParam(":ftem_registro_sanitario_file", $data_1[0]['ftem_registro_sanitario_file'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_perm_func_mitur_file", $data_1[0]['ftem_perm_func_mitur_file'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_cert_super_compania_file", $data_1[0]['ftem_cert_super_compania_file'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_cert_obligaciones_file", $data_1[0]['ftem_cert_obligaciones_file'], \PDO::PARAM_STR);
        $command->bindParam(":ftem_razon_social", $data_1[0]['ftem_razon_social'], \PDO::PARAM_STR);
        $command->execute();
    }*/

    public function insertarSolicitud($data) {
        $arroout = array();
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            $data_1 = isset($data['DATA_1']) ? $data['DATA_1'] : array();
            $data_2 = isset($data['DATA_2']) ? $data['DATA_2'] : array();
            $data_3 = isset($data['DATA_3']) ? $data['DATA_3'] : array();        
            $reg_id = Yii::$app->session->get('PB_idregister', FALSE);
            $this->insertarDataSolicitud($con,$data_1,$data_2,$data_3,$reg_id);
            $ftem_id=$con->getLastInsertID();//IDS Formulario Temp
            $this->insertarNivelNacional($con, $data_2[0]['ftem_nivelNacional'],$ftem_id);
            $this->insertarNivelInternacional($con, $data_2[0]['ftem_nivelInternacional'],$ftem_id);
            //Guardar segun el uso de la Marca
            switch ($data_3[0]['umar_id']) {
                case '1':
                    $this->insertarOtrosUsosMarca($con, $data_3[0]['ftem_otrosUsos'],$ftem_id);
                    break;
                case '2':
                    $this->insertarProductos($con,json_decode($data_3[0]['data_producto']),$ftem_id);
                    break;
                case '3':
                    $this->insertarOtrosUsosMarca($con, $data_3[0]['ftem_otrosUsos'],$ftem_id);
                    $this->insertarEventos($con,$data_3,$ftem_id);
                    break;
                case '4':
                    $this->insertarOtrosUsosMarca($con, $data_3[0]['ftem_otrosUsos'],$ftem_id);
                    break;
                default:
            }
            $trans->commit();
            $con->close();
             //RETORNA DATOS 
            $arroout["ids"]= $ftem_id;
            $arroout["status"]= true;
            $arroout["secuencial"]= $doc_numero;
            $arroout["cedula"]= $data_1[0]['ftem_cedula'];
            $arroout["accion"]= 'Update';
            return $arroout;
            //return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            $arroout["status"]= false;
            return $arroout;
            //return false;
        }
    }

    private function insertarDataSolicitud($con,$data_1,$data_2,$data_3,$reg_id) {
        //Utilities::putMessageLogFile($data_1);
        //Utilities::putMessageLogFile($data_2);
        //Utilities::putMessageLogFile($data_3);//ftem_fecha_envio
        $doc_numero='00001';
        $sql = "INSERT INTO " . $con->dbname . ".mce_formulario_temp
            (doc_numero,can_id,reg_id,ind_id,ftem_condiciones,ftem_origen,ftem_personeria,ftem_nombre,ftem_apellido,ftem_cedula,ftem_ruc,
             ftem_direccion,ftem_sitio_web,ftem_contacto,ftem_cargo_persona,ftem_contacto_cargo,ftem_contacto_correo,ftem_contacto_telefono,
             pai_id_ext,ftem_ciudad_ext,ftem_exporta_servicio,ftem_definicion_sector,
             ftem_correo,ftem_telefono,ftem_tipo_pyme,ftem_cedula_file,ftem_ruc_file,ftem_cert_file,ftem_trayectoria,
             ftem_decl_jurada_file,ftem_trayectoria_file,ftem_genero,ftem_raza_etnica,
             ftem_giroprincipal,ftem_vision,ftem_mision,ftem_referencia,ftem_estado,ftem_estado_logico,obj_id,ftem_detalle,
             umar_id,ftem_registro_sanitario_file,ftem_perm_func_mitur_file,ftem_cert_super_compania_file,             
             ftem_cert_obligaciones_file,ftem_razon_social,ftem_imp_renta_file)VALUES
            (:doc_numero,:can_id,:reg_id,:ind_id,:ftem_condiciones,:ftem_origen,:ftem_personeria,:ftem_nombre,:ftem_apellido,:ftem_cedula,:ftem_ruc,
             :ftem_direccion,:ftem_sitio_web,:ftem_contacto,:ftem_cargo_persona,:ftem_contacto_cargo,:ftem_contacto_correo,:ftem_contacto_telefono,
             :pai_id_ext,:ftem_ciudad_ext,:ftem_exporta_servicio,:ftem_definicion_sector,
             :ftem_correo,:ftem_telefono,:ftem_tipo_pyme,:ftem_cedula_file,:ftem_ruc_file,:ftem_cert_file,:ftem_trayectoria,
             :ftem_decl_jurada_file,:ftem_trayectoria_file,:ftem_genero,:ftem_raza_etnica,
             :ftem_giroprincipal,:ftem_vision,:ftem_mision,:ftem_referencia,1,1,:obj_id,:ftem_detalle,:umar_id,
             :ftem_registro_sanitario_file,:ftem_perm_func_mitur_file,:ftem_cert_super_compania_file,             
             :ftem_cert_obligaciones_file,:ftem_razon_social,:ftem_imp_renta_file)";
        //Utilities::putMessageLogFile($sql);
        //PASO 1
        $command = $con->createCommand($sql);
        $command->bindParam(":doc_numero",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":can_id", $data_1[0]['can_id'], PDO::PARAM_INT);
        $command->bindParam(":reg_id", $reg_id, PDO::PARAM_INT);//ID REGISTRO SESION
        $command->bindParam(":ind_id", $data_1[0]['ind_id'], PDO::PARAM_INT);//ID SECTOR       
        $command->bindParam(":ftem_origen", $data_1[0]['ftem_origen'], PDO::PARAM_INT);
        $command->bindParam(":ftem_personeria", $data_1[0]['ftem_personeria'], PDO::PARAM_INT);
        $command->bindParam(":ftem_nombre", $data_1[0]['ftem_nombre'], PDO::PARAM_STR);
        $command->bindParam(":ftem_apellido", $data_1[0]['ftem_apellido'], PDO::PARAM_STR);
        $command->bindParam(":ftem_cedula", $data_1[0]['ftem_cedula'], PDO::PARAM_STR);
        $command->bindParam(":ftem_ruc", $data_1[0]['ftem_ruc'], PDO::PARAM_STR);
        $command->bindParam(":ftem_direccion", $data_1[0]['ftem_direccion'], PDO::PARAM_STR);
        $command->bindParam(":ftem_sitio_web", $data_1[0]['ftem_sitio_web'], PDO::PARAM_STR);
        $command->bindParam(":ftem_contacto", $data_1[0]['ftem_contacto'], PDO::PARAM_STR);
        $command->bindParam(":ftem_cargo_persona", $data_1[0]['ftem_cargo_persona'], PDO::PARAM_STR);  
        $command->bindParam(":ftem_contacto_cargo", $data_1[0]['ftem_contacto_cargo'], PDO::PARAM_STR);
        $command->bindParam(":ftem_contacto_correo", $data_1[0]['ftem_contacto_correo'], PDO::PARAM_STR);
        $command->bindParam(":ftem_contacto_telefono", $data_1[0]['ftem_contacto_telefono'], PDO::PARAM_STR);
        $command->bindParam(":pai_id_ext", $data_1[0]['pai_id_ext'], PDO::PARAM_INT);
        $command->bindParam(":ftem_ciudad_ext", $data_1[0]['ftem_ciudad_ext'], PDO::PARAM_STR);
        $command->bindParam(":ftem_correo", $data_1[0]['ftem_correo'], PDO::PARAM_STR);
        $command->bindParam(":ftem_telefono", $data_1[0]['ftem_telefono'], PDO::PARAM_STR);
        $command->bindParam(":ftem_tipo_pyme", $data_1[0]['ftem_tipo_pyme'], PDO::PARAM_INT);
        $command->bindParam(":ftem_cedula_file", $data_1[0]['ftem_cedula_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_ruc_file", $data_1[0]['ftem_ruc_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_cert_file", $data_1[0]['ftem_cert_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_razon_social", $data_1[0]['ftem_razon_social'], PDO::PARAM_STR);
        $command->bindParam(":ftem_genero", $data_1[0]['ftem_genero'], PDO::PARAM_INT);
        $command->bindParam(":ftem_raza_etnica", $data_1[0]['ftem_raza_etnica'], PDO::PARAM_INT);
        $command->bindParam(":ftem_registro_sanitario_file", $data_1[0]['ftem_registro_sanitario_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_perm_func_mitur_file", $data_1[0]['ftem_perm_func_mitur_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_cert_super_compania_file", $data_1[0]['ftem_cert_super_compania_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_cert_obligaciones_file", $data_1[0]['ftem_cert_obligaciones_file'], PDO::PARAM_STR);
        

        //PASO 2
        $command->bindParam(":ftem_trayectoria_file", $data_2[0]['ftem_trayectoria_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_trayectoria", $data_2[0]['ftem_trayectoria'], PDO::PARAM_STR);
        //$command->bindParam(":ftem_motivo", $data_2[0]['ftem_motivo'], PDO::PARAM_STR);
        $command->bindParam(":ftem_giroprincipal", $data_2[0]['ftem_giroprincipal'], PDO::PARAM_STR);
        $command->bindParam(":ftem_vision", $data_2[0]['ftem_vision'], PDO::PARAM_STR);
        $command->bindParam(":ftem_mision", $data_2[0]['ftem_mision'], PDO::PARAM_STR);//Dato Eliminado
        $command->bindParam(":ftem_referencia", $data_2[0]['ftem_referencia'], PDO::PARAM_STR);
        $command->bindParam(":obj_id", $data_2[0]['obj_id'], PDO::PARAM_INT);
        $command->bindParam(":ftem_detalle", $data_2[0]['ftem_detalle'], PDO::PARAM_STR);
        $command->bindParam(":ftem_imp_renta_file", $data_2[0]['ftem_imp_renta_file'], PDO::PARAM_STR);

        //PASO 3
        $command->bindParam(":ftem_condiciones", $data_3[0]['ftem_condiciones'], PDO::PARAM_INT);//Acepta Condiciones
        $command->bindParam(":ftem_decl_jurada_file", $data_3[0]['ftem_decl_jurada_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_exporta_servicio", $data_3[0]['ftem_exporta_servicio'], PDO::PARAM_STR);
        $command->bindParam(":ftem_definicion_sector", $data_3[0]['ftem_definicion_sector'], PDO::PARAM_STR);
        $command->bindParam(":umar_id", $data_3[0]['umar_id'], PDO::PARAM_INT);
        $command->execute();
    }
    
    private function insertarNivelNacional($con, $dts_nacional,$ftem_id) {
        //Si tiene valores Inserta Datos
        for ($i = 0; $i < sizeof($dts_nacional); $i++) {
            $idPais=Provincia::getPaisID($dts_nacional[$i]);//Envia Datos Provincia
            $sql = "INSERT INTO " . $con->dbname . ".mce_marca_lugar_temp
                    (pai_id,ftem_id,prov_id,mlte_estado_logico)VALUES
                    (:pai_id,:ftem_id,:prov_id,1)";
            $command = $con->createCommand($sql);
            $command->bindParam(":pai_id", $idPais, PDO::PARAM_INT);//ID pais
            $command->bindParam(":ftem_id", $ftem_id, PDO::PARAM_INT);//ID pais
            $command->bindParam(":prov_id", $dts_nacional[$i], PDO::PARAM_INT);//Provincia
            $command->execute();
        }
    }
    private function insertarNivelInternacional($con, $dts,$ftem_id) {
        //Si tiene valores Inserta Datos
        for ($i = 0; $i < sizeof($dts); $i++) {
            $sql = "INSERT INTO " . $con->dbname . ".mce_marca_lugar_temp
                    (pai_id,ftem_id,mlte_estado_logico)VALUES
                    (:pai_id,:ftem_id,1)";
            $command = $con->createCommand($sql);
            $command->bindParam(":pai_id", $dts[$i], PDO::PARAM_INT);//ID pais
            $command->bindParam(":ftem_id", $ftem_id, PDO::PARAM_INT);//ID pais
            $command->execute();
        }
    }
    
    private function insertarOtrosUsosMarca($con,$dts,$ftem_id) {
        for ($i = 0; $i < sizeof($dts); $i++) {
            $sql = "INSERT INTO " . $con->dbname . ".mce_otros_usos_marca_temp
                (ous_id,ftem_id,oumt_estado_logico)VALUES
                (:ous_id,:ftem_id,1)";
            $command = $con->createCommand($sql);
            $command->bindParam(":ous_id", $dts[$i], PDO::PARAM_INT);//ID pais
            $command->bindParam(":ftem_id", $ftem_id, PDO::PARAM_INT);//ID pais
            $command->execute();
        }
    }
    
    private function insertarEventos($con, $data_3, $ftem_id) {
        $sql = "INSERT INTO " . $con->dbname . ".mce_evento_temp
                (ftem_id,etem_nombre,etem_descripcion,etem_referencia,etem_lugar,etem_estado_logico)VALUES
                (:ftem_id,:etem_nombre,:etem_descripcion,:etem_referencia,:etem_lugar,1)";
        $command = $con->createCommand($sql);
        $command->bindParam(":ftem_id", $ftem_id, PDO::PARAM_INT);
        $command->bindParam(":etem_nombre", $data_3[0]['etem_nombre'], PDO::PARAM_STR);
        $command->bindParam(":etem_descripcion", $data_3[0]['etem_descripcion'], PDO::PARAM_STR);
        $command->bindParam(":etem_referencia", $data_3[0]['etem_referencia'], PDO::PARAM_STR);
        $command->bindParam(":etem_lugar", $data_3[0]['etem_lugar'], PDO::PARAM_STR);
        //$command->bindParam(":etem_fecha", $data_3[0]['etem_fecha'], PDO::PARAM_STR);
        $command->execute();
    }
    
    private function insertarProductos($con,$dts,$ftem_id) {
        for ($i = 0; $i < sizeof($dts); $i++) {
            $sql = "INSERT INTO " . $con->dbname . ".mce_producto_temp
            (por_id,ftem_id,ptem_nombre,ptem_foto,ptem_envase,ptem_empaque,ptem_etiqueta,ptem_publicidad,ptem_otros,ptem_detalle_uso,ptem_estado_logico)VALUES
            (:por_id,:ftem_id,:ptem_nombre,:ptem_foto,:ptem_envase,:ptem_empaque,:ptem_etiqueta,:ptem_publicidad,:ptem_otros,:ptem_detalle_uso,1)";
            $command = $con->createCommand($sql);
            $command->bindParam(":por_id", $dts[$i]->pro_porcentaje, PDO::PARAM_INT);
            $command->bindParam(":ftem_id", $ftem_id, PDO::PARAM_INT);
            $command->bindParam(":ptem_nombre", $dts[$i]->pro_nombre, PDO::PARAM_STR);
            $command->bindParam(":ptem_foto", $dts[$i]->pro_foto, PDO::PARAM_STR);
            $command->bindParam(":ptem_detalle_uso", $dts[$i]->pro_detalle_uso, PDO::PARAM_STR);
            $command->bindParam(":ptem_envase", $dts[$i]->pro_envase, PDO::PARAM_INT);
            $command->bindParam(":ptem_empaque", $dts[$i]->pro_empaque, PDO::PARAM_INT);
            $command->bindParam(":ptem_etiqueta", $dts[$i]->pro_etiqueta, PDO::PARAM_INT);
            $command->bindParam(":ptem_publicidad", $dts[$i]->pro_publicidad, PDO::PARAM_INT);
            $command->bindParam(":ptem_otros", $dts[$i]->pro_otros, PDO::PARAM_INT);
            $command->execute();
        }
        
    }
    
    public function getSolicitudTempID($ids){
        $con = \Yii::$app->db;
        $sql = "SELECT A.ftem_id Ids,A.obj_id,A.can_id,A.reg_id,A.ind_id,A.umar_id,A.ftem_origen Origen,A.ftem_personeria Personeria,
                    CONCAT(A.ftem_nombre,' ',A.ftem_apellido) Nombres,A.ftem_nombre Nombre,A.ftem_apellido Apellido,A.ftem_cedula Cedula,A.ftem_ruc Ruc,A.ftem_direccion Direccion,
                    A.ftem_sitio_web Sitio,A.ftem_contacto Contacto,A.ftem_cargo_persona Cargo_Persona,A.ftem_correo Correo,A.ftem_telefono Telefono,
                    A.ftem_tipo_pyme Pyme,A.ftem_cedula_file CedulaFile,A.ftem_ruc_file RucFile,A.ftem_cert_file CertFile,A.ftem_registro_sanitario_file RegSanFile,
                    A.ftem_perm_func_mitur_file PermMinturFile,A.ftem_cert_super_compania_file CertSuperFile,A.ftem_imp_renta_file ImpRentFile,A.ftem_condiciones Condiciones,
                    A.ftem_trayectoria Trayectoria,A.ftem_decl_jurada_file DecLJuradaFile,A.ftem_trayectoria_file TrayectoriaFile,A.ftem_giroprincipal Actividad,
                    A.ftem_vision Vision,A.ftem_mision Mision,A.ftem_referencia Referencia,A.ftem_detalle DetalleObjetivo,A.ftem_estado Estado,A.ftem_fecha_creacion Fecha,
                    A.ftem_fecha_modificacion FechaMod,A.ftem_razon_social RazonSocial,A.ftem_genero Genero,A.ftem_raza_etnica Etnica,A.ftem_contacto_cargo ContactoCargo,
                    A.ftem_contacto_correo ContactoCorreo,A.ftem_contacto_telefono ContactoTelefono,A.ftem_exporta_servicio ExporServicio,A.ftem_definicion_sector DefinicionSector,
                    (SELECT G.prov_id FROM " . $con->dbname . ".canton F   INNER JOIN " . $con->dbname . ".provincia G ON F.prov_id=G.prov_id WHERE F.can_id=A.can_id) prov_id
                FROM " . $con->dbname . ".mce_formulario_temp A
                WHERE A.ftem_estado_logico=1 AND A.ftem_id=:ftem_id";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":ftem_id", $ids, PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    public function getEventoTempID($ids){
        $con = \Yii::$app->db;
        $sql = "SELECT etem_nombre Nombre,etem_descripcion Descripcion,etem_referencia Referencia,etem_lugar Lugar,etem_fecha Fecha
                FROM " . $con->dbname . ".mce_evento_temp WHERE etem_estado_logico=1 AND ftem_id=:ftem_id;";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":ftem_id", $ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    public function getProductoTempID($ids){
        $con = \Yii::$app->db;
        $sql = "SELECT A.ptem_id ProId,A.ftem_id FtemId,A.por_id PorId,A.ptem_nombre Nombre,A.ptem_foto foto,A.ptem_envase,A.ptem_empaque,A.ptem_etiqueta,A.ptem_publicidad,A.ptem_otros,
                    A.ptem_detalle_uso Detalle,B.por_nombre Porcentaje
                    FROM " . $con->dbname . ".mce_producto_temp A
                        INNER JOIN " . $con->dbname . ".mce_porcentaje B
                            ON A.por_id=B.por_id
                  WHERE A.ptem_estado_logico=1 AND A.ftem_id=:ftem_id";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":ftem_id", $ids, PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    public function getMensajesTempID($ids){
        $con = \Yii::$app->db;
        $sql = "SELECT A.corr_id Ids,A.ftem_id,CONCAT(C.per_nombres,' ',C.per_apellidos) Nombres,A.corr_mensaje Mensaje,A.corr_fecha_creacion fecha
                    FROM " . $con->dbname . ".mce_correcion_temp A
                       INNER JOIN " . $con->dbname . ".usuario B ON A.usu_id=B.usu_id
                       INNER JOIN " . $con->dbname . ".persona C ON B.per_id=C.per_id
                   WHERE corr_estado_logico=1 AND A.ftem_id=:ftem_id";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":ftem_id", $ids, PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    public function getOtrosUsosTempID($ids){
        $con = \Yii::$app->db;
        $sql = "SELECT A.ous_id,B.ous_nombre
                    FROM " . $con->dbname . ".mce_otros_usos_marca_temp A
                        INNER JOIN " . $con->dbname . ".mce_otros_usos B
                            ON A.ous_id=B.ous_id
                  WHERE A.oumt_estado_logico=1 AND A.ftem_id=:ftem_id";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":ftem_id", $ids, PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    public function getFilesProducts($ids, $dni){
        $arrPro = $this->consultarProductosTemp($ids);
        //$base_img = Yii::$app->params["documentFolder"];
        $rutaImg = array();
        for($i=0; count($arrPro)>$i; $i++){
            $foto = $arrPro[$i]["Foto"];
            $rutaImg["productos"][] = Yii::$app->basePath . "/uploads/" . $dni . "_" . $ids . "/productos/" . $foto;
            //$rutaImg["productos"][$i] = $base_img . $dni . "_" . $ids . "/productos/" . $foto;
            //http://localhost/mce/site/getimage/?route=/uploads/0924829591_2/ruc.png
        }
        // otros documentos
        //$rutaImg["otros"][] = Yii::$app->basePath . $base_img . "/" . $dni . "_" . $ids . "/" . $foto;
        return $rutaImg;
        
    }
    
    public static function consultarSolicitudTemp(){
        $reg_id=Yii::$app->session->get('PB_idregister', FALSE);
        $con = \Yii::$app->db;
        $sql = "SELECT A.ftem_id Ids,(SELECT MAX(corr_mensaje) FROM mce_base.mce_correcion_temp B WHERE B.ftem_id=A.ftem_id) Observacion,
                    A.ftem_estado Estado,A.ftem_fecha_creacion FechaEnvio,
                    CASE A.umar_id WHEN 1 THEN 'Servicios' WHEN 2 THEN 'Productos' WHEN 3 THEN 'Eventos' ELSE 'Inst. Públicas' END Licencia,
                    (SELECT MAX(R.form_fecha_creacion) FROM mce_base.mce_formulario R WHERE R.ftem_id=A.ftem_id) FechaAuto
                        FROM " . $con->dbname . ".mce_formulario_temp A
                WHERE A.ftem_estado_logico=1 and A.reg_id=:reg_id ORDER BY A.ftem_id DESC";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":reg_id", $reg_id, \PDO::PARAM_INT);//Ubicar el Uusrio Registro para Filtrar su informacion
        $resultData=$comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'sort' => [
                'attributes' => ['Ids', 'Observacion', 'Estado', 'Fecha'],
            ],
        ]);
        //print_r($dataProvider->getModels());
        return $dataProvider;
    }
    public static function getEstadoSolicitud($estado) {
        $mensaje = "";
        switch ($estado) {
            case '0':
                $mensaje = Yii::t("formulario", "IN DEVELOPMENT");
                break;
            case '1':
                $mensaje = Yii::t("formulario", "SENT");
                break;
            case '2':
                $mensaje = Yii::t("formulario", "CORRECTION");
                break;
            case '3':
                $mensaje = Yii::t("formulario", "REJECTED");
                break;
            case '4':
                $mensaje = Yii::t("formulario", "APPROVED");
                break;
            default:
                $mensaje = "";
        }
        return $mensaje;
    }
    
    public function consultarNivelNacionalTemp($ids) {
        $con = \Yii::$app->db;
        $sql = "SELECT mlte_id Ids,pai_id Ids_Pais,prov_id Ids_Provincia
                    FROM " . $con->dbname . ".mce_marca_lugar_temp WHERE ftem_id=:ftem_id AND mlte_estado_logico=1;";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":ftem_id", $ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    public function consultarOtrosUsosMarcaTemp($ids) {
        $con = \Yii::$app->db;
        $sql = "SELECT oumt_id Ids,ous_id OtrosUsos 
            FROM " . $con->dbname . ".mce_otros_usos_marca_temp "
                . " WHERE ftem_id=:ftem_id AND oumt_estado_logico=1;";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":ftem_id", $ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    public function consultarProductosTemp($ids) {
        $con = \Yii::$app->db;
        $sql = "SELECT por_id IdPor,ptem_nombre Nombre,ptem_foto Foto,ptem_envase Envase,ptem_empaque Empaque,
            ptem_etiqueta Etiqueta,ptem_publicidad Publicidad,ptem_otros Otros,ptem_detalle_uso Detalle
            FROM " . $con->dbname . ".mce_producto_temp
           WHERE ftem_id=:ftem_id AND ptem_estado_logico=1 ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":ftem_id", $ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    /* ACTUALIZAR DATOS */
    public function actualizarSolicitud($data) {
        $arroout = array();
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            $data_1 = isset($data['DATA_1']) ? $data['DATA_1'] : array();
            $data_2 = isset($data['DATA_2']) ? $data['DATA_2'] : array();
            $data_3 = isset($data['DATA_3']) ? $data['DATA_3'] : array();     
            $reg_id= Yii::$app->session->get('PB_idregister', FALSE);
            $doc_numero='00001';
            $this->actualizarDataSolicitud($con,$data_1,$data_2,$data_3,$reg_id);
            $ftem_id=$data_1[0]['ftem_id'];//$con->getLastInsertID();//IDS Formulario Temp
            $this->deleteNivelNacInter($con,$ftem_id);
            $this->insertarNivelNacional($con, $data_2[0]['ftem_nivelNacional'],$ftem_id);
            $this->insertarNivelInternacional($con, $data_2[0]['ftem_nivelInternacional'],$ftem_id);
            //Guardar segun el uso de la Marca
            switch ($data_3[0]['umar_id']) {
                case '1':
                    $this->deleteOtrosUsosMarca($con,$ftem_id);
                    $this->insertarOtrosUsosMarca($con, $data_3[0]['ftem_otrosUsos'],$ftem_id);
                    break;
                case '2':
                    $this->deleteProductos($con,$ftem_id);
                    $this->insertarProductos($con,json_decode($data_3[0]['data_producto']),$ftem_id);
                    break;
                case '3':
                    $this->deleteOtrosUsosMarca($con,$ftem_id);
                    $this->deleteEventos($con,$ftem_id);
                    $this->insertarOtrosUsosMarca($con, $data_3[0]['ftem_otrosUsos'],$ftem_id);
                    $this->insertarEventos($con,$data_3,$ftem_id);
                    break;
                case '4':
                    $this->deleteOtrosUsosMarca($con,$ftem_id);
                    $this->insertarOtrosUsosMarca($con, $data_3[0]['ftem_otrosUsos'],$ftem_id);
                    break;
                default:
            }
            $trans->commit();
            $con->close();
            //RETORNA DATOS 
            $arroout["ids"]= $ftem_id;
            $arroout["status"]= true;
            $arroout["secuencial"]= $doc_numero;
            $arroout["cedula"]= $data_1[0]['ftem_cedula'];
            $arroout["accion"]= 'Update';
            return $arroout;
            //return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            throw $e;
            $arroout["status"]= false;
            return $arroout;
            //return false;
        }
    }
    
    private function actualizarDataSolicitud($con,$data_1,$data_2,$data_3,$reg_id) {
        $doc_numero='00001';
        $sql = "UPDATE " . $con->dbname . ".mce_formulario_temp
                    SET can_id = :can_id,ind_id = :ind_id,ftem_origen = :ftem_origen,ftem_personeria = :ftem_personeria,ftem_nombre = :ftem_nombre,
                    ftem_apellido = :ftem_apellido,ftem_cedula = :ftem_cedula,ftem_ruc = :ftem_ruc,ftem_direccion = :ftem_direccion,
                    ftem_sitio_web = :ftem_sitio_web,ftem_contacto = :ftem_contacto,ftem_cargo_persona = :ftem_cargo_persona,
                    ftem_contacto_cargo= :ftem_contacto_cargo,ftem_contacto_correo= :ftem_contacto_correo,ftem_contacto_telefono= :ftem_contacto_telefono,
                    pai_id_ext= :pai_id_ext,ftem_ciudad_ext= :ftem_ciudad_ext,ftem_exporta_servicio= :ftem_exporta_servicio,ftem_definicion_sector= :ftem_definicion_sector,
                    ftem_correo = :ftem_correo,ftem_telefono = :ftem_telefono,ftem_tipo_pyme = :ftem_tipo_pyme,ftem_cedula_file = :ftem_cedula_file,ftem_ruc_file = :ftem_ruc_file,
                    ftem_cert_file = :ftem_cert_file,ftem_trayectoria = :ftem_trayectoria,ftem_decl_jurada_file = :ftem_decl_jurada_file,
                    ftem_trayectoria_file = :ftem_trayectoria_file,ftem_genero= :ftem_genero,ftem_raza_etnica= :ftem_raza_etnica,ftem_giroprincipal = :ftem_giroprincipal,ftem_vision = :ftem_vision,
                    ftem_mision = :ftem_mision,ftem_referencia = :ftem_referencia,obj_id = :obj_id,ftem_detalle = :ftem_detalle,umar_id = :umar_id,ftem_registro_sanitario_file = :ftem_registro_sanitario_file,
                    ftem_perm_func_mitur_file = :ftem_perm_func_mitur_file,ftem_cert_super_compania_file = :ftem_cert_super_compania_file,
                    ftem_cert_obligaciones_file = :ftem_cert_obligaciones_file,ftem_razon_social = :ftem_razon_social,ftem_imp_renta_file = :ftem_imp_renta_file,
                    ftem_fecha_modificacion = CURRENT_TIMESTAMP(),ftem_estado=1
                    WHERE ftem_id=:ftem_id ";     
        //PASO 1
        $command = $con->createCommand($sql);
        $command->bindParam(":ftem_id", $data_1[0]['ftem_id'], PDO::PARAM_INT);//Id Comparacion
        $command->bindParam(":can_id", $data_1[0]['can_id'], PDO::PARAM_INT);
        //$command->bindParam(":reg_id", $reg_id, PDO::PARAM_INT);//ID REGISTRO SESION
        $command->bindParam(":ind_id", $data_1[0]['ind_id'], PDO::PARAM_INT);//ID SECTOR
        $command->bindParam(":ftem_origen", $data_1[0]['ftem_origen'], PDO::PARAM_INT);
        $command->bindParam(":ftem_personeria", $data_1[0]['ftem_personeria'], PDO::PARAM_INT);
        $command->bindParam(":ftem_nombre", $data_1[0]['ftem_nombre'], PDO::PARAM_STR);
        $command->bindParam(":ftem_apellido", $data_1[0]['ftem_apellido'], PDO::PARAM_STR);
        $command->bindParam(":ftem_cedula", $data_1[0]['ftem_cedula'], PDO::PARAM_STR);
        $command->bindParam(":ftem_ruc", $data_1[0]['ftem_ruc'], PDO::PARAM_STR);
        $command->bindParam(":ftem_direccion", $data_1[0]['ftem_direccion'], PDO::PARAM_STR);
        $command->bindParam(":ftem_sitio_web", $data_1[0]['ftem_sitio_web'], PDO::PARAM_STR);
        $command->bindParam(":ftem_contacto", $data_1[0]['ftem_contacto'], PDO::PARAM_STR);
        $command->bindParam(":ftem_cargo_persona", $data_1[0]['ftem_cargo_persona'], PDO::PARAM_STR);  
        $command->bindParam(":ftem_contacto_cargo", $data_1[0]['ftem_contacto_cargo'], PDO::PARAM_STR);
        $command->bindParam(":ftem_contacto_correo", $data_1[0]['ftem_contacto_correo'], PDO::PARAM_STR);
        $command->bindParam(":ftem_contacto_telefono", $data_1[0]['ftem_contacto_telefono'], PDO::PARAM_STR);
        $command->bindParam(":pai_id_ext", $data_1[0]['pai_id_ext'], PDO::PARAM_INT);
        $command->bindParam(":ftem_ciudad_ext", $data_1[0]['ftem_ciudad_ext'], PDO::PARAM_STR);
        $command->bindParam(":ftem_correo", $data_1[0]['ftem_correo'], PDO::PARAM_STR);
        $command->bindParam(":ftem_telefono", $data_1[0]['ftem_telefono'], PDO::PARAM_STR);
        $command->bindParam(":ftem_tipo_pyme", $data_1[0]['ftem_tipo_pyme'], PDO::PARAM_INT);
        $command->bindParam(":ftem_cedula_file", $data_1[0]['ftem_cedula_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_ruc_file", $data_1[0]['ftem_ruc_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_cert_file", $data_1[0]['ftem_cert_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_razon_social", $data_1[0]['ftem_razon_social'], PDO::PARAM_STR);
        $command->bindParam(":ftem_genero", $data_1[0]['ftem_genero'], PDO::PARAM_INT);
        $command->bindParam(":ftem_raza_etnica", $data_1[0]['ftem_raza_etnica'], PDO::PARAM_INT);
        $command->bindParam(":ftem_registro_sanitario_file", $data_1[0]['ftem_registro_sanitario_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_perm_func_mitur_file", $data_1[0]['ftem_perm_func_mitur_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_cert_super_compania_file", $data_1[0]['ftem_cert_super_compania_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_cert_obligaciones_file", $data_1[0]['ftem_cert_obligaciones_file'], PDO::PARAM_STR);
        
        //PASO 2
        $command->bindParam(":obj_id", $data_2[0]['obj_id'], PDO::PARAM_INT);
        $command->bindParam(":ftem_trayectoria", $data_2[0]['ftem_trayectoria'], PDO::PARAM_STR);
        $command->bindParam(":ftem_trayectoria_file", $data_2[0]['ftem_trayectoria_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_giroprincipal", $data_2[0]['ftem_giroprincipal'], PDO::PARAM_STR);
        $command->bindParam(":ftem_vision", $data_2[0]['ftem_vision'], PDO::PARAM_STR);
        $command->bindParam(":ftem_mision", $data_2[0]['ftem_mision'], PDO::PARAM_STR);
        $command->bindParam(":ftem_referencia", $data_2[0]['ftem_referencia'], PDO::PARAM_STR);
        $command->bindParam(":ftem_detalle", $data_2[0]['ftem_detalle'], PDO::PARAM_STR);
        $command->bindParam(":ftem_imp_renta_file", $data_2[0]['ftem_imp_renta_file'], PDO::PARAM_STR);

        //PASO 3
        //$command->bindParam(":ftem_condiciones", $data_3[0]['ftem_condiciones'], PDO::PARAM_INT);//Acepta Condiciones
        $command->bindParam(":umar_id", $data_3[0]['umar_id'], PDO::PARAM_INT);
        $command->bindParam(":ftem_decl_jurada_file", $data_3[0]['ftem_decl_jurada_file'], PDO::PARAM_STR);
        $command->bindParam(":ftem_exporta_servicio", $data_3[0]['ftem_exporta_servicio'], PDO::PARAM_STR);
        $command->bindParam(":ftem_definicion_sector", $data_3[0]['ftem_definicion_sector'], PDO::PARAM_STR);
        $command->execute();

        
    }
    
    private function deleteNivelNacInter($con,$ftem_id) {
        $sql = "DELETE FROM " . $con->dbname . ".mce_marca_lugar_temp WHERE ftem_id=:ftem_id ";
        $command = $con->createCommand($sql);
        $command->bindParam(":ftem_id", $ftem_id, PDO::PARAM_INT);
        $command->execute();
    }
    
    private function deleteOtrosUsosMarca($con,$ftem_id) {
        $sql = "DELETE FROM " . $con->dbname . ".mce_otros_usos_marca_temp WHERE ftem_id=:ftem_id ";
        $command = $con->createCommand($sql);
        $command->bindParam(":ftem_id", $ftem_id, PDO::PARAM_INT);
        $command->execute();
    }
    
    private function deleteProductos($con,$ftem_id) {
        $sql = "DELETE FROM " . $con->dbname . ".mce_producto_temp WHERE ftem_id=:ftem_id ";
        $command = $con->createCommand($sql);
        $command->bindParam(":ftem_id", $ftem_id, PDO::PARAM_INT);
        $command->execute();
    }
    
    private function deleteEventos($con,$ftem_id) {
        $sql = "DELETE FROM " . $con->dbname . ".mce_evento_temp WHERE ftem_id=:ftem_id ";
        $command = $con->createCommand($sql);
        $command->bindParam(":ftem_id", $ftem_id, PDO::PARAM_INT);
        $command->execute();
    }
    
    public static function tamanoEmpresa() {  
        return [
            '1' => Yii::t('formulario', 'Grande: N° Empleados(100 > Superiores)'),
            '2' => Yii::t('formulario', 'Mediana N° Empleados(50 a 99)'),
            '3' => Yii::t('formulario', 'Pequeña: N° Empleados(10 a 49)'),
            '4' => Yii::t('formulario', 'Microempresa: N° Empleados(1 a 9)'),
        ];
    }
    
    public static function tab3UsoMarca() {
        return [
            '1' => Yii::t('formulario', 'Pack'),
            '2' => Yii::t('formulario', 'Packing'),
            '3' => Yii::t('formulario', 'Label'),
            '4' => Yii::t('formulario', 'Publicity'),
            '5' => Yii::t('formulario', 'Others.'),
        ];
    }
    public static function origen() {
        return [
            '0' => Yii::t("formulario", "-Select-"),
            '1' => Yii::t("formulario", "National"),
            '2' => Yii::t("formulario", "Foreign"),
        ];
    }
    public static function genero() {
        return [
            //'0' => Yii::t("formulario", "-Select-"),
            '1' => Yii::t("formulario", "Male"),
            '2' => Yii::t("formulario", "Female"),
            '3' => Yii::t("formulario", "GLBT"),
        ];
    }
    public static function definicionEtnica() {
        return [
            //'0' => Yii::t("formulario", "-Select-"),
            '1' => Yii::t("formulario", "half Blood"),
            '2' => Yii::t("formulario", "Montubio"),
            '3' => Yii::t("formulario", "White"),
            '4' => Yii::t("formulario", "Indigenous"),
            '5' => Yii::t("formulario", "Afro-American"),
        ];
    }

    public static function personeria() {
        return [
            '0' => Yii::t("formulario", "-Select-"),
            '1' => Yii::t("formulario", "Natural"),
            '2' => Yii::t("formulario", "Legal"),
        ];
    }
    
    public static function trayectoriaAnos() {
        $cont = array();
        //for ($i = 0; $i < 100; $i=$i+10) {
        for ($i = 0; $i < 100; $i++) {
            $cont[] = $i;
        }
        return $cont;
    }

    

}
