<div class="panel panel-primary">
        <div class="panel-heading"><?php echo __('Calendar Scrap'); ?> </div>
        <div class="panel-body">
            <table>
                
                <td><?php echo $this->Html->link(__('New Calendar Scrap'), array('action' => 'add'), ['class' => 'btn btn-primary pull-right']); ?>
                </td>
                <td>
                <a class="btn btn-success" href="<?=$base_url;?>CalenderScraps/exportcsv"><i class="glyphicon glyphicon-download"></i> Export CSV</a>
                </td>

                </tr>
                <br/>



                <div class="calenderScraps index">
   
    <table class="col-md-12 table-bordered table-striped table-condensed cf">
    <br/>
        <tr>
            <th><?php echo $this->Paginator->sort('date'); ?></th>
            <th><?php echo $this->Paginator->sort('resuable'); ?></th>
            <th><?php echo $this->Paginator->sort('lamps_plates'); ?></th>
            <th><?php echo $this->Paginator->sort('total_scrap_generated'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($calenderScraps as $calenderScrap): ?>
            <tr>
                <td><?php echo h($calenderScrap['CalenderScrap']['date']); ?>&nbsp;</td>
                <td><?php echo h(number_format($calenderScrap['CalenderScrap']['resuable'],2)); ?>&nbsp;</td>
                <td><?php echo h(number_format($calenderScrap['CalenderScrap']['lamps_plates'],2)); ?>&nbsp;</td>
                <td><?php echo h(number_format($calenderScrap['CalenderScrap']['total_scrap_generated'],2)); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $calenderScrap['CalenderScrap']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $calenderScrap['CalenderScrap']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $calenderScrap['CalenderScrap']['id']), null, __('Are you sure you want to delete # %s?', $calenderScrap['CalenderScrap']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><br/>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>    </p>

    <ul class="pagination">
        
        <li><?php echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));?></li>
        <li><?php echo $this->Paginator->numbers(array('separator' => ''));?></li>
        <li><?php echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')); ?></li>
    </ul>
    </div>
</div>
            </table>
        </div>
    </div>



