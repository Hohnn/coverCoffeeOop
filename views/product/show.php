<h1>Produit n°<?= $params['product']->reference_product_type ?> <?= $params['product']->name_product_type ?></h1>



<?php foreach($params['contracts'] as $contract){ ?>
    <h2>Contrat n°<?= $contract->reference_contract ?></h2>
    <p>Du <?= $contract->DATE_START ?> au <?= $contract->DATE_END ?></p>
    <p>Fournisseur : <?= $contract->name_provider ?></p>
    <p>Prix : <?= $contract->price_contract ?>€</p>
    <p>Quantité : <?= $contract->quantity_contract ?></p>
<?php } ?>