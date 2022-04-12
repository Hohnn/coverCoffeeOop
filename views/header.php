<main class="col " data-bs-spy="scroll" data-bs-target="#navSide" data-bs-offset="0" tabindex="0">
            <header>
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
                        <img src="/public/assets/images/user_logo/<?= $_SESSION['user']->USER_LOGO ?>" class="profilLogo" id="profilLogo" alt="profil logo">
                    </a>
<?php } ?>
                </header>