<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php echo $this->Html->link(__('List Mixing Category'), array('action' => 'index'), ['class'=>'btn btn-primary pull-right']); ?>
            <br><br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Add new Item</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <form method="post">
                            <td>Name</td>
                            <td><input required="required" type="text" name="name" value="" class="form-control" placeholder="Category Name"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="Submit" class="btn btn-primary pull-right"></td>
                            </form>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>
</div>