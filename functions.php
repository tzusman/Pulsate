<?

	/************************
		Title:	Pulsate
		Author: Todd Zusman
		Description: Add-on to Pulse CMS http://pulsecms.com/
	 ************************/

	function get_block ( $file, $title ) {
		$path = get_path( $file, $title );
		if ( file_exists($path) )
			return file_get_contents( $path );
		$regex = sprintf( '#(<([\w]+)[^>]*class=[\'"][^\'"]*pulse[^\'"]*[\'"][^>]*(title=[\'"]%s[\'"])[^>]*>)(.*?)(</\\2>)#', preg_quote($title) );
		$html = file_get_contents( $file );
		preg_match( $regex, $html, $match );
		if ( ! $match )
			return null;
		return $match[4];
	}

	function get_revisions ( $path, $title ) {
		global $rootpath;
		$path = substr( $path, strlen($rootpath)+1 );
		$new = $path.'-'.$title;
		$new = preg_replace( '#[^a-zA-Z0-9]#', '-', $new );
		$new = trim( $new, '-' );
		$path = sprintf( '%s/blocks/%s', $rootpath, $new );
		$revs = array();
		for ( $i=1; true; $i++ ) {
			$new = sprintf( '%s.%d', $path, $i );
			if ( file_exists($new) )
				$revs[] = $new;
			else break;	
		}
		return $revs;
	}

	function get_path ( $path, $title ) {
		global $rootpath;
		$path = substr( $path, strlen($rootpath)+1 );
		$new = $path.'-'.$title;
		$new = preg_replace( '#[^a-zA-Z0-9]#', '-', $new );
		$new = trim( $new, '-' );
		$path = sprintf( '%s/blocks/%s', $rootpath, $new );
		return $path;
	}

	function backup_block ( $path ) {
		$new = $path;
		for ( $i=1; file_exists($new); $i++ )
			$new = sprintf( '%s.%d', $path, $i );
		rename( $path, $new );
	}

	function list_blocks ( ) {
		global $rootpath;
		$blocks = array();
		$path = sprintf( '%s/../build/', $rootpath );
		$files = list_files( $path, 'html' );
		$regex = '#(<([\w]+)[^>]*class=[\'"][^\'"]*pulse[^\'"]*[\'"][^>]*(title=[\'"]([^\'"]*)[\'"])[^>]*>)(.*?)(</\\2>)#';
		foreach ( $files as $file ) {
			$html = file_get_contents( $file );
			preg_match_all( $regex, $html, $matches, PREG_SET_ORDER );
			foreach ( $matches as $match ) {
				$block = array();
				$block['file'] = $file;
				$block['title'] = $match[4];
				$block['default'] = $match[5];
				$blocks[] = $block;
			}
		}
		return $blocks;
	}

	function list_files ( $dir, $ext ) {
		if ( substr($dir,-1) == '/' )
			$dir = substr( $dir, 0, -1 );
		$dirs = array( $dir );
		#while ( $ds=glob($dir.='/*',GLOB_ONLYDIR) )
		#	$dirs = array_merge( $dirs, $ds );
		$files = array();
		foreach ( $dirs as $dir ) {
			$fs = glob( $dir.'/*.'.$ext );
			$files = array_merge( $files, $fs );
		}
		return $files;
	}

	function sync_blocks ( ) {
		global $rootpath;
		$blocks = array();
		$path = sprintf( '%s/../build/', $rootpath );
		$files = list_files( $path, 'html' );
		foreach ( $files as $file ) {
			$new = substr( $file, strlen($rootpath)+1 );
			$new = str_replace( 'build/', 'webroot/', $new );
			//////////////////////
			$html = file_get_contents( $file );
			$regex = '#(<([\w]+)[^>]*class=[\'"][^\'"]*pulse[^\'"]*[\'"][^>]*(title=[\'"]([^\'"]*)[\'"])[^>]*>)(.*?)(</\\2>)#';
			preg_match_all( $regex, $html, $matches, PREG_SET_ORDER );
			foreach ( $matches as $match ) {
				$block = get_block( $file, $match[4] );
				$html = str_replace( $match[0], $match[1].$block.$match[6], $html );
			}
			file_put_contents( $new, $html );
			//////////////////////
		}
	}

	function humanize ( $str ) {
		$new = preg_replace( '#[-_]#', ' ', $str );
		return ucwords( $new );
	}

