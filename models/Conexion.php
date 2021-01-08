<?php 

namespace models;

class Conexion
{
    public static $user = "uslhxvoijyjxgvgh";
    public static $pass = "08LVIbtN1rh6LQS0XKQl";
    public static $URL = "mysql:host=b73ic08qv8xvfesxflby-mysql.services.clever-cloud.com;dbname=b73ic08qv8xvfesxflby";

    //public static $user = "root";
    //public static $pass = "";
    //public static $URL = "mysql:host=localhost;dbname=optica_2020";

    public static function conector()
    {
        try {
            return new \PDO(Conexion::$URL, Conexion::$user, Conexion::$pass);
        } catch (\PDOException $e) {
            return null;
        }
    }
}