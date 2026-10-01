<?php
/**
 * Five different code-drawn project covers (picked by position). Args: idx, mono.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$idx  = isset( $args['idx'] ) ? (int) $args['idx'] % 5 : 0;
$mono = isset( $args['mono'] ) ? $args['mono'] : '';
?>
<span class="art art--<?php echo (int) $idx; ?>" aria-hidden="true">
	<?php if ( 0 === $idx ) : // Browser window. ?>
		<span class="art__win"><i></i><i></i><i></i><span class="art__bar"></span><span class="art__hero"></span><span class="art__cols"><b></b><b></b><b></b></span></span>
	<?php elseif ( 1 === $idx ) : // Phone. ?>
		<span class="art__phone"><span class="art__notch"></span><b></b><b></b><span class="art__tile"></span></span>
	<?php elseif ( 2 === $idx ) : // Hexagon grid. ?>
		<span class="art__hex"><i></i><i></i><i></i><i></i><i></i></span>
	<?php elseif ( 3 === $idx ) : // Bars. ?>
		<span class="art__bars"><i style="--h:40%"></i><i style="--h:65%"></i><i style="--h:50%"></i><i style="--h:85%"></i><i style="--h:70%"></i></span>
	<?php else : // Node network. ?>
		<span class="art__net"><i class="n1"></i><i class="n2"></i><i class="n3"></i><i class="n4"></i><s class="l1"></s><s class="l2"></s><s class="l3"></s></span>
	<?php endif; ?>
	<span class="art__mono"><?php echo esc_html( $mono ); ?></span>
</span>
