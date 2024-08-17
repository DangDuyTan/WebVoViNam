<?php

// require('../DAL/connectionDatabase.php');

abstract class AbstracGiamKhaoDAL
{
       public $conn = null;
       public function __construct()
       {
              $conectionDATA = new ConnectionDatabase();
              $this->conn = $conectionDATA->getConn();
       }
       public function getConn()
       {
              return $this->conn;
       }

       // lấy ra mảng các đối tượng
       abstract function getListObj();

       // sửa một đối tượng
       abstract function updateObj($obj);

       abstract function getSelect() ;
    }
