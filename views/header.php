<main class="col">
    <header>
        <div class="panierProfil contractPanier">
            <div class="cart" id="cart2">
                <i class="bi bi-card-heading fs-3"></i>
                <div
                    class="item-number <?= !isset($_SESSION['contract']) || count($_SESSION['contract']) == '0' ? "d-none" : "" ?>">
                    <?= isset($_SESSION['contract']) ? count($_SESSION['contract']) : null ?>
                </div>
            </div>
        </div>

        <div class="cart-card" id="cart-card2">
            <div class="title"><strong>Récapitulatif</strong></div>
            <div class="card-content">
                <?php
if (!isset($_SESSION['contract']) || empty($_SESSION['contract'])) { ?>
                <section>Vide</section>
                <?php }
if(isset($_SESSION['contract']) && !empty($_SESSION['contract'])) {
  foreach( $totalByProvider as $key => $provider) {
    $providerInfos = $provider->getProviderById($key);
    $name = $providerInfos->name_provider; ?>
                <div class="col mt-2 border-bottom">
                    <div class="text-uppercase fs-5"><?= $name ?></div>
                    <?php foreach($provider as $contract) { ?>
                    <div class="p-1 mb-1">
                        <a href="">
                            <section class="p-0 d-block text-dark">
                                <?= $contract ?>
                            </section>
                        </a>
                    </div>
                    <?php } ?>
                </div>

                <?php } }?>
                <a href="/views/contractCart.php" type="button" class="cartBtn text-center">Voir les contrats</a>
            </div>
        </div>


        <div class="panierProfil">
            <div class="cart" id="cart">
                <i class="bi bi-cart2 fs-3"></i>
                <div
                    class="item-number <?= !isset($_SESSION['order']) || count($_SESSION['order']) == '0' ? "d-none" : "" ?>">
                    <?= isset($_SESSION['order']) ? count($_SESSION['order']) : null  ?></div>
            </div>
        </div>

        <div class="cart-card" id="cart-card">
            <div class="title"><strong>Commande</strong></div>
            <div class="card-content">
                <?php
if ( !isset($_SESSION['order']) || empty($_SESSION['order'])) { ?>
                <section class="mx-3">Vide</section>
                <?php } elseif (isset($_SESSION['order'])){
            foreach ($_SESSION['order'] as $key => $value) { 
            $contractInfo = $product->getContractById($value['contractId']); ?>
            <div>
                <a href="<?= BASEURL ?>product/<?= $contractInfo->id_product_type ?>">
                    <section>
                        <div class="desc">
                            <div class="desc-title"><?= $contractInfo->name_contract ?></div>
                            <div class="price"><span><?= $value['quantity'] ?></span> Sacs</div>
                        </div>
                        <form action="<?= BASEURL ?>order/delete/<?= $key ?>" method="post" class="deleteForm">
                            <button type="submit" name="submitDeleteOrder"class="text-secondary"><i class="bi bi-x-circle"></i></button>
                            <input type="hidden" name="key" value="<?= $key ?>">
                        </form>
                    </section>
                </a>
                </div>
                <?php } } ?>
                <div class="m-2">
                    <a href="/order/cart" type="button" class="btn myCustomBtn w-100 text-center">Voir les commandes</a>
                </div>
            </div>
        </div>




        <!-- <input type="search" placeholder="Rechercher" class="d-none d-sm-block  me-auto"> -->
        <?php if (!isset($_SESSION['user'])) {  ?>
        <a href="/login" class="ms-auto">Se connecter</a>
        <?php } else { ?>
        <!--  <i class="bi bi-bell mx-3 "></i>
                    <i class="bi bi-chat-left-text"></i> -->


        <a href="../views/user.php?nickname=<?= $_SESSION['user']->USER_USERNAME ?? '' ?>" class="userInfos">
            <div class="wrapProfil">
                <div class="userName" id="userName"><?= $_SESSION['user']->USER_USERNAME  ?? '' ?></div>
                <div class="role"><?= $_SESSION['user']->STATUS_ROLE  ?? '' ?></div>
            </div>
            <img src="/public/assets/images/user_logo/<?= $_SESSION['user']->USER_LOGO ?>" class="profilLogo"
                id="profilLogo" alt="profil logo">
        </a>
        <?php } ?>
    </header>

    <script defer src="/public/assets/js/cartComponent.js"></script>
    <script defer src="/public/assets/js/contractCartComponent.js"></script>
