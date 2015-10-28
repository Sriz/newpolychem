<div class="baseEmbosses index">
    <h2><?php echo __('Base Embosses'); ?></h2>
    <table class="col-md-12 table-bordered table-striped table-condensed cf">
        <tr>

            <th><?php echo $this->Paginator->sort('Brand'); ?></th>
            <th><?php echo $this->Paginator->sort('Dimension'); ?></th>
            <th><?php echo $this->Paginator->sort('Type'); ?></th>
            <th><?php echo $this->Paginator->sort('Color'); ?></th>
            <th><?php echo $this->Paginator->sort('Emboss'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($baseEmbosses as $baseEmboss): ?>
            <tr>
                <td><?php echo h($baseEmboss['BaseEmboss']['Brand']); ?>&nbsp;</td>
                <td><?php echo h($baseEmboss['BaseEmboss']['Dimension']); ?>&nbsp;</td>
                <td><?php echo h($baseEmboss['BaseEmboss']['Type']); ?>&nbsp;</td>
                <td><?php echo h($baseEmboss['BaseEmboss']['Color']); ?>&nbsp;</td>
                <td><?php echo h($baseEmboss['BaseEmboss']['Emboss']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $baseEmboss['BaseEmboss']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $baseEmboss['BaseEmboss']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $baseEmboss['BaseEmboss']['id']), null, __('Are you sure you want to delete # %s?', $baseEmboss['BaseEmboss']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>
    </p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => '&nbsp;'));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Base Emboss'), array('action' => 'add')); ?></li>
    </ul>
</div>
