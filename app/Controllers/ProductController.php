<?php

namespace App\Controllers;

class ProductController extends Controller
{
    public function index()
    {
        return $this->view('product.index');
    }

    public function show($id)
    {
        $req = $this->db->getPDO()->prepare('SELECT * FROM product_type WHERE id_product_type = :id');
        $req->execute(['id' => $id]);
        $product = $req->fetch();
        return $this->view('product.show', compact('product'));
    }
}