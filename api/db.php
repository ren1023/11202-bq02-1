<?php
session_start();
date_default_timezone_set("Asia/Taipei");

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=bq0201";
    protected $pdo;
    protected $table;

    public function __construct($table)
    {
        $this->table=$table;
        $this->pdo=new PDo($this->dsn,'root','');
    }

    public function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function a2s($array){
        foreach($array as $col=>$value){
            $tmp[]="`$col`='$value'";
        }
        return $tmp;
    }
    private function sql_all($sql,$array,$other){
        if(isset($this->table) && !empty($this->table)){
            if(is_array($array)){//常忽略
                if(!empty($array)){
                    $tmp=$this->a2s($array);
                    $sql.=join(" && ",$tmp);
                }
            }
            $sql.=" $array";
        }
        $sql.=$other;
        return $sql;
    }
    protected function math($math,$col,$array,$other){
        $sql="select $math(`$col`) from `$this->table` ";
        $sql.=$this->sql_all($sql,$array,$other);
        return $this->pdo->query($sql)->fetchColumn();
    }

    function all($where='',$other=''){
        $sql="select * from `$this->table` ";
        $sql.=$this->sql_all($sql,$where,$other);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function find($id){
        $sql="select * from `$this->table` where ";
        if(is_array($id)){
            $tmp=$this->a2s($id);
            $sql.=join(" && ",$tmp);
        }elseif(is_numeric($id)){
            $sql.=" `id`='{$id}'";
        }
        $row=$this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);//常忽略
        return $row;
    }
    function del($id){
        $sql="delete from `$this->table` where ";
        if(is_array($id)){
            $tmp=$this->a2s($id);
            $sql.=join(" && ",$tmp);
        }elseif(is_numeric($id)){
            $sql.=" `id`='{$id}'";
        }
        return $this->pdo->exec($sql);
    }
    function save($array){
        if(isset($array['id'])){ //常忽略
            $sql="update `$this->table` set ";
            if(!empty($array)){
                $tmp=$this->a2s($array);
            }
            $sql.=join(",",$tmp);
            $sql.=" where `id`= '{$array['id']}'"; //常忽略
        }else{
            $sql="insert into `$this->table` ";
            $cols="(`".join("`,`",array_keys($array))."`)";
            $vals="('".join("','",$array)."')";
            $sql=$sql.$cols." values ".$vals;//values常拚錯
        }
        return $this->pdo->exec($sql);//常忽略
    }

    function sum($col,$where='',$other=''){
        return $this->math('sum',$col,$where,$other);
    }
    function max($col,$where='',$other=''){
        return $this->math('max',$col,$where,$other);
    }
    function min($col,$where='',$other=''){
        return $this->math('min',$col,$where,$other);
    }
    function count($where='',$other=''){
        $sql="select count(*) from `$this->table` ";
        $sql.=$this->sql_all($sql,$where,$other);
        return $this->pdo->query($sql)->fetchColumn();
    }

}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function to($url){
    header("location:$url");
}

$User=new DB('users');
$Total=new DB('total');
$News=new DB('news');
$Log=new DB('logs');
$Que=new DB('ques');