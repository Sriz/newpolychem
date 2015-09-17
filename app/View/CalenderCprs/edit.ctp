<script>
    $(document).ready(function () {
        $('.nepali-calendar').nepaliDatePicker();
    });
    $(document).ready(function () {
        $("#nepali-calendar").focus(function (e) {
            //$("span").css("display", "inline").fadeOut(2000);
            //	console.log("focus")
            showCalendarBox('nepali-calendar');
        });
    });
</script>
<?php echo $this->Html->link(__('List Calender Cprs'), array('action' => 'index'),['class'=>'btn btn-primary pull-right']); ?>

<div class="calenderCprs form">
    <table class="table table-hover">
        <tr class="success">
            <td>Nepalidate</td>
            <td>Shift</td>
            <td>Quality</td>
            <td>Color</td>
            <td>Dimension</td>
            <td>Length</td>
            <td>NTWT</td>
            <td>Mixing Total</td>
            <td>Action</td>
        </tr>
        <?php if($consumptionItem):?>
            <?php foreach($consumptionItem as $c):?>
                <tr>
                    <td><?=$c['tbl_consumption_stock']['nepalidate'];?></td>
                    <td><?=$c['tbl_consumption_stock']['shift'];?></td>
                    <td><?=$c['tbl_consumption_stock']['quality'];?></td>
                    <td><?=$c['tbl_consumption_stock']['color'];?></td>
                    <td><?=$c['tbl_consumption_stock']['dimension'];?></td>

                    <form method="post" name="TblConsumptionStock">
                        <input type="hidden" value="<?=$c['tbl_consumption_stock']['id'];?>" name="id">
                        <td><input type="text" placeholder="Length" name="length" value="<?=$c['tbl_consumption_stock']['length']?$c['tbl_consumption_stock']['length']:0;?>" class="form-control input-sm length"></td>
                        <td><input type="text" name="ntwt" placeholder="NTWT" value="<?=$c['tbl_consumption_stock']['ntwt']?$c['tbl_consumption_stock']['ntwt']:0;?>" class="form-control input-sm ntwt"></td>
                        <td>
                            <span class="mixingTotal">
                            <?php $total = 0;?>
                            <?php
                            $materials = json_decode($c['tbl_consumption_stock']['materials']);
                            foreach ($material_lists as $m):
                                if (property_exists($materials, $m['mixing_materials']['id'])) {
                                    $materialWeight = $materials->$m['mixing_materials']['id'];
                                } else {
                                    $materialWeight = 0;
                                }
                                $total = $total + $materialWeight;
                            endforeach;
                            ?>
                            <?= $total; ?>
                                </span>
                        </td>
                        <td><input type="submit" value="Submit" name="submit" class="btn btn-primary btnAction"></form></td>
                </tr>
            <?php endforeach;?>
        <?php else:?>
            <tr>
                <td colspan="9">No Data Found</td>
            </tr>
        <?php endif;?>
    </table>

    <script>
        $(document).ready(function(){
            $('.ntwt').bind('change paste',function(){
                var netwt = $(this).val();
                var mixingtotal = parseInt($('.mixingTotal').html());
                if(mixingtotal<=netwt)
                {
                    $('.ntwt').css('border','1px solid red');
                    $('.btnAction').removeClass('btn-primary').addClass('disabled');
                    alert('NTWT should be smaller than Mixing Total');
                }else{
                    $('.ntwt').css('border','1px solid green');
                    $('.btnAction').addClass('btn-primary').removeClass('disabled');
                }
            })
        });
    </script>
