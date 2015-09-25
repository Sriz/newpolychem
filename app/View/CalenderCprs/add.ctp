<script>
    $(document).ready(function () {
        $('.nepali-calendar').nepaliDatePicker();
    });
    $(document).ready(function () {
        $("#nepali-calendar").focus(function (e) {
            //$("span").css("display", "inline").fadeOut(2000);
            //  console.log("focus")
            showCalendarBox('nepali-calendar');
        });
    });
</script>
<?php echo $this->Html->link(__('List Calender Cprs'), array('action' => 'index'), ['class' => 'btn btn-primary pull-right']); ?>
<div class="col-sm-3">
    <form method="get">
        <div class="input-group">
            <input type="text" name="search" class="form-control nepali-calendar ndp-nepali-calendar"
                   id="nepali-calendar" autocomplete="off"
                   value="<?= isset($_GET['search']) ? $_GET['search'] : $lastDate; ?>" placeholder="Search for..."
                   onfocus="showCalendarBox('nepali-calendar')">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </span>
        </div>
    </form>
</div>
<div class="clearfix"></div>
<br><br>
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
        </tr>
        <?php if ($consumptionItems): ?>
            <form method="post" name="TblConsumptionStock">
            <?php foreach ($consumptionItems as $c): ?>
                <tr>
                    <td><?= $c['tbl_consumption_stock']['nepalidate']; ?></td>
                    <td><?= $c['tbl_consumption_stock']['shift']; ?></td>
                    <td><?= $c['tbl_consumption_stock']['quality']; ?></td>
                    <td><?= $c['tbl_consumption_stock']['color']; ?></td>
                    <td><?= $c['tbl_consumption_stock']['dimension']; ?></td>

                    <td><input id="length_<?=$c['tbl_consumption_stock']['id'];?>" type="text" placeholder="Length" name="length[<?=$c['tbl_consumption_stock']['id'];?>]" value="<?= $c['tbl_consumption_stock']['length'] ? $c['tbl_consumption_stock']['length'] : 0; ?>" class="form-control input-sm"></td>
                    <td><input id="ntwt_<?=$c['tbl_consumption_stock']['id'];?>" type="text" name="ntwt[<?=$c['tbl_consumption_stock']['id'];?>]" placeholder="NTWT" value="<?= $c['tbl_consumption_stock']['ntwt'] ? $c['tbl_consumption_stock']['ntwt'] :0; ?>" class="form-control input-sm"></td>
                    <td><span id="mixingTotal_<?=$c['tbl_consumption_stock']['id'];?>">
                        <?php $total = 0; ?>
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
                        <?=$total; ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach;?>
            </table>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary btnAction pull-right">
    </form>
        <?php else: ?>
            <tr>
                <td colspan="9">No Data Found</td>
            </tr>
        </table>
        <?php endif; ?>
</div>
<script>
    $(document).ready(function(){
        //send only id of ntwt and id of total
        function ntwt_check(ntwt, mixingTotal) {
            if(mixingTotal <= ntwt){
                return false;
            } else {
                return true;
            }
        }
        <?php foreach ($consumptionItems as $c): ?>
        $("#ntwt_<?=$c['tbl_consumption_stock']['id'];?>").bind('change paste', function () {
            var ntwt_val = $("#ntwt_<?=$c['tbl_consumption_stock']['id'];?>").val();
            var mixing_val = parseInt($("#mixingTotal_<?=$c['tbl_consumption_stock']['id'];?>").html());
            if(ntwt_check(ntwt_val, mixing_val)==false)
            {
                $(this).css('border','1px solid red');
                $('.btnAction').removeClass('btn-primary').addClass('btn-default disabled')
                alert('NTWT should be smaller than MixingTotal');
            }else{
                $('.btnAction').addClass('btn-primary').removeClass('btn-default disabled')
                $(this).css('border','1px solid green');
            }
        });
        <?php endforeach;?>
    });
</script>