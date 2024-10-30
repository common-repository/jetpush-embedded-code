<?php

	class Output {
		
		const _NAMESPACE = 'jetpush_embedded_code' ;

		public static function __($output) {
			return __($output, self::_NAMESPACE) ;
		}
		
		public static function _e($output) {
			_e($output, self::_NAMESPACE) ;
		}

		public static function settingsPage() {	
		?>
			<div class="wrap">
				<h2><?php Output::_e('JetPush Embedded Code.') ; ?></h2>
				<p>
					<?php
						Output::_e('JetPush Embedded Code allows you to easilly add your JetPush Embedded code on all your pages.') ;
						echo '<br/>' ;
						Output::_e('Just add your ID.') ;
						echo '<br/>' ;
						Output::_e('That\'s all, you\'re ready to go.') ;
					?>
				</p>

				<form method="post" action="options.php" id="jetpush_form">
					<?php settings_fields(Settings::$settingsGroup) ; ?>

					<table class="form-table">
						<tr valign="top">
							<th scope="row" style="text-align:right;"><?php Output::_e('JetPush ID') ; ?></th>
							<td>
								<?php
								$apikey = trim(Settings::getVal('jec_shopowner_id'));
								if($apikey == "") {
									$response = file_get_contents('https://api.jetpush.com/apikey');
									$data = json_decode($response);
									if($data) {
										$apikey = $data->apikey;
									}
								}
								
								?>
								<input type="text" name="jec_shopowner_id" value="<?php echo $apikey; ?>"> <?php Output::_e('Example : m69h8semi') ; ?>
								<?php
								if( ! $data) {
								?>
								<br/>
								Get apikey <a href="https://app.jetpush.com/apikey">here</a>
								<?php
								}
								?>
							</td>
						</tr>
					</table>

					<p class="submit">
						<input type="submit" class="button-primary" value="<?php Output::_e('Save Changes') ?>" />
					</p>
				</form>

				<p>
					<?php
						Output::_e('If you need any support go to the plugin homepage and contact us !') ;
						echo '<br/><br/>' ,
							 '<a href="http://jetpush.com/" target="_blank">http://jetpush.com</a>' ,
							 '<br/><br/>' ;
					?>
				</p>
			</div>

		<?php
		}

		public static function jetpushCode(array $options) {

			$ret .= '<script type="text/javascript">' . "\n" ;

			$ret .= 'var jet=jet||[];(function(){var e=["init","identify","listen","track","trackForm","trackLink","pageview"];var t=function(e){return function(){jet.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var n=0;n<e.length;n++){jet[e[n]]=t(e[n])}})();jet.load=function(e){var t=document.createElement("script");t.type="text/javascript";t.async=true;t.src="https://s3.amazonaws.com/jetpush/jet.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);jet.init(e);jet.listen()};'. "\n";
			$ret .= 'jet.load("' . $options['_setAccount']  . '")' ;
			
			$ret .= '</script>' ;
			
			return $ret ;
		}
	}
	
?>
