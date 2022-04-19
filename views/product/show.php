<section>
    <div class="container-fluid px-1 px-md-2">
        <div class="d-flex align-items-start">
            <h1 class="text-uppercase ">Contrat</h1>
            <select class="form-select w-0 text-uppercase" name="forma" onchange="location = this.value;" style="width: fit-content;">
            <option value="">Sélectionnez un produit </option>
            <?php foreach ($params['products'] as $product):  ?>
                <option class="text-uppercase" value="<?= $product->id_product_type ?>" <?= $_SERVER['REQUEST_URI'] == '/product/' . $product->id_product_type ? 'selected' : null ?>>  <?= $product->reference_product_type ?> - <?= $product->name_product_type ?></option>
            <?php endforeach ?>
            </select>
            <p class="ms-3"><a id="toggleAddContractBtn" data-bs-toggle="collapse" href="#collapseExample" role="button" class="btn btn-outline-light">Ajouer un contrat</a></p>
        </div>

        <div class="collapse" id="collapseExample">
            <h2 id="editContractTitle" class="fs-6 text-white active mt-4 mb-3">Nouveau contrat</h2>
            <form class="row g-3 my-2" method="POST" >
                <div class="col-md-4">
                <label for="refContract" class="form-label">n°contrat</label>
                <input type="text" class="form-control" id="refContract" name="refContract" value="<?= $_POST['refContract'] ?? '' ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>
                <div class="col-md-2">
                <label for="startDate" class="form-label">Date de Début</label>
                <input type="date" class="form-control" id="startDate" name="startDate" value="<?= $_POST['startDate'] ?? '' ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>
                <div class="col-md-2">
                <label for="endDate" class="form-label">Date de fin</label>
                <input type="date" class="form-control" id="endDate" name="endDate" value="<?= $_POST['endDate'] ?? '' ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>
                <div class="col-md-4">
                <label for="providerSelect" class="form-label">Fournisseur</label>
                <select name="providerId" class="form-select" id="providerSelect">

                <?php foreach($params['providers'] as $key => $provider) : ?>
                    <option value="<?= $provider->id_provider ?>"><?= $provider->name_provider ?></option>
                <?php endforeach ?>

                </select>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>
                <div class="col-md-2">
                <label for="quantityContract" class="form-label">Quantité</label>
                <input type="number" min=0 id="quantityContract" name="quantity" value="<?= $_POST['quantity'] ?? '' ?>" class="form-control" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>

                <div class="col-md-6">
                <label for="productName" class="form-label">Désignation fournisseur</label>
                <input list="productName" type="text" id="productName" class="form-control" name="productName" value="<?= $_POST['productName'] ?? '' ?>" >
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>
                <div class="col-md-2">
                <label for="price" class="form-label">Prix</label>
                <div class="input-group mb-3">
                    <input type="number" min=0 step="0.01" id="price" name="price" class="form-control" value="<?= $_POST['price'] ?? '' ?>" required>
                    <div class="input-group-append">
                    <span class="input-group-text">€</span>
                    </div>
                </div>
                </div>
                <div class="col-12 d-flex my-3">
                    <button id="updateContractBtn" class="btn btn-sm btn-primary bgYellow px-3 d-none" type="submit" name="submitUpdateContract" value="" >Valider</button>
                    <button id="addContractBtn" class="btn btn-sm btn-primary bgYellow px-3" type="submit" name="submitAddContract">Ajouter</button>
                    <a data-bs-toggle="collapse" href="#collapseExample" role="button" class="btn btn-sm btn-outline-secondary px-3 ms-3" >Annuler</a>
                    <button id="deleteContractBtn" class="btn btn-sm btn-outline-danger px-3 d-none ms-auto" type="button" name="deleteAddContract" data-bs-toggle="modal" data-bs-target="#deleteContractModal" value="">Supprimer</button>
                </div>
                <input type="text" name="productId" value="<?= $params['product']->id_product_type ?>" hidden >
                <input type="text" id="contractIdUpdate" name="contractIdUpdate" value="" hidden >
            </form>
            </div>

<style>
    .product-list {
        background-color: #23282c;
        display: grid;
        grid-template-columns: 120px 120px 120px 120px 50px 50px 50px 1fr 80px 30px;
        border-radius: 0.5rem;
        border: 1px solid #e7e7e72e;
        padding: 0;
        margin: 0.5rem 0;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .header {
        display: grid;
        grid-template-columns: 120px 120px 120px 120px 50px 50px 50px 1fr 80px 30px;
        border-radius: 0.5rem;
        padding: 0;
        margin: 0.5rem 0;
        font-weight: lighter;
        color: #dedede;
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    .product-list:hover {
        background-color: #2c3235;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
        color: white;
    }
    
    .product-list li, .header li  {
        list-style: none;
        padding: 10px;
        font-weight: normal;
        color: #d4d4d4;
    }
    .name {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;

    }
</style>

<?php 
require '../views/product-nav.php'; ?>

    <ul class=" header">
        <li class="">Contrat</li>
        <li class="">Début</li>
        <li class="">Fin</li>
        <li class="">Fournisseur</li>
        <li class="">Qté</li>
        <li class="">Livré</li>
        <li class="">Solde</li>
        <li class=" name">Désignation</li>
        <li class="">Prix</li>
        <li class=""></li>
    </ul>
<?php
foreach($params['contracts'] as $contract) :
    if ($contract->solde > 0) : ?>
    <ul class="product-list" data-bs-toggle="modal" data-bs-target="#contractModal" data-id="<?= $contract->id_contract ?>" >
        <li class=""><?= $contract->reference_contract ?></li>
        <li class=""><?= $contract->DATE_START ?></li>
        <li class=""><?= $contract->DATE_END ?></li>
        <li class=""><?= $contract->name_provider ?></li>
        <li class=""><?= $contract->quantity_contract ?></li>
        <li class=""><?= $contract->delivered ?></li>
        <li class="stock"><?= $contract->solde ?></li>
        <li class=" name"><?= $contract->name_contract ?></li>
        <li class=""><?= $contract->price_contract ?>€</li>
        <li class=""><i class="bi bi-three-dots-vertical"></i></li>
    </ul>
<?php endif; endforeach; ?>
<p class="mt-3"><a id="toggleSoldeOutBtn" data-bs-toggle="collapse" href="#collapseSoldOut" role="button" class="btn btn-secondary">Contrat épuisé <span>&#9662</span></a></p>
<div class="collapse" id="collapseSoldOut">
<?php
foreach($params['contracts'] as $contract) :
    if ($contract->solde <= 0) : ?>
    <ul class="product-list" data-bs-toggle="modal" data-bs-target="#contractModal" data-id="<?= $contract->id_contract ?>" >
        <li class=""><?= $contract->reference_contract ?></li>
        <li class=""><?= $contract->DATE_START ?></li>
        <li class=""><?= $contract->DATE_END ?></li>
        <li class=""><?= $contract->name_provider ?></li>
        <li class=""><?= $contract->quantity_contract ?></li>
        <li class=""><?= $contract->delivered ?></li>
        <li class="stock"><?= $contract->solde ?></li>
        <li class=" name"><?= $contract->name_contract ?></li>
        <li class=""><?= $contract->price_contract ?>€</li>
        <li class=""><i class="bi bi-three-dots-vertical"></i></li>
    </ul>
<?php endif; endforeach; ?>

</div>
</div>


</section>



<script defer src="/public/assets/js/contract.js"></script>