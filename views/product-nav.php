<?php $activeTab = explode('/',ltrim($_SERVER['REQUEST_URI'],'/')); ?> 
<nav class="sub-nav">
  <ul>
    <li><a href="<?=  '/product/' . $params['product']->id_product_type ?? '' ?>" class="sub-nav-item <?= ($activeTab[2] ?? '') == "" ? 'active' : ''  ?>">état des contrats</a></li>
    <li><a href="<?= '/product/' . $params['product']->id_product_type . "/cover" ?>" class="sub-nav-item <?= ($activeTab[2] ?? '') == "cover" ? 'active' : ''  ?>">Consommation - Couverture</a></li>
    <li><a href="<?= '/product/' . $params['product']->id_product_type . "/description" ?>" class="sub-nav-item <?= ($activeTab[2] ?? '') == "description" ? 'active' : ''  ?>">Fiche produit</a></li>
    <li><a href="../views/couverture?ref=<?= $_GET['ref'] ?? '' ?>&page=orders" class="sub-nav-item <?= isset($_GET['page']) && $_GET['page'] == 'orders' ? 'active' : ''  ?>"></a></li>
    <!-- <li><a href="" class="sub-nav-item">Fiche produit</a></li> -->
  </ul>
</nav>