<h1>Liste des produits</h1>

<div class="row g-3" >
    <nav class="productList">
        <ul>
        <?php foreach($params['products'] as $product){ ?>
            <li ><a href="/product/<?= $product->id_product_type ?>"><?= $product->reference_product_type ?> - <?= $product->name_product_type ?></a></li>
        <?php } ?>
        </ul>                  
    </nav>
</div>