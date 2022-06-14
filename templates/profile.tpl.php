<?php
    declare(strict_types = 1); 
    //require_once(__DIR__ . '/../database/plate.class.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/pedido.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
?>

<?php function drawTitles() { ?>
    <div class="max">
        <div class="main-titles">
            <a href="javascript:void(0)" onclick="new_func(1)">
                <div class="my-profile flex">
                    <i class="material-icons">assignment_ind</i>
                    <button type="button" class="ttl-btn" id="prof-btn" onclick="new_func(1)">My Profile</button>
                </div>
            </a>
            <?php if (1 == 1) { ?> <!-- User is a client -->
                <a href="javascript:void(0)" onclick="new_func(2)">
                    <div class="my-addresses flex">
                        <i class="material-icons">place</i>
                        <button type="button" class="ttl-btn" id="addr-btn" onclick="new_func(2)">My Adresses</button>
                    </div>
                </a>
            <?php }
            else { ?>
                <a href="javascript:void(0)" onclick="new_func(2)">
                    <div class="my-addresses flex">
                        <i class="material-icons">building</i>
                        <button type="button" class="ttl-btn" id="addr-btn" onclick="new_func(2)">My Restaurats</button>
                    </div>
                </a>
            <?php } ?>
                
            <a href="javascript:void(0)" onclick="new_func(3)">
                <div class="my-orders flex">
                    <i class="material-icons">business_center</i>
                    <button type="button" class="ttl-btn" id="order-btn" onclick="new_func(3)">My Orders</button>
                </div>
            </a>
            <a href="javascript:void(0)" onclick="new_func(4)">
                <div class="my-favorites flex">
                    <i class="material-icons">star</i>
                    <button type="button" class="ttl-btn" id="fav-btn" onclick="new_func(4)">My Favorites</button>
                </div>
            </a>
        </div>
<?php } ?>

<?php function drawMyProfile(PDO $db, User $user, array $userAddresses, array $userOrders, array $favoriteRestaurants, int $error) {
    $userProfilePic = $user->profilePic;
    $userUsername = $user->username;
    $userPassword = $user->password;
    $userName = $user->name;
    $userAge = $user->age;
    $userNIF = $user->nif;
    $userPhone = $user->phone;
    $userAddress = $user->address;
    //$client = $user->client;

    ?>
        <div class="my-profile-div center show" id="my-profile-div">
            <div class="change-info">
            <div class="usr-info">
                <img src="<?=$userProfilePic?>" width=150>
                <h2><?=ucwords($userName)?></h2>
            </div> 
            <div class="my-profile-div">
                <form action="../actions/action_edit_profile.php" method="post">
                    <p><label for="newPassword">Step 1) Insert Your Old Password*</label></p>
                    <input type="password" placeholder="Old Password" name="oldPassword"><p>
                    <p>Step 2) Change Your Personal Info</p>
                    <p><label for="name">Change Name:</label>
                    <input type="text" id="name" name="name" class="form-control form-control-filled" autocorrect="off" autocomplete="off" autocapitalize="off" placeholder="<?php echo $userName?>"></p>
                    <p><label for="username">Change Username: </label>
                    <input type="text" id="username" name="username" class="form-control form-control-filled" autocorrect="off" autocomplete="off" autocapitalize="off" placeholder="<?php echo $userUsername?>">
                    <p><label for="phone">Change Phone Number:</label>
                    <input type="text" placeholder="<?php echo $userPhone?>" name="phone" class="form-control form-control-filled" autocorrect="off" autocomplete="off" autocapitalize="off"></p>
                    <p><label for="newPassword">Change Your Password:</label>
                    <input type="password" placeholder="New Password" name="newPassword"></p>
                    <?php if ($error == 0) { ?>
                        <span class="error-message">Changes saved successfully!</span>
                    <?php }
                    else if ($error == 1) { ?>
                        <span class="error-message">Wrong password! Please try again</span>
                    <?php } 
                    else if ($error == 2) { ?>
                        <p>Please, fill in all mandatory fields.</p>
                    <?php } ?>
                    <button type="submit" class="btn-save-changes">Save changes</button>
                </form>
                <form action="../actions/action_logout.php" method="post" class="logout">
                    <button type="submit">Logout</button>
                </form>
            </div>
            </div>
        </div>
        <?php 
            $user = User::getUser($db, $user->id);
            if (1 == 1) { ?> <!-- User it's a client -->
                <div class="my-addresses-div center hidden" id="my-addresses-div">
                    <div class="both">
                        <div class="new-address-div">
                            <button><img src="../images/plus-address.png" width=20> Add new address</button>
                            <form action=<?="../actions/action_add_new_address.php"?> method="post">
                                <p><label for="new-address">Insert your new address</label></p>
                                <input type="text" placeholder="New address" name="new-address" class="diactivated"></p>
                                <button type="submit" class="btn-save-changes">Save changes</button>
                            </form>
                        </div>
                        <div class="user-addresses" id="novo">
                            <?php $userAddresses = Address::getUserAddresses($db, $user->id);?>
                            <?php foreach($userAddresses as $address) { ?>
                                <div class="user-address" id="selam<?=$address->id?>">
                                    <div class="pd">
                                        <small><?=$address->address?></small>
                                        <div class="btns">
                                            <button type="button" class="btn-edit-address" onclick="function()">Edit</button>
                                            <input type="submit" class="butuns" name="insert" value="Delete"/>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        $('.butuns').click(function(){
                                            var clickBtnValue = $(this).val();
                                            var ajaxurl = '../actions/action_delete_address.php?id='+<?=$address->id?>;
                                            data =  {'action': clickBtnValue};
                                            $.post(ajaxurl, data, function (response) {
                                                // Response div goes here.
                                                //document.getElementById("selam<?=$address->id?>").remove();
                                                var elem = document.getElementById("selam<?=$address->id?>");
                                                elem.remove();
                                            });
                                        });
                                    });
                                </script>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php }
            else { ?> <!-- User it's not a client (owner) -->
                
            <?php } ?>

        <div class="my-orders-div center hidden" id="my-orders-div">
            <?php foreach ($userOrders as $order) { ?>
                <?php $restaurantName = Restaurant::getRestaurantName($db, intval($order->idRestaurant)); ?>
                <div class="user-order">
                    <p>Order <?=$order->id?> (<?=$order->submissonDate?> | <?=$order->submissonHour?>)</p>
                    <p><?=$restaurantName?></p>
                </div>
            <?php }
            if (sizeof($userOrders) == 0) { ?>
                <p>No orders available!</p>
            <?php } ?>
        </div>

        <div class="my-favorites-div center hidden" id="my-favorites-div">
            <div class="name">
            <?php foreach ($favoriteRestaurants as $favorite) { ?>
                <?php $restaurantName = Restaurant::getRestaurantName($db, intval($favorite->idRestaurant)); ?>
                <div class="user-order">
                    <p>Name: <?=$restaurantName?></p>
                </div>
            <?php }
            if (sizeof($favoriteRestaurants) == 0) { ?>
                <p>No plates in favorites, yet!</p>
            <?php } ?>
            </div>
        </div>
    </div>
    <?php $error = 0; ?>
<?php } ?>