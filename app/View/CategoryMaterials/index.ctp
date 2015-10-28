<h2>Mixing Categories</h2>
<?php echo $this->Html->link(__('Add Mixing Category'), array('action' => 'add'), ['class'=>'btn btn-primary pull-right']); ?>
<br><br>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4>Categories</h4>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover">
            <tr class="success">
                <td>ID</td>
                <td>Name</td>
                <td>Action</td>
            </tr>
            <?php $i=1;?>
            <?php foreach($categoryItems as $c):?>
            <tr>
                <td><?=$i++;?></td>
                <td><?=$c['category_materials']['name'];?></td>
                <td><?php echo $this->Html->link('Edit',array('action' => 'edit', $c['category_materials']['id'])); ?> 
                    <!--$this->Html->link('Delete',array('action' => 'delete', $c['category_materials']['id']),  array('confirm' => 'Are you sure you wish to delete this item?'));-->
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
    <div class="panel-footer">

    </div>
</div>