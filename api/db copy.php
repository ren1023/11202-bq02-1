<?php
session_start();
date_default_timezone_set("Asia/Taipei");

/** =======class DB __Start=======**/
class DB{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=bq02"; //$dsn=data source name
    protected $pdo; //$pdo=> php data object
    protected $table;

    public function __construct($table){
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
        //$this->pdo=new PDO($this->dsn,'s1120401','s1120401');
    }

    /**
     * 撰寫輔助用的全域函式
     */
    function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**********撰寫內部共用方法_Start_共3個__Start**********/

    protected function a2s($array){
        foreach ($array as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        return $tmp;    /**$array = [    `name` => 'John',    `age` => 30,    `city` => 'New York'    ]; */
    }


    private function sql_all($sql, $array, $other){
        if (isset($this->table) && !empty($this->table)) {
            if (is_array($array)) {
                if (!empty($array)) {
                    $tmp = $this->a2s($array);
                    $sql .= " where " . join(" && ", $tmp);
                }
            } else {
                $sql .= " $array";
            }
            $sql .= $other;
            return $sql; 
            // echo 'all=>'.$sql;
            // $rows = $this->pdo->query($sql)->fetchColumn();
            //SELECT * FROM users WHERE id=1 && name='John' ORDER BY id DESC
        }
    }


    protected function math($math, $col, $array = '', $other = ''){
        $sql = "select $math(`$col`)  from `$this->table` ";
        $sql = $this->sql_all($sql, $array, $other);
        return $this->pdo->query($sql)->fetchColumn();
    }

    /**********撰寫內部共用方法__End**********/


    /**********撰寫外部共用方法__8個__Start**********/

    function all($where = '', $other = ''){
        $sql = "select * from `$this->table` ";
        $sql = $this->sql_all($sql, $where, $other);
        return  $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    // $News->all(['type'=>$_GET['type'],'sh'=>1]);
    }



    function find($id){
        $sql = "select * from `$this->table` ";
        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .="  where ". join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .= " where  `id`='{$id}'";
        }
        // echo 'find=>'.$sql;
        //將sql句子帶進pdo的query方法中，並以fetch的方式回傳一筆資料結果
        $row = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $row;
    // $news=$News->find($id);
    }
    


    function del($id){
        $sql = "delete from `$this->table` ";
        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .=" where ".join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .=" where  `id`='{$id}'";
        }
        return $this->pdo->exec($sql);
        //echo $sql;
    // $Log->del(['news'=>$_POST['news'],'acc'=>$_SESSION['user']]);
    }


    function save($array){
        if (isset($array['id'])) {
            $sql = "update `$this->table` set ";
            if (!empty($array)) {
                $tmp = $this->a2s($array);
            }
            $sql .= join(",", $tmp);
            $sql .= " where `id`='{$array['id']}'"; // UPDATE `users` SET `name`='John Doe',`email`='john@example.com' WHERE `id`='1'
        } else {
            $sql = "insert into `$this->table` ";
            $cols = "(`" . join("`,`", array_keys($array)) . "`)";
            $vals = "('" . join("','", $array) . "')";
            $sql = $sql . $cols . " values " . $vals;
        }
        return $this->pdo->exec($sql);

        // $array = [
        //     'id' => 1,
        //     'name' => 'John Doe',
        //     'email' => 'john@example.com'
        // ];

        // $array = [
        //     'name' => 'Jane Doe',
        //     'email' => 'jane@example.com'
        // ];

        // INSERT INTO `users` (`name`,`email`) VALUES ('Jane Doe','jane@example.com')
    // $News->save($news);
    // $Log->save(['news'=>$_POST['news'],'acc'=>$_SESSION['user']]);
    }



    function sum($col = '', $where = '', $other = ''){
        return  $this->math('sum', $col, $where, $other);
    }

    function max($col, $where = '', $other = ''){
        return  $this->math('max', $col, $where, $other);
    }

    function min($col, $where = '', $other = ''){
        return  $this->math('min', $col, $where, $other);
    }

    function count($where = '', $other = ''){
        $sql = "select count(*) from `$this->table` ";
        $sql = $this->sql_all($sql, $where, $other);
        return  $this->pdo->query($sql)->fetchColumn();
    }
    /**********撰寫外部共用方法__8個__End**********/







}

/** =======class DB __End=======**/


/**********always use function__Start**********/
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url){
    header("location:$url");
}
/**********always use function__End**********/



$Total = new DB('total');
$User = new DB('user');
$News = new DB('news');
$Que = new DB('que');
$Log = new DB('log');

// $tt=$Total->q("select * from total");
// $tt=$Total->q("INSERT INTO `total` (`id`, `total`, `date`) VALUES (NULL, '10', '2024-02-24')");
// $tt=$Total->q("UPDATE `total` SET `total` = '110' WHERE `total`.`id` = 8");
// $tt=$Total->find(2);
// $tt=$Total->find(['date' => date("Y-m-d")])['total'];
// echo print_r($tt);
// dd($tt);


if (!isset($_SESSION['visited'])) {
    if ($Total->count(['date' => date('Y-m-d')]) > 0) {
        $total = $Total->find(['date' => date('Y-m-d')]);
        $total['total']++;
        $Total->save($total);
    } else {
        $Total->save(['total' => 1, 'date' => date('Y-m-d')]);
    }
    $_SESSION['visited'] = 1;
}
