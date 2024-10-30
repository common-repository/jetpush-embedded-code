<?php

	class Settings {

		public static $settingsGroup = 'jec-settings-group' ;

		private static $settingsArray = array(
			'jec_shopowner_id',
		) ;
		
		
		public static function registerSettings() {
			foreach (self::$settingsArray as $value) {
				register_setting(self::$settingsGroup, $value) ;
			}
		}
		
		public static function getVal($option) {
			if (!in_array(strtolower($option), self::$settingsArray)) {
				return false ;
			} else {
				return get_option($option) ;
			}
		}
		
	}

?>
