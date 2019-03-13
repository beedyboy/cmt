 

<div id="alert_message_mod"> 
	 	 
	 </div>

<form  method="post"  class="storeRecovery" role="form">
	 
	<input type="hidden" name="id" value="<?=$this->data->id?>">
<div class="form-group">

<label>Recovery Question</label> 
<textarea name="acc_question" id="" cols="10" rows="3" class="form-control"><?=$this->data->acc_question?></textarea>
 </div>

 <div class="form-group">
<label>Recovery Answer</label>
<textarea name="acc_answer" id="" cols="10" rows="3" class="form-control"><?=$this->data->acc_answer?>
	 
</textarea>
 </div>
 
 
 
<div class="form-group">
 
 <button type="submit" class="btn btn-info"><span class="fas fa-save"></span> Save Update</button>
 </div>

 
</form>
  