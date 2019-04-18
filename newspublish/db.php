<?php
include_once ('conn.php');
include_once ("page.class.php");
class DB
{
    function __construct(){}

        function addlanmu($name){
        $conn=new Conn();
        $db=$conn->open();
        $arr=array("name"=>$name);
        $db->AutoExecute("type",$arr,"INSERT");
        echo "ok";
        $db->close();
    }

        function adduser($name,$pass){
        $conn=new Conn();
        $db=$conn->open();
        $arr=array("username"=>$name,"password"=>md5($pass));
        $db->AutoExecute("admin",$arr,"INSERT");
        echo "ok";
        $db->close();
    }

        function addnews($typeid,$title,$content){
        $conn=new Conn();
        $db=$conn->open();
        $arr=array("typeid"=>$typeid,"title"=>$title,"content"=>$content,"time"=>$strtotime("now"));
        $db->AutoExecute("news",$arr,"INSERT") or die("添加失败");
        echo "ok";
        $db->close();
    }

        function dels($biao,$id){
        $cn=new Conn();
        $db=$cn->open();
        $sql="delete from".$biao."where id=".$id;
        $db->Execute($sql) or die("删除失败");
        echo "删除成功";
        $db->close();
    }

        function delall($biao,$id){
        $id1=implode(",",$id);
        $db=new Conn();
        $cn=$db->open();
        $sql="delete from $biao where id in ($id1)";
        echo $sql;
        $rs=$cn->Execute($sql);
        if(!$rs)
            echo "删除成功";
        else
            echo "操作成功.<br/>";
        $cn->close();
    }

        function sel($content,$yanshi){
            $cn = new Conn();
            $db = $cn->open();
            $sql = "select id, title from news where title like '%" .$content."%'";
            $rs = $db->Execute($sql);
            echo $sql;
            if (!$rs->eof) {
                echo "<table class=$yanshi>\n";
                while (!$rs->EOF) {
                    echo "<tr><td><a href='show.php?id=" .$rs->fields['id'] ." > " . $rs->fields[2] . "</a></td></tr>";
            $rs->MoveNext();
        }
                print "</table>\n";
            } else
                return "没有找到相关数据";

            $db->close();
    }
        function fenye1($sql,$n,$col){
        $cn=new Conn();
        $db=$cn->open();
        $rs=$db->Execute($sql);
        @$tol=$rs->RecordCount();
        $page=new Page($tol,$n);
        $sql1=$sql."{$page->limit}";
        $rsl=$db->Execute($sql1);
            while (!$rsl->EOF) {
                echo "<tr><td><input type='checkbox' name='mm[]' id='mm[]' value='". $rsl->fields['id']."' onclick=Item(this, 'mmAll') > </td></tr>";
                $n=count($rsl->fields);
                for($i=0,$i<$n/2;$i++){
                    echo "<td>".$rsl->fields[$i]."</td>";
                }
                    echo "<td> <a href=edit_user.php?id=" .$rsl->fields['id']. ">编辑 </a><span><a href='?id=".$rsl->fields['id']."' onclick='del(".$rsl->fields['id'].")'>删除</a></span></td>";
                    echo "</tr>";
            }
                echo "<tr><td colspan='".$col."' align='right'>".$page->fpage() ."</tr></td>";
                $db->close();
    }

        function rxiugai($biao,$id){
        $cn=new Conn();
        $db=$cn->open();
        $sql="select * from $biao where id=$id";
        $rs=$db->Execute($sql);
        return $rs;
        $db->close();
    }
        function savexiugai($biao,$content,$id){
        $cn=new Conn();
        $db=$cn->open();
        $sql="update $biao set $content where id=$id";
        $db->Excute($sql) or die ("修改失败");
        $db->close();
    }

        function slanmu($sql){
        $cn=new Conn();
        $db=$cn->open();
        $rs=$db->Execute($sql);
            while (!$rs->EOF) {
                echo "<option value='".$rs->fields['id']."'>".$rs->fields['name']."</option>";
                $rs->MoveNext();
            }
        $db->close();
    }
}