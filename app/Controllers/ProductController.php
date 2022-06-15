<?php

namespace App\Controllers;
use App\Controllers\ContractController;
use App\Controllers\OrderController;
use App\Controllers\CoverController;
use App\Controllers\ProviderController;

class ProductController extends Controller
{

    public $product = null;
    public $allProducts = null;

    public function index()
    {   
        $products = $this->getAllProduct();
        $this->allProducts = $products;
        return $this->view('product.index', compact('products'));
    }

    public function show($id)
    {
        $contractController = new ContractController($this->db);
        $contracts = $contractController->getAllContractByProduct($id);
        $product = $this->getOneProduct($id);
        $products = $this->getAllProduct();
        $providerController = new ProviderController($this->db);
        $providers = $providerController->getAllProvider();
        $dispoDate = $contractController->dispoDate();

        return $this->view('product.show', compact('product', 'contracts', 'products', 'providers', 'dispoDate'));
    }

    public function showOrders($id)
    {
        $orderController = new OrderController($this->db);
        $orders = $orderController->getAllOrdersByProduct($id);
        $product = $this->getOneProduct($id);
        return $this->view('product.orders', compact('product', 'orders'));
    }

    public function showCover($id)
    {
        $orderController = new OrderController($this->db);
        $orders = $orderController->getAllOrdersByProduct($id);
        $product = $this->getOneProduct($id);
        $this->product = $product;
        $coverController = new CoverController();
        $cover = $coverController->algo($orders);
        $deltaByTrimestre = $coverController->getDeltaByTrimestre($orders);
        $deltaStack = $coverController->getDeltaStack($orders);
        $contractController = new ContractController($this->db);
        $contracts = $contractController->getAllContractByProduct($id);
        $contractCover = $coverController->getContractCover($contracts);
        $this->allProducts ? $products = $this->allProducts : $products = $this->getAllProduct();
        return $this->view('product.cover', compact('product', 'cover', 'deltaByTrimestre', 'deltaStack', 'contractCover', 'coverController', 'products'));
    }

    public function getOneProduct($id)
    {
        $req = $this->db->getPDO()->prepare('SELECT * FROM product_type WHERE id_product_type = :id');
        $req->execute(['id' => $id]);
        return $req->fetch();
    }

    public function getAllProduct()
    {
        $req = $this->db->getPDO()->prepare('SELECT * FROM product_type ORDER BY reference_product_type ASC');
        $req->execute();
        return $req->fetchAll();
    }

    

}