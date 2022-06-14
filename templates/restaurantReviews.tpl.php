<?php
    declare(strict_types = 1); 
    require_once('../database/restaurant.class.php');
    require_once('../templates/plate.tpl.php');
    require_once('../database/user.class.php');
?>

<?php function drawComments(int $restaurantId, array $comments) {
    $db = getDatabaseConnection();
    foreach ($comments as $comment) {
        $client = User::getUser($db, $comment['idClient']);
        $owner = User::getUser($db, $comment['idOwner']); ?>
        <p><?=$client->username?> (<?=$comment['submissonDate']?> - <?=$comment['submissonHour']?>)</p>
        <p><?=$comment['comment']?></p>
        <?php if ($comment['answer'] != '') { ?>
            <p><?=$owner->username?></p>
            <p><?=$comment['answer']?></p>
        <?php }?>
    <?php } ?>
<?php } ?>

<?php function restaurantDiv(Restaurant $restaurant) { ?>
    <div class="plate">
        <a href=<?php echo "../pages/restaurant.php?id=" . $restaurant->id?>><img src="../images/restaurantImg.png"></a>
        <p><?=$restaurant->name?></p>
    </div>
<?php } ?>

<?php function drawFavoriteRestaurant(Restaurant $restaurant, float $restaurantGrade) { ?>
    <section class="favorite-restaurant">
        <img src="../images/restaurantImg.png">
        <p><?=$restaurant->name?></p>
        <p><?=$restaurantGrade?></p>
    </section>
<?php }?>