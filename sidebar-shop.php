<?php
if (!is_active_sidebar('sidebar_woocommerce')) {
    return;
}
?>
<aside id="secondary" class="widget-area woocommerce-sidebar">
	<?php dynamic_sidebar('sidebar_woocommerce');?>
</aside><!-- #secondary -->