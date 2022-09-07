<section> 
    <div class="container-fluid px-1 px-md-2">
        <div class="d-flex align-items-start">
            <h1>Accueil</h1>
        </div>
        <div class="row mt-4 g-3">
            <div class="col-6 d-flex ">
                <div class="card p-3 flex-grow-1 bgSoftBleu">
                    <div class="d-flex">
                        <h2>Taux d'échange</h2>
                        <span id="refreshTrade" class="ms-auto load"><i class="bi bi-arrow-clockwise"></i></span>
                    </div>
                    <ul id="exchangeData"></ul>
                </div>
            </div>
            <div class="col-6 d-flex" id="exchangeCurrency">
                <div class="card p-3 flex-grow-1 bgSoftBleu">
                    <div class="d-flex">
                        <h2>Taux de change</h2>
                        <span id="refreshChange" class="ms-auto load"><i class="bi bi-arrow-clockwise"></i></span>
                    </div>
                    <h3> <span id="current">...</span> / <span id="compare">...</span></h3>
                    <div>
                        <span id="value">-</span><span id="currency">-</span> <span id="parcent">-%</span>
                        <p class="desc">Valeur indicative: <span>1.0000€</span></p>
                    </div>
                </div>
            </div>
            <div class="col-6 d-flex ">
                <div class="card p-3 flex-grow-1 bgSoftBleu">
                    <div class="d-flex">
                        <h2>Arabica</h2>
                        <span id="refreshArabica" class="ms-auto load"><i class="bi bi-arrow-clockwise"></i></span>
                    </div>
                    <ul id="arabicaData"></ul>
                </div>
            </div>
            <div class="col-6 d-flex ">
                <div class="card p-3 flex-grow-1 bgSoftBleu">
                    <div class="d-flex">
                        <h2>Robusta</h2>
                        <span id="refreshRobusta" class="ms-auto load"><i class="bi bi-arrow-clockwise"></i></span>
                    </div>
                    <ul id="robustaData"></ul>
                </div>
            </div>
        </div>
    </div>
</section> 



<script defer src="./public/assets/js/home.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>