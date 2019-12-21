<?php

ss_main( $argv );

function ss_main( $args ) {
	if ( empty( $args[1] ) ) {
		ss_show_usage();
		exit;
	} else {
		$db_path = $args[1];
	}

	$pdo = ss_connect_db( $db_path );
	if ( $pdo === false ) {
		echo "Failed to open $db_path\n";
		exit;
	}
}

/* Supporting Functions */

function ss_connect_db( $db_path ) {
	if ( !is_readable( $db_path ) ) {
		return false;
	}

	try {
		$pdo = new PDO( "sqlite:$db_path" );
	} catch ( Exception $e ) {
		return false;
	}

	return $pdo;
}

function ss_show_usage() {
	echo "Usage: sqlsight.php /path/to/sqlite.db\n";
}
