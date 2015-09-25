<script>
    $(document).ready(function () {
        $('.nepalidatepicker').nepaliDatePicker();
    });
    $(document).ready(function () {
        $("#nepalidatepicker").focus(function (e) {
            //$("span").css("display", "inline").fadeOut(2000);
            //console.log("focus")
            showCalendarBox('nepalidatepicker');
        });
    });
</script>
<div class="timeLosses index">
    <div class="panel panel-primary">
        <div class="panel-heading"><?php echo __('Time Losses For '); ?> </div>
        <div class="panel-body">
            <table>
                <?php
                echo $this->Search->create();
                echo '<tr><td>' . $this->Search->input('filter1', array('id' => 'nepalidatepicker', 'class' => 'nepalidatepicker')) . '</td>';
                echo '<td>' . $this->Search->end(__('Search', true)) . '</td>';
                ?>
                <td><?php echo $this->Html->link("Add", array('controller' => 'TimeLosses', 'action' => 'add'), array('class' => 'btn btn-primary')); ?>  
                <a class="btn btn-success" href="<?=$base_url;?>Timelosses/exportcsv"><i class="glyphicon glyphicon-download"></i> Export CSV</a>
                </td>

                </tr>
            </table>
        </div>
    </div>
    <table class="col-md-12 table-bordered table-striped table-condensed cf">
        <tr>
            <th><?php echo $this->Paginator->sort('nepalidate'); ?></th>
            <th><?php echo $this->Paginator->sort('shift'); ?></th>
            <th><?php echo $this->Paginator->sort('department_id'); ?></th>
            <th><?php echo $this->Paginator->sort('type'); ?></th>
            <th><?php echo $this->Paginator->sort('reasons'); ?></th>
            <th><?php echo $this->Paginator->sort('StartTime'); ?></th>
            <th><?php echo $this->Paginator->sort('EndTime'); ?></th>
            <th><?php echo $this->Paginator->sort('LossTime'); ?></th>

            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php $losses_current =0;?>
        <?php foreach ($timeLosses as $timeLoss): ?>
            <tr>
                <td><?php echo h($timeLoss['TimeLoss']['nepalidate']); ?>&nbsp;</td>
                <td><?php echo h($timeLoss['TimeLoss']['shift']); ?>&nbsp;</td>

                <!-- <td><?php echo h('Calendar'); ?>&nbsp;</td> -->
                <td><?php echo h($timeLoss['TimeLoss']['department_id']); ?>&nbsp;</td>
                <td><?php echo h($timeLoss['TimeLoss']['type']); ?>&nbsp;</td>
                <td><?php echo h($timeLoss['TimeLoss']['reasons']); ?>&nbsp;</td>
                <td><?php echo h($timeLoss['TimeLoss']['time']); ?>&nbsp;</td>
                    <?php /*echo h($timeLoss['TimeLoss']['time']).'='.h($timeLoss['TimeLoss']['totalloss_sec']).'<br>';*/?>
                <td><?php echo h($timeLoss['TimeLoss']['wk_hrs']); ?>&nbsp;</td>
                <td><?php echo h($timeLoss['TimeLoss']['totalloss']); ?>&nbsp;</td>
                <td class="actions">
                    
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $timeLoss['TimeLoss']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $timeLoss['TimeLoss']['id']), null, __('Are you sure you want to delete # %s?', $timeLoss['TimeLoss']['id'])); ?>
                </td>
            </tr>
            <?php
                $losses_current = $losses_current+h($timeLoss['TimeLoss']['totalloss_sec']);
            ?>
        <?php endforeach; ?>
        <tr>
            <?php
            function time_elapsed($secs){
                if(isset($secs)):
                    $bit = [
                        'Years' => $secs / 31556926 % 12,
                        'Weeks' => $secs / 604800 % 52,
                        'Days' => $secs / 86400 % 7,
                        'Hours' => $secs / 3600 % 24,
                        'Minutes' => $secs / 60 % 60,
                        'seconds' => $secs % 60
                    ];
                    foreach($bit as $k => $v)
                        if($v > 0) {
                            $ret[] = $v .' '. $k;
                        }
                    return join(' ', $ret);
                endif;
            }
            ?>
            <td colspan="7" align="right"><strong>Total Time Loss of Current Data:</strong></td>
            <td><strong><?php echo time_elapsed($losses_current); ?></strong></td>
        </tr>
        <tr>
            <td colspan="7" align="right"><strong>Total Time Loss:</strong></td>
            <td><strong><?php echo $losses; ?></strong></td>
        </tr>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>    </p>
    <ul class="pagination">
        <li><?php
            echo $this->Paginator->prev(' ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . '', array(), null, array('class' => 'next disabled'));
            ?>
        </li>
    </ul>
</div>

