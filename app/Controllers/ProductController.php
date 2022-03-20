<?php

namespace App\Controllers;
use App\Controllers\ContractController;
use App\Controllers\OrderController;
use App\Controllers\CoverController;

class ProductController extends Controller
{

    public $product = null;

    public function index()
    {   
        $products = $this->getAllProduct();
        return $this->view('product.index', compact('products'));
    }

    public function show($id)
    {
        $contractController = new ContractController($this->db);
        $contracts = $contractController->getAllContractByProduct($id);
        $product = $this->getOneProduct($id);
        return $this->view('product.show', compact('product', 'contracts'));
    }

    public function showOrders($id)
    {
        $contractController = new OrderController($this->db);
        $orders = $contractController->getAllOrdersByProduct($id);
        $product = $this->getOneProduct($id);
        return $this->view('product.orders', compact('product', 'orders'));
    }

    public function showCover($id)
    {
        $contractController = new OrderController($this->db);
        $orders = $contractController->getAllOrdersByProduct($id);
        $product = $this->getOneProduct($id);
        $this->product = $product;
        $coverController = new CoverController();
        $cover = $coverController->algo($orders);
        return $this->view('product.cover', compact('product', 'cover'));
    }

    public function getOneProduct($id)
    {
        $req = $this->db->getPDO()->prepare('SELECT * FROM product_type WHERE id_product_type = :id');
        $req->execute(['id' => $id]);
        return $req->fetch();
    }

    public function getAllProduct()
    {
        $req = $this->db->getPDO()->prepare('SELECT * FROM product_type');
        $req->execute();
        return $req->fetchAll();
    }

}