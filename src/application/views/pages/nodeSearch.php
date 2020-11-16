<h1>Node Search</h1>
<?php echo validation_errors(); ?>

<?php echo form_open('b/main/nodeSearch'); ?>

<div class="form-group row col-10" >
<label for="nodeName">Поиск</label>
    <input class="form-control" type="text" placeholder="[nodeName] or [ipAddress]" id="lookFor" name="lookFor"/>
  </div>
<input class="btn btn-primary" type="submit" value="Найти" />

</form>
<br />