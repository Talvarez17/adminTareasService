<?php
class Tareas extends Conectar
{


    public function login($correo, $pass) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT id FROM usuarios WHERE `correo` = ? AND `pass` = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $correo);
        $sql->bindValue(2, $pass);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'id' => (int)$resultado->id
        ] : ['id' => 0];
        return $Array;
    }

    function insertarTarea($titulo, $descripcion, $fecha, $estado) {
        $db = parent::Conexion();
        parent::set_names();
        $sql = "INSERT INTO `tareas`( `titulo`, `descripcion`, `fechaVencimiento`, `estado`) VALUES (?,?,?,?)";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $titulo);
        $sql->bindValue(2, $descripcion);
        $sql->bindValue(3, $fecha);
        $sql->bindValue(4, $estado);
        
        $result['status'] = $sql->execute();
        return $result;
    }

    public function getTareas()
    {
        $db = parent::Conexion();
        parent::set_names();
        $sql = "SELECT * FROM tareas" ;
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'id' => (int)$d->id, 'titulo' => $d->titulo,
                'descripcion' => $d->descripcion,'fechaVencimiento' => $d->fechaVencimiento, 'estado' => $d->estado
            ];
        }
        return $Array;
    }

    function getTareaxid($id) {
        $db = parent::Conexion();
        parent::set_names();
        $sql = "SELECT * FROM tareas WHERE id = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
 
  
    
    public function editarTarea($id,$titulo, $descripcion, $fecha, $estado)
    {
        $db = parent::Conexion();
        parent::set_names();
        $sql = "UPDATE `tareas` SET `titulo`='$titulo',`descripcion`='$descripcion',
        `fechaVencimiento`='$fecha',`estado`='$estado' WHERE  `id` = $id;";
        $sql = $db->prepare($sql);
        $resultado['estatus'] = $sql->execute();
        return $resultado;

    }


    public function eliminarTarea($id)
    {
        $db = parent::Conexion();
        parent::set_names();
        $sql = "DELETE FROM `tareas` WHERE id = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $id);

        try {
            $result['status'] = $sql->execute();        
        } catch (PDOException $e) {
            $result['code'] = $e->getCode();
        } finally {
            return $result;
        }
    }



}