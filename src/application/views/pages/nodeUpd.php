<h1>Update Node</h1>
<?php echo validation_errors(); ?>

<?php echo form_open('b/main/nodeUpd/'.$id); ?>

<div class="form-group row col-10" >
<label for="nodeName">Node name</label>
<input class="form-control" type="text" value="<?=$node['nodeName'];?>" id="nodeName" name="nodeName"/>
</div>

<div class="form-group row col-10">
<label for="ipAdress">IP address</label>
<input class="form-control" type="text" value="<?=$node['ipAddress'];?>" id="ipAddress" name="ipAddress"/>
</div>

<div class="form-group row col-10">
<label for="idParent">PID</label>
<input class="form-control alert-danger" type="text" value="<?=$node['idParent'];?>" id="idParent" name="idParent"/>
</div>

<div class="form-group row col-10">
<label for="weight">Weight</label>
<input class="form-control" type="text" value="<?=$node['weight'];?>" id="weight" name="weight"/>
</div>

<input class="btn btn-primary" type="submit" value="Submit" />

</form>
<br />
