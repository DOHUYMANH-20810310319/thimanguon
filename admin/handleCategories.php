<?php
include '../db.php';
if (empty($_SESSION)) {
    session_start();
}
$sql = "SELECT idCategorie,desp_cat,idCat_parente FROM categorie";
$result = mysqli_query($con, $sql);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Espace Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./main.css" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                </div>
                                <img width="42" class="rounded-circle" src="assets/images/avatars/avatar-admin.png" alt="">
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php echo $_SESSION["userName"] . ' ' . $_SESSION["userFirstName"] ?>
                                    </div>
                                    <div class="widget-subheading">
                                        Admin
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Chung</li>
                            <li>
                                <a href="index.php">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                   Thông tin chung
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Thể loại</li>
                            <li>
                                <a href="addCategorie.php">
                                    <i class="metismenu-icon pe-7s-diamond"></i>
                                    Thêm danh mục
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                            </li>
                            <li>
                                <a href="handleCategories.php" class="mm-active">
                                    <i class="metismenu-icon pe-7s-car"></i>
                                    Quản lý danh mục
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Các sản phẩm</li>
                            <li>
                                <a href="addProduct.php">
                                    <i class="metismenu-icon pe-7s-eyedropper"></i>
                                    Thêm sản phẩm
                                </a>
                                <a href="handleProducts.php">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Quản lý sản phẩm
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Khách hàng</li>
                            <li>
                                <a href="handleClients.php">
                                    <i class="metismenu-icon pe-7s-mouse">
                                    </i>Quản lý khách hàng
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Đơn hàng</li>
                            <li>
                                <a href="handleSells.php">
                                    <i class="metismenu-icon pe-7s-graph2">
                                    </i>Quản lý đơn hàng
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Đăng xuất</li>
                            <li>
                                <a href="../destroy.php">
                                    <i class="metismenu-icon pe-7s-power">
                                    </i>Đăng xuất
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                                    </i>
                                </div>
                                <div>Quản lý danh mục
                                    <div class="page-title-subheading">Chỉnh sửa danh mục
                                    </div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <button type="button" data-toggle="tooltip" title="Espace Admin" data-placement="left" class="btn-shadow mr-3 btn btn-dark">
                                    <i class="fa fa-star"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">Tất cả danh mục</h5>
                                    <table class="mb-0 table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Loại</th>
                                                <th>Nhóm</th>
                                                <th>Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form method="POST" action="handleCategories.php">
                                                <?php
                                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                    $idCatParente = $row['idCat_parente'];
                                                    $queryCat = "SELECT categorie_idName('$idCatParente')";
                                                    $res1 = mysqli_query($con, $queryCat);
                                                    $tab = mysqli_fetch_array($res1);
                                                    $catParente = $tab[0];
                                                    $idC = $row['idCategorie'];
                                                    echo '
                                                    <tr>
                                                            <th scope="row">' . $row['idCategorie'] . '</th>
                                                            <td>' . $row['desp_cat'] . '</td>
                                                            <td>' . $catParente . '</td>';
                                                    $prodCat = "SELECT idProduit FROM produit WHERE idCategorie = $idC";
                                                    $resPC = mysqli_query($con, $prodCat);
                                                    $SCat = "SELECT idCategorie FROM categorie WHERE idCat_parente = $idC";
                                                    $resSC = mysqli_query($con, $SCat);
                                                    if (mysqli_num_rows($resPC) > 0  or mysqli_num_rows($resSC) > 0) {
                                                        echo '<th><button type="submit" name="supCat' . $row['idCategorie'] . '"  class="mb-2 mr-2 btn btn-danger disabled" disabled><i class="fa fa-fw" aria-hidden="true"></i></button></th>';
                                                    } else {
                                                        echo '<th><button type="submit" name="supCat' . $row['idCategorie'] . '"  class="mb-2 mr-2 btn btn-danger"><i class="fa fa-fw" aria-hidden="true"></i></button></th>';
                                                    }


                                                    echo '</tr>
                                                    ';
                                                    if (array_key_exists('supCat' . $row['idCategorie'], $_POST)) {
                                                        $delQuery = "DELETE FROM categorie WHERE idCategorie = $idC";
                                                        $resDel = mysqli_query($con, $delQuery); ?>
                                                        <script>
                                                            location.reload(true);
                                                        </script><?php
                                                                }
                                                            }
                                                                    ?>


                                        </tbody>
                                    </table>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-wrapper-footer">
        <div class="app-footer">
            <div class="app-footer__inner">
                <div class="app-footer-right">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link">
                                FANABLO
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>