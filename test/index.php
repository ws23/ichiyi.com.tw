<?php
function module_enabled($module){
	$modules = apache_get_modules();
	return in_array($module, $modules);
}

if(module_enabled("mod_rewrite")){
	echo "mod_rewrite enabled.";
}
?>
