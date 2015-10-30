<?php
$date = isset($_GET['search'])?$_GET['search']:$lastDate;
$date = $date?$date:$lastDate;
?>
<script>
    $(document).ready(function () {
        $('.nepaliDatePicker').nepaliDatePicker();
    });
</script>
<div class="calenderCprs index">
<!--<h2><?php echo __('<center>Calender Production Report</center>'); ?></h2> -->
<div class="pull-right">
    <?= $this->Html->link('Add', array('action' => 'add'), ['class' => 'btn btn-primary']); ?>
    <?php
    $pageSearch = isset($_GET['search'])?('?search='.$_GET['search']):'';
    $pagePageid = isset($_GET['page_id'])?isset($_GET['search'])?'&page_id='.$_GET['page_id']:'?page_id='.$_GET['page_id']:'';
    ?>
    <a href="<?=$base_url;?>CalenderCprs/pdf<?=$pageSearch.$pagePageid;?>" class="btn btn-warning"><i class="glyphicon glyphicon-download"></i> Download PDF</a>
    <a class="btn btn-success" href="<?=$base_url;?>CalenderCprs/exportcsv"><i class="glyphicon glyphicon-download"></i> Export CSV</a>
</div>
<br><br>

<div class="panel panel-primary">
    <div class="panel-heading">
        <center><h4>Calendar Production Report :<stong><?=$date;?></stong></center>
        </h4></div>
    <div class="panel-body">
        <!-- row -->
        <div class="row">
            <div class="col-sm-3">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td colspan="2" class="danger text-center"><h5>Materials <strong><?=isset($_GET['search'])?'of '.$_GET['search']:$date;?></strong></h5></td>
                    </tr>
                    <?php
                    $totalBroughtScrap = 0;
                    $totalScrap = 0;
                    $totalRawMaterials = 0;
                    $allTotal =0;
                    foreach($materialCategory as $r):?>
                        <?php
                        foreach($mixingMaterialLists as $m):
                            if($m['mixing_materials']['category_id']==$r['category_materials']['id'])
                            {
                                foreach($consumptionMaterials as $c):
                                    $materialJSON = $c['tbl_consumption_stock']['materials'];
                                    $materialOBJ = json_decode($materialJSON);
                                    if(property_exists($materialOBJ, $m['mixing_materials']['id'])) {
                                        $valMaterial = $materialOBJ->$m['mixing_materials']['id'];
                                    }else{
                                        $valMaterial = 0;
                                    }
                                    if($r['category_materials']['id']==13){
                                        $totalBroughtScrap += $valMaterial;
                                    }elseif($r['category_materials']['id']==14){
                                        $totalScrap += $valMaterial;
                                    }else{
                                        $totalRawMaterials += $valMaterial;
                                    }
                                    $allTotal += $valMaterial;
                                endforeach;
                            }
                        endforeach;
                        ?>
                    <?php endforeach;?>
                    <tr>
                        <td>Raw Materials</td>
                        <td class="success"><?=h(number_format($totalRawMaterials, 2));?></td>
                    </tr>
                    <tr>
                        <td>Bought Scrap</td>
                        <td class="success"><?=h(number_format($totalBroughtScrap,2));?></td>
                    </tr>
                    <tr>
                        <td>Factory Scrap</td>
                        <td class="success"><?=h(number_format($totalScrap,2));?></td>
                    </tr>
                    <tr class="warning">
                        <td>Total</td>
                        <td class="success"><?=h(number_format($allTotal,2));?></td>
                    </tr>

                </table>
            </div>
            <div class="col-sm-3">
                <?php
                $resuable = 0;
                $lamps_plates=0;
                $total_scrap_generated=0;
                foreach($calenderScraps as $c):
                    $resuable += $c['calender_scrap']['resuable'];
                    $lamps_plates += $c['calender_scrap']['lamps_plates'];
                    $total_scrap_generated += ($resuable+$lamps_plates);
                endforeach;
                ?>
                <table class="table table-bordered table-hover">
                    <tr class="danger">
                        <td colspan="2" class="text-center"><h5>Scrap Details <strong><?=isset($_GET['search'])?'of '.$_GET['search']:$date;?></strong></h5></td>
                    </tr>
                    <td>Reusable</td>
                    <td class="success"><?=h(number_format($resuable, 2));?></td>
                    </tr>
                    <td>Lamps and Plates</td>
                    <td class="success"><?=h(number_format($lamps_plates,2));?></td>
                    </tr>
                    <td>Total Scrap Used</td>
                    <td class="success"><?=h(number_format($total_scrap_generated, 2));?></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-3">
                <form method="get">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control nepaliDatePicker ndp-nepali-calendar"
                               id="nepaliDatePicker" autocomplete="off" value="<?= isset($_GET['search']) ? $_GET['search'] : null; ?>" placeholder="Search for..." onfocus="showCalendarBox('nepaliDatePicker')">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <div class="well">
                    <p class="text-danger"><?= $newItemAdded; ?> Item is added by Mixing Section</p>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table table-bordered table-hover" align="left" style="font-size:13">
    <tr class="success">
        <th>Nepalidate</th>
        <th>Shift</th>
        <th>Brand</th>
        <th>Quality</th>
        <th>Color</th>
        <th>Dimension</th>
        <th>Base Emboss</th>
        <th >Length</th>
        <th >NTWT</th>
        <th >Total of Materials</th>
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php $totalOfCurrentData = 0;//for currentTotal ?>
    <?php foreach ($consumptionItems as $c): ?>
        <tr>
            <td><?= $c['tbl_consumption_stock']['nepalidate']; ?></td>
            <td><?= $c['tbl_consumption_stock']['shift']; ?></td>
            <td><?= $c['tbl_consumption_stock']['brand']; ?></td>
            <td><?= $c['tbl_consumption_stock']['quality']; ?></td>
            <td><?= $c['tbl_consumption_stock']['color']; ?></td>
            <td><?= $c['tbl_consumption_stock']['dimension']; ?></td>
            <?php $id = $c['tbl_consumption_stock']['id']; ?>
            <td><?php echo $mix_emboss[$id]; ?></td>
            <td><?= h(number_format($c['tbl_consumption_stock']['length'],2)); ?></td>
            <td><?= h(number_format($c['tbl_consumption_stock']['ntwt'],2)); ?></td>
            <td>
                <?php
                $total = 0;
                //total of current items calculation
                $materials = json_decode($c['tbl_consumption_stock']['materials']);
                foreach ($material_lists as $m):
                    if(property_exists($materials, $m['mixing_materials']['id']))
                    {
                        $totalWeight=$materials->$m['mixing_materials']['id'];
                    }else{
                        $totalWeight =0;
                    }
                    $total = $total + $totalWeight;
                endforeach;
                ?>
                <?= h(number_format($total,2)); ?>
                <?php $totalOfCurrentData += $total; ?>
            </td>
            <!-- <td align="right"><?php // echo h(number_format($calenderCpr['CalenderCpr']['length'])); ?>&nbsp;</td> -->


            <td class="actions">
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $c['tbl_consumption_stock']['id'])); ?>
                <?php /* echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $calenderCpr['CalenderCpr']['id']), null, __('Are you sure you want to delete # %s?', $CalenderCpr['CalenderCpr']['id'])); */ ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php
    //total netwt of current data
    $length_current = 0;
    $ntwt_current = 0;
    $mixing_wt_current = 0;
    $total = 0;
    foreach ($consumptionItems as $c):
        $length_current = $c['tbl_consumption_stock']['length'] + $length_current;
        $ntwt_current = $c['tbl_consumption_stock']['ntwt'] + $ntwt_current;
        $mixing_wt_current = $totalOfCurrentData;
    endforeach;
    foreach ($totalMaterials as $t):
        $material = json_decode($t['tbl_consumption_stock']['materials']);
        foreach ($material_lists as $m):
            if (property_exists($material, $m['mixing_materials']['id'])) {
                $materialWeight = $material->$m['mixing_materials']['id'];
            } else {
                $materialWeight=0;
            }
            $total = $total + $materialWeight;
        endforeach;
    endforeach;
    ?>

    <tr class="success">
        <td colspan="7"  align="right" ><strong>Total of current data</strong></td>
        <td><strong><?= h(number_format($length_current, 2)); ?></strong></td>
        <td><strong><?= h(number_format($ntwt_current, 2)); ?></strong></td>
        </td>
        <td><strong><?= h(number_format($mixing_wt_current, 2)); ?></strong></td>
        <td></td>
    </tr>

    <tr class="warning">
        <td align="right" colspan="7"><strong>Total</strong></td>
        <td>
            <strong><?= h(number_format($lengthTotal, 2)); ?></strong>
        </td>
        <td>
            <strong><?= h(number_format($ntwtTotal, 2)); ?></strong>
        </td>
        </td>
        <td>
            <strong><?= h(number_format($total,2)); ?></strong>
        <td>
    </tr>

   <!--  <tr class="danger">
        <td colspan="7"  align="right" ><strong>Total of this Month</strong></td>
        <td><strong><?= h(number_format($consumptionItemsThisMonth['length'], 2)); ?></strong></td>
        <td><strong><?= h(number_format($consumptionItemsThisMonth['ntwt'], 2)); ?></strong></td>
        </td>
        <td><strong><?= h(number_format($consumptionItemsThisMonth['total'], 2)); ?></strong></td>
        <td></td>
    </tr>
    <tr class="danger">
        <td colspan="7"  align="right" ><strong>Total of this Year</strong></td>
        <td><strong><?= h(number_format($consumptionItemsThisYear['length'], 2)); ?></strong></td>
        <td><strong><?= h(number_format($consumptionItemsThisYear['ntwt'], 2)); ?></strong></td>
        </td>
        <td><strong><?= h(number_format($consumptionItemsThisYear['total'], 2)); ?></strong></td>
        <td></td>
    </tr> -->
</table>


<!-- pagination -->
<nav>
    <ul class="pagination pull-right">
        <?php if ($pagination->currentPage - 1 >= 1): ?>
            <li>
                <a href="<?= $this->Html->url(null, true) . (isset($_GET['search']) ? '?search=' . $_GET['search'] . '&page_id=' . ($pagination->currentPage - 1) : '?page_id=' . ($pagination->currentPage - 1)); ?>"
                   aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
        <?php endif; ?>

        <!-- first page -->
        <?php if ($pagination->currentPage > 1): ?>
            <li>
                <a href="<?= $this->Html->url(null, true) . (isset($_GET['search']) ? '?search=' . $_GET['search'] . '&page_id=1' : '?page_id=1'); ?>">1</a>
            </li>
        <?php endif; ?>
        <!-- end first page -->
        <?php if ($pagination->currentPage > 3): ?>
            <li><a href="#">...</a></li>
        <?php endif; ?>

        <?php if (2 < $pagination->currentPage): ?>
            <li>
                <a href="<?= $this->Html->url(null, true) . (isset($_GET['search']) ? '?search=' . $_GET['search'] . '&page_id=' . ($pagination->currentPage - 1) : '?page_id=' . ($pagination->currentPage - 1)); ?>"><?= $pagination->currentPage - 1; ?></a>
            </li>
        <?php endif; ?>
        <!-- current page -->
        <?php if ($pagination->totalPage != 1): ?>
            <li class="<?= isset($_GET['page_id']) == 1 ? 'active' : ''; ?>"><a
                    href="<?= $this->Html->url(null, true) . (isset($_GET['search']) ? '?search=' . $_GET['search'] . '&page_id=' . $pagination->currentPage : '?page_id=' . $pagination->currentPage); ?>"><?= $pagination->currentPage; ?></a>
            </li>
        <?php endif; ?>
        <!-- end current page -->

        <?php if ($pagination->totalPage > $pagination->currentPage + 1): ?>
            <li>
                <a href="<?= $this->Html->url(null, true) . (isset($_GET['search']) ? '?search=' . $_GET['search'] . '&page_id=' . ($pagination->currentPage + 1) : '?page_id=' . ($pagination->currentPage + 1)); ?>"><?= $pagination->currentPage + 1; ?></a>
            </li>
        <?php endif; ?>

        <?php if ($pagination->totalPage > $pagination->currentPage + 2): ?>
            <li>
                <a href="<?= $this->Html->url(null, true) . (isset($_GET['search']) ? '?search=' . $_GET['search'] . '&page_id=' . ($pagination->currentPage + 2) : '?page_id=' . ($pagination->currentPage + 2)); ?>"><?= $pagination->currentPage + 2; ?></a>
            </li>
        <?php endif; ?>

        <?php if ($pagination->totalPage - 3 >= $pagination->currentPage): ?>
            <li><a href="#">...</a></li>
        <?php endif; ?>

        <!-- last page -->
        <?php if ($pagination->currentPage != $pagination->totalPage): ?>
            <li>
                <a href="<?= $this->Html->url(null, true) . (isset($_GET['search']) ? '?search=' . $_GET['search'] . '&page_id=' . $pagination->totalPage : '?page_id=' . $pagination->totalPage); ?>"><?= $pagination->totalPage; ?></a>
            </li>
        <?php endif; ?>
        <!-- end last page -->

        <?php if ($pagination->currentPage < $pagination->totalPage): ?>
            <li>
                <a href="<?= $this->Html->url(null, true) . (isset($_GET['search']) ? '?search=' . $_GET['search'] . '&page_id=' . ($pagination->currentPage + 1) : '?page_id=' . ($pagination->currentPage + 1)); ?>"
                   aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
        <?php endif; ?>
    </ul>
</nav>
<!-- end pagination -->
</div>
