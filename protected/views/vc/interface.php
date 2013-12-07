<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
print <<<EOT
<script type="text/javascript" src="/viewcreater/js/codemirror-3.19/lib/codemirror.js"></script>
<link rel="stylesheet" type="text/css" href="/viewcreater/js/codemirror-3.19/lib/codemirror.css" />
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
    
</style>



<script>
    var viewsrc='';
    var viewsrc1='';
    var viewelements={} ;
    //= new Array();
    var viewelementscount={};
    var editor;
    var delay;
    var selecteddiv;
    //=new Array();     
    $(document).ready(function(){
        selecteddiv=$('#layoutinfo');
        $('#yw0').append('<li>Site:<select id="siteselect"></select><button id="siteselect-btn">Change</button></li>');
        $.get('<?php echo Yii::app()->createUrl('sites/allsites'); ?>',function (data){$('#siteselect').html(data)})
        // $.get('<?php echo Yii::app()->createUrl('functions/allF'); ?>?controller='+$('#controller-select').val(),function (data){$('#function-select').html(data)})
        
        // $.get('<?php echo Yii::app()->createUrl('sites/allc'); ?>',function (data){$('#controller-select').html(data)})
       
        $.get('<?php echo Yii::app()->createUrl('sites/getpath'); ?>',function (data){$('#sitepath').html(data+'/protected/views/')})
        $('#siteselect-btn').click(function(){$.get("<?php echo Yii::app()->createUrl('sites/addsitetosession'); ?>"+'?site_id='+$('#siteselect').val(),
            function(data){
                $('#sitepath').html(data+'/protected/views/')
                //  $.get('<?php echo Yii::app()->createUrl('functions/allF'); ?>?controller='+$('#controller-select').val(),function (data){$('#function-select').html(data)})
        
                //  $.get('<?php echo Yii::app()->createUrl('sites/allc'); ?>',function (data){$('#controller-select').html(data)})
       
                // changeinput()      
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
            delay = setTimeout(function(){$('#code1').val(editor.getValue());saveView();}, 300);
        });
    });
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
                          else el = $(e.target)
           
                          el.addClass('highlight');
           
                          selecteddiv=el
                          alert(selecteddiv.attr('class'))
           
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
                  function populateF()
                  {
                      controller=$('#controller-select').val()
                      $.get("<?php echo Yii::app()->createUrl('functions/allF'); ?>"+'?controller='+$('#controller-select').val(),function (data){$('#function-select').html(data)})
       
            
                  }
                  function newF()
                  {
                      controller = $('#controller-select').val()
                      html ="<form role='form' action='<?php echo Yii::app()->createUrl('functions/createF') ?>' method='post'>"
                      html +='<input type="hidden" value="'+controller+'" class="form-control" name="functions[controller]"></div>'
                      html +='<label for="functions[comments]">Comments</label>';
                      html +='<textarea rows="2" class="form-control" name="functions[comments]" ></textarea>';
                      html +='<div class="form-group">';
                      html +='<label for="functions[name]">Name of Function</label>';
                      html +='<input type="text" class="form-control" name="functions[name]" placeholder="Name"></div>'
                      html +='<div class="form-group">';
                      html +='<label for="functions[parameters]">Parameters</label>';
                      html +='<input type="text" class="form-control" name="functions[parameters]" placeholder="$x,$y"></div>'
                      html +='<label for="functions[code]">Code</label>';
                      html +='<textarea rows="4" class="form-control" name="functions[code]" ></textarea>';
                      html +='<input type="submit" value="Submit" onsubmit="$(this).submit();$(this).clear();return false;"/>'
                      $('#functionspace').html(html);
                      $('#layoutinfo').removeClass('show');
                      $('#functionspace').removeClass('hide');
                      $('#layoutinfo').addClass('hide');
                      $('#functionspace').addClass('show');
            
                  }
                  function loadF() 
                  {
                      functionid = $('#function-select').val()
                      $.get("<?php echo Yii::app()->createUrl('functions/loadF') ?>?id="+functionid,
                      function(data){
                          data = $.parseJSON(data)
                          str=''
                          // str='<div class="edit">'
                          // str='<pre class="pre-scrollable">'
                          // str+='<p>'+data.comments+'</p>'
                          str+=data.comments
                          //str+='<p>'
                          str+='function '+data.name+'('+data.parameters+')'
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
                          editor.setValue('\<\?php \n\
             '+str+' \n\
\?\>');
                          $('#layoutinfo').removeClass('show');
                          $('#functionspace').removeClass('hide');
                          $('#layoutinfo').addClass('hide');
                          $('#functionspace').addClass('show');
                      })
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
                  function showSource() {
             
                      $('#layoutinfo').removeClass('show');
                      $('#functionspace').removeClass('hide');
                      $('#layoutinfo').addClass('hide');
                      $('#functionspace').addClass('show');
                      $('#pw').addClass('hide');
                      $('#functionspace').removeClass('col-md-6');
                      $('#functionspace').addClass('col-md-9');
                      
                      // $('#viewsource').removeClass('hide');
                      //$('#viewsource').addClass('show');
                       editor.setValue(getview())
                      //$.get('<?php echo Yii::app()->createUrl("controllers/htmlentities") ?>?src='+encodeURIComponent(viewsrc),function(data){viewsrc1=data;});
            
                      //$('#viewsource').html ('<pre class="pre-scrollable">'+viewsrc1+'</pre><script>$("pre").snippet("php",{style:"navy",showNum:false});<\/script>')
                  }
        
                  function showLayout()
                  {
                      $('#layoutinfo').removeClass('hide');
                      $('#functionspace').removeClass('show');
                      $('#layoutinfo').addClass('show');
                      $('#functionspace').addClass('hide');
                      $('#viewsource').removeClass('show');
                      $('#viewsource').addClass('hide');
                      $('#pw').removeClass('hide');
          
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
                      viewpath = $('#sitepath').html()+$('#viewname').val()+'.php'
                      $.post("<?php echo Yii::app()->createUrl('view/saveview'); ?>",{'viewpath':viewpath,'content':getview()},function(data){$('#saveviewresult').html('View Saved!')})
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
                  function getview()
                  {
                      var x={}
                      viewsrc = $('#layoutinfo').html()
                      var doc = $(viewsrc)
                      doc.find('.bordered').removeClass('bordered');
                      doc.find('.highlight').removeClass('highlight');
                      doc.find('div.viewelement').each(function(){
                          elid='%('+$(this).attr('viewelement-id')+')s'
                          $(this).parent().append(elid)
                          $(this).remove()
                      });
                      
                      viewsrc=doc.html()
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


</script>
<div class="row well">
    View Path:<span id="sitepath"></span><span>/<input id="viewname" size="20"></span>

    <span>Rows:</span><input type="text" size="2" id ="noofrows" name="noofrows" value="1"/>
    <span>Divid:<input size="5" id="divid" value="layoutinfo" ></span>
    <button onclick="js:addcolumns($('#noofrows').val())">Add</button>
    <span id="colinfo">
    </span>
    <p><button class="btn" onclick="js:showSource()">Show View Source</button><button class="btn" onclick="js:showLayout()">Show Layout</button>
        <button class="btn" onclick="js:saveView()">Save View</button></p>
</div>
<div class='row'>
    <div class="well col-md-3">
        <span>Controllers</span>
        <select id="controller-select" onclick="js:populateF()">
            <option value="Hi">Hi</option>
        </select><button id ="newc" class="btn btn-success btn-xs">New</button>
        <button id ="writec" class="btn btn-success btn-xs" onclick="js:writeC()">W</button>
        <button id ="importc" class="btn btn-success btn-xs" onclick="js:importC()">I</button>

        <p>Functions </p>
        <select id="function-select" onchange="js:loadF()">
            <option value="Hi">Hi</option>
        </select>
        <button id ="loadf" class="btn btn-success btn-xs" onclick="js:loadF()">Load</button>
        <button id="newf" class="btn btn-success btn-xs" onclick="js:newF()">New</button>
        <p></p>
        <span>Models</span>
        <select id="model-select">
            <option value="Hi">Hi</option>
        </select>
        <p ></p>
        <span class="label label-primary">View Elements</span>
        <p></p>
        Select:<select id="viewelement-select">
            <?php echo Htmlreference::model()->listAllAsOptions() ?>

        </select>
        <button class="btn btn-success btn-xs" onclick="js:addviewelement()">Add</button>
        Containers:<select id="containerelement-select">
            <?php echo Htmlreference::model()->listAllContainers() ?>

        </select>
          <button class="btn btn-success btn-xs" onclick="js:addContainerElement()">Add</button>
      
        
    </div>

    <div id="layoutinfo" class='well col-md-6 show'>

    </div>
    <div id="viewsource" class='well col-md-6 hide'>

    </div>
    <div id="functionspace" class="well col-md-6 hide">
        <textarea id="code1" rows="20" cols="20">Hi
        </textarea>
    </div>

    <div id="pw" class='well col-md-3'>

    </div>
    <div class="well row"></div>
</div>