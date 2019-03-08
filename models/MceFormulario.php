<?php

namespace app\models;

use Yii;
use yii\data\ArrayDataProvider;
use app\models\MceFormularioTemp;

/**
 * This is the model class for table "mce_formulario".
 *
 * @property integer $form_id
 * @property integer $can_id
 * @property integer $reg_id
 * @property integer $ind_id
 * @property integer $form_origen
 * @property integer $form_personeria
 * @property string $form_nombre
 * @property string $form_cedula
 * @property string $form_ruc
 * @property string $form_cargo
 * @property string $form_direccion
 * @property string $form_sitio_web
 * @property string $form_contacto
 * @property string $form_correo
 * @property string $form_telefono
 * @property string $form_cedula_file
 * @property string $form_ruc_file
 * @property string $form_reg_sanitario_file
 * @property string $form_cert_votacion_file
 * @property string $form_trayectoria_file
 * @property string $form_decl_jurada_file
 * @property string $form_motivo
 * @property string $form_giroprincipal
 * @property string $form_vision
 * @property string $form_mision
 * @property string $form_referencia
 * @property integer $form_participa
 * @property string $form_detalle
 * @property integer $form_nacional
 * @property integer $form_extranjero
 * @property integer $form_estado
 * @property string $form_fecha_creacion
 * @property string $form_fecha_modificacion
 * @property integer $form_estado_logico
 *
 * @property Canton $can
 * @property MceRegistro $reg
 * @property MceIndustria $ind
 * @property MceFormularioObjetivo[] $mceFormularioObjetivos
 * @property MceMarcaLugar[] $mceMarcaLugars
 * @property MceMensajes[] $mceMensajes
 * @property MceUsoMarcaFormulario[] $mceUsoMarcaFormularios
 * @property MceVisita[] $mceVisitas
 * 
 * ESTADO DE FORMULARIO
    0=EN ELABORACIÓN
    1=ENVIADO
    2=CORRECCIÓN
    3=RECHAZADO
    4=APROBADO
 * 
 */
class MceFormulario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mce_formulario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['can_id', 'reg_id', 'ind_id', 'form_estado_logico'], 'required'],
            [['can_id', 'reg_id', 'ind_id', 'form_origen', 'form_personeria', 'form_participa', 'form_nacional', 'form_extranjero', 'form_estado', 'form_estado_logico'], 'integer'],
            [['form_motivo', 'form_giroprincipal', 'form_vision', 'form_mision', 'form_referencia', 'form_detalle'], 'string'],
            [['form_fecha_creacion', 'form_fecha_modificacion'], 'safe'],
            [['form_nombre', 'form_cargo', 'form_direccion', 'form_correo'], 'string', 'max' => 60],
            [['form_cedula', 'form_ruc', 'form_telefono'], 'string', 'max' => 15],
            [['form_sitio_web'], 'string', 'max' => 80],
            [['form_contacto', 'form_cedula_file', 'form_ruc_file', 'form_reg_sanitario_file', 'form_cert_votacion_file', 'form_trayectoria_file', 'form_decl_jurada_file'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'form_id' => Yii::t('mce_formulario', 'Form ID'),
            'can_id' => Yii::t('mce_formulario', 'Can ID'),
            'reg_id' => Yii::t('mce_formulario', 'Reg ID'),
            'ind_id' => Yii::t('mce_formulario', 'Ind ID'),
            'form_origen' => Yii::t('mce_formulario', 'Form Origen'),
            'form_personeria' => Yii::t('mce_formulario', 'Form Personeria'),
            'form_nombre' => Yii::t('mce_formulario', 'Form Nombre'),
            'form_cedula' => Yii::t('mce_formulario', 'Form Cedula'),
            'form_ruc' => Yii::t('mce_formulario', 'Form Ruc'),
            'form_cargo' => Yii::t('mce_formulario', 'Form Cargo'),
            'form_direccion' => Yii::t('mce_formulario', 'Form Direccion'),
            'form_sitio_web' => Yii::t('mce_formulario', 'Form Sitio Web'),
            'form_contacto' => Yii::t('mce_formulario', 'Form Contacto'),
            'form_correo' => Yii::t('mce_formulario', 'Form Correo'),
            'form_telefono' => Yii::t('mce_formulario', 'Form Telefono'),
            'form_cedula_file' => Yii::t('mce_formulario', 'Form Cedula File'),
            'form_ruc_file' => Yii::t('mce_formulario', 'Form Ruc File'),
            'form_reg_sanitario_file' => Yii::t('mce_formulario', 'Form Reg Sanitario File'),
            'form_cert_votacion_file' => Yii::t('mce_formulario', 'Form Cert Votacion File'),
            'form_trayectoria_file' => Yii::t('mce_formulario', 'Form Trayectoria File'),
            'form_decl_jurada_file' => Yii::t('mce_formulario', 'Form Decl Jurada File'),
            'form_motivo' => Yii::t('mce_formulario', 'Form Motivo'),
            'form_giroprincipal' => Yii::t('mce_formulario', 'Form Giroprincipal'),
            'form_vision' => Yii::t('mce_formulario', 'Form Vision'),
            'form_mision' => Yii::t('mce_formulario', 'Form Mision'),
            'form_referencia' => Yii::t('mce_formulario', 'Form Referencia'),
            'form_participa' => Yii::t('mce_formulario', 'Form Participa'),
            'form_detalle' => Yii::t('mce_formulario', 'Form Detalle'),
            'form_nacional' => Yii::t('mce_formulario', 'Form Nacional'),
            'form_extranjero' => Yii::t('mce_formulario', 'Form Extranjero'),
            'form_estado' => Yii::t('mce_formulario', 'Form Estado'),
            'form_fecha_creacion' => Yii::t('mce_formulario', 'Form Fecha Creacion'),
            'form_fecha_modificacion' => Yii::t('mce_formulario', 'Form Fecha Modificacion'),
            'form_estado_logico' => Yii::t('mce_formulario', 'Form Estado Logico'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCan()
    {
        return $this->hasOne(Canton::className(), ['can_id' => 'can_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReg()
    {
        return $this->hasOne(MceRegistro::className(), ['reg_id' => 'reg_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInd()
    {
        return $this->hasOne(MceIndustria::className(), ['ind_id' => 'ind_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceFormularioObjetivos()
    {
        return $this->hasMany(MceFormularioObjetivo::className(), ['form_id' => 'form_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceMarcaLugars()
    {
        return $this->hasMany(MceMarcaLugar::className(), ['form_id' => 'form_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceMensajes()
    {
        return $this->hasMany(MceMensajes::className(), ['form_id' => 'form_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceUsoMarcaFormularios()
    {
        return $this->hasMany(MceUsoMarcaFormulario::className(), ['form_id' => 'form_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMceVisitas()
    {
        return $this->hasMany(MceVisita::className(), ['form_id' => 'form_id']);
    }
    
    public static function consultarSolicitudTemp($data){
        $con = \Yii::$app->db;
        /*$valor = isset($data['valor']) ? $data['valor'] : "";
        if ($valor <> '') {
            //Patron de Busqueda
            // http://www.mclibre.org/consultar/php/lecciones/php_expresiones_regulares.html 
            $patron = "/^[[:digit:]]+$/"; //Los patrones deben empezar y acabar con el carácter / (barra).
            if (preg_match($patron, $valor)) {
                $op = "CED"; //La cadena son sólo números.
            } else {
                $op = "NOM"; //La cadena son Alfanumericos.
                //Las separa en un array 
                $aux = explode(" ", $valor);
                $condicion = " ";
                for ($i = 0; $i < count($aux); $i++) {
                    //Crea la Sentencia de Busqueda
                    $condicion .=" AND (A.ftem_nombre LIKE '%$aux[$i]%' OR A.ftem_apellido LIKE '%$aux[$i]%' OR A.ftem_razon_social LIKE '%$aux[$i]%' ) ";
                }
            }
        }*/

        $sql = "SELECT A.ftem_id Ids,CONCAT(D.per_nombres,' ',D.per_apellidos) Cuenta,A.ftem_origen Origen,A.ftem_personeria Personeria,A.ftem_cedula,
                CASE A.ftem_personeria WHEN 1 THEN CONCAT(A.ftem_nombre,' ',A.ftem_apellido) ELSE A.ftem_razon_social END Nombres,
                A.ftem_estado Estado,A.ftem_fecha_creacion F_Creado,A.ftem_fecha_modificacion F_Modificado,B.ind_giro Sector,
                CASE A.umar_id WHEN 1 THEN 'Servicios' WHEN 2 THEN 'Productos' WHEN 3 THEN 'Eventos' ELSE 'Inst. Públicas' END Licencia,
                (SELECT MAX(R.form_fecha_creacion) FROM " . $con->dbname . ".mce_formulario R WHERE R.ftem_id=A.ftem_id) FechaAuto
                FROM " . $con->dbname . ".mce_formulario_temp A
                      INNER JOIN (" . $con->dbname . ".mce_registro E
                          INNER JOIN (" . $con->dbname . ".usuario C
                              INNER JOIN " . $con->dbname . ".persona D
                                 ON C.per_id=D.per_id)
                            ON E.usu_id=C.usu_id)
                        ON A.reg_id=E.reg_id
                      INNER JOIN " . $con->dbname . ".mce_industria B
                          ON A.ind_id=B.ind_id
                WHERE A.ftem_estado_logico=1 ";
        
        $sql .= ($data['estado'] > -1) ? "AND A.ftem_estado = :ftem_estado  " : "";
        $sql .= ($data['licencia'] > 0) ? "AND A.umar_id = :umar_id  " : "";
        $sql .= ($data['valor'] <>'') ? "AND A.ftem_cedula like :ftem_cedula  " : "";
        $sql .= ($data['f_ini']<>'' && $data['f_fin']<>'' ) ? "AND DATE(A.ftem_fecha_creacion) BETWEEN :f_ini AND :f_fin " : " ";
        
        /*switch ($op) {
            case 'CED':
                $sql .=" AND A.ftem_cedula LIKE '%$valor%' ";
                break;
            case 'NOM':
                $sql .=$condicion;
                break;
            default:
        }*/
        
        $sql .= "ORDER BY A.ftem_id ASC ";
        
        //Utilities::putMessageLogFile($sql);
        $comando = $con->createCommand($sql);
        
        if($data['estado'] > -1){
            $comando->bindParam(":ftem_estado", $data['estado'], \PDO::PARAM_STR);
        }
        if($data['licencia'] > 0){
            $comando->bindParam(":umar_id", $data['licencia'], \PDO::PARAM_STR);
        }
        if($data['valor']<>''){
            $comando->bindParam(":ftem_cedula", $data['valor'], \PDO::PARAM_STR);
        }
        if($data['f_ini']<>'' && $data['f_fin']<>''){
            $comando->bindParam(":f_ini",date("Y-m-d", strtotime($data['f_ini'])), \PDO::PARAM_STR);
            $comando->bindParam(":f_fin",date("Y-m-d", strtotime($data['f_fin'])), \PDO::PARAM_STR);
        }
        $resultData=$comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                //'attributes' => ['Ids','Cuenta', 'Origen','Personeria','Nombres','Estado', 'F_Creado', 'F_Modificado','Sector','Licencia'],
                'attributes' => ['Nombres'],
            ],
        ]);
        //Utilities::putMessageLogFile($dataProvider);
        //print_r($dataProvider->getModels());
        return $dataProvider;
    }
    
    public static function consultarSolicitud($data){
        $con = \Yii::$app->db;
        $sql = "SELECT A.ftem_id IdsSolicitud,IF(A.ftem_origen=1,'Nacional','Extranjero') Origen,IF(A.ftem_personeria=1,'Natural','Jurídica') Personeria,CONCAT('\'',A.ftem_cedula) ftem_cedula,
            CASE A.ftem_personeria WHEN 1 THEN CONCAT(A.ftem_nombre,' ',A.ftem_apellido) ELSE A.ftem_razon_social END Nombres,
            (SELECT F.umar_nombre FROM " . $con->dbname . ".mce_uso_marca F where F.umar_id=A.umar_id) TipoLicencia,B.ind_giro GiroNegocio,(SELECT MAX(IFNULL(F.ptem_nombre,'')) FROM " . $con->dbname . ".mce_producto_temp F WHERE F.ftem_id=A.ftem_id) ProductoNombre,
            CONCAT('\'',A.ftem_ruc) Ruc,A.ftem_cargo_persona Cargo,A.ftem_direccion Direccion,(SELECT CONCAT(G.prov_nombre,'-',F.can_nombre) CantoProvincia FROM " . $con->dbname . ".canton F   INNER JOIN " . $con->dbname . ".provincia G ON F.prov_id=G.prov_id WHERE F.can_id=A.can_id) Provincia,
            CONCAT('\'',A.ftem_telefono) Telelfono,A.ftem_correo Email,A.ftem_sitio_web PaginaWeb,A.ftem_contacto Contacto,A.ftem_contacto_cargo ContactoCargo,CONCAT('\'',A.ftem_contacto_telefono) ContactoTelefono,A.ftem_contacto_correo ContactoCorreo,
            CASE A.ftem_tipo_pyme WHEN 1 THEN 'Grande: N° Empleados(100 > Superiores)' WHEN 2 THEN 'Mediana N° Empleados(50 a 99)' WHEN 3 THEN 'Pequeña: N° Empleados(10 a 49)' ELSE 'Microempresa: N° Empleados(1 a 9)' END  EmpresaTamano,
            CASE A.ftem_estado WHEN 1 THEN 'Enviado' WHEN 2 THEN 'Corrección' WHEN 3 THEN 'Rechazado' WHEN 4 THEN 'Aprobado' END   Estado,A.ftem_fecha_creacion F_Envio,
            (SELECT MAX(R.form_fecha_creacion) FROM " . $con->dbname . ".mce_formulario R WHERE R.ftem_id=A.ftem_id) FechaAuto,IF(A.ftem_condiciones=1,'SI','NO') DeclaracionJurada
                    FROM " . $con->dbname . ".mce_formulario_temp A
                          INNER JOIN (" . $con->dbname . ".mce_registro E
                              INNER JOIN (" . $con->dbname . ".usuario C
                                  INNER JOIN " . $con->dbname . ".persona D
                                     ON C.per_id=D.per_id)
                                ON E.usu_id=C.usu_id)
                            ON A.reg_id=E.reg_id
                          INNER JOIN " . $con->dbname . ".mce_industria B
                              ON A.ind_id=B.ind_id
                    WHERE A.ftem_estado_logico=1 ";
        
        $sql .= ($data['estado'] > -1) ? "AND A.ftem_estado = :ftem_estado  " : "";
        $sql .= ($data['licencia'] > 0) ? "AND A.umar_id = :umar_id  " : "";
        $sql .= ($data['valor'] <>'') ? "AND A.ftem_cedula = :ftem_cedula  " : "";
        $sql .= ($data['f_ini']<>'' && $data['f_fin']<>'' ) ? "AND DATE(A.ftem_fecha_creacion) BETWEEN :f_ini AND :f_fin " : " ";
        $sql .= "ORDER BY A.ftem_id DESC ";

        $comando = $con->createCommand($sql);
        
        if($data['estado'] > -1){
            $comando->bindParam(":ftem_estado", $data['estado'], \PDO::PARAM_STR);
        }
        if($data['licencia'] > 0){
            $comando->bindParam(":umar_id", $data['licencia'], \PDO::PARAM_STR);
        }
        if($data['valor']<>''){
            $comando->bindParam(":ftem_cedula", $data['valor'], \PDO::PARAM_STR);
        }
        if($data['f_ini']<>'' && $data['f_fin']<>''){
            $comando->bindParam(":f_ini",date("Y-m-d", strtotime($data['f_ini'])), \PDO::PARAM_STR);
            $comando->bindParam(":f_fin",date("Y-m-d", strtotime($data['f_fin'])), \PDO::PARAM_STR);
        }
        $resultData=$comando->queryAll();
        return $resultData;
    }
    
    
    public static function rechazarSolicitud($data) {
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            $ids = isset($data['ids']) ? base64_decode($data['ids']) :NULL;
            $sql = "UPDATE " . $con->dbname . ".mce_formulario_temp SET ftem_estado=3 WHERE ftem_id=:ftem_id";
            $command = $con->createCommand($sql);
            $command->bindParam(":ftem_id", $ids, \PDO::PARAM_INT);
            $command->execute();
            $trans->commit();
            $con->close();
            return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            return false;
        }
    }
    
    private function getSolicitudTemp($con,$ids){
        $sql = "SELECT * FROM " . $con->dbname . ".mce_formulario_temp WHERE ftem_estado_logico=1 AND ftem_id=:ftem_id;";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":ftem_id", $ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }

    
    public function autorizarSolicitud($data) {
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        $soliTemp = new MceFormularioTemp();
        try {
            $ids = isset($data['ids']) ? base64_decode($data['ids']) : NULL;
            $usu_id = Yii::$app->session->get('PB_iduser', FALSE); //Usuario Autoriza
            //Consulta Datos
            $data_1 = $this->getSolicitudTemp($con, $ids); 
            $this->insertarDataSolicitud($con, $data_1, $usu_id);
            $form_id = $con->getLastInsertID(); //IDS Formulario 
            $this->insertarNivelNacional($con,$soliTemp->consultarNivelNacionalTemp($ids), $form_id);
            switch ($data_1[0]['umar_id']) {
                case '1':
                    $this->insertarOtrosUsosMarca($con,$soliTemp->consultarOtrosUsosMarcaTemp($ids),$form_id);
                    break;
                case '2':
                    $this->insertarProductos($con,$soliTemp->consultarProductosTemp($ids),$form_id);
                    break;
                case '3':
                    $this->insertarOtrosUsosMarca($con,$soliTemp->consultarOtrosUsosMarcaTemp($ids),$form_id);
                    $this->insertarEventos($con,$soliTemp->getEventoTempID($ids),$form_id);
                    break;
                case '4':
                    $this->insertarOtrosUsosMarca($con,$soliTemp->consultarOtrosUsosMarcaTemp($ids),$form_id);
                    break;
                default:
            }
            $this->actAutoriza($con, $ids);//Actualiza la Tabla Temporal
            $trans->commit();
            $con->close();
            return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            return false;
        }
    }

    private function insertarDataSolicitud($con,$data_1,$usu_id) {
        $doc_numero='00001';
        $sql = "INSERT INTO " . $con->dbname . ".mce_formulario
            (doc_numero,obj_id,can_id,reg_id,ind_id,form_condiciones,umar_id,form_origen,form_personeria,form_nombre,form_apellido,form_cedula,form_ruc,
             form_direccion,form_sitio_web,form_contacto,form_cargo_persona,form_contacto_cargo,form_contacto_correo,form_contacto_telefono,pai_id_ext,form_ciudad_ext,
             form_exporta_servicio,form_definicion_sector,form_correo,form_telefono,form_genero,form_raza_etnica,form_tipo_pyme,
             form_cedula_file,form_ruc_file,form_trayectoria,form_cert_votacion_file,form_trayectoria_file,form_decl_jurada_file,
             form_giroprincipal,form_vision,form_mision,form_referencia,form_detalle,form_registro_sanitario_file,form_perm_func_mitur_file,             
             form_cert_super_compania_file,form_imp_renta_file,form_cert_obligaciones_file,form_razon_social,
             form_estado,form_fecha_envio,form_estado_logico,ftem_id,usu_id)VALUES
            (:doc_numero,:obj_id,:can_id,:reg_id,:ind_id,:form_condiciones,:umar_id,:form_origen,:form_personeria,:form_nombre,:form_apellido,:form_cedula,:form_ruc,
             :form_direccion,:form_sitio_web,:form_contacto,:form_cargo_persona,:form_contacto_cargo,:form_contacto_correo,:form_contacto_telefono,:pai_id_ext,:form_ciudad_ext,
             :form_exporta_servicio,:form_definicion_sector,:form_correo,:form_telefono,:form_genero,:form_raza_etnica,:form_tipo_pyme,
             :form_cedula_file,:form_ruc_file,:form_trayectoria,:form_cert_votacion_file,:form_trayectoria_file,:form_decl_jurada_file,
             :form_giroprincipal,:form_vision,:form_mision,:form_referencia,:form_detalle,:form_registro_sanitario_file,:form_perm_func_mitur_file,             
             :form_cert_super_compania_file,:form_imp_renta_file,:form_cert_obligaciones_file,:form_razon_social,
             4,:form_fecha_envio,1,:ftem_id,:usu_id)";

        //PASO 1
        $command = $con->createCommand($sql);
        $command->bindParam(":doc_numero",$doc_numero, \PDO::PARAM_STR);
        $command->bindParam(":ftem_id", $data_1[0]['ftem_id'], \PDO::PARAM_INT);        
        $command->bindParam(":usu_id", $usu_id, \PDO::PARAM_INT);//ID REGISTRO SESION
        $command->bindParam(":can_id", $data_1[0]['can_id'], \PDO::PARAM_INT);
        $command->bindParam(":reg_id", $data_1[0]['reg_id'], \PDO::PARAM_INT);//ID REGISTRO SESION
        $command->bindParam(":ind_id", $data_1[0]['ind_id'], \PDO::PARAM_INT);//ID SECTOR        
        $command->bindParam(":form_origen", $data_1[0]['ftem_origen'], \PDO::PARAM_INT);
        $command->bindParam(":form_personeria", $data_1[0]['ftem_personeria'], \PDO::PARAM_INT);
        $command->bindParam(":form_nombre", $data_1[0]['ftem_nombre'], \PDO::PARAM_STR);
        $command->bindParam(":form_apellido", $data_1[0]['ftem_apellido'], \PDO::PARAM_STR);
        $command->bindParam(":form_cedula", $data_1[0]['ftem_cedula'], \PDO::PARAM_STR);
        $command->bindParam(":form_ruc", $data_1[0]['ftem_ruc'], \PDO::PARAM_STR);
        $command->bindParam(":form_direccion", $data_1[0]['ftem_direccion'], \PDO::PARAM_STR);
        $command->bindParam(":form_sitio_web", $data_1[0]['ftem_sitio_web'], \PDO::PARAM_STR);
        $command->bindParam(":form_contacto", $data_1[0]['ftem_contacto'], \PDO::PARAM_STR);
        $command->bindParam(":form_cargo_persona", $data_1[0]['ftem_cargo_persona'], \PDO::PARAM_STR);
        $command->bindParam(":form_contacto_cargo", $data_1[0]['ftem_contacto_cargo'], \PDO::PARAM_STR);
        $command->bindParam(":form_contacto_correo", $data_1[0]['ftem_contacto_correo'], \PDO::PARAM_STR);
        $command->bindParam(":form_contacto_telefono", $data_1[0]['ftem_contacto_telefono'], \PDO::PARAM_STR);
        $command->bindParam(":pai_id_ext", $data_1[0]['pai_id_ext'], \PDO::PARAM_INT);
        $command->bindParam(":form_ciudad_ext", $data_1[0]['ftem_ciudad_ext'], \PDO::PARAM_STR);
        $command->bindParam(":form_correo", $data_1[0]['ftem_correo'], \PDO::PARAM_STR);
        $command->bindParam(":form_telefono", $data_1[0]['ftem_telefono'], \PDO::PARAM_STR);
        $command->bindParam(":form_tipo_pyme", $data_1[0]['ftem_tipo_pyme'], \PDO::PARAM_INT);
        $command->bindParam(":form_cedula_file", $data_1[0]['ftem_cedula_file'], \PDO::PARAM_STR);
        $command->bindParam(":form_ruc_file", $data_1[0]['ftem_ruc_file'], \PDO::PARAM_STR);
        $command->bindParam(":form_cert_votacion_file", $data_1[0]['ftem_cert_file'], \PDO::PARAM_STR);
        $command->bindParam(":form_razon_social", $data_1[0]['ftem_razon_social'], \PDO::PARAM_STR);
        $command->bindParam(":form_genero", $data_1[0]['ftem_genero'], \PDO::PARAM_INT);
        $command->bindParam(":form_raza_etnica", $data_1[0]['ftem_raza_etnica'], \PDO::PARAM_INT);
        $command->bindParam(":form_registro_sanitario_file", $data_1[0]['ftem_registro_sanitario_file'], \PDO::PARAM_STR);
        $command->bindParam(":form_perm_func_mitur_file", $data_1[0]['ftem_perm_func_mitur_file'], \PDO::PARAM_STR);
        $command->bindParam(":form_cert_super_compania_file", $data_1[0]['ftem_cert_super_compania_file'], \PDO::PARAM_STR);
        $command->bindParam(":form_cert_obligaciones_file", $data_1[0]['ftem_cert_obligaciones_file'], \PDO::PARAM_STR);
        
        //PASO 2
        $command->bindParam(":form_trayectoria_file", $data_1[0]['ftem_trayectoria_file'], \PDO::PARAM_STR);
        $command->bindParam(":form_trayectoria", $data_1[0]['ftem_trayectoria'], \PDO::PARAM_STR);
        $command->bindParam(":form_giroprincipal", $data_1[0]['ftem_giroprincipal'], \PDO::PARAM_STR);
        $command->bindParam(":form_vision", $data_1[0]['ftem_vision'], \PDO::PARAM_STR);
        $command->bindParam(":form_mision", $data_1[0]['ftem_mision'], \PDO::PARAM_STR);
        $command->bindParam(":form_referencia", $data_1[0]['ftem_referencia'], \PDO::PARAM_STR);
        $command->bindParam(":obj_id", $data_1[0]['obj_id'], \PDO::PARAM_INT);
        $command->bindParam(":form_detalle", $data_1[0]['ftem_detalle'], \PDO::PARAM_STR);
        $command->bindParam(":form_imp_renta_file", $data_1[0]['ftem_imp_renta_file'], \PDO::PARAM_STR);

        //PASO 3
        $command->bindParam(":form_condiciones", $data_1[0]['ftem_condiciones'], \PDO::PARAM_INT);//Acepta Condiciones
        $command->bindParam(":form_decl_jurada_file", $data_1[0]['ftem_decl_jurada_file'], \PDO::PARAM_STR);
        $command->bindParam(":form_exporta_servicio", $data_1[0]['ftem_exporta_servicio'], \PDO::PARAM_STR);
        $command->bindParam(":form_definicion_sector", $data_1[0]['ftem_definicion_sector'], \PDO::PARAM_STR);
        $command->bindParam(":form_fecha_envio", $data_1[0]['ftem_fecha_envio'], \PDO::PARAM_STR);
        $command->bindParam(":umar_id", $data_1[0]['umar_id'], \PDO::PARAM_INT);
        
        $command->execute();
    }
    
    private function insertarNivelNacional($con, $dts,$form_id) {
        for ($i = 0; $i < sizeof($dts); $i++) {
            $sql = "INSERT INTO " . $con->dbname . ".mce_marca_lugar
                    (pai_id,form_id,prov_id,mlu_estado_logico)VALUES
                    (:pai_id,:form_id,:prov_id,1)";
            $command = $con->createCommand($sql);
            $command->bindParam(":pai_id", $dts[$i]['Ids_Pais'], \PDO::PARAM_INT);//ID pais
            $command->bindParam(":form_id", $form_id, \PDO::PARAM_INT);//ID pais
            $command->bindParam(":prov_id", isset($dts[$i]['Ids_Provincia'])?$dts[$i]['Ids_Provincia']:0, \PDO::PARAM_INT);//Provincia
            $command->execute();
        }
    }
    
    private function insertarOtrosUsosMarca($con,$dts,$form_id) { 
        for ($i = 0; $i < sizeof($dts); $i++) {
            $sql = "INSERT INTO " . $con->dbname . ".mce_otros_usos_marca
                (ous_id,form_id,ouma_estado_logico)VALUES
                (:ous_id,:form_id,1)";
            $command = $con->createCommand($sql);
            $command->bindParam(":ous_id", $dts[$i]['OtrosUsos'], \PDO::PARAM_INT);//ID pais
            $command->bindParam(":form_id", $form_id, \PDO::PARAM_INT);//ID pais
            $command->execute();
        }
    }
    
    private function insertarProductos($con,$dts,$form_id) {
        for ($i = 0; $i < sizeof($dts); $i++) {
            $sql = "INSERT INTO " . $con->dbname . ".mce_producto
            (por_id,form_id,pro_nombre,pro_foto,pro_envase,pro_empaque,pro_etiqueta,pro_publicidad,pro_otros,pro_detalle_uso,pro_estado_logico)VALUES
            (:por_id,:form_id,:pro_nombre,:pro_foto,:pro_envase,:pro_empaque,:pro_etiqueta,:pro_publicidad,:pro_otros,:pro_detalle_uso,1)";
            $command = $con->createCommand($sql);
            $command->bindParam(":por_id", $dts[$i]['IdPor'], \PDO::PARAM_INT);
            $command->bindParam(":form_id", $form_id, \PDO::PARAM_INT);
            $command->bindParam(":pro_nombre", $dts[$i]['Nombre'], \PDO::PARAM_STR);
            $command->bindParam(":pro_foto", $dts[$i]['Foto'], \PDO::PARAM_STR);
            $command->bindParam(":pro_detalle_uso", $dts[$i]['Detalle'], \PDO::PARAM_STR);
            $command->bindParam(":pro_envase", $dts[$i]['Envase'], \PDO::PARAM_INT);
            $command->bindParam(":pro_empaque", $dts[$i]['Empaque'], \PDO::PARAM_INT);
            $command->bindParam(":pro_etiqueta", $dts[$i]['Etiqueta'], \PDO::PARAM_INT);
            $command->bindParam(":pro_publicidad", $dts[$i]['Publicidad'], \PDO::PARAM_INT);
            $command->bindParam(":pro_otros", $dts[$i]['Otros'], \PDO::PARAM_INT);
            $command->execute();
        } 
    }
    
    private function insertarEventos($con, $dts, $form_id) {
        $sql = "INSERT INTO " . $con->dbname . ".mce_evento
                (form_id,eve_nombre,eve_descripcion,eve_referencia,eve_lugar,eve_estado_logico)VALUES
                (:form_id,:eve_nombre,:eve_descripcion,:eve_referencia,:eve_lugar,1)";
        $command = $con->createCommand($sql);
        $command->bindParam(":form_id", $form_id, \PDO::PARAM_INT);
        $command->bindParam(":eve_nombre", $dts[0]['Nombre'], \PDO::PARAM_STR);
        $command->bindParam(":eve_descripcion", $dts[0]['Descripcion'], \PDO::PARAM_STR);
        $command->bindParam(":eve_referencia", $dts[0]['Referencia'], \PDO::PARAM_STR);
        $command->bindParam(":eve_lugar", $dts[0]['Lugar'], \PDO::PARAM_STR);
        //$command->bindParam(":eve_fecha", $dts[0]['Fecha'], \PDO::PARAM_STR);
        $command->execute();
    }
    
    private function actAutoriza($con, $ids) {
        $sql = "UPDATE " . $con->dbname . ".mce_formulario_temp SET ftem_estado=4 WHERE ftem_id=:ftem_id";
        $command = $con->createCommand($sql);
        $command->bindParam(":ftem_id", $ids, \PDO::PARAM_INT);
        $command->execute();
    }
    
    public function sendMenssage($data) {
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        $soliTemp = new MceFormularioTemp();
        try {
            $ids = isset($data['ids']) ? $data['ids'] : NULL;
            $message = isset($data['message']) ? $data['message'] : NULL;
            $usu_id = Yii::$app->session->get('PB_iduser', FALSE); //Usuario Autoriza            
            $sql = "INSERT INTO  " . $con->dbname . ".mce_correcion_temp
                    (usu_id,ftem_id,corr_mensaje,corr_estado_logico)VALUES
                    (:usu_id,:ftem_id,:corr_mensaje,1) ";
            $command = $con->createCommand($sql);
            $command->bindParam(":usu_id", $usu_id, \PDO::PARAM_INT);
            $command->bindParam(":ftem_id", $ids, \PDO::PARAM_INT);
            $command->bindParam(":corr_mensaje", $message, \PDO::PARAM_STR);
            $command->execute();
            
            //Actualiza el Estado en Formulario
            $sql = "UPDATE " . $con->dbname . ".mce_formulario_temp SET ftem_estado=2 WHERE ftem_id=:ftem_id";
            $command = $con->createCommand($sql);
            $command->bindParam(":ftem_id", $ids, \PDO::PARAM_INT);
            $command->execute();
            
            $trans->commit();
            $con->close();
            return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            return false;
        }
    }
    
    public static function eliminarMenssage($ids) {
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            $sql = "UPDATE " . $con->dbname . ".mce_correcion_temp SET corr_estado_logico=0 WHERE corr_id=:corr_id";
            $command = $con->createCommand($sql);
            $command->bindParam(":corr_id", $ids, \PDO::PARAM_INT);
            $command->execute();
            $trans->commit();
            $con->close();
            return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            return false;
        }
    }
    
    public static function retornarPersona($valor, $op) {
        $con = \Yii::$app->db;
        $rawData = array();
        //Patron de Busqueda
        /* http://www.mclibre.org/consultar/php/lecciones/php_expresiones_regulares.html */
        $patron = "/^[[:digit:]]+$/"; //Los patrones deben empezar y acabar con el carácter / (barra).
        if (preg_match($patron, $valor)) {
            $op = "CED"; //La cadena son sólo números.
        } else {
            $op = "NOM"; //La cadena son Alfanumericos.
            //Las separa en un array 
            $aux = explode(" ", $valor);
            $condicion = " ";
            for ($i = 0; $i < count($aux); $i++) {
                //Crea la Sentencia de Busqueda
                $condicion .=" AND (A.ftem_nombre LIKE '%$aux[$i]%' OR A.ftem_apellido LIKE '%$aux[$i]%' OR A.ftem_razon_social LIKE '%$aux[$i]%' ) ";
            }
        }
        $sql = "SELECT A.ftem_cedula Cedula,CASE A.ftem_personeria WHEN 1 THEN CONCAT(A.ftem_nombre,' ',A.ftem_apellido) ELSE A.ftem_razon_social END RazonSocial
                    FROM " . $con->dbname . ".mce_formulario_temp A
                  WHERE A.ftem_estado_logico=1 ";

        switch ($op) {
            case 'CED':
                $sql .=" AND A.ftem_cedula LIKE '%$valor%' ";
                break;
            case 'NOM':
                $sql .=$condicion;
                break;
            default:
        }
        $sql .= " GROUP BY A.ftem_cedula ";
        $sql .= " LIMIT " . Yii::$app->params["limitRow"];
        //Utilities::putMessageLogFile($sql);
        $comando = $con->createCommand($sql);
        //$comando->bindParam(":valor", $ids, \PDO::PARAM_STR);
        return $comando->queryAll();
    }

}
