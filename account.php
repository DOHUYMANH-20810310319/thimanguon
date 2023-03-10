<?php

include 'db.php';
include 'functions.php';
if (empty($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["id_user"]))
    header('Location: index.php');

$query = "SELECT * FROM client WHERE (idClient = " . $_SESSION['id_user'] . ")";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);


?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Projet Web</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">

    <link rel="stylesheet" type="text/css" href="css/rating.css">


    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/account.js"></script>
    <script src="js/wishlist.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <div class="wrapper fixed__footer">
        <!-- Start Header Style -->
        <header id="header" class="htc-header header--3 bg__white">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="images/logo/logo.png" alt="logo">
                                </a>
                            </div>
                        </div>
                        <!-- Start MAinmenu Ares -->
                        <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                            <nav class="mainmenu__nav hidden-xs hidden-sm">
                                <ul class="main__menu">
                                    <li class="drop"><a href="index.php">Trang ch???</a></li>

                                    <li class="drop"><a href="shop.php">S???n ph???m</a>
                                    </li>
                                    <li><a href="help.php">H??? tr???</a></li>
                                    <li><a href="contact.php">Li??n h???</a></li>
                                    <?php if (isset($_SESSION["id_user"])) echo '<li><a href="destroy.php">????ng xu???t</a></li>'; ?>
                                    <!-- End Single Mega MEnu -->
                                    <!-- Start Single Mega MEnu -->
                                </ul>
                            </nav>
                            <div class="mobile-menu clearfix visible-xs visible-sm">
                                <nav id="mobile_dropdown">
                                    <ul>
                                        <li><a href="index.php">Trang ch???</a></li>
                                        <li><a href="shop.php">S???n ph???m</a></li>
                                        <li><a href="help.php">H??? tr???</a></li>
                                        <li><a href="contact.php">Li??n h???</a></li>
                                        <?php if (isset($_SESSION["id_user"])) echo '<li><a href="destroy.php">????ng xu???t</a></li>'; ?>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- End MAinmenu Ares -->
                        <div class="col-md-2 col-sm-4 col-xs-3">
                            <ul class="menu-extra">
                                <li class="search search__open hidden-xs"><span class="ti-search"></span></li>
                                <?php
                                if (isset($_SESSION["id_user"])) {
                                    echo '<li><a href="account.php"><span class="ti-user">' . $_SESSION["userFirstName"] . '</span></a></li>';
                                } else {
                                    echo '<li><a href="login-register.php"><span class="ti-user">Login</span></a></li>';
                                }
                                ?>

                                <?php if (isset($_SESSION["id_user"]))
                                    echo '<li class="cart__menu"><span class="ti-shopping-cart"></span><span class="cart-counter">' . $_SESSION["cartItems"] . '</span></li>';
                                else
                                    echo '<li class="cart__menu"><a href="cart_logged_out.php"><span class="ti-shopping-cart"></span><span class="cart-counter">' . $_SESSION["cartItems"] . '</span></a></li>';
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Style -->
        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form action="#" method="get">
                                    <input placeholder="Search here... " type="text">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
            <!-- Start Cart Panel -->
               <?php if (isset($_SESSION["id_user"])) {
                echo
                '<div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">';

                $total_prix = 0;
                $query = mysqli_query($con, "SELECT * from panier_produits join produit on produit.idProduit=panier_produits.idProduit where idClient= " . $_SESSION["id_user"] . " ");
                $num_Line = mysqli_num_rows($query);
                if ($num_Line == 0) echo ' <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title"></h2>
                                <nav class="bradcaump-inner">
                                    <span class="breadcrumb-item active">Votre panier est vide !</span>
                                    <a class="continuer" href="index.php">Continuer vos achats</a>                                    
                                </nav>
                            </div>';
                if($num_Line>=1){
                echo '<ul id="ticker">';
                while ($rowp = mysqli_fetch_array($query)) {
                    $image = $rowp["img_prod"];
                    $prix = $rowp['prix'] * (1 - $rowp['promo'] / 100);
                    $total_prix += $prix * $rowp['quantite'];
                    echo '
                            <li> <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="product-details.php?idprod=' . $rowp['idProduit'] . '">
                                    <img src="images/' . $image . '" alt="product images" style="width:265px;Height:67px;">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.php?idprod=' . $rowp['idProduit'] . '" style="text-transform: uppercase;">' . $rowp['nom_prod'] . '</a></h2>
                                <span class="quantity">S??? l?????ng: ' . $rowp['quantite'] . '</span>
                                <span class="shp__price">Gi?? : ' . $prix . ' VND</span>
                            </div>
                           
                        </div></li>';
                }

                echo '</ul>
                    </div>
                    ';
                    } echo'
                    <ul class="shoping__total">
                        <li class="subtotal">T???ng ti???n</li>
                        <li class="total__price">' . $total_prix . ' VND</li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart_logged_in.php">Xem gi??? h??ng</a></li>
                    </ul>
                </div>
            </div>';

            } ?>
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Mon compte</h2>
                                <nav class="bradcaump-inner">
                                    <a class="breadcrumb-item" href="index.php">Trang ch???</a>
                                    <span class="brd-separetor">></span>
                                    <span class="breadcrumb-item active">Mon compte</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->

        <!-- Start Product tab -->
        <section class="htc__product__details__tab bg__white pb--120">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <br>
                        <ul class="product__deatils__tab mb--60" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#description" role="tab" data-toggle="tab">Mon profil</a>
                            </li>
                            <li role="presentation">
                                <a href="#reviews" role="tab" data-toggle="tab">Mes avis en attente</a>
                            </li>
                            <li role="presentation">
                                <a href="#orders" role="tab" data-toggle="tab">Ma liste d'envies</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="product__details__tab__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="product__tab__content fade in active">

                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                            <div class="product__details__container">

                                                <div class="product__big__images">
                                                    <div class="portfolio-full-image tab-content">
                                                        <div role="tabpanel" class="tab-pane fade in active product-video-position" id="img-tab-1">
                                                            <img src="images/user_img.png" alt="full-image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
                                            <div class="htc__product__details__inner">

                                                <form id="account-form" method="post" action="" role="form">
                                                    <div class="checkout-form">
                                                        <h2 class="section-title-3">Informations personnelles</h2>

                                                        <div class="checkout-form-inner">

                                                            <div class="single-checkout-box">

                                                                <h3>Pr??nom</h3>
                                                                <input style="margin-top:10px;" name="lastName" id="lastName" type="text" placeholder="Nom" value="<?php echo $row["nom"]; ?>" required>
                                                            </div>
                                                            <div class="single-checkout-box">
                                                                <h3>Nom</h3>
                                                                <input style="margin-top:10px;" name="firstName" id="firstName" type="text" placeholder="Prenom" value="<?php echo $row["prenom"]; ?>" required>
                                                            </div>
                                                            <div class="single-checkout-box">
                                                                <h3>Email</h3>
                                                                <input style="margin-top:10px;" name="email" id="email" type="text" placeholder="email" value="<?php echo $row["email"]; ?>" required>
                                                                <span id="email-status" class="comments"></span>
                                                            </div>
                                                            <div class="single-checkout-box">
                                                                <h3>T??l??phone</h3>
                                                                <input style="margin-top:10px;" name="tel" id="tel" type="text" placeholder="tel" value="<?php echo $row["tel"]; ?>">
                                                                <span id="tel-status" class="comments"></span>
                                                            </div>
                                                            <ul class="pro__dtl__btn" style="margin-bottom:10px;">
                                                                <li class="buy__now__btn"><input type="submit" class="form-submit" value="Enregistrer" /></li>
                                                            </ul>
                                                            <span id="account-status" class="comments"></span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content -->

                            <!-- Start Single Content -->
                            <div role="tabpanel" id="reviews" class="product__tab__content fade">
                                <div class="review__address__inner" >
                                    <!-- Start Single Review -->
                                    <?php
                                    $query = "SELECT * FROM commande JOIN commande_produits ON commande.idCommande = commande_produits.idCommande JOIN produit ON commande_produits.idProduit = produit.idProduit  WHERE (idClient = " . $_SESSION['id_user'] . ")";
                                    $result2 = mysqli_query($con, $query);
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        echo '<div class="pro__review style="margin: 0 auto;">
                                        <div class="review__thumb">
                                            <img src="images/' . $row2["img_prod"] . '" alt="review images" style="height:88px; width:99px;">
                                        </div>
                                        <div class="review__details"  style="width:400px;">
                                            <div class="review__info">
                                            <br>
                                                <h4><a href="product-details.php?idprod='.$row2["idProduit"]. '">' . $row2["nom_prod"] . '</a></h4>
                                            
                                            </div>
                                            <div class="review__date">
                                                <span>Command?? le ' . date('j', strtotime($row2["date_cmd"])) . ' ' . date('M', strtotime($row2["date_cmd"])) . ', ' . date('Y', strtotime($row2["date_cmd"])) . ' ?? ' . date('H:i', strtotime($row2["date_cmd"])) . '</span>
                                            </div>
                                           
                                        </div>
                                        
                                        <div class="rating__send" style="margin-top: 30px;">
                                            <a data-toggle="modal" data-target="#productModal" title="Quick View" class="quick-view modal-view detail-link" href="#"><i class="zmdi zmdi-star"></i></a>
                                                
                                        </div>
                                    </div><br>
                                    <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal__container" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-product">
                                                         <!-- Start RAting Area -->
                                                         <div class="rating__wrap">
                                                                <h2 class="rating-title">Write  A review</h2><br>
                                                                <h4 class="rating-title-2">Your Rating</h4>
                            
                                                                <form action="sendReview.php" method="POST">
                                                                <div class="rate">
                                                                    <input type="radio" id="star5" name="rate" value="5" />
                                                                    <label for="star5" title="5 stars"></label>
                                                                    <input type="radio" id="star4" name="rate" value="4" />
                                                                    <label for="star4" title="4 stars"></label>
                                                                    <input type="radio" id="star3" name="rate" value="3" />
                                                                    <label for="star3" title="3 stars"></label>
                                                                    <input type="radio" id="star2" name="rate" value="2" />
                                                                    <label for="star2" title="2 stars"></label>
                                                                    <input type="radio" id="star1" name="rate" value="1" required/>
                                                                    <label for="star1" title="1 star"></label>
                                                                </div>                                
                                                            </div>
                                                                <input type="text" name="idProd" value="'.$row2["idProduit"].'" style = "display : none"/>
                                                            </div>
                                                            <div class="review__box">
                                                                    <div class="single-review-form">
                                                                        <div class="review-box message">
                                                                            <textarea name="review" placeholder="Write your review" required></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="review-btn">
                                                                        <input type="submit" class="fv-btn" value="submit review">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    ';
                                    }
                                    ?>
                                    <!-- End Single Review -->
                                </div>
                                <div id="quickview-wrapper">

    </div>
                            </div>
                            <!-- End Single Content -->

                            <!-- Start Single Content -->
                            <div role="tabpanel" id="orders" class="product__tab__content fade in">
                                <!-- cart-main-area start -->
                                <?php
                                $query = "SELECT * FROM envie NATURAL JOIN produit  WHERE (idClient = " . $_SESSION['id_user'] . ")";
                                $result = mysqli_query($con, $query);

                                if (mysqli_num_rows($result) == 0) {
                                    echo '   <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
                                            <div class="ht__bradcaump__wrap">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="bradcaump__inner text-center">
                                                                <nav class="bradcaump-inner">
                                                                    <span class="breadcrumb-item active">Votre liste d\'envies est vide !</span>
                                                                    <a class="continuer" href="index.php">Continuer vos achats</a>  
                                                                </nav>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                } else {
                                    echo '<div id="wishlist" class="cart-main-area ptb--120 bg__white">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
            
                                                    <div class="table-content table-responsive">';

                                    echo '<table>
                                                            <thead>
                                                                <tr>
                                                                    <th class="product-thumbnail">Image</th>
                                                                    <th class="product-name">Produit</th>
                                                                    <th class="product-price">Prix</th>
                                                                    <th class="product-subtotal">Ajouter au panier</th>
                                                                    <th class="product-remove">Supprimer</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>';
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo '<tr>';
                                                                echo '<td class="product-thumbnail"><a href="product-details.php?idprod=' . $row["idProduit"] . '"><img src="images/' . $row['img_prod'] . '" alt="image produit" /></a></td>';
                                                                echo '<td class="product-name"><a href="product-details.php?idprod=' . $row["idProduit"] . '">' . $row['nom_prod'] . '</a></td>';
                                                                echo '<td class="product-price"><span class="amount">' . $row["prix"] * (1 - $row["promo"] / 100) . ' VND</span></td>';
                                                                echo '<td class="product-subtotal">';
                                                                if($row["stock"] > 0){
                                                                    
                                                                        echo'<form class="add-wish" method="post" action="" role="form">
                                                                            <a href="#/"><span class="ti-shopping-cart" style="font-size: 25px;"></span></a>
                                                                            <input type="text" style="display: none;" name="id_product" value="' . $row['idProduit'] . '" />
                                                                        </form>';
    
                                                                    
                                                                }
                                                                else{
                                                                         echo '<span class="comments">Produit ??puis??</span>';
                                                                }
                                                                echo '</td>';
                                        echo '<td class="product-remove">
                                                                    <form class="remove-wish" method="post" action="" role="form">
                                                                        <a href="#/"><span class="ti-trash" style="font-size: 25px;"></span></a>
                                                                        <input type="text" style="display: none;" name="id_product" value="' . $row['idProduit'] . '" />
                                                                    </form>
                                                                </td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>
                                                        </table>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8 col-sm-7 col-xs-12">
                                                            <div class="buttons-cart">
                                                                <input type="submit" value="Vider la liste d\'envies" />
                                                                <a href="index.php">Continuez vos achats</a>
                                                            </div>

                                                        </div>

                                                    </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                }
                                ?>
                                <!-- cart-main-area end -->
                            </div>
                            <!-- End Single Content -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product tab -->
        <!-- Start Footer Area -->
        <footer class="htc__foooter__area gray-bg">
            <div class="container">
                <div class="row">
                    <div class="footer__container clearfix">
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="ft__widget">
                                <div class="ft__logo">
                                    <a href="index.php">
                                        <img src="images/logo/logo.png" alt="footer logo">
                                    </a>
                                </div>
                                <div class="footer-address">
                                    <ul>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-pin"></i>
                                            </div>
                                            <div class="address-text">
                                                <p>194 Main Rd T, FS Rayed <br> VIC 3057, USA</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-email"></i>
                                            </div>
                                            <div class="address-text">
                                                <a href="#"> info@exemple.com</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-phone-in-talk"></i>
                                            </div>
                                            <div class="address-text">
                                                <p>+012 345 678 102 </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="social__icon">
                                    <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-lg-2 col-sm-6 smt-30 xmt-30">
                            <div class="ft__widget">
                                <h2 class="ft__title">Cat??gories</h2>
                                <ul class="footer-categories">
                                    <li><a href="shop-sidebar.html">Composants</a></li>
                                    <li><a href="shop-sidebar.html">P??riph??riques</a></li>
                                    <li><a href="shop-sidebar.html">PC portables</a></li>
                                    <li><a href="shop-sidebar.html">PC gamer</a></li>
                                    <li><a href="shop-sidebar.html">Processeurs</a></li>
                                    <li><a href="shop-sidebar.html">Stockage</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-lg-2 col-sm-6 smt-30 xmt-30">
                            <div class="ft__widget">
                                <h2 class="ft__title">Infomation</h2>
                                <ul class="footer-categories">
                                    <li><a href="about.html">?? Propos De Nous</a></li>
                                    <li><a href="contact.html">Nous Contacter</a></li>
                                    <li><a href="#">Termes & Conditions</a></li>
                                    <li><a href="#">Retours & ??changes</a></li>
                                    <li><a href="#">Facturation & Livraison</a></li>
                                    <li><a href="#"> Politique De Confidentialit??</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-lg-3 col-lg-offset-1 col-sm-6 smt-30 xmt-30">
                            <div class="ft__widget">
                                <h2 class="ft__title">Newsletter</h2>
                                <div class="newsletter__form">
                                    <p>Inscrivez-vous ?? notre newsletter et obtenez 10% de r??duction sur votre premier achat.</p>
                                    <div class="input__box">
                                        <div id="mc_embed_signup">
                                            <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                                <div id="mc_embed_signup_scroll" class="htc__news__inner">
                                                    <div class="news__input">
                                                        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Adresse mail" required>
                                                    </div>
                                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                                    <div class="clearfix subscribe__btn"><input type="submit" value="Send" name="subscribe" id="mc-embedded-subscribe" class="bst__btn btn--white__color">

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->
                    </div>
                </div>
                <!-- Start Copyright Area -->
                <div class="htc__copyright__area">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="copyright__inner">
                                <div class="copyright">
                                    <p>?? 2022 <a href="#">Ph??t tri???n b???i M???nh v?? L??m</a>
                                        </p>
                                </div>
                                <ul class="footer__menu">
                                    <li><a href="index.php">Trang ch???</a></li>
                                    <li><a href="shop.php">S???n ph???m</a></li>
                                    <li><a href="contact.php">Li??n h???</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Copyright Area -->
            </div>
        </footer>
        <!-- End Footer Area -->
    </div>
    <!-- Body main wrapper end -->
    <!-- QUICKVIEW PRODUCT -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal__container" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <!-- Start product images -->
                            <div class="product-images">
                                <div class="main-image images">
                                    <img alt="big images" src="images/product/big-img/1.jpg">
                                </div>
                            </div>
                            <!-- end product images -->
                            <div class="product-info">
                                <h1>Simple Fabric Bags</h1>
                                <div class="rating__and__review">
                                    <ul class="rating">
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                    </ul>
                                    <div class="review">
                                        <a href="#">4 customer reviews</a>
                                    </div>
                                </div>
                                <div class="price-box-3">
                                    <div class="s-price-box">
                                        <span class="new-price">$17.20</span>
                                        <span class="old-price">$45.00</span>
                                    </div>
                                </div>
                                <div class="quick-desc">
                                    Designed for simplicity and made from high quality materials. Its sleek geometry and material combinations creates a modern look.
                                </div>
                                <div class="select__color">
                                    <h2>Select color</h2>
                                    <ul class="color__list">
                                        <li class="red"><a title="Red" href="#">Red</a></li>
                                        <li class="gold"><a title="Gold" href="#">Gold</a></li>
                                        <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                        <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                    </ul>
                                </div>
                                <div class="select__size">
                                    <h2>Select size</h2>
                                    <ul class="color__list">
                                        <li class="l__size"><a title="L" href="#">L</a></li>
                                        <li class="m__size"><a title="M" href="#">M</a></li>
                                        <li class="s__size"><a title="S" href="#">S</a></li>
                                        <li class="xl__size"><a title="XL" href="#">XL</a></li>
                                        <li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
                                    </ul>
                                </div>
                                <div class="social-sharing">
                                    <div class="widget widget_socialsharing_widget">
                                        <h3 class="widget-title-modal">Share this product</h3>
                                        <ul class="social-icons">
                                            <li><a target="_blank" title="rss" href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                                            <li><a target="_blank" title="Linkedin" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                                            <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                            <li><a target="_blank" title="Tumblr" href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
                                            <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="addtocart-btn">
                                    <a href="#">Add to cart</a>
                                </div>
                            </div><!-- .product-info -->
                        </div><!-- .modal-product -->
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div>
        <!-- END Modal -->
    </div>
    <!-- END QUICKVIEW PRODUCT -->
    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="js/vendor/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!-- Waypoints.min.js. -->
    <script src="js/waypoints.min.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script>
    <script>
      const btn = document.querySelector("button");
      const post = document.querySelector(".post");
      const widget = document.querySelector(".star-widget");
      const editBtn = document.querySelector(".edit");
      btn.onclick = ()=>{
        widget.style.display = "none";
        post.style.display = "block";
        editBtn.onclick = ()=>{
          widget.style.display = "block";
          post.style.display = "none";
        }
        return false;
      }
    </script>

</body>

</html>