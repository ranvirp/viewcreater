<div class="well col-md-6">
  <form role="form" method="post" >
    <div class="form-group">
      <label for="htmlreference[htmltype]">Html Type</label>
      <input type="text" class="form-control" name="htmlreference[htmltype]" placeholder="Enter Html Type" 
              value="<?php echo $model->htmltype;?>"/>
    </div>
      <div class="form-group">
      <label for="htmlreference[cssframeworkname]">Css Framework Name</label>
      <input type="text" class="form-control" name="htmlreference[cssframeworkname]" placeholder="Enter CSS Framework" 
              value="<?php echo $model->cssframeworkname;?>"/>
    </div>
      <div class="form-group">
      <label for="htmlreference[container]">Container</label>
      <select  class="form-control" name="htmlreference[container]"  >
		  <option value="n" selected>No</option>
          <option value="y">Yes</option>
          
          
      </select>
    </div>
      <input type="hidden" name="htmlreference[id]" value="<?php echo $model->id; ?>"/>
    <div class="form-group">
      <label for="htmlreference[parameters]">Parameters</label>
      <input type="text" class="form-control" name="htmlreference[parameters]" placeholder="Enter Parameters"
              value="<?php echo htmlentities($model->parameters, ENT_QUOTES);?>"/>
    </div>
    <div class="form-group">
      <label for="htmlreference[dummycode]">Dummy Code</label>
      <textarea class="form-control" rows="2" name="htmlreference[dummycode]" >
      <?php echo $model->dummycode;?></textarea>
    </div>
</div>
<div class="well col-md-6 highlight">
  <div class="form-group">
    <label for="htmlreference[code]">Code</label>
    <textarea class="form-control" rows="6" name="htmlreference[code]" ><?php echo $model->code;?></textarea>
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
</form>
</div>
