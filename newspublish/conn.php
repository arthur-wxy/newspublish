<?php
/**
 * Created by PhpStorm.
 * User: aw
 * Date: 2019-01-10
 * Time: 14:16
 */
    class DB{
        public $db_host;
        public $db_user;
        public $db_pwd;
        public $db_name;
        public $links;

        function __construct($db_host,$db_name,$db_pwd,$db_user){
            $this -> db_host = $db_host;
            $this -> db_user = $db_user;
            $this -> db_pwd = $db_pwd;
            $this -> db_name = $db_name;
            $this -> links = @mysql_connect($db_host,$db_pwd,$db_user) or die("数据库连接失败");
            mysql_query("set names utf8");
            mysql_select_db($db_name,$this -> links);
        }
        function query($sql){
            return mysql_query($sql);
        }
        function numRows($sql){
            $result = $this -> query($sql);
        }

    }
?>