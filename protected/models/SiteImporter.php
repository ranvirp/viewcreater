<?php

/*
 * This Class imports all models,controllers,behaviours and widgets from an existing site and stores in the database
 */

/**
 * Description of SiteImporter
 *
 * @author mac
 */
class SiteImporter {
	/*
	 * Site Id that needs to be imported
	 */

	public $siteId = 2;
	public $yiiPath;
	public $config;

	public static function import($site) {
		error_reporting(E_ERROR);
		$siteId = $site->id;
		$code = "class yii" . $siteId . " extends YiiBase1 {}";
		eval($code);
		//$config = "/Users/mac/htdocs/viewcreater/protected/config/main.php";
		$config = $site->config;
		$yii;
		eval("\$yii=yii$siteId::createWebApplication(\$config);");
		$basePath = YiiBase1::app()->basePath;
		$iterator = new RecursiveDirectoryIterator($basePath);
        foreach ( new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST) as $file ) {
        if ($file->isFile()) {
            $thispath = str_replace('\\', '/', $file);
            $thisfile = utf8_encode($file->getFilename());
			if (stripos($thisfile, '.php') !== false) 
		    {
				//include_once($thispath);
				$filecontents = file_get_contents($thispath);
				/*
				$filecontents = "<?php namespace tempimporter$siteId; ?>".$filecontents; 
				 * 
				 */
				$className=  str_ireplace('.php', '', $thisfile);
				if (preg_match('/class\s+'.$className.'\s+extends\s+(CActiveRecord|Controller)/',$filecontents)==0){ print $className." not found<br>";continue; }
				print "here\n";
				$filecontents=preg_replace('/class\s+'.$className.'\s+extends\s+/',"class tempimporter$siteId$className extends ",$filecontents);
				//echo $filecontents;
				//exit;
				file_put_contents("tempimporter$siteId$className.php",$filecontents);
				//include_once("temp.php");
				eval ($filecontents);
				//print $className."-".$thispath;
				//exit;
				//spl_autoload_unregister(array('YiiBase', 'autoload'));
				$reflection = new ReflectionClass("tempimporter$siteId$className");
				//print_r($reflection);
				//exit;
				//spl_autoload_register(array('YiiBase', 'autoload'));
				$class = new Classes();
				$class->siteid=$siteId;
				$class->type=$reflection->getParentClass()->name;
				$class->path=$thispath;
				$class->code=file_get_contents($thispath);
				$class->name=$className;
				$class->updated=time();
				$classes=Classes::model()->findAllByAttributes(array('path'=>$thispath));
				
				if (!empty($classes))
				{
					if (count($classes)!=1)						throw new Exception;
					else {
						unset($class);
						$class=$classes[0];
						$class->siteid=$siteId;
				$class->type=$reflection->getParentClass()->name;
				$class->path=$thispath;
				$class->code=file_get_contents($thispath);
				$class->name=$className;
				$class->updated=time();
						
					}
				}
				if (!$class->save()) 
					print_r($class->getErrors());
				//print_r($class);
				//Now import functions of these classes
				$methods = $reflection->getMethods();
				foreach ($methods as $method)
				{
					//print $method->class."-".$reflection->getName()."<br>";
					
				if ($method->class == $reflection->getName()){ //filters out methods of parent classes
					$code=self::getCode($method);
				    $start = $method->getStartLine();
                    $end = $method->getEndLine();
					$file= $method->getFileName();
					$function = new Functions;
					$function->classid=$class->id;
					
					$function->name=$method->getName();
					$function->code=$code;
					$function->start_line=$start;
					$function->end_line=$end;
					$parameters='';
					foreach ($method->getParameters() as $param)
					{
						$parameters.=$param->name.",";
					}
					$function->parameters=$parameters;
					$functions=Functions::model()->findAllByAttributes(array("classid"=>$class->id,"name"=>$function->name));
					if (!empty($functions))
				{
					if (count($functions)!=1)						throw new Exception;
					else {
						$function=$functions[0];
						$function->classid=$class->id;
					$function->name=$method->getName();
					$function->code=$code;
					$function->start_line=$start;
					$function->end_line=$end;
					$function->parameters=$parameters;
						
					}
				}
				if (!$function->save()) print_r($function->errors);
				}
				
				}
				unlink("tempimporter$siteId$className.php");
				}
			}
           
        }
		}
	

	
	
	public static function getCode($res)
	{
		$start = $res->getStartLine();
        $end = $res->getEndLine();
        $file = $res->getFileName();

       // echo 'get from ' . $start . ' to ' . $end . ' from file ' . $file . '<br/>';
        $lines = file($file);
        $fct = '';
        for ($i = $start; $i < $end + 1; $i++) {
            $num_line = $i - 1; // as 1st line is 0
            $fct .= $lines[$num_line];
        }
        //echo '<pre>';
       // echo $fct;
		return $fct;
        
	}

	private function importModels($file) 
		{
		$modelPath = YiiBase1::getPathOfAlias('application.models');
		$files = scandir($modelPath);
		foreach ($files as $f) {
			if (stripos($f, '.php') !== false) {
				$modelName = str_ireplace('.php', '', $f);
				//echo $modelName;
				include_once($modelPath . DIRECTORY_SEPARATOR . $f);
				$x = new ReflectionClass($modelName);
				$methods = $x->getMethods();
				foreach ($methods as $method)
				{
					//print_r($method);
				if ($method->class == $x->getName()) //filters out methods of parent classes
					self::getCode($method);
				}
				
			}
		}
	}
	private function importControllers()
	{
		
	}
	

}

?>