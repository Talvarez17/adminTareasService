<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

class Conectar
{
    protected $db;
    protected function Conexion()
    {
        try {
            $NAMEDB = 'adminTareas';
            $HOST = 'localhost';
            $USER = 'root';
            $PASSWORD = '';
            $conectar = $this->db = new PDO("mysql:local=$HOST;dbname=$NAMEDB", "$USER", "$PASSWORD");
            return $conectar;
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function set_names()
    {
        return $this->db->query("SET NAMES 'utf8'");
    }

}
