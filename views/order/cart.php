<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/product.css">
    <title>Cover coffee</title>
</head>
<section class="team" id="teamScroll">
    <h1 class="text-uppercase">Commande</span></h1>
    <div class="container-fluid cardWrapper mt-3">
        <div class="productContainer">
            <div class="">
                <?php if (isset($_SESSION['order']) && !empty($_SESSION['order'])) { 
                    var_dump($this->getUniqueProvider());    

            foreach ($this->getUniqueProvider() as $keyP => $value) { ?>
                <div class=" mt-3">
                    <h2 class="text-uppercase fs-4"><?= $value->provider ?></h2>
                    <?php
                        foreach ($this->getTotalProvider() as $key => $value) { ?>
                    <div class="cart-content myCard p-3">
                        <a href="/views/contract.php?ref=<?= $contractInfo['reference_product_type'] ?>">
                            <section class="p-0">
                                <div class="desc">
                                    <div class="desc-title">
                                        <h3 class="nameContract"> <?= $contractInfo['name_contract'] ?></h3>
                                        <div class="price">Prix : <span><?= $price ?> €</span></div>
                                    </div>
                                    <div class="provider">
                                        <p class="nameProvider"> Fournisseur :
                                            <span><?= $contractInfo['name_provider'] ?></span></p>
                                        <p class="refContract"> Contrat :
                                            <span><?= $contractInfo['reference_contract'] ?></span></p>
                                    </div>
                                    <div class="product">
                                        <p class="refProduct">Produit :
                                            <span><?= $contractInfo['name_product_type'] ?></span></p>
                                        <p class="refProduct"> Référence :
                                            <span><?= $contractInfo['reference_product_type'] ?></span></p>
                                    </div>
                                    <footer>
                                        <div class="selectCart">
                                            Quantité :
                                            <form class="numberOrderSelect" action="" method="post">
                                                <input type="hidden" name="itemNumber" value="<?= $key ?>">
                                                <?php if (isset($value['type']) && $value['type'] == 'dispo') { ?>
                                                <input class="form-control" max="999" type="number"
                                                    name="updateOrderQuantity" min="1"
                                                    value="<?= $value['quantity'] ?>">
                                                <?php } else { ?>
                                                <select name="updateOrderQuantity" class="form-select">
                                                    <?php for ($i=1; $i <= $solde ; $i++) { ?>
                                                    <option value="<?= $i ?>"
                                                        <?= $value['quantity'] == $i ? 'selected' : '' ?>><?= $i ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <?php } ?>
                                            </form>
                                        </div>
                                        <form action="" method="post" class="deleteForm ">
                                            <button type="submit" name="submitDeleteOrder"
                                                class="text-light fw-light">Supprimer</button>
                                            <input type="hidden" name="key" value="<?= $key ?>">
                                        </form>
                                    </footer>

                                </div>

                            </section>
                        </a>
                    </div>
                    <?php } } } ?>

                </div>
                 } else {
  echo '<div class="myCard">Aucune commande en cours</div>';
} ?>

            </div>
        </div>
  <!--       <div class="totalContainer">
            <div class="p-3">
                <h4><span>Total :</span> <?= $totalPrice ?> €</h4>
                <hr>
                <?php foreach ($providerTotal as $key => $value) { ?>
                <p><?= $value['provider'] ?> : <span class="text-lowercase"> <?= $value['quantity'] ?>
                        <?= $value['quantity'] > 1 ? 'sacs' : 'sac' ?></span></p>
                <?php }
                            ?>
                <form class="d-flex" target="_blank" method="POST"
                    onsubmit="javascript: setTimeout(function(){window.location.href = window.location.href;}, 2000);return true;">
                    <button type="submit" class="btn btn-sm bgYellow mt-3 w-100" name="validation">Valider la
                        commande</button>
                </form>
            </div>
        </div> -->
    </div>
</section>
</main>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="contractModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content text-dark" action="" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modalBody"></p>
                <div class="d-flex gap-3">
                    <div class="select">
                        <label for="stockSelect" class="form-label">Quantité</label>
                        <select name="orderQuantity" class="form-select" id="stockSelect"></select>
                    </div>
                    <div class="price">
                        <label for="priceSelect" class="form-label">Prix</label>
                        <input type="text" id="pricePreview" class="form-control" disabled>
                    </div>
                    <div class="solde">
                        <label for="soldeSelect" class="form-label">Solde</label>
                        <input type="text" id="soldePreview" class="form-control" disabled>
                        <input type="hidden" id="solde" class="form-control" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                <div>
                    <input type="hidden" id="contractId" name="contractId" value="">
                    <input type="hidden" id="contractDate" name="contractDate" value="">
                    <button type="submit" name="submitAddOrder" class="btn btn-success ps-2"><i class="bi bi-plus"></i>
                        Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="matchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-dark">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Attention !</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Vous êtes sur le point de supprimer un match.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                <form action="" method="POST">
                    <input type="hidden" id="matchId" name="matchId" value="">
                    <button type="submit" name="submitDeleteMatch" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tournamentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-dark">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Attention !</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Vous êtes sur le point de supprimer un tournoi. <br> Tous les matchs associés seront également
                supprimés.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                <form action="" method="POST">
                    <input type="hidden" id="tournamentId" name="tournamentId" value="">
                    <button type="submit" name="submitDeleteTournament" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="position-fixed bottom-0 end-0 p-3 myToast" style="z-index: 110">
    <div id="liveToast" class="toast align-items-center text-white <?= $color ?? 'bg-success' ?> border-0" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <?= $success ?? '' ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
</div>


<!-- Script -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>
<!-- Masonry -->
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
    integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
</script>
<!-- page -->
<script src="../assets/js/comp.js"></script>
<script src="../assets/js/cart.js"></script>
<?php if(isset($success)){ ?>
<script>
    let myToast = new bootstrap.Toast(document.getElementById('liveToast'))
    myToast.show()
</script>
<?php }
/* if(isset($redirect)){?>
<script type="text/javascript">
    window.open('contractCart.php', '_blank');
</script>
<?php  }  */?>
</body>

</html>