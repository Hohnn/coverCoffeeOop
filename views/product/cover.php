
<section>
    <div class="container-fluid px-1 px-md-2">
    <h1>Cover <span><?= $params['product']->reference_product_type ?> <?= $params['product']->name_product_type ?></span></h1>

<?php 
require '../views/product-nav.php'; ?>

<table class="table table-dark table-striped table-hover table-bordered">
    <thead>
        <tr >
            <th scope="col" class="text-center">Fournisseur</th>
            <th scope="col" class="text-center">Année</th>
            <th scope="col" class="text-center">Trimestre n°1</th>
            <th scope="col" class="text-center">Trimestre n°2</th>
            <th scope="col" class="text-center">Trimestre n°3</th>
            <th scope="col" class="text-center">Trimestre n°4</th>
            <th scope="col" class="text-center">Totale</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($params['cover'] as $yearKey => $year) : $i = 0 ?>
        <?php foreach ($year['orders'] as $provider) : $i++ ?>
            <tr class="fw-light <?=  $i == 1 && ($params['cover'][$yearKey - 1]['year'] ?? $year['year']) != $year['year'] ? 'firstMonth' : '' ?>">
                <td ><?= $provider['provider'] ?></td>
                <td class="text-center"><?= $year['year'] ?></td>
                <td class="text-center"><?= $provider['orders'][1]['total'] ?? null ?></td>
                <td class="text-center"><?= $provider['orders'][2]['total'] ?? null ?></td>
                <td class="text-center"><?= $provider['orders'][3]['total'] ?? null ?></td>
                <td class="text-center"><?= $provider['orders'][4]['total'] ?? null ?></td>
                <td class="text-center"><?= $provider['total'] ?? null ?></td>
            </tr>
        <?php endforeach; ?>
            <tr class="<?= count($year['orders']) <= 1 ? 'd-none' : null ?>">
                <td  colspan="2">Total</td>
                <td class="text-center"><?= $year['totalByTrimestre'][1]['total'] ?? null ?></td>
                <td class="text-center"><?= $year['totalByTrimestre'][2]['total'] ?? null ?></td>
                <td class="text-center"><?= $year['totalByTrimestre'][3]['total'] ?? null ?></td>
                <td class="text-center"><?= $year['totalByTrimestre'][4]['total'] ?? null ?></td>
                <td class="text-center"><?= $year['total'] ?? null ?></td>
            </tr>
            <tr class="fw-light <?= isset($params['deltaByTrimestre'][$yearKey]) ? '' : 'd-none' ?>">
                <td  colspan="2">Delta / T</td>
                <td class="text-center <?= $params['coverController']::deltaColor($params['deltaByTrimestre'][$yearKey][1] ?? null) ?>"><?= $params['deltaByTrimestre'][$yearKey][1] ?? null ?>%</td>
                <td class="text-center <?= $params['coverController']::deltaColor($params['deltaByTrimestre'][$yearKey][2] ?? null) ?>"><?= $params['deltaByTrimestre'][$yearKey][2] ?? null ?>%</td>
                <td class="text-center <?= $params['coverController']::deltaColor($params['deltaByTrimestre'][$yearKey][3] ?? null) ?>"><?= $params['deltaByTrimestre'][$yearKey][3] ?? null ?>%</td>
                <td class="text-center <?= $params['coverController']::deltaColor($params['deltaByTrimestre'][$yearKey][4] ?? null) ?>"><?= $params['deltaByTrimestre'][$yearKey][4] ?? null ?>%</td>
                <td class="text-center <?= $params['coverController']::deltaColor($params['deltaStack'][$yearKey][4] ?? null) ?>"><?= $params['deltaStack'][$yearKey][4] ?? null ?>%</td>
                
            </tr>
            <tr class="fw-light <?= isset($params['deltaByTrimestre'][$yearKey]) ? '' : 'd-none' ?>">
                <td  colspan="2">Delta / cumulé</td>
                <td class="text-center <?= $params['coverController']::deltaColor($params['deltaStack'][$yearKey][1] ?? null) ?>"><?= $params['deltaStack'][$yearKey][1] ?? null ?>%</td>
                <td class="text-center <?= $params['coverController']::deltaColor($params['deltaStack'][$yearKey][2] ?? null) ?>"><?= $params['deltaStack'][$yearKey][2] ?? null ?>%</td>
                <td class="text-center <?= $params['coverController']::deltaColor($params['deltaStack'][$yearKey][3] ?? null) ?>"><?= $params['deltaStack'][$yearKey][3] ?? null ?>%</td>
                <td class="text-center <?= $params['coverController']::deltaColor($params['deltaStack'][$yearKey][4] ?? null) ?>"><?= $params['deltaStack'][$yearKey][4] ?? null ?>%</td>
                <td class="text-center"></td>
            </tr>
    <?php endforeach; ?>
    <?php foreach ($params['contractCover'] as $yearKey => $year) : ?>
        <tr class="table-light border-black <?= array_key_first($params['contractCover']) == $yearKey ? 'firstMonth' : null ?>">
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

    </div>  
</section>

<?php 
echo "<pre>";
/* print_r($params['deltaStack']); */
echo "</pre>";

?>