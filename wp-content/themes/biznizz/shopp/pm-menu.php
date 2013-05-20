<ul class="pm-mymedia-menu">
	<li><a href="<?php bloginfo('url') ?>/pm/account/?acct">My Media</a></li>
	<li><a href="<?php bloginfo('url') ?>/pm">Media Store</a></li>
	<?php
	while (shopp('storefront','account-menu')) {
	    $action = shopp('storefront.get-account-menu-item', 'action=on');
	    switch ( $action ) {
	        case "logout":
	            //do stuff
	            ?>
	            <li><a href=<?php shopp('storefront','account-menu-item','url'); ?>>Logout</a></li>
	            <?php
	            break;
	        case "orders":
	            //do stuff          echo "Orders";
	            ?>
	            <li><a href=<?php shopp('storefront','account-menu-item','url'); ?>>My Orders</a></li>
	            <?php
	            break;
	        case "downloads":
	            //do stuff
	            ?>
	            <li><a href=<?php shopp('storefront','account-menu-item','url'); ?>>My Downloads</a></li>
	            <?php
	            break;
			case "media":
		         //do stuff
		         ?>
		         <li><a href=<?php shopp('storefront','account-menu-item','url'); ?>>My Media</a></li>
		         <?php
		         break;
	        case "profile":
	            //do stuff
	            ?>
	            <li><a href=<?php shopp('storefront','account-menu-item','url'); ?>>My Profile</a></li>
	            <?php 
	            break;
	    }
	}
	?>
</ul>