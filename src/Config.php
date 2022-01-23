<?php

namespace App;

class Config
{

    public static function getDsnByXML(string $nameFile="../config.xml"){
        $xml = simplexml_load_file($nameFile);
        return $xml->dsn;
    }

    public static  function getDsnByJSON(string $nameFile="../config.json"){
        $dsn = file_get_contents($nameFile);
        $conf = json_decode($dsn, true);
        var_dump($conf);
        return $conf["dsn"];
    }

    public static function getDsnByIni(string $nameFile="../config.ini"){
        $contenido = parse_ini_file($nameFile, true);
        $contenidoDSN = $contenido["DSN"];
        $dsn = "mysql:host=".$contenidoDSN["host"]."; dbname=".$contenidoDSN["dbname"]."; user=".$contenidoDSN["user"]."; password=".$contenidoDSN["password"];
        var_dump($dsn);
        return $dsn;
    }

    public static function getDsnByYaml(string $nameFile="../config.yml")
    {
        var_dump(yaml_parse($nameFile));
//        var_dump(yaml_parse_file($nameFile));
//        $dsn = yaml_parse_file($nameFile, -1);
//        var_dump($dsn);
    }
}