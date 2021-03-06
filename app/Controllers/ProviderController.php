<?php

namespace App\Controllers;

class ProviderController extends Controller
{

    public function getAllContractByProduct($id)
    {
        $req = $this->db->getPDO()->prepare("SELECT *, DATE_FORMAT(C.date_start_contract, '%d/%m/%Y') as DATE_START, DATE_FORMAT(C.date_end_contract, '%d/%m/%Y') as DATE_END FROM contract as C
        NATURAL JOIN product_type
        NATURAL JOIN `provider`
        WHERE id_product_type = :id
        ORDER BY date_start_contract ASC");
        $req->execute(['id' => $id]);
        $result = $req->fetchAll();
        return $this->updateQuantity($result);
    }

    public function updateQuantity($allContracts)
    {
        foreach($allContracts as $contract){
            $orders = new OrderController($this->db);
            $orders = $orders->getAllOrdersByContract($contract->id_contract);
            $quantity = 0;
            foreach($orders as $order){
                $quantity += $order->quantity_order;
            }
            $contract->delivered =  $quantity;
            $contract->solde = $contract->quantity_contract - $quantity;
        }
        return $allContracts;
    }

    public function getAllProvider()
    {
        $req = $this->db->getPDO()->prepare("SELECT * FROM `provider`");
        $req->execute();
        return $req->fetchAll();
    }
}