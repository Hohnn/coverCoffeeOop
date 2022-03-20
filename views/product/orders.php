<h1>Produit n°<?= $params['product']->reference_product_type ?></h1>

<?= $params['product']->name_product_type ?>
<?php foreach($params['orders'] as $order) ?>
 <ul>
     <li><?= $order->reference_order ?> / <?= $order->date_order2 ?></li>
 </ul>