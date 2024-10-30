<?php
	
	function jec_autoload($className) {
		$filename = JEC_DIRPATH . '/class/' . $className . '.class.php' ;
		if (file_exists($filename)) {
			include_once($filename) ;
		}
	}
	spl_autoload_register('jec_autoload') ;

?>
