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
<<<<<<< HEAD
    
    $file =file(str_replace("\\","\\",Yii::getPathOfAlias("bootstrap.widgets.TbActiveForm")).".php");
    //$file =file("d:\\xampp\\htdocs\\viewcreater\protected\\extensions\\yiistrap\\helpers\\TbHtml.php",FILE_IGNORE_NEW_LINES);

	$ref = new ReflectionClass("TbActiveForm");

$methods=$ref->getMethods();
=======
    error_reporting(E_ERROR);
   // $file =file("'".str_replace("\\","\\",Yii::getPathOfAlias("bootstrap.helpers.TbHtml")).".php'");
    $fns=array("TbHtml",'TbActiveForm','TbApi');
    $widget=array('TbAffix','TbAlert','TbBreadcrumb','TbButtonColumn','TbCollapse',  'TbDataColumn','TbDetailView','TbGridView','TbJumbotron','TbListView','TbModal','TbNav','TbNavbar','TbPager','TbPanel','TbScrollspy','TbTabs','TbThumbnails','TbApi');
   // $fns=array_merge($fns,array($fns1));
    $outstr="";
    foreach ($fns as $fn)
    {
       
    $ref = new ReflectionClass($fn);
    $filename= $ref->getFileName();
    
    $file =file($filename,FILE_IGNORE_NEW_LINES);
   // $file =file($filename);
    $methods=$ref->getMethods();
    
>>>>>>> origin

foreach ($methods as  $method)
{
    $name=$method->getName();
<<<<<<< HEAD
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
=======
     if (($method->isPublic() || $method->isStatic()) && ($method->class==$fn))
    {
         //$hr=new htmlreference();
    //$widgetName = preg_split("/ControlGroup/",$name);
   // $widgetName=$matches[1];
>>>>>>> origin
   
        //print $widgetName."-".$name."<br>";
        $parameters=$method->getParameters();
        $str=array();
        $str1=array();
        $i=0;
        $line=$method->getStartLine()-1;
        print $fn.'-'.$name."$line<br>";
            while (!preg_match("/\/\*\*/",$file[$line-1]))
            {
                print $file[$line-1].'-'.$line.'<br>';
                $line=$line-1;
            }
            //$line=$line+2;
        foreach ($parameters as $parameter)
        {
            $i++;
<<<<<<< HEAD
=======
            
>>>>>>> origin
            if ($parameter->name=="htmlOptions")
            {
                $str[]="array('nv','htmlOptions:Options:Add Html Options in name value format','name:Option Name:Name of Html Option example size','value:Value:Value of Html Option')";
            
                $str1[]="%(htmlOptions)s";
            }
            else 
                if ($parameter->name=="model")
            {
<<<<<<< HEAD
              $str1[]='$model';   
=======
                $str1[]='$model';
>>>>>>> origin
            }
			else 
                if ($parameter->name=="data")
            {
<<<<<<< HEAD
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
=======
              
                 while (!preg_match("/.".$parameter->name."/",$file[$line+$i]))
                   $line++;
                   if (preg_match('/string/',$file[$line+$i]))
                 $str1[]="'%(".$parameter->name.")s'";
                else 
                    $str1[]="%(".$parameter->name.")s";
                $str[]="'".$parameter->name.":".$parameter->name.":".preg_replace("/(@param)|\*|\$/","",$file[$line+$i])."'";
            }
          
        }
        if ($method->isStatic())
         $code='<?php echo '.$fn.'::'.$name.'('.implode(',',$str1).');?>';
        else {
            $class=lcfirst(substr($fn, 2));
           $code='<?php echo $'.$class.'->'.$name.'('.implode(',',$str1).');?>'; 
        }
        $pr="array(".implode(",",$str).")";
        $sql= "insert into htmlreference(cssframeworkname,htmltype,code,parameters,dummycode) values('yiistrap','".$fn.'-'.$name."','".mysql_escape_string($code)."','".mysql_escape_string($pr)."','<p>".$fn.'-'.$name."</p>');\n";
        $outstr.=$sql;
        print $sql."</br>"; 
        //$hr->cssframeworkname="yiistrap";
        // print $name;
        // $x="?";
        // $hr->code='<?php echo $form->'.$name."(\$model,\%(attribute)s',";
        //.implode(",",$str1).");";
        
          //$hr->parameters= "array(".implode(",",$str).")";
          //$hr->dummycode="<p>".$name."</p>";
          //$hr->htmltype=$name;
         // $hr->save();
>>>>>>> origin
    }
	
		 
}
}
file_put_contents("d:/xampp/htdocs/viewcreater/protected/data/htmlref.sql", $outstr);
}
}
