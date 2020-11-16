<h1>Node add</h1>
<?php echo validation_errors(); ?>

<?php echo form_open('b/main/nodeAdd/'.$id); ?>

<div class="form-group row col-10" >
<label for="nodeName">Node name</label>
<input class="form-control" type="text" placeholder="nodeName" id="nodeName" name="nodeName"/>
</div>

<div class="form-group row col-10">
<label for="ipAdress">IP address</label>
<input class="form-control" type="text" placeholder="0.0.0.0" id="ipAdress" name="ipAddress"/>
</div>

<input class="btn btn-primary" type="submit" value="Submit" />

</form>
<br />
