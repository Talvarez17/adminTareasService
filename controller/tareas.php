<?php
require_once("../config/conexion.php");
require_once("../models/tareasModel.php");
$tareas = new Tareas();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "getAll":
        $datos = $tareas->getTareas();
        echo json_encode($datos);
        break;

    case "getId":
        $datos = $tareas->getTareaxid($body["id"]);
        echo json_encode($datos);
        break;

    case "insert":
        $datos = $tareas->insertarTarea($body["titulo"], $body["descripcion"], $body["fecha"], $body["estado"]);
        echo json_encode($datos);
        break;

    case "update":
        $datos = $tareas->editarTarea($body["id"], $body["titulo"], $body["descripcion"], $body["fecha"], $body["estado"]);
        echo json_encode($datos);
        break;

    case "delete":
        $datos = $tareas->eliminarTarea($body["id"]);
        echo json_encode($datos);
        break;

    case "login":
        $datos = $tareas->login($body["correo"],$body["pass"]);
        echo json_encode($datos);
        break;
}
