<?php

namespace App\Controllers;

use Database\DBConnection;


class Controller
{
    protected $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }
    
    public function view(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path) . '.php';
        $product = new ContractController($this->db);
        $provider = new ProviderController($this->db);
        require VIEWS . '/nav/asideNav.php';
        require VIEWS . 'header.php';
        require VIEWS . $path;
        require VIEWS . 'footer.php';
        if($params){
            $params = extract($params);
        }
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }

    public function viewEmpty(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path) . '.php';
        require VIEWS . $path;
        if($params){
            $params = extract($params);
        }
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }
}