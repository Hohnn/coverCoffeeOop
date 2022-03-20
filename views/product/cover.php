<h1>Produit n°<?= $params['product']->reference_product_type ?> <?= $params['product']->name_product_type ?></h1>


<table border="1">
    <thead>
        <tr>
            <th scope="col">Année</th>
            <th scope="col" class="text-center">Fournisseur</th>
            <th colspan="3" scope="col" class=" text-center">Trimestre n°1</th>
            <th colspan="3" scope="col" class=" text-center">Trimestre n°2</th>
            <th colspan="3" scope="col" class=" text-center">Trimestre n°3</th>
            <th colspan="3" scope="col" class=" text-center">Trimestre n°4</th>
            <th scope="col" class="text-center">Totale</th>
        </tr>
    </thead>
    <?php foreach ($params['cover'] as $year) : ?>
        <?php foreach ($year['orders'] as $provider) : ?>
            <tbody>
                <td><?= $year['year'] ?></td>
                <td><?= $provider['provider'] ?></td>
                <td><?= $provider['orders'][1]['total'] ?? null ?></td>
                <td><?= $provider['orders'][2]['total'] ?? null ?></td>
                <td><?= $provider['orders'][3]['total'] ?? null ?></td>
                <td><?= $provider['orders'][4]['total'] ?? null ?></td>
            </tbody>
        <?php endforeach; ?>
    <?php endforeach; ?>
</table>

<?php 

echo "<pre>";
print_r($params['cover']);
echo "</pre>";

?>