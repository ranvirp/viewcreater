<div class="col-md-6">
  <nav class="navbar navbar-default navbar-fixed-top containerelement label-success" role="navigation">
	  <div class="container">
		  <div class="navbar-collapse collapse">
    <ul class="nav nav-pills">
		<li><a href="#">HI</a></li>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
Sites
<b class="caret"></b>
</a>
			<ul class="dropdown-menu">
      <?php $menuitems=array( array( 'href'=>'sites/create','text'=>'Add New','header'=>'','divider'=>'n',),array('href'=>'sites/import','text'=>'Import
      Existing','header'=>'','divider'=>'n',),); foreach ($menuitems as $menuitem)
      { if ($menuitem['header']!='') { echo '
      <li role="presentation" class="dropdown-header">'.$menuitem['header']."</li>\n"; } elseif ($menuitem['divider']=='y'){ echo
      '
      <li role="presentation" class="divider"></li>'."\n"; } else { echo '
      <li role="presentation"><a role="menuitem" tabindex="-1" href="'.$menuitem['href'].'">'.$menuitem['text'].'</a>
      </li>'."\n"; } } ?>
			</ul>
		</li>
    </ul>
	  </div>
  </nav>
</div>
<div class="col-md-6">
</div>
