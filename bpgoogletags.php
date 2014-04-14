<?php
defined('_JEXEC') or die( 'Restricted access' );
jimport('joomla.plugin.plugin');

class plgSystemBPGoogleTags extends JPlugin {

	function onAfterRender() {
		$container = $this->params->get('container');
		$app = JFactory::getApplication();
		
		if (!$container || $app->isAdmin() || strpos($_SERVER['PHP_SELF'], 'index.php') === false) return true;
		
		$body = JResponse::getBody();
		$gtmcode = sprintf('<!-- Google Tag Manager -->
<noscript>
 <iframe src="//www.googletagmanager.com/ns.html?id=%s" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<script>
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':
new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=
\'//www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,\'script\',\'dataLayer\',\'%s\');
</script>
<!-- End Google Tag Manager -->',
				$container, $container);
		$body = preg_replace ('~<\s*body[^>]*>~ui', "$0\n".$gtmcode, $body);
		JResponse::setBody($body);
	}
}
