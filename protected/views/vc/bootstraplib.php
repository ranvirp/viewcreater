<?php
/* 
 * @author Ranvir Prasad
 * @date 15/11/2013
 */
$items=array('11'=>array(
    'type'=>'table','parameters'=>
    array(
        'title'=>'First letter',
        'tablecss'=>'table table-striped',
        'griddataprovider'=>'griddataprovider',
        'template'=>'items',
        'columnarraystring'=>"array(
				array('name'=>'id', 'header'=>'#'),
				array('name'=>'firstName', 'header'=>'First name'),
				array('name'=>'lastName', 'header'=>'Last name'),
				array('name'=>'language', 'header'=>'Language', 'type'=>'raw'),
				array('name'=>'usage', 'header'=>'Usage', 'type'=>'raw'),
				
			)",
    
    )));
$items['12']=$items['13']=$items['21']=$items['22']=$items['23']=$items['11'];
writePage($items);
function writePage($items)
{
    $divs=array('1'=>3,'2'=>3);
    //check what has been merged in the first row
    
    printdiv($divs,$items);
    
    
}
function printdiv($divs,$items)
{
    //print_r($divs);
                
    foreach (array_keys($divs) as $row)
    {
        //print $row."-".$divs[$row];
        //exit;
            $spans=(int) 12/$divs[$row];
            //print $spans."-".$row;
            print "<div class='row-fluid'>\n";
            for($i=1;$i<=$divs[$row];$i++){
                print "<div class='span$spans'>";
                $type = $items[$row.$i]['type'];
                //print($type);
                $parameters=$items[$row.$i]['parameters'];
                //print_r($parameters);
                //echo call_user_func($type,array($parameters));
                echo $type($parameters);
                print '</div>';
            }
            print '</div>';
        
    }
}
function tabs($parameters)
{
    $title=$parameters['title'];
    $tabsarraystring = $parameters['tabsarraystring'];
    $optionstring=$parameters['optionarraystring'];
    /*Format of arraystring
     * array(
     
			'StaticTab 1'=>$sample_text,
			'StaticTab 2'=>$sample_text,
			'StaticTab 3'=>array('content'=>$sample_text, 'id'=>'tab3'),
		)
     * 
     * 'options'=>array(
			'collapsible'=>true,
		)
     */
    return <<<EOT
    <?php
		\$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"$title",
		));
		
	?>
    <?php
    \$this->widget('zii.widgets.jui.CJuiTabs', array(
		'tabs'=>$tabsarraystring,
		// additional javascript options for the tabs plugin
		'options'=>$optionstring,
		),
	));
	?>
    <?php \$this->endWidget();?>
EOT;
}
function table($parameters)
{
    //print_r($parameters);
    $title=$parameters['title'];
    $tablecss=$parameters['tablecss'];
    $griddataprovider=$parameters['griddataprovider'];
    $template=$parameters['template'];
    $columnarraystring=$parameters['columnarraystring'];
    
 return <<<EOT
    <?php
		\$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"$title",
		));
		
	?>
    
  	<?php \$this->widget('zii.widgets.grid.CGridView', array(
			/*'type'=>'striped bordered condensed',*/
			'itemsCssClass'=>'$tablecss',
			'dataProvider'=>\$$griddataprovider,
			//'template'=>"\{$template\}",
			'columns'=>$columnarraystring,
		)); ?>
        
     <?php    \$this->endWidget(); ?>
EOT;
    
}
function datepicker($parameters)
{
    $name=parameters['name'];
    $showanim=parameters['showanim'];
    return <<<EOT
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'$name',
		// additional javascript options for the date picker plugin
		'options'=>array(
			'showAnim'=>'$showanim',
		),
		'htmlOptions'=>array(
			'style'=>'height:20px;'
		),
	));
	?>
EOT;

}
function inputdropdown($parameters)
{
    
}
function inputtextbox($parameters)
{
    
}
function inputcheckbox($parameters)
{
    
}
function inputradio($parameters)
{
    
}
function inputchilddropdown($parameters)
{
    
}
function autocomplete($parameters)
{
    $source =$parameters['source'];//    array('John Doe', 'John Murry', 'Ben John', 'Johnny Walker')
    $minLength=$parameters['minlength'];
    return <<<EOT
    <?php
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		'name'=>'city',
		'source'=>$source,
		// additional javascript options for the autocomplete plugin
		'options'=>array(
			'minLength'=>'$minLength',
		),
		'htmlOptions'=>array(
			'style'=>'height:20px;'
		),
	));
	?>
EOT;
}
?>
