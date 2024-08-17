<?php

// require('../DAL/connectionDatabase.php');

abstract class AbstracDSachCTKQ
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
       abstract function getListObj($maChiTietKetQua);


    }
