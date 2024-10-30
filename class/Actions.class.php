<?php

	class Actions {
		
		const _NAMESPACE = 'jetpush-embedded-code' ;
		
		private $javascript = array(
			'admin' => array(
				'jec.js',
			),
			'front' => array(
			),
		) ;
		
		private $actions = array(
			'init' => 'launch_i18n',
			'admin_init' => 'registerSettings',
			'admin_menu' => 'menu',
			'wp_%%LOCATION%%' => 'insertCode',
		) ;
		
		private $filters = array(
			'plugin_action_links' => 'actionLinks',
		) ;
		
		public function __construct() {
			$this->addAll() ;
		}
		
		private function addAll() {
			$this->addJS() ;
			$this->addActions() ;
			$this->addFilters() ;
		}
		
		protected $adminJSFiles = array() ;
		protected $frontJSFiles = array() ;
		private function addJS() {
			foreach ($this->javascript as $location => $files) {
				switch ($location) {
					case 'admin':
						if (!empty($files)) {
							$this->adminJSFiles = $files ;
							add_action('admin_enqueue_scripts', array(&$this, 'addAdminJS')) ;
						}
						break ;
					case 'front':
						if (!empty($files)) {
							$this->frontJSFiles = $files ;
							add_action('wp_enqueue_scripts', array(&$this, 'addFrontJS')) ;
						}
						break ;
					default:
						break ;
				}
			}
		}

		public function addAdminJS() {
			foreach ($this->adminJSFiles as $file) {
				wp_enqueue_script(self::_NAMESPACE, plugins_url('', dirname(__FILE__)) . '/js/' . $file, array('jquery')) ;
			}
		}

		public function addFrontJS() {
			foreach ($this->frontJSFiles as $file) {
				wp_enqueue_script(self::_NAMESPACE, plugins_url('', dirname(__FILE__)) . '/js/' . $file, array('jquery')) ;
			}
		}
		
		//============== ACTIONS
		
		private function addActions() {

			foreach ($this->actions as $key => $value) {
				$key = str_replace('%%LOCATION%%', 'head', $key) ;
				add_action($key, 'Actions::' . $value) ;
			}
			
		}
		
		public static function launch_i18n() {
			$lngPath = JEC_ROOT . '/languages/' ;
			load_plugin_textdomain(self::_NAMESPACE, false, $lngPath) ;
		}
		
		public static function registerSettings() {
			Settings::registerSettings() ;
		}
		
		public static function menu() {
			add_options_page(JEC_PLUGIN_TITLE, Output::__('JetPush Plugin Settings'), JEC_SETTINGS_AUTH, 'jetpush-embedded-code-config', "Output::settingsPage") ;
		}

		public static function insertCode() {
			if (self::showCode()) {
				
				$options = array() ;

				if (Settings::getVal('jec_shopowner_id') !== false) {
					$options['_setAccount'] = Settings::getVal('jec_shopowner_id') ;

					echo "\n" ;
					echo '<!-- JetPush Plugin Begin -->' . "\n" ;
					echo Output::jetpushCode($options) ;
					echo "\n" . '<!-- JetPush Plugin End -->' ;
					echo "\n" ;
				}
			}
		}

		
		//============== FILTRES
		
		private function addFilters() {
			
			foreach ($this->filters as $key => $value) {
				add_filter($key . '_' . JEC_BASENAME, 'Actions::' . $value) ;
			}
			
		}
		
		public static function actionLinks($links) {
			$link = '<a href="' . menu_page_url('jetpush-embedded-code-config' , false) . '">' . Output::__('Settings') .'</a>' ;
			array_unshift($links, $link) ;
			return $links ;
		}
		
		public static function showCode() {
			$result = true ;
			if( is_user_logged_in() ) {
				$result = "1" ;
			}
			return $result ;
		}

	}
	
?>
