<?php

namespace App\Controllers;
use App\Controllers\ProductController;
use App\Controllers\OrderController;
use DateTime;

class ContractController extends Controller
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

        if (isset($_SESSION['order']) && !empty($_SESSION['order'])) {
            foreach($_SESSION['order'] as $order) {
                if ($order['productId'] = $allContracts[0]->id_product_type) {
                    $contract = $this->getContractById($order['contractId']);
                    foreach($allContracts as $contract) {
                        if ($contract->id_contract == $order['contractId']) {
                            $contract->delivered += $order['quantity'];
                            $contract->solde = $contract->quantity_contract - $contract->delivered;
                        }
                    }
                }
            }
        }
        return $allContracts;
    }

    public function getContractById($id)
    {
        $bdd = $this->db->getPDO();
        $condition = "SELECT *, DATE_FORMAT(C.date_start_contract, '%d/%m/%Y') as DATE_START, DATE_FORMAT(C.date_end_contract, '%d/%m/%Y') as DATE_END FROM contract as C
        NATURAL JOIN product_type
        NATURAL JOIN `provider`
        WHERE id_contract = ?
        ORDER BY date_start_contract ASC";
        $result = $bdd->prepare($condition);
        $result->bindValue(1, $id, \PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }

    public function fetchContractById($id)
    {
        echo json_encode($this->getContractById($id));
    }

    public function postContract($id)
    {
        if (isset($_POST['submitAddOrder'])) {
            !isset($_SESSION['order']) ? $_SESSION['order'] = [] : $_SESSION['order'];
            $count = count($_SESSION['order']);
            foreach($_SESSION['order'] as $key => $value) {
                if ($value['contractId'] == $_POST['contractId']) {
                    $_SESSION['order'][$key]['quantity'] += $_POST['orderQuantity'];
                    $count--;
                    break;
                }
            }

            $Order = new OrderController($this->db);
            $countOrder = count($Order->getAllOrdersByContract($_POST['contractId']));
            if ($count == count($_SESSION['order'])) {
                $order = [
                    'reference' => 'order' . $id . $_POST['contractId'] . $countOrder,
                    'date' => $_POST['contractDate'],
                    'quantity' => $_POST['orderQuantity'],
                    'contractId' => $_POST['contractId'],
                    'productId' => $id
                ];
                array_push($_SESSION['order'], $order);  
            }
    
    /*         $product->addOrder('order' . $ref, $_POST['contractDate'], +$_POST['orderQuantity'], +$_POST['contractId']); */
            $success = 'Commande ajoutée avec succès';
            $show = new ProductController($this->db);
            $show->show($id);
            var_dump($_SESSION['order']);
        }


        if (isset($_POST['submitUpdateContract'])) {
            $contractId = htmlspecialchars($_POST['contractIdUpdate']);
            $refContract = htmlspecialchars($_POST['refContract']);
            $startDate = htmlspecialchars($_POST['startDate']);
            $endDate = htmlspecialchars($_POST['endDate']);
            $providerId = htmlspecialchars($_POST['providerId']);
            $quantity = htmlspecialchars($_POST['quantity']);
            $price = htmlspecialchars($_POST['price']);
            $productName = htmlspecialchars($_POST['productName']);


            $bdd = $this->db->getPDO();
            $condition = "UPDATE `contract` SET `reference_contract` = ?, `name_contract` = ?, `date_start_contract` = ?, `date_end_contract` = ?, `quantity_contract` = ?, `price_contract` = ?, `id_provider` = ? WHERE `id_contract` = ?";
            $result = $bdd->prepare($condition);
            $result->bindValue(1, $refContract, \PDO::PARAM_STR);
            $result->bindValue(2, $productName, \PDO::PARAM_STR);
            $result->bindValue(3, $startDate, \PDO::PARAM_STR);
            $result->bindValue(4, $endDate, \PDO::PARAM_STR);
            $result->bindValue(5, $quantity, \PDO::PARAM_INT);
            $result->bindValue(6, $price, \PDO::PARAM_STR);
            $result->bindValue(7, $providerId, \PDO::PARAM_INT);
            $result->bindValue(8, $contractId, \PDO::PARAM_INT);
            $result->execute();
            
            $show = new ProductController($this->db);
            $show->show($id);
        }

        if(isset($_POST['submitAddContract'])) {
            $productId = htmlspecialchars($_POST['productId']);
            $refContract = htmlspecialchars($_POST['refContract']);
            $startDate = htmlspecialchars($_POST['startDate']);
            $endDate = htmlspecialchars($_POST['endDate']);
            $providerId = htmlspecialchars($_POST['providerId']);
            $quantity = htmlspecialchars($_POST['quantity']);
            $price = htmlspecialchars($_POST['price']);
            $productName = htmlspecialchars($_POST['productName']);
        
            $date = new DateTime();
            $date = $date->format('Y-m-d');
            
            $contractId = $this->setContract($productId, $refContract, $productName, $startDate, $endDate, $quantity, $price, $providerId);
            $show = new ProductController($this->db);
            $show->show($id);
        }

        if (isset($_POST['submitDeleteContractModal'])) {
            $contractId = $_POST['contractId'];
            $this->deleteContract($contractId);
            $show = new ProductController($this->db);
            $show->show($id);
        }

        if (isset($_POST['submitAddDispo'])) {
            $productId = $_POST['productId'];
            $providerId = $_POST['providerId'];
            $refContract = htmlspecialchars($_POST['refContract']);
            $nameContract = htmlspecialchars($_POST['nameContract']);
            $date = new DateTime();
            $thisYear = $date->format('Y');
            if ($_POST['trimestre'] == 1) {
                $dateStart = $thisYear . '-01-01';
                $dateEnd = $thisYear . '-03-30';
            } elseif ($_POST['trimestre'] == 2) {
                $dateStart = $thisYear . '-04-01';
                $dateEnd = $thisYear . '-06-30';
            } elseif ($_POST['trimestre'] == 3) {
                $dateStart = $thisYear . '-07-01';
                $dateEnd = $thisYear . '-09-30';
            } elseif ($_POST['trimestre'] == 4) {
                $dateStart = $thisYear . '-10-01';
                $dateEnd = $thisYear . '-12-30';
            }
            $quantity = htmlspecialchars($_POST['quantity']);
            $price = $_POST['price'];
            $today = $date->format('Y-m-d');
        
            $contratId = $contractModel->setContract($productId, $refContract, $nameContract, $dateStart, $dateEnd, $quantity, $price, $providerId);
            $count = count($_SESSION['order']);
        /*     foreach($_SESSION['order'] as $key => $value) {
                if ($value['contractId'] == $_POST['contractId']) {
                    $_SESSION['order'][$key]['quantity'] += $_POST['orderQuantity'];
                    $count--;
                    break;
                }
            } */
            if ($count == count($_SESSION['order'])) {
                $order = [
                    'reference' => $refContract,
                    'date' => $today,
                    'quantity' => $quantity,
                    'contractId' => $contratId,
                    'type' => 'dispo'
                ];
                array_push($_SESSION['order'], $order);  
            }
            
            $success = 'Dispo ajouté avec succès';
            $contracts = $product->getContractByRef($ref);
        
        }
    }

    public function setContract($productId, $refContract, $nameContract, $dateStartContract, $dateEndContract, $quantityContract, $priceContract, $providerId)
    {
        $bdd = $this->db->getPDO();
        $condition = "INSERT INTO `contract` (`id_product_type`, `reference_contract`, `name_contract`, `date_start_contract`, `date_end_contract`, `quantity_contract`, `price_contract`, `id_provider`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $result = $bdd->prepare($condition);
        $result->bindValue(1, $productId, \PDO::PARAM_INT);
        $result->bindValue(2, $refContract, \PDO::PARAM_STR);
        $result->bindValue(3, $nameContract, \PDO::PARAM_STR);
        $result->bindValue(4, $dateStartContract, \PDO::PARAM_STR);
        $result->bindValue(5, $dateEndContract, \PDO::PARAM_STR);
        $result->bindValue(6, $quantityContract, \PDO::PARAM_INT);
        $result->bindValue(7, $priceContract, \PDO::PARAM_STR);
        $result->bindValue(8, $providerId, \PDO::PARAM_INT);
        $result->execute();
        return $bdd->lastInsertId();
    }

    public function deleteContract($contractId)
    {
        $bdd = $this->db->getPDO();
        $condition = "DELETE FROM `contract` WHERE id_contract = ?";
        $result = $bdd->prepare($condition);
        $result->bindValue(1, $contractId, \PDO::PARAM_INT);
        $result->execute();
    }

    public function dispoDate()
    {
        $date2 = new DateTime();
        $month = $date2->format('m');
        $year = $date2->format('Y');
        if($month >= 1 && $month <= 3) {
            $trimestre = 1;
        } elseif($month >= 4 && $month <= 6) {
            $trimestre = 2;
        } elseif($month >= 7 && $month <= 9) {
            $trimestre = 3;
        } elseif($month >= 10 && $month <= 12) {
            $trimestre = 4;
        }

        return [
            'date' => $date2->format('Y-m-d'),
            'trimestre' => $trimestre,
            'year' => $year
        ];
    }
}