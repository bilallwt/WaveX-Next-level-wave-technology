<?php
/** Scene: e-commerce. @package WaveX */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="mk-shop">
	<div class="mk-shop__top"><span class="mk-url">Shop</span><span class="mk-cart"><?php echo wavex_icon( 'cart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><b class="mk-cart__n0">0</b><b class="mk-cart__n1">1</b></span></div>
	<div class="mk-product mk-pop" style="--d:.2s">
		<div class="mk-product__img"></div>
		<div class="mk-line" style="--w:60%"></div>
		<div class="mk-line" style="--w:35%"></div>
		<span class="mk-pill mk-press" style="--d:1.8s">Add to cart</span>
	</div>
	<ol class="mk-flow">
		<li class="mk-pop" style="--d:2.4s">Cart</li>
		<li class="mk-pop" style="--d:2.9s">Checkout</li>
		<li class="mk-pop" style="--d:3.4s">Paid</li>
	</ol>
	<span class="mk-tag mk-tag--g mk-pop" style="--d:3.9s">Order confirmed</span>
</div>
