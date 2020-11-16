<h3>Result of search: <?php echo $find->num_rows();?></h3>
<div class="list-group">
<?php foreach($find->result_array() as $row) :?>
<a class="list-group-item list-group-item-action" href="<?=base_url();?>b/main/getTree/<?=$row['id'];?>"><?=$row['nodeName'];?></a>
<?php endforeach;?>
</div>
<hr />
<p><?php echo anchor('b/main/nodeSearch', 'Try it again!', 'class="btn btn-success"/'); ?></p>