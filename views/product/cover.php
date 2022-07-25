
<section>
    <div class="container-fluid px-1 px-md-2">
        <div class="d-flex align-items-start">
            <h1>Cover</h1>
            <select class="form-select w-0 text-uppercase" name="forma" onchange="location.replace(`/product/${this.value}/cover`)" style="width: fit-content;">
                <option value="">Sélectionnez un produit </option>
                <?php foreach ($params['products'] as $product): ?>
                <option class="text-uppercase" value="<?= $product->id_product_type ?>" <?= $product->id_product_type == $params['product']->id_product_type ? 'selected' : null ?>>  <?= $product->reference_product_type ?> - <?= $product->name_product_type ?></option>
                <?php endforeach ?>
            </select>
        </div>
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
<div class="row">
    <div class="col-2">
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-light" id="btnAddContract">Add cover</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#providerModal" class="btn bgYellow d-none" name="submitAddContract" id="submitAddContract">Valider</button>
            <input type="hidden" name="productId" value="<?= $params['product']->id_product_type ?>">
        </div>
    </div>
    <div class="col-10">
        <div class="d-flex  mb-2" id="rowCover">
            <div class="input-group me-4">
                <span class="input-group-text">Année</span>
                <input class="form-control" type="text" disabled value="2022" min=0>
            </div>
            <div class="input-group me-3">
                <span class="input-group-text">T1</span>
                <input class="form-control" type="number" min=0>
            </div>
            <div class="input-group me-3">
                <span class="input-group-text">T2</span>
                <input class="form-control" type="number" min=0>
            </div>
            <div class="input-group me-3">
                <span class="input-group-text">T3</span>
                <input class="form-control" type="number" min=0>
            </div>
            <div class="input-group me-3">
                <span class="input-group-text">T4</span>
                <input class="form-control" type="number" min=0>
            </div>
            <div class="input-group">
                <span class="input-group-text">Totale</span>
                <input class="form-control" type="text" disabled value="2022" min=0>
            </div>
        </div>
        <div class="plus">
            <button class="btn btn-outline-light p-1 px-3" id="addRowCover"> + </button>
        </div>
    </div>
</div>


    </div>  
</section>

<script defer src="/public/assets/js/cover.js"></script>

<!-- <?php 
echo "<pre>";
print_r($params);
echo "</pre>";

?> -->