<?php
require('../DAL/connectionDatabase.php');
require('../DAL/AbstracDSachCTKQ.php');
require('../DTO/ChiTietKetQuaDTO.php');
require('../DAL/ChiTietKetQuaDAL.php');

class ChiTietKetQuaBLL
{
    private $ChiTietKetQuaDAL;
    function __construct()
    { 
        $this->ChiTietKetQuaDAL = new ChiTietKetQuaDAL();
    }
    // Lấy danh sách
    function ListCTKQ($maChiTietKetQua) {
        // Kiểm tra $maChiTietKetQua
        $results = $this->ChiTietKetQuaDAL->getListObj($maChiTietKetQua);
        return $results;
    }
}
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $function = $_POST['function'] ?? '';
    $maChiTietKetQua = $_POST['maChiTietKetQua'] ?? '';
    switch ($function) {
        case 'ListCTKQ':
            try {
                $response = (new ChiTietKetQuaBLL())->ListCTKQ($maChiTietKetQua);
                echo json_encode($response);
            } catch (Exception $e) {
                error_log($e->getMessage());
                http_response_code(500);
                echo json_encode(['Lỗi BLL' => $e->getMessage()]);
            }
            break;
    }
}