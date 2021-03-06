<div class="wrap ot-reports-page">
	<div class="icon32 icon32-opentickets icon32-opentickets-reports" id="icon-opentickets"><br /></div><h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
		<?php
			foreach ( $reports as $key => $report_group ) {
				echo '<a href="'.admin_url( apply_filters('qsot-get-menu-page-uri', '', 'main', true).'&tab=' . urlencode( $key ) ).'" class="nav-tab ';
				if ( $current_tab == $key ) echo 'nav-tab-active';
				echo '">' . esc_html( $report_group[ 'title' ] ) . '</a>';
			}
		?>
		<?php do_action('qsot_reports_tabs'); ?>
	</h2>

	<?php if ( sizeof( $reports[ $current_tab ]['reports'] ) > 1 ) {
		?>
		<ul class="subsubsub">
			<li><?php

				$links = array();

				foreach ( $reports[ $current_tab ]['reports'] as $key => $report ) {

					$link = '<a href="admin.php?page=wc-reports&tab=' . urlencode( $current_tab ) . '&amp;report=' . urlencode( $key ) . '" class="';

					if ( $key == $current_report ) $link .= 'current';

					$link .= '">' . $report['title'] . '</a>';

					$links[] = $link;

				}

				echo implode(' | </li><li>', $links);

			?></li>
		</ul>
		<br class="clear" />
		<?php
	}

	if ( isset( $reports[ $current_tab ][ 'reports' ][ $current_report ] ) ) {

		$report = $reports[ $current_tab ][ 'reports' ][ $current_report ];

		if ( ! isset( $report['hide_title'] ) || $report['hide_title'] != true )
			echo '<h3>' . $report['title'] . '</h3>';

		if ( $report['description'] )
			echo '<p>' . $report['description'] . '</p>';

		if ( $report['function'] && ( is_callable( $report['function'] ) ) )
			call_user_func( $report['function'], $current_report );
	}
	?>
</div>
