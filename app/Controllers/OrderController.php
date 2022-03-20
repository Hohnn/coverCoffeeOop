<?php

namespace App\Controllers;

class OrderController extends Controller
{

    public function getAllOrdersByContract($id)
    {
        $req = $this->db->getPDO()->prepare("SELECT *, DATE_FORMAT(date_order, '%d/%m/%Y') as date_order2 FROM `order`
        NATURAL JOIN contract as c
        NATURAL JOIN product_type
        WHERE id_contract = :id
        ORDER BY date_order DESC ");
        $req->execute(['id' => $id]);
        return $req->fetchAll();
    }

    public function getAllOrdersByProduct($id)
    {
        $req = $this->db->getPDO()->prepare("SELECT *, DATE_FORMAT(date_order, '%d/%m/%Y') as date_order2 FROM `order`
        NATURAL JOIN contract as c
        NATURAL JOIN product_type
        NATURAL JOIN `provider`
        WHERE id_product_type = :id
        ORDER BY date_order DESC");
        $req->execute(['id' => $id]);
        return $req->fetchAll();
    }
}