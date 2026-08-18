<?php
// autoload.php
// [created] 10 octubre del 2014
// [rebuilded] 9 abril del 2016
// esta funcion elimina el hecho de estar agregando los modelos manualmente
// by evilnapsis

function my_autoload($className){
	if(Model::exists($className)){
		include Model::getFullpath($className);
		return;
	} 

	// Fallback autoloader for App\Controller\ and App\Service\
	if(strpos($className, 'App\\') === 0){
		$parts = explode('\\', $className);
		if(count($parts) >= 3){
			$subfolder = strtolower($parts[1]); // 'controller' o 'service'
			$classname = $parts[2];
			$fullpath = __DIR__ . "/" . $subfolder . "/" . $classname . ".php";
			if(file_exists($fullpath)){
				include $fullpath;
			}
		}
	}
}

spl_autoload_register("my_autoload");

?>