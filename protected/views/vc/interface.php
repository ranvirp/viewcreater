<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
print <<<EOT
<script type="text/javascript" src="/viewcreater/js/codemirror-3.19/lib/codemirror.js"></script>
<link rel="stylesheet" type="text/css" href="/viewcreater/js/codemirror-3.19/lib/codemirror.css" />
<link rel="stylesheet" type="text/css" href="/viewcreater/css/abound.css" />

<script src="/viewcreater/js/codemirror-3.19/addon/edit/matchbrackets.js"></script>
<script src="/viewcreater/js/codemirror-3.19/mode/htmlmixed/htmlmixed.js"></script>
<script src="/viewcreater/js/codemirror-3.19/mode/xml/xml.js"></script>
<script src="/viewcreater/js/codemirror-3.19/mode/javascript/javascript.js"></script>
<script src="/viewcreater/js/codemirror-3.19/mode/css/css.js"></script>
<script src="/viewcreater/js/codemirror-3.19/mode/clike/clike.js"></script>
<script type="text/javascript" src="/viewcreater/js/codemirror-3.19/mode/php/php.js"></script>
<script type="text/javascript" src="/viewcreater/js/sprintf.js"></script>
<script type="text/javascript" src="/viewcreater/js/beautify-html.js"></script>
EOT;
?>
<style>
    .highlight{
        background-color:yellow;
    }
    .containerelement 
    {
		position:relative;
        background-color:red;
        display:block;
        min-height: 20px;
    }
    .bordered {
        border:1px solid #7b44e0;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;
        margin-bottom: 20px;
        min-height: 20px;
        padding: 19px;
    }
    .viewelement
    {
        min-height:10px;
        padding:10px;
        border:1px solid brown;
        background:yellowgreen;
    }
    #layoutinfo div.row {
        background-color: gold;
    }
    #layoutinfo div.col-md-*{
        background-color: grey;
    }
	.background {
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;

		min-height:20px;
		overflow: hidden;
	}

</style>



<script>
    // Jquery Plugin 
    //http://stackoverflow.com/questions/946534/insert-text-into-textarea-with-jquery/946556#946556
    
    $.fn.extend({
  insertAtCaret: function(myValue){
  var obj;
  if( typeof this[0].name !='undefined' ) obj = this[0];
  else obj = this;

  if ($.browser.msie) {
    obj.focus();
    sel = document.selection.createRange();
    sel.text = myValue;
    obj.focus();
    }
  else if ($.browser.mozilla || $.browser.webkit) {
    var startPos = obj.selectionStart;
    var endPos = obj.selectionEnd;
    var scrollTop = obj.scrollTop;
    obj.value = obj.value.substring(0, startPos)+myValue+obj.value.substring(endPos,obj.value.length);
    obj.focus();
    obj.selectionStart = startPos + myValue.length;
    obj.selectionEnd = startPos + myValue.length;
    obj.scrollTop = scrollTop;
  } else {
    obj.value += myValue;
    obj.focus();
   }
 }
})
    
    //end jquery plugin
	var vieworfunction='view' //to track what the code displayed is
    var viewsrc='';
    var viewsrc1='';
    var viewelements={} ;
	var containerelements={}
    //= new Array();
    var viewelementscount={};
	var containerelementscount={}
    var editor;
    var delay;
    var selecteddiv;
    //=new Array();     
    $(document).ready(function(){
        selecteddiv=$('#layoutinfo');
        $('#yw0').append('<li>Site:<select id="siteselect"></select><button id="siteselect-btn">Change</button></li>');
		$('#yw0').append('<li><button id="import-btn">Import</button></li>');
                $('#yw0').append('<li>Theme:<select id="themeselect"></select><button id="themeselect-btn">Change</button></li>');
		
        $('#import-btn').click(function(){$.get('<?php echo Yii::app()->createUrl("sites/import"); ?>')});
        $('#themeselect-btn').click(function(){$.get('<?php echo Yii::app()->createUrl("sites/setTheme"); ?>?csstype='+$('#themeselect').val())});
        $.get('<?php echo Yii::app()->createUrl('sites/allsites'); ?>',function (data){$('#siteselect').html(data)})
        $.get('<?php echo Yii::app()->createUrl('sites/allThemes'); ?>',function (data){$('#themeselect').html(data)})
        
		$.get('<?php echo Yii::app()->createUrl('sites/allC'); ?>',function (data){$('#controller-select').html(data)})
		$.get('<?php echo Yii::app()->createUrl('sites/allM'); ?>',function (data){$('#model-select').html(data)})
        $.get('<?php echo Yii::app()->createUrl('sites/allV'); ?>',function (data){$('#view-select').html(data)})
      

          $('#siteselect-btn').click(function(){$.get("<?php echo Yii::app()->createUrl('sites/addsitetosession'); ?>"+'?site_id='+$('#siteselect').val(),
            function(data){
                
            });
			
        });
        
        
        //$("pre").snippet("php",{style:"navy",showNum:true});
        //myCodeMirror = CodeMirror($('#functionspace').get(0));
        editor = CodeMirror.fromTextArea(document.getElementById("code1"), {
            lineNumbers: true,
            matchBrackets: true,
            //mode: "application/x-httpd-php",
            mode:'text/x-php',
            indentUnit: 4,
            indentWithTabs: true,
            enterMode: "keep",
            tabMode: "shift"
       
        });
        editor.on("change", function() {
            clearTimeout(delay);
            delay = setTimeout(function(){$('#code1').val(editor.getValue());
				if (vieworfunction=='view') {
				$('#layoutinfo').html(editor.getValue());
                                viewsrc=editor.getValue();
                                }
			}, 300);
        });
    });
	function refreshList()
	{
		$.get('<?php echo Yii::app()->createUrl('sites/allC'); ?>',function (data){$('#controller-select').html(data)})
		$.get('<?php echo Yii::app()->createUrl('sites/allM'); ?>',function (data){$('#model-select').html(data)})
        $.get('<?php echo Yii::app()->createUrl('sites/allV'); ?>',function (data){$('#view-select').html(data)})
     
	}
    function addContainerElement()
    {
        if (selecteddiv.is('.row')) { alert('Please select a column div;');return;}
        id=$('#containerelement-select').val();
        type=$('#containerelement-select option:selected').text();
     
        $.get("<?php echo Yii::app()->createUrl('htmlreference/value') ?>"+'?'+'id='+id,
        function (data){
            data=$.parseJSON(data);
            el = $(data.code);
            el.addClass('containerelement');
			el.append('<div class="background pull-right">'+data.htmltype+'</div>');
            selecteddiv.append(el);
        });
        elements1();
    }
    function addviewelement()
    
    {
        if (selecteddiv.is('.row')) { alert('Please select a column div;');return;}
        id=$('#viewelement-select').val();
        type=$('#viewelement-select option:selected').text();
     
        $.get("<?php echo Yii::app()->createUrl('htmlreference/value') ?>"+'?'+'id='+id,
        function(data){
            data=$.parseJSON(data)
            if (viewelementscount[type]!=null)
                viewelementscount[type]++;
            else 
                viewelementscount[type]=1;
            // var el = $(data.dummycode)
            var el=$('<div></div>');
            el.html('<button class="pull-right" onclick="js:{$(this).parent(\'div\').remove();$(\'#pw\').html(\'\');delete viewelements[\''+type+viewelementscount[type]+'\'];}">x</button>\n\
       <span class="badge">'+data.dummycode+'</span>');
                   el.addClass('viewelement')
                   el.attr('viewelement-type',type)
                   // el.html(data.dummycode);
                   // el.append('<h3>'+type.toUpperCase()+'</h3>');
                   // $('#tooltip-'+type+viewelementscount[type]).tooltip(data.dummycode);
                   // var el1 = $(data.code)
                   //var doc = $(viewsrc)
                   //var el1 =doc.find('#'+$('#divid').val()).append("%("+type+viewelementscount[type]+")s")
                   //viewsrc = $("<div />").append(doc.clone()).html();
         
                   selecteddiv.append(el)
                   //$('#'+$('#divid').val()).append(el)
                   el.attr('viewelement-id',type+viewelementscount[type])
                   viewelements[type+viewelementscount[type]]={};
                   viewelements[type+viewelementscount[type]]['code']=data.code;
                   viewelements[type+viewelementscount[type]]['parameters']={};
                   // $('#'+type+viewelementscount[type]).draggable();
                   var v = {id:type+viewelementscount[type]};
                   $('#pw').html(sprintf(data.parameters,v));
				   $('#pw').prepend('<h3> Parameters for '+type+viewelementscount[type]+'</h3>');
				   $('#pw').removeClass("hide");
				   $('#pw').addClass("show");
				   $('#layoutinfo').removeClass('col-md-9');
				   $('#layoutinfo').addClass('col-md-3');
                   saveParameters(type+viewelementscount[type]);
                   $('.parameters').change(function(e){saveParameters(e);});
                   $('div.viewelement').click(function(e){clickviewelement($(this))});
                   // console.log(viewelements);
                   //$.post('<?php echo Yii::app()->createUrl('htmlreference/value') ?>')
         
         
               }
           );
           }
           function clickviewelement(type)
           {
               var eltype;
               var id;
               //var table =prettyPrint(type)
               //$(table).dialog()
               eltype=type.attr('viewelement-type')
               id=type.attr('viewelement-id')
               object = viewelements[id]['parameters']
               str='';
               for (var property in object) {
                   if (object.hasOwnProperty(property)) {
                       if(object[property].length <=20)
                           str+='<div class="form-group">\n\
              <label for="%(id)s_'+id+'">'+property+'</label>\n\
              <input type="text" class="form-control parameters" parameter-name="'+property+'" parameter-type="'+id+'"\n\
                placeholder="Enter '+property+'" value="'+object[property]+'"/>\n\
                </div>';
                              else
                                  str+='<div class="form-group">\n\
              <label for="%(id)s_'+id+'">'+property+'</label>\n\
              <textarea rows="10" cols="10" class="form-control parameters" parameter-name="'+property+'" parameter-type="'+id+'"\n\
                placeholder="Enter '+property+'" value="'+object[property]+'">\n\
                '+object[property]+'</textarea>\n\
                </div>';
                
                          }
                      }
                      $('#pw').html(str);
					  $('#pw').removeClass("hide");
					  $('#pw').addClass("show");
					  $('#layoutinfo').removeClass('col-md-9');
					  $('#layoutinfo').addClass('col-md-3');
				   
                      $('.parameters').unbind('change');
                      $('.parameters').change(function(e){saveParameters(e);});
                      /*
       $.get("<?php echo Yii::app()->createUrl('htmlreference/value') ?>"+'?'+'type='+eltype,
       function(data){
         data=$.parseJSON(data)
         var v = {id:id};
         $('#pw').html(sprintf(data.parameters,v));
     })
                       */
                  }
                  function elements(){
                      $('div.elements').click(function(e){
                          e.stopPropagation();
                          $('#divid').val($(this).attr('id'));
                          $('.elements').removeClass('highlight');
                          $(this).addClass('highlight');
           
                      }) ;
                  }
                  function elements1(){
                      $('#layoutinfo').find('div,nav').click(function(e){
                          e.stopPropagation();
                          if ($(this).parents().addBack().is('.viewelement')) return;
                          $('div').removeClass('highlight');
                          $('nav').removeClass('highlight');
                          var el;
                          // alert(e.target.tagName.toLowerCase())
                          if ($(e.target).is('.containerelement')) {el= $(e.target);}
                          else
                              if (e.target.tagName.toLowerCase()!='div') el=$(e.target).parent('div')
                          else if ($(e.target).is('.background')) 
							  el=$(e.target).parent('div')
						  else el = $(e.target)
           
                          el.addClass('highlight');
           
                          selecteddiv=el
						  $('.classinfo').html('<input id="classinfo">');
						  $('#classinfo').val(selecteddiv.attr("class"));
						  $('input#classinfo').change(function(){selecteddiv.attr('class',$('#classinfo').val())});
                          //alert(selecteddiv.attr('class'))
           
                      }) ;
                  }

                  function addcolumns(rows)
                  {
                      var str='';
                      for(i=1;i<=rows;i++)
                      {
                          str+='<span>Row'+i+'<input type="text" size="1" id="cols_'+i+'">';  
                      }
                      str+="<button onclick='js:addDivs("+rows+")'>Add</button>";
                      $('#colinfo').html(str);
                  }
                  function addDivs(rows)
                  {
                      var prefix='';
                      var divid = $('#divid').val()
                      if (divid!='layoutinfo') prefix=divid+'_';
       
                      str1='<script>elements1()<\/script>';
                      str='';
					  //str+="<div class='container'>";
                      for (i=1;i<=rows;i++)
                      {
                          str+='<div class="row">\n\
        ';
                          var cols = $('#cols_'+i).val();
                          var span=  12/cols;
                          for (j=1;j<=cols;j++){
                              str+='<div class="bordered col-md-'+span+'">\n\
                    </div>\n\
  ';  
                              // str+='<script>$("#'+prefix+i+j+'").droppable({drop:function(event,ui){}})<\/script>'
            
                          }
                          str+='</div>'; 
						  
                      }
					  // str+="</div>";
                      // $('#layoutinfo').html(str);
                      //selecteddiv.dialog();
                      selecteddiv.append(str);
                      elements1();
                      viewsrc =$('#layoutinfo').html()
                      //$(viewsrc).dialog()
                      // $('#'+divid).html(str1+str);
                      //if (divid!='layoutinfo'){
                      //var doc = $(viewsrc)
                      // var el1 =doc.find('#'+$('#divid').val()).html(str)
                      //viewsrc = $("<div />").append(doc.clone()).html();
                      //} else 
                      //viewsrc=str;
           
                  }
                  function populateF(classid,destcontainer)
                  {
                      
                      $.get("<?php echo Yii::app()->createUrl('controllers/allF'); ?>"+'?c='+classid,function (data){$('#'+destcontainer).html(data)})
       
            
                  }
                  function newF(afterFunction)
                  {
                      $('#functionid').html(afterFunction)
                      html ='<button id="newbtn" type="button" value="Create" onclick="createF();">Save Function</button>';
					  editor.setValue('public function newfunction(){}');
					  
                     $('#fnsavebtn').hide();
					  $('#viewsavebtn').hide();
					 
                      $('#layoutinfo').removeClass('show');
                      $('#functionspace').removeClass('hide');
                      $('#layoutinfo').addClass('hide');
                      $('#functionspace').addClass('show');
             $('#functionspace').prepend(html);
                  }
                  function loadF(functionid) 
                  {
					  // functionid = $('#function-select').val()
					  $('#functionid').html(functionid);
                      $.get("<?php echo Yii::app()->createUrl('functions/loadF') ?>?id="+functionid,
                      function(data){
                          data = $.parseJSON(data)
                          str=''
                          // str='<div class="edit">'
                          // str='<pre class="pre-scrollable">'
                          // str+='<p>'+data.comments+'</p>'
						  // str+=data.comments
                          //str+='<p>'
                          //str+='function '+data.name+'('+data.parameters+')'
                          //str+='</p>'
                          //str+='<p>{</p>'
                          //str+='<p>'+data.code+'</p>'
                          str+=data.code
                          // str+='<p>}</p>'
                          //str+='</pre>'
                          // str+= '<script>$("pre").snippet("html",{style:"navy",showNum:false});$(".edit").editable("http://www.google.com");<\/script>'
                          //str+='</div>'
                          //$('#functionspace').html(str);
                          //$('#code1').val('');
                          //$('#code1').val(str);
                          //document.getElementById('code1').value = str
						  editor.setValue(str);
                          //editor.setValue('\<\?php \n\
						  // '+str+' \n\
						  //\?\>');
                          $('#layoutinfo').removeClass('show');
                          $('#functionspace').removeClass('hide');
                          $('#layoutinfo').addClass('hide');
                          $('#functionspace').addClass('show');
						  vieworfunction ='fn'
						  $('#viewsavebtn').hide()
						  $('#fnsavebtn').show()
                      })
                  }
				  function showAttributes(model)
				  {
					  $.get('<?php echo Yii::app()->createUrl("models/showAttributes") ?>'+'?model='+model,
					  function(data){$('#model-attributes').html(data)});
				  }
                  function writeC()
                  {
                      controller = $('#controller-select').val()
                      $.get('<?php echo Yii::app()->createUrl("controllers/writeC") ?>'+'?controller='+controller);
                  }
                  function importC()
                  {
                      controller = $('#controller-select').val()
                      $.get('<?php echo Yii::app()->createUrl("controllers/importC") ?>'+'?controller='+controller);
                  }
				  function importViewFromDisk()
				  {
					  $('#layoutinfo').removeClass('show');
                      $('#functionspace').removeClass('hide');
                      $('#layoutinfo').addClass('hide');
                      $('#functionspace').addClass('show');
                      $('#pw').addClass('hide');
                      $('#functionspace').removeClass('col-md-6');
                      $('#functionspace').addClass('col-md-9');
					  $.get('<?php echo Yii::app()->createUrl("sites/importV") ?>'+'?view='+$('#viewname').val(),
					  function(data){editor.setValue(data);vieworfunction='view';});
				  }
				  function showViewSourceFromDisk(view)
				  {
					  $('#layoutinfo').removeClass('show');
                      $('#functionspace').removeClass('hide');
                      $('#layoutinfo').addClass('hide');
                      $('#functionspace').addClass('show');
                      $('#pw').addClass('hide');
                      $('#functionspace').removeClass('col-md-6');
                      $('#functionspace').addClass('col-md-9');
					  $.get('<?php echo Yii::app()->createUrl("sites/getview") ?>?view='+view,
					  function(data){
						  vieworfunction='view';
                                                  viewsrc=data;
                                                  $('#layout').html(data);
						  editor.setValue(data);
						  
					  })
				  }
				   function showViewSourceFromDatabase(view)
				  {
					  $('#layoutinfo').removeClass('hide');
                      $('#functionspace').removeClass('show');
                      $('#layoutinfo').addClass('show');
                      $('#functionspace').addClass('hide');
                      $('#pw').addClass('hide');
                      $('#functionspace').removeClass('col-md-6');
                      $('#functionspace').addClass('col-md-9');
					  $.get('<?php echo Yii::app()->createUrl("view/getview") ?>?view='+view,
					  function(data){
						  vieworfunction='view';
                                                  viewsrc=data;
                                                  
						  editor.setValue(data);
						  
					  })
				  }
				  
                  function showSource() {
					  $('#layoutrendered').removeClass('show');
					  $('#layoutrendered').addClass('hide');
                      $('#layoutinfo').removeClass('show');
                      $('#functionspace').removeClass('hide');
                      $('#layoutinfo').addClass('hide');
                      $('#functionspace').addClass('show');
                      $('#pw').addClass('hide');
                      $('#functionspace').removeClass('col-md-6');
                      $('#functionspace').addClass('col-md-9');
                      
                     vieworfunction=''
                      editor.setValue(getview())
					  $('#fnsavebtn').hide();
					  $('#viewsavebtn').show();
					  
				  }
				  function showRawSource() {
					  $('#layoutrendered').removeClass('show');
					  $('#layoutrendered').addClass('hide');
                      $('#layoutinfo').removeClass('show');
                      $('#functionspace').removeClass('hide');
                      $('#layoutinfo').addClass('hide');
                      $('#functionspace').addClass('show');
                      $('#pw').addClass('hide');
                      $('#functionspace').removeClass('col-md-6');
                      $('#functionspace').addClass('col-md-9');
                     
                      editor.setValue(getRawView())
					  vieworfunction='view'
					  $('#fnsavebtn').hide()
					  $('#viewsavebtn').hide()
				  }
        
                  function showLayout()
                  {
                      $('#layoutinfo').removeClass('hide');
                      $('#functionspace').removeClass('show');
                      $('#layoutinfo').addClass('show');
                      $('#functionspace').addClass('hide');
                      $('#viewsource').removeClass('show');
                      $('#viewsource').addClass('hide');
					  $('#pw').removeClass('show');
                      $('#pw').addClass('hide');
					  $('#layoutinfo').removeClass('col-md-3');
					  $('#layoutinfo').addClass('col-md-9');
					  $('#layoutrendered').removeClass('show');
					  $('#layoutrendered').addClass('hide');
          
                  }
				  function showLayoutRendered()
                  {
                      $('#layoutinfo').removeClass('show');
                      $('#functionspace').removeClass('show');
                      $('#layoutinfo').addClass('hide');
                      $('#functionspace').addClass('hide');
                      $('#viewsource').removeClass('show');
                      $('#viewsource').addClass('hide');
					  $('#pw').removeClass('show');
                      $('#pw').addClass('hide');
					  $('#layoutrendered').removeClass('hide');
					  $('#layoutrendered').addClass('show');
					  $('#layoutrendered').html(getview());
					 
					  
                  }
				  function resetView() 
				  {
					  viewsrc1='';
     viewelements ;
	 containerelements={}
    //= new Array();
     viewelementscount={};
	 containerelementscount={}
	 $('#layoutinfo').html('')
	 selecteddiv=$('#layoutinfo')
				  }
                  function saveParameters(type)
                  { 
                      if (typeof(type)=='object'){
                          type = $(type.target).attr('parameter-type')
                      }
                      $('.parameters[parameter-type="'+type+'"]').each (function(index){
                          // alert(index) 
                          k= $(this);
                          parametername=k.attr('parameter-name');
                          value = k.val();
                          // alert(parametername+'='+value)
                          viewelements[type]['parameters'][parametername]=value;
                      });
                      //var table = prettyPrint(viewelements)
                      //$(table).dialog()
                  }
                  function saveView() 
                  {
                      viewpath = $('#viewname').val()
                      $.post("<?php echo Yii::app()->createUrl('view/saveview'); ?>",{'viewpath':viewpath,'content':getview()},
					  function(data){vieworfunction='';editor.setValue(data)})
                  }
				   function writeView() 
                  {
                      viewpath = $('#viewname').val()
                      $.post("<?php echo Yii::app()->createUrl('view/writeview'); ?>",{'viewpath':viewpath,'site_id':$('#siteselect').val()},
					  function(data){vieworfunction='';editor.setValue(data)})
                  }
				  function createF()
				  {
					  code = editor.getValue();
					  afterFunction=$('#functionid').html();
					$.post("<?php echo Yii::app()->createUrl('functions/createF'); ?>",{'code':code,'afn':afterFunction},
					  function(data){vieworfunction='';$('#functionspace').prepend('<div> Success='+data+'</div>')})  
				  }
				  function saveFunction()
				  {
					  functionid=$('#functionid').html()
					  newcode= $('#code1').val()
					  $.post("<?php echo Yii::app()->createUrl('functions/saveFunction'); ?>",{'fid':functionid,'newcode':newcode});
				  }
                  function replaceViewElementWrapper (z){
                      if (z.children('div').length>=1)
                      {
                          z.children('div').each(function(){replaceViewElementWrapper($(this))});
                      } else {
                          attr=z.attr('viewelement-id');
                          if (typeof attr !== 'undefined' && attr !== false){
                              elid='%('+z.attr('viewelement-id')+')s'
                              z.parent().append(elid)
                              z.remove()
                          }
                      }
                      //  el = $('%('+$(this).attr('viewelement-id')+')s');
                      // $(this).html('%('+$(this).attr('viewelement-id')+')s')
                  }
				  function getRawView()
				  {
					  a=$('#layoutinfo').html();
					  a=html_beautify(a, {
                          'indent_inner_html': false,
                          'indent_size': 2,
                          'indent_char': ' ',
                          'wrap_line_length': 78,
                          'brace_style': 'expand',
                          'unformatted': ['a', 'sub', 'sup', 'b', 'i', 'u'],
                          'preserve_newlines': true,
                          'max_preserve_newlines': 5,
                          'indent_handlebars': false
                      });
					  
                      return a;
				  }
                  function getview()
                  {
                      var x={}
					  viewsrc = "<div>"+$('#layoutinfo').html()+"</div>";
                      //var jq2 = jQuery(dom)
					  var doc = $(jQuery.parseHTML(viewsrc))
					  doc.find('.background').remove()
                      doc.find('.bordered').removeClass('bordered');
                      doc.find('.highlight').removeClass('highlight');
					  
                      doc.find('div.viewelement').each(function(){
                          elid='%('+jQuery(this).attr('viewelement-id')+')s'
                          jQuery(this).parent().append(elid)
                          jQuery(this).remove()
                      });
                      
                      viewsrc=doc.html();
                      for(key in viewelements){
                          if(viewelements.hasOwnProperty(key)){
                              x[key]=sprintf(viewelements[key]['code'],viewelements[key]['parameters'])
                              //console.log("key = " + key + ", value = " + dict[key]);
                          }
                      }
                      a=sprintf(viewsrc,x)
                      a=html_beautify(a, {
                          'indent_inner_html': false,
                          'indent_size': 2,
                          'indent_char': ' ',
                          'wrap_line_length': 78,
                          'brace_style': 'expand',
                          'unformatted': ['a', 'sub', 'sup', 'b', 'i', 'u'],
                          'preserve_newlines': true,
                          'max_preserve_newlines': 5,
                          'indent_handlebars': false
                      });
					  
                      return a;
                  }
  
                  //$('.parameters').change(function(e){saveParameters(e);});
                  function addDivHere(e)
                  {
                      count=e.parent('div').attr('count')
                      el=e.parent('div').children('div.groupf[count="1"]').clone()
                      el.attr('count', parseInt(count)+1)
                      e.parent('div').attr('count',parseInt(count)+1)
                      e.parent('div').append('<br/>')
                      e.parent('div').append(el)
                      name = e.parent('div').attr('p-n')
                      changeinput(name)
                  }
                  function changeinput(name)
                  {
                      $('[p-n="'+name+'"]').unbind('change')
                      $('[p-n="'+name+'"]').change(function(){
                          str='array( ';
                          for (i=1;i<=parseInt($('div.groupc[p-n="'+name+'"]').attr('count'));i++) {
                              mode=$('div.groupc[p-n="'+name+'"]').attr('mode')
    
                              if (mode!='nv')
                                  str+='array(';
                              $('div.groupf[p-n="'+name+'"]'+'[count="'+i+'"]') .find('*[p-n="'+name+ '"]').each(function(i,el1){
                                  el = $(el1)
                                  if (mode!='nv')
                                      str+="'"+el.attr('name')+"'=>"+"'"+el.val()+"',";
                                  else 
                                  {
                                      if (el.attr('name')==='name') str+="'"+el.val()+"'";
                                      if (el.attr('name')==='value') str+="=>'"+el.val()+"',";
                                  }
       
                              });
                              if (mode!='nv')
                                  str+='),';
                          }
                          str+=')'
                          el =$('input.parameters[parameter-name="'+name+'"]');
                          el.val(str);
                          // alert(str);
          
                          saveParameters(el.attr('parameter-type'));
                      });
                  }

function updateviewelement(viewid)
{
    
    $.get("<?php echo Yii::app()->createUrl('view/allVE'); ?>"+'?viewid='+viewid,function (data){$('#viewelement').html(data)})
}
function showviewelement(viewelementid)
{
   $.get("<?php echo Yii::app()->createUrl('viewelements/gethtml'); ?>"+'?veid='+viewelementid,function (data){$('#rawviewelement').html(data)}) 
}
function addViewElementRaw()
{
   editor.replaceSelection($('#rawviewelement').html(), focus);
    editor.focus();
}
</script>
<div class="row">
	<nav class="navbar navbar-default">
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">

			</ul>
			<div class="navbar-form">
				<div class="form-group">
					View Elements:<select id="viewelement-select">
						<?php echo Htmlreference::model()->listAllAsOptions() ?>

					</select><button class="btn btn-success btn-xs" onclick="js:addviewelement()">Add</button>
				</div>

				<div class="form-group">
					Containers:<select id="containerelement-select" >
						<?php echo Htmlreference::model()->listAllContainers() ?>

					</select><button class="btn btn-success btn-xs" onclick="js:addContainerElement()">Add</button>
				</div>
				<div class="form-group">
			<span>Rows:</span><input type="text" size="2" id ="noofrows" name="noofrows" value="1"/>
		<button onclick="js:addcolumns($('#noofrows').val())">Add</button>
		<span id="colinfo">
		</span>
		<div class="classinfo">Selected DIV css</div>
			</div>
					<div class="btn-group navbar-right">
				
		<button onclick="js:resetView()" type="button" class="btn btn-info">
			Reset
		</button>

		<button onclick="js:showSource()" type="button" class="btn btn-success">
			Source
		</button>

		<button type="button" class="btn btn-danger" onclick="js:showLayout()">Layout</button>

		<button type="button" class="btn btn-warning"  onclick="js:showLayoutRendered()">Rendered</button>

		<button type="button" onclick="js:showRawSource()" class="btn btn-default">
			Raw Source
		</button>
		
	</div>
			</div>
			
		
		</div>
	</nav>
	
</div>
<div class='row'>
    <div class=" col-md-3">
		<div class="panel-group">
			<div class="panel panel-info">
				<div class="panel-heading">
					Site Info for <?php $siteid= Yii::app()->session['site_id'];
					
					if ($siteid)
						{
						$site=Sites::model()->findByPk($siteid);
						echo "<b>".$site->name."</b>";
						
						} else { echo "<No site selected>";}
					?>
					<span class="glyphicon glyphicon-refresh" onclick="refreshList()"></span>
				</div>
				<div class="panel-body">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs">
						<li><a href="#models" data-toggle="tab">Models</a></li>
						<li><a href="#views" data-toggle="tab">Views</a></li>
						<li><a href="#controllers" data-toggle="tab">Controllers</a></li>

					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="models">

							<div class="row">
								<div class="col-md-12">
									<label for="model-select">Models:</label>
									<select id="model-select" class="form-control input-mini" onChange="js:populateF($(this).val(),'mf-select')">
										<option value="Hi">Hi</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label for="model-select">Model Functions:</label>
									<select id="mf-select" class="form-control" onchange="">
										<option value="Hi">Hi</option>
									</select>
								</div>
							</div>
							<div class="row" >

								<div class="col-md-3">
									<button class="btn btn-success" style="font-size:10px;" onclick="showAttributes($('#model-select').val())">Attributes</button>
								</div>
								<div class="col-md-3">
									<button class="btn btn-success" style="font-size:10px;" onclick="js:loadF($('#mf-select').val())">View Code</button>
								</div>
								
								<div class="col-md-3">
									<button style="font-size:10px;" onclick="newF($('#mf-select').val())" class="btn btn-success">New Function</button>
								</div>
							</div>
							<div class="row">
								<div id="model-attributes"></div>
							</div>

						</div>
						<div class="tab-pane" id="views">


							<div class="panel panel-primary">
								<div class="panel-heading"> View</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<label for="model-select">Views:</label>
											<select id="view-select" class="form-control" onchange="$('#viewname').val($(this).find('option:selected').text())">
												<option value="Hi">Hi</option>
											</select>
										</div>
									</div>
									<div class="row">
										<span class="hide">Divid:<input size="5" id="divid" value="layoutinfo" ></span>
										<label>View Path:</label>
										<input class="form-control" id="viewname"/>
									</div>
									<div class="row">
										<div class="btn-group">
										<button class="btn btn-success" onclick="js:showViewSourceFromDatabase($('#viewname').val())">Show view</button>
										
										<button class="btn btn-success" onclick="js:showViewSourceFromDisk($('#viewname').val())">Show view File</button>
										<button class="btn btn-success" onclick="js:importViewFromDisk()">Import From Disk</button>
										<button class="btn btn-success" onclick="js:writeView()">Write View to Disk</button>
										
										</div>
									</div>


								</div>
							</div>
						</div>
						<div class="tab-pane" id="controllers">
							<div class="panel panel-default panel-success">
								<div class="panel-heading"> Controller Info</div>
								<div class="panel-body">
									<label for="controller-select"> </label>
									<select id="controller-select" class="form-control input-sm" onChange="js:populateF($(this).val(),'cf-select')">
										<option value="Hi">Hi</option>
									</select>

									<div class="row">
										<div class="col-md-12">
											<label >Controller Functions:</label>
											<select id="cf-select" class="form-control" onchange="">
												<option value="Hi">Hi</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<button class="btn btn-success" onclick="js:loadF($('#cf-select').val())">View Code</button>
										</div>
										<div class="col-md-3">
									<button style="font-size:10px;" onclick="newF($('#cf-select').val())" class="btn btn-success">New Function</button>
								</div>
									</div>
								</div>
							</div>  
						</div>
					</div>

				</div>
			</div>



		</div>


	</div>


	<div id="layoutinfo" class='well col-md-9 show'>

	</div>
	<div id="layoutrendered" class='well col-md-9 hide'>

	</div>
	<div id="viewsource" class='well col-md-9 hide'>

	</div>
	<div id="functionspace" class="well col-md-9 hide">
		<div class="hide" id="functionid"></div>
		<div class="row">
			<div id="classpath"></div>
			<div id="fnsavebtn" class="pull-right">
				<button class="btn btn-success" onclick="js:saveFunction()">
					<span class="glyphicon glyphicon-save">Save Function</span>
				</button>
			</div>
			<div id="viewsavebtn" class="pull-right">
				<button class="btn btn-success" onclick="js:saveView()">
					<span class="glyphicon glyphicon-save"> Save View</span>
				</button>
			</div>
		</div>
		<div class="row">
			<textarea id="code1" rows="20" cols="20">Hi
			</textarea>
		</div>
	</div>

	<div id="pw" class='well col-md-6 hide'>


	</div>
</div>
<div class="row">
    <nav class="navbar navbar-default">
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">

			</ul>
			<div class="navbar-form">
				<div class="form-group">
					View Elements:<select id="rawviews" onChange="js:updateviewelement($(this).val())">
						<?php echo View::model()->listAllAsOptions() ?>

					</select>
				</div>

				<div class="form-group">
					Raw View Elements:<select id="viewelement" onChange="js:showviewelement($(this).val())" >
						

					</select><button class="btn btn-success btn-xs" onclick="js:addViewElementRaw()">Add</button>
				</div>
                            <div class="form-group" id="rawviewelement">
                                
                            </div>
                        </div>
</div>


