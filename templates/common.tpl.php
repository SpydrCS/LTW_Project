<?php
    declare(strict_types = 1);
    include_once(__DIR__ . '/../templates/common.tpl.php');
?>
<link rel="stylesheet" href="../css/index.css"> <!-- Style of the header and the footer -->
<?php function drawHeader(Session $session) { ?>
    <!DOCTYPE html>
    <html lang="en">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MyFood</title>
    </head>
    <body>
        <header>
            <div class="container2" id="row">
                <?php if ($session->isLoggedIn()) { ?>
                    <a href= <?= "../pages/index.php?userUsername=" . $session->getName()?>>
                        <img src="../images/logo.png" alt="" width="70" height="70">
                    </a>
                    <a id="headerUsername" href= <?= "../pages/index.php?userUsername=" . $session->getName()?> class="hd-ttl">MyFood</a>
                <?php } 
                else { ?> 
                    <a href="../pages/index.php">
                        <img src="../images/logo.png" alt="" width="70" height="70">
                    </a>
                    <a id="headerLogo" href="../pages/index.php" class="hd-ttl">MyFood</a>
                <?php } ?>
            </div>
            <?php
                if ($session->isLoggedIn()) drawUsernameForm($session);
                else drawLoginForm();
            ?>
        </header>
        <?php drawCategoryMenu(); ?>
    <main>
<?php } ?>

<?php function drawFooter() { ?> 
    </main>
    <footer>
        <div class="all-content">
            <span class="rights">© 2022 MyFood  · All Rights Reserved</span>
            <div class="ft-txt">
                <a href="contact.html">Contacts</a>
                <a href="about.html">About Us</a>
            </div>
            <div class="back-top">
                <a href="#">Back to top</a>
            </div>
        </div>
    </footer>
    </body>
</html>
<?php } ?>

<?php function drawLoginForm() { ?>
    <div class="login">
        <i></i>
        <form action="../actions/action_login.php" method="post" class="login_form">
            <button type="submit" class="btn"><a href="../pages/login.php?error=-1">Login / Register</a></button>
        </form>
    </div>
<?php } ?>

<?php function drawUsernameForm(Session $session) { ?>
    <div class="username-div">
        <a href="../pages/shoppingCart.php"><i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 35px;"></i></a>
        <div class="img-name">
            <i class="material-icons" style="font-size: 30px;">account_circle</i>
            <a href=<?="../pages/profile.php?userId=" . $session->getId() . "&error=-1"?> class="user-name"><?=$session->getName()?></a>
        </div>
    </div>
<?php } ?>

<?php function drawCategoryMenu() { ?>
    <div class = "scroll_menu">
        <div class = "scroll2">
        <div class="category-name"><a href = "../pages/category.php?category=burgers">Burgers</a></div>
            <div class="category-name"><a href = "../pages/category.php?category=pizza">Pizza</a></div>
            <div class="category-name"><a href = "../pages/category.php?category=sandwiches">Sandwiches</a></div>
            <div class="category-name"><a href = "../pages/category.php?category=hot-dogs">Hot-Dogs</a></div>
            <div class="category-name"><a href = "../pages/category.php?category=sushi">Sushi</a></div>
            <div class="category-name"><a href = "../pages/category.php?category=soups">Soups</a></div>
            <div class="category-name"><a href = "../pages/category.php?category=fried">Fried</a></div>
            <div class="category-name"><a href = "../pages/category.php?category=vegetarian">Vegetarian</a></div>
            <div class="category-name"><a href = "../pages/category.php?category=mexican">Mexican</a></div>
            <div class="category-name"><a href = "../pages/category.php?category=portuguese">Portuguese</a></div>
            <div class="category-name"><a href = "../pages/category.php?category=drinks">Drinks</a></div>
            <div class="category-name"><a href = "../pages/category.php?category=desserts">Desserts</a></div>
        </div>
    </div>
<?php } ?>