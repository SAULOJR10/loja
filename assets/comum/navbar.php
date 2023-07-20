<div class="menu-top" style="display: flex; align-items: center;">
    <center style="width: 100%; position: relative">
        <a href="#">
            <img alt="Logo Prive Diversão" loading="lazy" class="logo" src="../ecommerce/assets/img/logo-navbar.webp">
        </a>
        <div style="display: flex; align-items: center; height: 60px; top: 0px; right: 0px; z-index: 9999; position: fixed; margin: 0px;">
            <p style="margin: 0px; margin-right: 15px;">
                <span style="color: #f68c16; font-weight: 700;"><?php echo explode(" ", $_SESSION['dados_usuario']['nome'])[0] ?></span>
                <img src="assets/img/user.svg" alt="" width="30px" style="margin-left: 5px;">
            </p>
        </div>
    </center>
</div>