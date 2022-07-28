<section>
    <div class="container-fluid px-1 px-md-2">
        <div class="title d-flex align-items-center fw-bold">
            <h1 class="text-uppercase">Produits</h1>
            <p><a data-bs-toggle="collapse" href="#collapseExample" role="button" class="btn myCustomBtn-outline">Ajouer un produit</a></p>
            <form class="searchMember ms-5" action="" method="POST">
                <input type="text" id="searchMember" name="searchMember" placeholder="Recherche">
            </form>
        </div>

        <div class="collapse" id="collapseExample">
            <h2 class="fs-6 text-white active mt-4 mb-3">Nouveau produit</h2>
            <form class="row g-3 my-2" method="POST">
                <div class="col-md-4">
                    <label for="nameProduct" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" id="nameProduct" name="nameProduct" value="<?= $_POST['nameProduct'] ?? '' ?>" required>
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-4">
                    <label for="refProduct" class="form-label">Référence</label>
                    <input type="text" class="form-control" id="refProduct" name="refProduct" value="<?= $_POST['refProduct'] ?? '' ?>" required>
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-12 d-flex my-3">
                    <button class="btn btn-sm btn-primary bgYellow px-3" type="submit" name="submitAddProduct">Ajouter</button>
                    <a data-bs-toggle="collapse" href="#collapseExample" role="button" class="btn btn-sm btn-outline-secondary px-3 ms-3" >Annuler</a>
                </div>
            </form>
        </div>

        <div class="row g-3" >
            <nav class="productList">
                <ul>
                <?php foreach($params['products'] as $product){ ?>
                    <li ><a href="/product/<?= $product->id_product_type ?>"><?= $product->reference_product_type ?> - <?= $product->name_product_type ?></a></li>
                <?php } ?>
                </ul>                  
            </nav>
        </div>

    </div>
</section>

<script src="/public/assets/js/product.js"></script>