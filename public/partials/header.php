<?php 
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'mp-tutor-lms' ); ?></a>
<header id="header-top" class="header-top" itemscope itemtype="http://schema.org/WPHeader">
    <nav id="primary1" class="primary1" itemscope itemtype="http://schema.org/SiteNavigationElement">
        <div id="container-primary1" class="container-primary1">
            <div class="box-menu">
                <?php 
                $headerWishlist  = esc_url( get_theme_mod('header_link_wishlist') );
                $headerWishlist  = empty( $headerWishlist ) ? '#' : $headerWishlist;
                $headerAccountLink  = esc_url( get_theme_mod('header_link_account_mobile') );
                $headerAccountLink  = empty( $headerAccountLink ) ? '#' : $headerAccountLink;
                $headerNavToggle = get_theme_mod('MP_toggle_icon_logo');
                $headerNavIcon   = get_theme_mod('MP_icon');
                $headerNaTitle   = get_theme_mod('MP_title');
                $headerNavLogo    = wp_get_attachment_url( get_theme_mod( 'MP_logo' ) );
                $headerNavLogo    = ( empty( $headerNavLogo ) ? plugins_url() . '/mp-tutor-lms/public/assets/images/logo.png' : $headerNavLogo );
                ?>
                <?php if ( $headerNavToggle == 'yes' ) : ?>
                    <div class="logo-icon">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <span class="icon-nav"><?php echo '<i class="' . $headerNavIcon . '"></i>'; ?></span>
                            <span class="title-nav"><?php echo $headerNaTitle; ?></span>
                        </a>                        
                    </div>
                <?php else: ?>
                    <div class="logo-icon logo-image"> 
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo $headerNavLogo; ?>" alt="Logo" width="150" height="60">
                        </a>                        
                    </div>
                <?php endif; ?> 
                <!-- Menus -->
                <?php 
                if ( has_nav_menu( 'mp-tutor-lms-header' ) ) : 
                    wp_nav_menu( 
                        array(
                            'container'      => false,
                            'theme_location' => 'mp-tutor-lms-header',
                        )
                    );	
                endif; 
                ?>
                <div class="box-icon">
                    <?php $activeWish = ! empty( $_COOKIE['MP-Wishlist'] ) ? 'class="nav-wishlist-active"' : ''; ?>
                    <div class="wishlist">
                        <a <?php echo $activeWish; ?> href="<?php echo $headerWishlist; ?>" target="_blank"><i class="far fa-heart"></i>Wishlist</a>
                    </div>               
                    <div class="cart">
                        <?php 
                        if ( is_plugin_active('easy-digital-downloads/easy-digital-downloads.php') ) {
                            $linkCartEdd   = esc_url( edd_get_checkout_uri() );
                            $cartNumberEdd = absint( edd_get_cart_quantity() );
                        } else {
                            $linkCartEdd = '#';
                            $cartNumberEdd = 0;
                        }
                        ?>
                        <a href="<?php echo $linkCartEdd; ?>">
                            <i class="fas fa-cart-plus"></i>
                            <span class="txt-cart">Cart</span>
                            <span class="header-cart edd-cart-quantity cart-number">
                                <?php echo $cartNumberEdd; ?>
                            </span>
                        </a>
                    </div>
                </div> <!-- /Box-icon -->
            </div> <!-- /End Box Menu -->


            <div class="box-menu nav-mobile">
                <?php if ( $headerNavToggle == 'yes' ) : ?>
                    <div class="logo-icon">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <span class="icon-nav"><?php echo '<i class="' . $headerNavIcon . '"></i>'; ?></span>
                            <span class="title-nav"><?php echo $headerNaTitle; ?></span>
                        </a>                        
                    </div>
                <?php else: ?>
                    <div class="logo-icon logo-image"> 
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo $headerNavLogo; ?>" alt="Logo" width="150" height="60">
                        </a>                        
                    </div>
                <?php endif; ?> 
                <div class="box-icon">
                    <div class="hamburger">
                        <span class="bar bar1"></span>
                        <span class="bar bar2"></span>
                        <span class="bar bar3"></span>
                        <span class="bar bar4"></span>
                    </div>          
                    <div class="wishlist-mobile-top">
                        <a <?php echo $activeWish; ?> href="<?php echo $headerWishlist; ?>"><i class="far fa-heart"></i></a>
                    </div>    
                    <div class="cart-mobile-top">
                        <a href="<?php echo $linkCartEdd; ?>"><i class="fas fa-cart-plus"></i></a>
                        <span class="header-cart edd-cart-quantity cart-number">
                            <?php echo $cartNumberEdd; ?>
                        </span>
                    </div>  
                </div> <!-- /Box-icon -->                
            </div> <!-- /nav-mobile -->
            <div class="menu-mobile">
                <!-- Menus -->
                <?php 
                if ( has_nav_menu( 'mp-tutor-lms-header' ) ) : 
                    wp_nav_menu( 
                        array(
                            'container'      => false,
                            'theme_location' => 'mp-tutor-lms-header',
                        )
                    );	
                endif; 
                ?>
            </div>
        </div> <!-- /container-primary1 -->
    </nav> <!-- /primary1 -->

    <nav class="bottom-nav-bar" itemscope itemtype="http://schema.org/SiteNavigationElement">
        <div class="box home-bottom">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
        </div>
        <div class="box wishlist-bottom">
            <a <?php echo $activeWish; ?> href="<?php echo $headerWishlist; ?>">            
                <i class="far fa-heart"></i>
                <span>Wishlist</span>            
            </a>            
        </div>
        <div class="box cart-bottom">
            <a href="<?php echo $linkCartEdd; ?>">            
                <i class="fas fa-cart-plus"></i>
                <span>Cart</span>            
            </a>            
        </div>
        <div class="box account-bottom">
            <a href="<?php echo $headerAccountLink; ?>">            
                <i class="far fa-user-circle"></i>
                <span>Account</span>            
            </a>            
        </div>                        
    </nav>
</header>