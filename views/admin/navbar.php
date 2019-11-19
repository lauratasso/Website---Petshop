<script src="js/navbar.js"></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="../index.php">
        <img src="../images/logo.jpg" alt="logo" width="150px" height="50px">
    </a>
    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link btn-dark" href="../index.php">
                    <i class="fas fa-home"> Home</i>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link btn-dark" href="../cart.php">
                    <i class="fas fa-shopping-cart"> Carrinho</i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle btn-dark" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="fas fa-user"> Usuário</i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../login.php">Login</a>
                    <a class="dropdown-item" href="../register-user.php">Cadastro</a>
                    <div id="area-cliente">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../complete-purchase.php">Concluir pedido</a>
                        <a class="dropdown-item" href="../customer-orders.php">Meus pedidos</a>
                        <a class="dropdown-item" href="../edit-user.php">Meus dados</a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" onclick="logout()">Logout</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="../search.php" method="GET">
            <input class="form-control mr-sm-2" id="consulta" name="consulta" type="search" placeholder="Pesquisar" aria-label="Pesquisar" id="pesquisar">
            <button class="btn btn-danger my-2 my-sm-0" role="button" onclick="buscar()">
                 <img src="../images/lupa.png" id="imglupa" style="width: 25px;">
            </button>
        </form>
    </div>
</nav>