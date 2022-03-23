<h1>Produit n°<?= $params['product']->reference_product_type ?> <?= $params['product']->name_product_type ?></h1>


<table border="1">
    <thead>
        <tr>
            <th scope="col">Année</th>
            <th scope="col" class="text-center">Fournisseur</th>
            <th scope="col" class="text-center">Trimestre n°1</th>
            <th scope="col" class="text-center">Trimestre n°2</th>
            <th scope="col" class="text-center">Trimestre n°3</th>
            <th scope="col" class="text-center">Trimestre n°4</th>
            <th scope="col" class="text-center">Totale</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($params['cover'] as $yearKey => $year) : ?>
        <?php foreach ($year['orders'] as $provider) : ?>
            <tr>
                <td class="text-center"><?= $year['year'] ?></td>
                <td ><?= $provider['provider'] ?></td>
                <td class="text-center"><?= $provider['orders'][1]['total'] ?? null ?></td>
                <td class="text-center"><?= $provider['orders'][2]['total'] ?? null ?></td>
                <td class="text-center"><?= $provider['orders'][3]['total'] ?? null ?></td>
                <td class="text-center"><?= $provider['orders'][4]['total'] ?? null ?></td>
                <td class="text-center"><?= $provider['total'] ?? null ?></td>
            </tr>
        <?php endforeach; ?>
            <tr>
                <td class="text-center" colspan="2">Total</td>
                <td class="text-center"><?= $year['totalByTrimestre'][1]['total'] ?? null ?></td>
                <td class="text-center"><?= $year['totalByTrimestre'][2]['total'] ?? null ?></td>
                <td class="text-center"><?= $year['totalByTrimestre'][3]['total'] ?? null ?></td>
                <td class="text-center"><?= $year['totalByTrimestre'][4]['total'] ?? null ?></td>
                <td class="text-center"><?= $year['total'] ?? null ?></td>
            </tr>
            <tr class="<?= isset($params['deltaByTrimestre'][$yearKey]) ? '' : 'd-none' ?>">
                <td class="text-center" colspan="2">Delta / T</td>
                <td class="text-center"><?= $params['deltaByTrimestre'][$yearKey][0] ?? null ?>%</td>
                <td class="text-center"><?= $params['deltaByTrimestre'][$yearKey][1] ?? null ?>%</td>
                <td class="text-center"><?= $params['deltaByTrimestre'][$yearKey][2] ?? null ?>%</td>
                <td class="text-center"><?= $params['deltaByTrimestre'][$yearKey][3] ?? null ?>%</td>
                <td class="text-center"><?= $params['deltaStack'][$yearKey][3] ?? null ?>%</td>
            </tr>
            <tr class="<?= isset($params['deltaByTrimestre'][$yearKey]) ? '' : 'd-none' ?>">
                <td class="text-center" colspan="2">Delta / cumulé</td>
                <td class="text-center"><?= $params['deltaStack'][$yearKey][0] ?? null ?>%</td>
                <td class="text-center"><?= $params['deltaStack'][$yearKey][1] ?? null ?>%</td>
                <td class="text-center"><?= $params['deltaStack'][$yearKey][2] ?? null ?>%</td>
                <td class="text-center"><?= $params['deltaStack'][$yearKey][3] ?? null ?>%</td>
                <td class="text-center"></td>
            </tr>
    <?php endforeach; ?>
    <?php foreach ($params['contractCover'] as $yearKey => $year) : ?>
        <tr>
                <td class="text-center"><?= $yearKey ?></td>
                <td >Couverture</td>
                <td class="text-center"><?= $year[1] ?? null ?></td>
                <td class="text-center"><?= $year[2] ?? null ?></td>
                <td class="text-center"><?= $year[3] ?? null ?></td>
                <td class="text-center"><?= $year[4] ?? null ?></td>
                <td class="text-center"><?= array_sum($year) ?? null ?></td>
            </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php 
echo "<pre>";
print_r($params['contractCover']);
echo "</pre>";

?>