<script>
    $(document).ready(function () {
        var value = ''
        $('.npicker').nepaliDatePicker();
        // Trigger On change/Selected event
        $.onChangeDatepicker_Ravindra = function (selectedDate) {
            value = $("#npicker").val();
            $.ajax({
                url: "/polychem/PrintingShiftreports/create_printingpdf",
                type: "POST",
                cache: false,
                data: {city_id: value}
            });
        }
    });
</script>
<div class="printingShiftreports index">
    <div class="panel panel-primary">
        <div class="panel-heading"><?php echo __('Daily Printing  Shift Report'); ?> </div>
        <div class="panel-body">
            <table>
                <?php
                echo $this->Search->create();
                echo '<tr><td>' . $this->Search->input('filter1', array('id' => 'npicker', 'class' => 'npicker')) . '</td>';
                echo '<td>' . $this->Search->end(__('Search', true)) . '</td>';
                ?>
                <td>
                    <button class="btn btn-primary"
                            onclick="window.location.href='<?php echo Router::url(array('controller' => 'PrintingShiftreports', 'action' => 'add')) ?>'">
                        Add
                    </button>
                </td>
                <td>
                    <button class="btn btn-warning" onclick="return print(this);"><i class="glyphicon glyphicon-download"></i> Download PDF</button>
                </td>
                <td>
                    <a class="btn btn-success" href="<?=$base_url;?>PrintingShiftreports/exportcsv"><i class="glyphicon glyphicon-download"></i> Export CSV</a>
                </td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        function print(that)
        {
            var date = $('#npicker').val();
            var url = "<?php echo Router::url(array('controller' => 'PrintingShiftreports', 'action' => 'download_pdf'))?>" + "?date=" + date;
            window.open(url);
        }
    </script>
    <ul class="pagination pagination-sm">
        <?php
        echo '<li>'.$this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')) . '</li>';
        echo '<li>'.$this->Paginator->numbers(array('separator' => '')) . '</li>';
        echo '<li>'.$this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')) . '</li>';
        ?>
    </ul>

    <div class="row">

        <h2><?php echo __('Printing Shift Reports'); ?></h2>
        <table class="col-md-12 table-bordered table-striped table-condensed cf">
            <tr>
                <th><?php echo $this->Paginator->sort('shift'); ?></th>
                <th><?php echo $this->Paginator->sort('date'); ?></th>

                <th><?php echo $this->Paginator->sort('dimension'); ?></th>
                <th><?php echo $this->Paginator->sort('PF_Color'); ?></th>
                <th><?php echo $this->Paginator->sort('color_code'); ?></th>
                <th style="text-align:right"><?php echo $this->Paginator->sort('input'); ?></th>
                <th style="text-align:right"><?php echo $this->Paginator->sort('output'); ?></th>
                <th style="text-align:right"><?php echo $this->Paginator->sort('unprinted_scrap'); ?></th>
                <!--<th><//?php echo $this->Paginator->sort('unprinted_scrap_reason'); ?></th>
            <!--<th><?php // echo $this->Paginator->sort('department_id'); ?></th> -->
                <th style="text-align:right"><?php echo $this->Paginator->sort('printed_scrap'); ?></th>
                <!--<th><? //php echo $this->Paginator->sort('printed_scrap_reason'); ?></th> -->


                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($printingShiftreports as $printingShiftreport): ?>
                <tr class="success">
                    <td><?php echo h($printingShiftreport['PrintingShiftreport']['shift']); ?>&nbsp;</td>
                    <td><?php echo h($printingShiftreport['PrintingShiftreport']['date']); ?>&nbsp;</td>

                    <td><?php echo h($printingShiftreport['PrintingShiftreport']['dimension']); ?>&nbsp;</td>
                    <td><?php echo h($printingShiftreport['PrintingShiftreport']['PF_Color']); ?>&nbsp;</td>
                    <td><?php echo h($printingShiftreport['PrintingShiftreport']['color_code']); ?>&nbsp;</td>
                    <td align="right"><?php echo h(number_format($printingShiftreport['PrintingShiftreport']['input'], 2)); ?>
                        &nbsp;</td>
                    <td align="right"><?php echo h(number_format($printingShiftreport['PrintingShiftreport']['output'], 2)); ?>
                        &nbsp;</td>
                    <td align="right"><?php echo h(number_format($printingShiftreport['PrintingShiftreport']['unprinted_scrap'], 2)); ?>
                        &nbsp;</td>
                    <!--<td><? //php echo h($printingShiftreport['PrintingShiftreport']['unprinted_scrap_reason']); ?>&nbsp;</td>-->
                    <!--<td><?php echo h($printingShiftreport['PrintingShiftreport']['department_id']); ?>&nbsp;</td> -->
                    <td align="right"><?php echo h(number_format($printingShiftreport['PrintingShiftreport']['printed_scrap'], 2)); ?>
                        &nbsp;</td>
                    <!--<td><?php //echo h($printingShiftreport['PrintingShiftreport']['printed_scrap_reason']); ?>&nbsp;</td> -->


                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $printingShiftreport['PrintingShiftreport']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $printingShiftreport['PrintingShiftreport']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $printingShiftreport['PrintingShiftreport']['id']), null, __('Are you sure you want to delete # %s?', $printingShiftreport['PrintingShiftreport']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($total as $tot): ?>
                <tr>
                    <td colspan="5" align="right"><strong>Total</strong></td>
                    
                    <td align="right"><strong><?php echo number_format($tot['0']['totalinput'], 2); ?><strong></td>
                    <td align="right"><strong><?php echo number_format($tot['0']['totaloutput'], 2); ?></strong></td>
                    <td align="right"><strong><?php echo number_format($tot['0']['totalu'], 2); ?></strong></td>
                    <td align="right"><strong><?php echo number_format($tot['0']['totals'], 2); ?></strong></td>
                </tr>
            <?php endforeach; ?>

            <?php foreach ($total as $tot): ?>
                <!-- <tr>
                    <td colspan="5" align="right"><strong>Total (To month)</strong></td>
                    
                    <td align="right"><strong><?php echo number_format($tot['0']['totalinput'], 2); ?><strong></td>
                    <td align="right"><strong><?php echo number_format($tot['0']['totaloutput'], 2); ?></strong></td>
                    <td align="right"><strong><?php echo number_format($tot['0']['totalu'], 2); ?></strong></td>
                    <td align="right"><strong><?php echo number_format($tot['0']['totals'], 2); ?></strong></td>
                </tr> -->
            <?php endforeach; ?>

            <?php foreach ($total as $tot): ?>
                <!-- <tr>
                    <td colspan="5" align="right"><strong>Total (To year)</strong></td>
                    
                    <td align="right"><strong><?php echo number_format($tot['0']['totalinput'], 2); ?><strong></td>
                    <td align="right"><strong><?php echo number_format($tot['0']['totaloutput'], 2); ?></strong></td>
                    <td align="right"><strong><?php echo number_format($tot['0']['totalu'], 2); ?></strong></td>
                    <td align="right"><strong><?php echo number_format($tot['0']['totals'], 2); ?></strong></td>
                </tr> -->
            <?php endforeach; ?>


        </table>
        <p>
            <?php
            echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
            ));
            ?>    </p>

        <!-- row coumn div -->
    </div>


</div>

 <ul class="pagination pagination-sm">
        <?php
        echo '<li>'.$this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')) . '</li>';
        echo '<li>'.$this->Paginator->numbers(array('separator' => '')) . '</li>';
        echo '<li>'.$this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')) . '</li>';
        ?>
    </ul>

