<?php $activeTab = explode('/',ltrim($_SERVER['REQUEST_URI'],'/')); ?> 
            
            <aside class="col-3">
                    <div class="stick">
                        <div class="brand d-none d-sm-block">COVER <span class="d-none d-lg-inline-block">coffee</span></div>
                        <nav id="navSide">
                            <a href="/" class="d-flex pages <?= ($activeTab[0] ?? '') == "" ? 'active' : ''  ?>">
                                <i class="bi bi-newspaper"></i>
                                <div class="ms-3 d-none d-lg-block">Accueil</div>
                            </a>
                            
                            <a href="/products" class="d-flex pages <?= !empty($_SESSION['user']) ? '' : 'd-none' ?>  <?= ($activeTab[0] ?? '') == "products" || ($activeTab[0] ?? '') == "product"  ? 'active' : ''  ?>">
                                <i class="bi bi-hdd-stack"></i>
                                <div class="ms-3 d-none d-lg-block">Produits</div>
                            </a>
                            <a href="../views/delivery.php" class="d-flex pages <?= !empty($_SESSION['user']) ? '' : 'd-none' ?>  <?= $_SERVER['SCRIPT_NAME'] == "/views/delivery.php" ? 'active' : ''  ?>">
                                <i class="bi bi-truck"></i>
                                <div class="ms-3 d-none d-lg-block">Livraison</div>
                            </a>
                            <!-- <a href="../views/about.php" class="d-flex pages <?= $_SERVER['SCRIPT_NAME'] == "/views/about.php" ? 'active' : ''  ?>">
                                <i class="bi bi-info-circle"></i>
                                <div class="ms-3 d-none d-lg-block">à propos</div>
                            </a> -->

                            <div id="plusPhone" class="d-md-none pages ms-auto plusPhone <?= !empty($_SESSION) ? '' : 'd-none' ?>">
                                <i class="bi bi-three-dots-vertical"></i>
                            </div>
                            <div id="userMenu" class="profilMenu2 <?= !empty($_SESSION['user']) ? '' : 'd-none' ?>">
                                <!-- <a href="../views/user.php?nickname=<?= $_SESSION['user']->USER_USERNAME ?? '' ?>" class="d-flex pages <?= $_SERVER['SCRIPT_NAME'] == "/views/user.php" ? 'active' : ''  ?>" >                                
                                    <i class="bi bi-person-lines-fill me-3"></i>  
                                    <div class="d-none d-lg-block">Profil</div>
                                </a>
                                <a href="../views/admin.php?news" class="<?= $user['STATUS_ROLE'] == 'administrateur' || $user['STATUS_ROLE'] == 'modérateur' ? 'd-block' : 'd-none' ?> d-flex pages <?= $_SERVER['SCRIPT_NAME'] == "/views/admin.php" ? 'active' : ''  ?>">
                                    <i class="bi bi-sliders me-3"></i>
                                    <div class="d-none d-lg-block">Administration</div>
                                </a> -->
                                <form method="post" action="/logout">
                                    <button name="logout" class="d-flex pages mb-0 mb-sm-3" value="logout">
                                        <i class="bi bi-box-arrow-left me-3"></i>
                                        <div class="d-none d-lg-block">Déconnexion</div>
                                    </button>
                                </form> 
                            </div> 
                        </nav>
                    </div>
            </aside>
            

                <script src="../assets/js/header.js"></script>