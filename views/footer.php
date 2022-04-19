</main>
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
        <button type="button" id="editCont>ract" class="btn btn-outline-success me-auto" data-bs-dismiss="modal" data-bs-toggle="collapse" href="#collapseExample">Modifier</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
