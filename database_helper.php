<?php

class database_helper
{
    private static $msi;
    private static $usecount = 0;
    function __construct()
    {
        if (!isset(self::$msi) || self::$msi===false) {
            self::$msi = new mysqli(
                'localhost',
                'smak',
                'qwerty',
                'web-prog',
                3306
            );
            if (!self::$msi || self::$msi->connect_errno) {
                throw new Exception('Ошибка подключения к базе данных');
            }
            self::$usecount++;
        }
    }

    public function __destruct()
    {
        self::$usecount--;
        if (self::$usecount===0) {
            try {
                self::$msi->close();
            } catch (Exception $e) {
            }
        }
    }

    public function execute_query($sql){
        $res = self::$msi->query($sql);
        if ($res){
            $obj = $res->fetch_all();
            $res->free_result();
            return $obj;
        }
        return false;
    }

    public function execute_param_query($sql){
        $anum = func_num_args();
        $args = func_get_args();
        $statement =
            self::$msi->prepare($sql);
        $t = '';
        for ($i = 1; $i<$anum; $i++){
            $t.='s';
        }
        $prm = [$t];
        for ($i = 1; $i<$anum; $i++) {
            $prm[$i] = &$args[$i];
        }
        try {
            $ref = new ReflectionClass('mysqli_stmt');
            $method = $ref->getMethod('bind_param');
            $method->invokeArgs($statement, $prm);
            if ($statement->execute()) {
                $meta = $statement->result_metadata();
                $params = [];
                while ($field = $meta->fetch_field()) {
                    $params[] = &$row[$field->name];
                }
                if (call_user_func_array(array($statement, 'bind_result'), $params)) {
                    $result = [];
                    while ($statement->fetch()) {
                        $c = [];
                        foreach ($row as $key => $val) {
                            $c[$key] = $val;
                        }
                        $result[] = $c;
                    }
                    $statement->free_result();
                    return $result;
                }
                return 'Ошибка получения данных из базы';
            }
            return 'Ошибка выполнения SQL-запроса';
        } catch (ReflectionException $e) {
            return 'Ошибка при работе с базой данных';
        }
    }

    public function execute_param($sql){
        $anum = func_num_args();
        $args = func_get_args();
        $statement =
            self::$msi->prepare($sql);
        $t = '';
        for ($i = 1; $i<$anum; $i++){
            $t.='s';
        }
        $prm = [$t];
        for ($i = 1; $i<$anum; $i++) {
            $prm[$i] = &$args[$i];
        }
        try {
            $ref = new ReflectionClass('mysqli_stmt');
            $method = $ref->getMethod('bind_param');
            $method->invokeArgs($statement, $prm);
            return $statement->execute();
        } catch (ReflectionException $e) {
            return 'Ошибка при работе с базой данных';
        }
    }

    public function execute($sql): bool{
        $res = self::$msi->query($sql);
        self::$msi->store_result();
        return $res;
    }

}