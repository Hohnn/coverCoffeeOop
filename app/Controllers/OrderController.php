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

    public function deleteOrder($id)
    {
        /* $req = $this->db->getPDO()->prepare("DELETE FROM `order` WHERE id_order = :id");
        $req->execute(['id' => $id]); */
        unset($_SESSION['order'][$id]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function viewCart()
    {
        $orders = $_SESSION['order'];
        /* $orders = $this->updateQuantity($orders); */
        $contract = new ContractController($this->db);
        $this->view('order/cart', compact('orders', 'contract'));
    }

    public function getUniqueProvider() 
    {
        $providerUnique = [];
        $providerTotal = [];
        $totalPrice = 0;
        $contract = new ContractController($this->db);
        $provider = new ProviderController($this->db);
        foreach ($_SESSION['order'] as $value) {
            $contractInfo3 = $contract->getContractById($value['contractId']);
            $providerUnique[$contractInfo3->id_provider][] = $value;
        }
        foreach ($providerUnique as $keyP => $value) { 
            $providerInfo = $provider->getProviderById($keyP);
            
            $providerTotal[$keyP] = (object) [
                'provider' => $providerInfo->name_provider,
                'quantity' => 0,
            ];
            foreach ($value as $key => $value) {
                $contractInfo = $contract->getContractById($value['contractId']);
                if ($keyP == $contractInfo->id_provider) {
                    $price = number_format($contractInfo->price_contract, 2, '.', '');
                    $delivred = $this->getOrderByContract($contractInfo->id_contract);
                    $solde = $delivred ? $contractInfo->quantity_contract - $delivred->quantity_order : $contractInfo->quantity_contract;
                    $totalPrice += $price * $value['quantity'];
                }
                $providerTotal[$keyP]->quantity += $value['quantity'];
                $providerTotal[$keyP]->price = $price;
                $providerTotal[$keyP]->solde = $solde;
                $providerTotal[$keyP]->totalPrice = $totalPrice;
            }
        }
        return $providerTotal;
    }

    public function getTotalProvider()
    {
        $providerTotal = [];
        $totalPrice = 0;
        $contract = new ContractController($this->db);
        $provider = new ProviderController($this->db);
        foreach ($_SESSION['order'] as $keyP => $order) { 
            
            $providerTotal[$keyP] = (object) [
                'quantity' => 0,
            ];
            foreach ($order as $key => $value) {
                $contractInfo = $contract->getContractById($value['contractId']);
                if ($keyP == $contractInfo->id_provider) {
                    $price = number_format($contractInfo->price_contract, 2, '.', '');
                    $delivred = $this->getOrderByContract($contractInfo->id_contract);
                    $solde = $delivred ? $contractInfo->quantity_contract - $delivred->quantity_order : $contractInfo->quantity_contract;
                    $totalPrice += $price * $value['quantity'];
                }
                $providerTotal[$keyP]->quantity += $value['quantity'];
                $providerTotal[$keyP]->price = $price;
                $providerTotal[$keyP]->solde = $solde;
                $providerTotal[$keyP]->totalPrice = $totalPrice;
            }
        }
        return $providerTotal;
    }

    public function getOrderByContract($contract)
    {
        $condition = "SELECT quantity_contract, SUM(quantity_order) as quantity_order FROM `contract` as c 
        NATURAL JOIN `order` 
        WHERE id_contract = ?
        GROUP BY reference_contract";
        $result = $this->db->getPDO()->prepare($condition);
        $result->bindValue(1, $contract, \PDO::PARAM_STR);
        $result->execute();
        return $result->fetch();
    }

}