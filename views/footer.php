</main>
<!-- Modal -->
<div class="modal fade" id="contractModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <button type="button" id="editContract" class="btn btn-outline-success me-auto" data-bs-dismiss="modal" data-bs-toggle="collapse" href="#collapseExample">Modifier</button>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
        <div>
            <input type="hidden" id="contractId" name="contractId" value="">
            <input type="hidden" id="contractDate" name="contractDate" value="">
            <button type="submit" name="submitAddOrder" class="btn btn-success ps-2">Ajouter</button>
        </div>
      </div>
    </form>
  </div>
</div>

    <!-- delete Modal -->
    <div class="modal fade" id="deleteContractModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-dark">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="exampleModalLabel">Attention !</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Vous êtes sur le point de supprimer un contrat. <br> Toutes les commandes associés seront également supprimés.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
        <form action="" method="POST">
            <input type="hidden" id="modalContractId" name="contractId" value="">
            <button type="submit" name="submitDeleteContractModal" class="btn btn-danger">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal DISPO -->
<div class="modal fade" id="contractDispoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content text-dark" action="" method="POST">
            <div class="modal-header">
                <h5 class="modal-title">Commande en Dispo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column gap-3">
                    <div>
                        <label for="refContract" class="form-label">N°contrat</label>
                        <input type="text" id="refContract" class="form-control" value="dispo<?= $params['dispoDate']['date'] ?>" disabled>
                        <input type="text" name="refContract" class="form-control" value="dispo<?= $params['dispoDate']['date'] ?>" hidden>
                    </div>

                    <div>
                        <label for="productName" class="form-label">Désignation</label>
                        <input type="text" id="productName" name="nameContract" class="form-control" value="<?= $params['product']->name_product_type ?>">
                    </div>

                    <div>
                        <label for="trimestreSelect" class="form-label">Trimestre</label>
                        <select name="trimestre" class="form-select" id="trimestreSelect">
                            <?php for($i = 1; $i <= 4; $i++) { ?>
                            <option value="<?= $i ?> <?= $i == $params['dispoDate']['trimestre'] ? 'selected' : null ?>">T<?= $i ?><?= $params['dispoDate']['year'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div>
                        <label for="providerSelect" class="form-label">Fournisseur</label>
                        <select name="providerId" class="form-select" id="providerSelect">
                            <?php foreach($params['providers'] as $key => $provider) { ?>
                            <option value="<?= $provider->id_provider ?>"><?= $provider->name_provider ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div>
                        <label for="quantity" class="form-label">Quantité</label>
                        <input type="number" min=1 id="quantity" name="quantity" class="form-control" required>
                    </div>

                    <div>
                        <label for="price" class="form-label">Prix</label>
                        <div class="input-group mb-3">
                            <input type="number" min=0 step="0.01" id="price" name="price" class="form-control"
                                required>
                            <div class="input-group-append">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                <div>
                    <input type="hidden" name="productId" value="<?= $params['product']->id_product_type ?>">
                    <button type="submit" name="submitAddDispo" class="btn btn-success ps-2">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

