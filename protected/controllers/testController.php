<?php

 Class testController extends Controller

{
/*
* What is this?
*/

public function actionIndex()

{
	$this->render('test');
	exit;
$gridDataProvider = new CArrayDataProvider(array(
    array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'<span class="badge badge-warning">HTML</span>','usage'=>'<span class="inlinebar">1,4,4,7,5,9,10</span>'),
    array('id'=>2, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'<span class="badge badge-important">CSS</span>','usage'=>'<span class="inlinebar">1,4,4,7,5,9,10</span>'),
    array('id'=>3, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'<span class="badge badge-info">Javascript</span>','usage'=>'<span class="inlinebar">1,4,4,7,5,9,10</span>'),
));
$model=new htmlreference;
Models::importModelFile();
//$this->render('test',array('griddataprovider'=>$gridDataProvider,'model'=>$model));
}
public function actionTest()
{
    
    $file =file(str_replace("\\","\\",Yii::getPathOfAlias("bootstrap.widgets.TbActiveForm")).".php");
    //$file =file("d:\\xampp\\htdocs\\viewcreater\protected\\extensions\\yiistrap\\helpers\\TbHtml.php",FILE_IGNORE_NEW_LINES);

	$ref = new ReflectionClass("TbActiveForm");

$methods=$ref->getMethods();

foreach ($methods as  $method)
{
    $name=$method->getName();
	 $line=$method->getStartLine();
	 $endcommentline=$line;
	  	
     if (preg_match("/(.*)ControlGroup/",$name,$matches))
    {
		  while (!preg_match("/@return/",$file[$endcommentline]))
	   {
		   $endcommentline--;
	   }
	
         $hr=new htmlreference();
    //$widgetName = preg_split("/ControlGroup/",$name);
    //$widgetName=$matches[1];
   
        //print $widgetName."-".$name."<br>";
        $parameters=$method->getParameters();
        $str=array();
        $str1=array();
        $i=0;
        
        foreach ($parameters as $parameter)
        {
            $i++;
            if ($parameter->name=="htmlOptions")
            {
                $str[]="array('nv','htmlOptions:Options:Add Html Options in name value format','name:Option Name:Name of Html Option example size','value:Value:Value of Html Option')";
            
                $str1[]="%(htmlOptions)s";
            }
            else 
                if ($parameter->name=="model")
            {
              $str1[]='$model';   
            }
			else 
                if ($parameter->name=="data")
            {
              $str1[]="%(".$parameter->name.")s";
                $str[]="'".$parameter->name.":".$parameter->name.":".preg_replace("/(@param)|\*/","",$file[$line-3-(count($parameters)+2-$i)])."'";
         
            }
            else
            {
				if (preg_match('/string/',$file[$endcommentline-(count($parameters)+1-$i)]))
                 $str1[]="'%(".$parameter->name.")s'";
				else 
					$str1[]="%(".$parameter->name.")s";
                $str[]="'".$parameter->name.":".$parameter->name.":".preg_replace("/(@param)|\*/","",$file[$endcommentline-(count($parameters)+1-$i)])."'";
            }
          
        }
          
		 $hr->cssframeworkname="yiistrap";
        // print $name;
         $x="?>";
        $hr->code='<?php echo $form->'.$name."(".implode(",",$str1).");?>";
        
          $hr->parameters= "array(".implode(",",$str).")";
		  print $hr->code."<br>".$hr->parameters."<br>";
          $hr->dummycode="<p>".$name."</p>";
          $hr->htmltype=$name;
		  $hr->container='n';
          if ($hr->save())
		  {
			 // $this->render('/htmlreference/view',array('model'=>$hr));
			  //exit;
			  print $hr->id."<br>";
		  } 
    }
	
		 
}
}
}
