
<script>

    function generate_report(sel) {
        //code
        var strUser = sel.value;
        var dataString = 'id=' + strUser;
        $.ajax
        ({
            type: "POST",
            url: "/newpolychem/TblConsumptionStocks/monthly_report",
            data: dataString,
            cache: false,
            success: function (html) {
                $(".mon").html(html);
            }
        });
    }
</script>
<script type="text/javascript">
    function getval(sel) {
        var strUser = sel.value;
        var dataString = 'id=' + strUser;
        $.ajax
        ({
            type: "POST",
            url: "/newpolychem/Pages/t",
            data: dataString,
            cache: false,
            success: function (html) {
                $(".dimension").html(html);
            }
        });
    }

</script>
<script>
    function gets(sel) {
        var strUser = sel.value;
        var brnd = $(".brnd option:selected").text();
        var dataString = 'dim=' + strUser + '&brand=' + brnd;
        console.log(dataString)
        $.ajax
        ({
            type: "POST",
            url: "/newpolychem/TblConsumptionStocks/to_date_consumption",
            data: dataString,
            cache: false,
            success: function (html) {
                $(".content").html(html);
            }
        });

    }


</script>


<script>
    function generate_print(sel) {
        //code
        var strUser = sel.value;
        var dataString = 'id=' + strUser;
        //var dataString = 'id='+ strUser;
        console.log(dataString)
        $.ajax
        ({
            type: "POST",
            url: "/newpolychem/Pages/generate_print_issue_report",
            data: dataString,
            cache: false,
            success: function (html) {
            //$(".content").html(html);
                $(".consumption").html(html);
            }
        });
    }
</script>


<div class="row">
    <div class="col-lg-12">
        <?php if (AuthComponent::user('id') and AuthComponent::user('role') == 'admin') { ?>
            <h1>Welcome to Administration Area</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
        <?php } ?>



        <?php if (AuthComponent::user('id') and AuthComponent::user('role') == 'store') { ?>
            <h1>Yeti Polychem Pvt. Ltd.</h1>
            <h3> Calendar Raw Material Consumtion and Stock Position<i>page 1</i></h3>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>


        <?php } ?>

        <!--mixing department-->
        <?php if (AuthComponent::user('id') and AuthComponent::user('role') == 'mixing'){ ?>

    <?php

    switch ($latestmonth) {
        case "01":
            $monthname = "Baishak";
            break;
        case "02":
            $monthname = "Jestha";
            break;
        case "03":
            $monthname = "Ashad";
            break;
        case "04":
            $monthname = "Shrawan";
            break;
        case "05":
            $monthname = "Bhadra";
            break;
        case "06":
            $monthname = "Ashoj";
            break;
        case "07":
            $monthname = "Kartik";
            break;
        case "08":
            $monthname = "Mangsir";
            break;
        case "09":
            $monthname = "Poush";
            break;
        case "10":
            $monthname = "Magh";
            break;
        case "11":
            $monthname = "Falgun";
            break;
        case "12":
            $monthname = "Chaitra";
            break;
    }

    ?>
        <h1>Welcome to Mixing Department</h1>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Number of Days Operated
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                </tr>
                                <tr>
                                    <td>In this Month (<?php echo $monthname; ?>)</td>
                                    <td align="right">

                                        <?php echo $operated_in_month[0][0]['operated_in_month']; ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td>In this Year (<?php echo $latestyear; ?>)</td>
                                    <td align="right">
                                        <?php echo $operated_in_year[0][0]['operated_in_year'];?>
                                    </td>

                                </tr>

                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Consumption
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <strong>
                                        <th></th>
                                        <th>Today<br/> (<?php echo $latestdate; ?>-<?php echo $latestmonth; ?>
                                            -<?php echo $latestyear; ?>)
                                        </th>
                                        <th>To Month<br/>(<?php echo $monthname; ?>)</th>
                                        <th>To Year<br/>(<?php echo $latestyear; ?>-<?php echo $latestyear + 1; ?>)</th>
                                    </strong>
                                <tr>
                                    <td>Raw Material</td>
                                    <td align="right">
                                        <?php echo number_format($raw_materials_d, 2); ?>

                                    </td>
                                    <td align="right">
                                       <?php echo number_format($raw_materials_m, 2); ?>
                                    </td>
                                    <td align="right">


                                       <?php echo number_format($raw_materials_y, 2); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bought Scrap</td>
                                    <td align="right">

                                        <?php echo number_format($bought_scrap_d, 2); ?>
                                    </td>
                                    <td align="right">

                                       <?php echo number_format($bought_scrap_m, 2); ?>
                                    </td>
                                    <td align="right">

                                        <?php echo number_format($bought_scrap_y, 2); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Factory Scrap</td>
                                    <td align="right">


                                    <?php echo number_format($scrap_d, 2); ?>
                                    </td>
                                    <td align="right">
                                       <?php echo number_format($scrap_m, 2); ?>
                                    </td>
                                    <td align="right">
                                        <?php echo number_format($scrap_y, 2); ?>

                                    </td>
                                </tr>
                                <tr bgcolor="grey">
                                    <td>Total</td>
                                    <td align="right">
                                        <?php echo number_format($total_d, 2); ?>
                                    </td>
                                    <td align="right">
                                        <?php echo number_format($total_m, 2); ?>
                                    </td>
                                    <td align="right">
                                        <?php echo number_format($total_y, 2); ?>
                                    </td>
                                </tr>
                                </tr></table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Monthly Report
                        </div>
                        <div class="panel-body">
                            <?php

                            echo '<td>';
                            //$this->Form->input('brand',array('type'=>'select','options'=>$brand,'class'=>'brnd','onchange'=>'getval(this);'));
                            echo $this->Form->input('Month', array('type' => 'select', 'options' => array('NULL' => 'Please Select', '01' => 'Baisakh', '02' => 'Jestha', '03' => 'Ashad', '04' => 'Shrawan', '05' => 'Bhadra', '06' => 'Ashoj', '07' => 'Kartik', '08' => 'Mangsir', '09' => 'Poush', '10' => 'Margh', '11' => 'falgun', '12' => 'Chaitra'), 'class' => 'brand form-control', 'onchange' => 'generate_report(this);'));
                            echo '</td>';

                            ?>
                            <br/>
                            <script>
                                function updateLink(that){
                                    var month = $('#Month').val();
                                    if(month){
                                        var url = $(that).attr('href');
                                        if(url.indexOf('?Month='))
                                        {
                                            url = url.split('?Month=')[0];
                                        }
                                        url+='?Month='+month;
                                        $(that).attr('href',url);
                                        return true;
                                    }
                                    return false;
                                }
                            </script>
                            <?php
                            echo $this->Html->link('Download CSV file', array('controller' => 'pages', 'action' => 'export'), array('class' => 'btn btn-success csv', 'onclick'=>'return updateLink(this);'));
                            ?>

                            <div class="mon">

                            </div>

                        </div>
                    </div>

                </div>

            </div>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                To Date Consumption
                            </div>
                            <div class="panel-body">
                                <?php

                                echo '<td>';

                                echo $this->Form->input('Brand', array('type' => 'select', 'options' => array('default' => 'Please Select', $brand), 'class' => 'brnd form-control', 'onchange' => 'getval(this);'));
                                echo '</td>';
                                echo '<td>';
                                ?><br/><?php
                                echo $this->Form->input('Dimension', array('class' => 'dimension form-control', 'type' => 'select', 'onchange' => 'gets(this);'));
                                echo '</td>';
                                ?>
                                <br/>

                                <script>
                                    function updateLink1(that){
                                        var brand = $('#Brand').val();
                                        var dim = $('#Dimension').val();
                                        if(brand){
                                            var url = $(that).attr('href');
                                            if(url.indexOf('?Brand='))
                                            {
                                                url = url.split('?Brand=')[0];
                                            }
                                            url+='?Brand='+brand+'&Dimension='+dim;
                                            $(that).attr('href',url);
                                            return true;
                                        }
                                        return false;
                                    }
                                </script>
                                <?php
                                echo $this->Html->link('Download CSV file', array('controller' => 'pages', 'action' => 'export_consumption'), array('class' => 'btn btn-success csv', 'onclick'=>'return updateLink1(this);'));
                                ?>

                                <?php
                                    // echo $this->Html->link('Download CSV file', array('controller' => 'pages', 'action' => 'export_consumption'), array('target' => '_blank', 'class' => 'btn btn-success'));
                                ?>

                                <div class="content">

                                </div>

                            </div>
                        </div>

                    </div>


            </div>



            <?php } ?>
            <!-- Ending mixing department-->

            <!--start of scrap department-->
            <?php if (AuthComponent::user('id') and AuthComponent::user('role') == 'scrap') { ?>
                <h1>Welcome to Scrap Department</h1>

                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
                </ol>
            <?php } ?>

            <!--End of scrap department-->

            <!--start of the calender department-->
            <?php if (AuthComponent::user('id') and AuthComponent::user('role') == 'calender') { ?>
            <h1>Welcome to Calendar Department</h1>


            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>

            <?php
         switch($latestmonth){
        case "01":
            $monthname="Baishak";
            break;
        case "02":
            $monthname="Jestha";
            break;
        case "03":
            $monthname="Ashad";break;
        case "04":
            $monthname="Shrawan";break;
        case "05":
            $monthname="Bhadra";break;
        case "06":
            $monthname="Ashoj";break;
        case "07":
            $monthname="Kartik";break;
        case "08":
            $monthname="Mangsir";break;
        case "09":
            $monthname="Poush";break;
        case "10":
            $monthname="Magh";break;
        case "11":
            $monthname="Falgun";break;
        case "12":
            $monthname="Chaitra";break;
   }

    ?>
        <div class="row">
            <div class="col-md-6">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Number of Days Operated
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td>In this Month (<?php echo $monthname;?>)</td>
                                <td align="right">
                                    <?php echo $month2[0][0]['month'];?>
                                </td>
                            </tr>
                            <tr>
                                <td>In this Year (<?php echo $latestyear;?>)</td>
                                <td align="right">
                                    <?php echo $year2[0][0]['year'];?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            <!-- <div class="panel panel-primary">
                <div class="panel-heading">
                    Number of Days Operated
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                       </tr>
                        <tr>
                            <td>In this Month (<?php echo $monthname;?>)</td>
                            <td align="right">
                            <?php echo $month2[0][0]['month'];?>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>In this Year (<?php echo $latestyear;?>)</td>
                            <td align="right">
                                <?php echo $year2[0][0]['year'];
                                ?>
                            </td>
                            
                        </tr>
                        
                    </tr>
                    </table>
            </div>
        </div> -->

            <div class="container-fluid">
               <div class="row">
            <div class="col-md-12">


                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Input-Output Analysis
                    </div>
                    <div class="panel-body">
                         <table class="table">
                                    <tr class="success">
                                        <th>Type</th>
                                        <th>Today <br>(<?= $latest_date; ?>)</th>
                                        <th>To Month <br>(<?=  $latest_month;?>)
                                        </th>
                                        <th>To Year<br>(<?=  $latest_year;?>)
                                        </th>
                                    </tr>
                                    <td>Length</td>
                                    <td>
                                        <?php echo number_format($length_d, 2);?>
                                    </td>
                                    <td>
                                        <?php echo number_format($length_m, 2);?>
                                    </td>

                                    <td>
                                        <?php echo number_format($length_y, 2);?>
                                    </td>
                                    </tr>

                                    <tr>
                                        <td>Total Input</td>
                                        <td>
                                            <?php echo number_format($total_d, 2);?>

                                        </td>
                                        <td>
                                           <?php echo number_format($total_m, 2);?>
                                        </td>
                                        <td>
                                              <?php echo number_format($total_y, 2);?>
                                        </td>
                                    </tr>
                                    <td>NT WT</td>
                                    <td>

                                       <?php echo number_format($net_d, 2);?>
                                    </td>

                                    <td>
                                       <?php echo number_format($net_m, 2);?>

                                    </td>

                                    <td>
                                        <?php echo number_format($net_y, 2);?>
                                    </td>
                                    <!-- new added line -->
                                    </tr>
                                    <tr>
                                     <tr>
                                        <td>Factory Scrap</td>
                                        <td>

                                            <?php echo number_format($scrap_total_d, 2);?>
                                        </td>
                                        <td>

                                            <?php echo number_format($scrap_total_m, 2);?>
                                        </td>
                                        <td>

                                           <?php echo number_format($scrap_total_y, 2);?>
                                        </td>

                                        <!-- <td>Scrap Total</td>
                                        <td>

                                            <?php echo number_format($total_scrap_d, 2);?>
                                        </td>
                                        <td>

                                            <?php echo number_format($total_scrap_m, 2);?>
                                        </td>
                                        <td>

                                           <?php echo number_format($total_scrap_y, 2);?>
                                        </td> -->



                                    <tr>
                                        <td>Unaccounted Loss</td>
                                        <td>

                                        <?php echo number_format($total_d-$net_d-$scrap_total_d, 2);?>
                                        </td>
                                        <td>
                                           <?php echo number_format($total_m-$net_m-$scrap_total_m, 2);?>
                                        </td>
                                        <td>
                                           <?php echo number_format($total_y-$net_y-$scrap_total_y, 2);?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unaccounted Loss %</td>
                                        <td>
                                           <?php
                                                echo number_format(($total_d-$net_d-$scrap_total_d)*100/$total_d, 2).'%';
                                            ?>
                                        </td>
                                         <td>
                                            <?php
                                            echo number_format(($total_m-$net_m-$scrap_total_m)*100/$total_m, 2).'%';
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo number_format(($total_y-$net_y-$scrap_total_y)*100/$total_y, 2).'%';
                                            ?>
                                        </td>
                                    </tr>
                                </table>


                    </div>
                </div>

            </div>



        </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin: 0px;padding: 0px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Semi Finished Goods
                        </div>
                        <div class="panel-body">
                            <div class="row">
                            <div class="col-md-2">
                                <table class="table">


                                    <tr class="success">
                                    <th>Dimension</th>
                                    <?php
                                        //print_r($dimyear);

                                        foreach ($dim_list as $dm):
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo $dm['baseemboss']['dimension'];
                                                echo "</td>";
                                        endforeach;
                                    ?>

                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2">
                                <table class="table">


                                    <tr class="success">
                                    <th>Type</th>
                                    <?php
                                        //print_r($dimyear);

                                        foreach ($dim_list as $dm):
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo $dm['baseemboss']['type'];
                                                echo "</td>";
                                        endforeach;
                                    ?>

                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2">
                                <table class="table">


                                    <tr class="success">
                                    <th>Brand</th>
                                    <?php
                                        //print_r($dimyear);

                                        foreach ($dim_list as $dm):
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo $dm['baseemboss']['brand'];
                                                echo "</td>";
                                        endforeach;
                                    ?>

                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2">
                                <table class="table">
                                    <tr class="success">
                                    <th>Today(<?= $latest_date;?>)</th>
                                    <?php

                                    foreach ($dim_daily as $dd):
                                        //print'<pre>';print_r($dy);print'</pre>';
                                        echo "<tr>";
                                            echo '<td>';
                                                echo number_format($dd,2);
                                            echo "</td>";
                                    endforeach;
                                    ?>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2">
                               <table class="table">
                                    <tr class="success">
                                    <th>To Month(<?= $latest_month;?>)</th>
                                    <?php
                                    foreach ($dim_monthly as $dm):
                                        //print'<pre>';print_r($dy);print'</pre>';
                                        echo "<tr>";
                                            echo '<td>';
                                                echo number_format($dm,2);
                                            echo "</td>";
                                    endforeach;
                                    ?>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2">
                                <table class="table">
                                    <tr class="success">
                                    <th>To Year (<?= $latest_year;?>)</th>
                                    <?php
                                    foreach ($dim_yearly as $dy):
                                        //print'<pre>';print_r($dy);print'</pre>';
                                        echo "<tr>";
                                            echo '<td>';
                                                echo number_format($dy,2);
                                            echo "</td>";
                                    endforeach;
                                    ?>
                                    </tr>
                                </table>
                            </div>
                        </div>


                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-md-12" style="margin:0px;padding:0px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">BreakDown Reasons %</div>
                        <div class="panel-body">
                            <div class="container-fluid">
                                <table class="table">
                                    <tr class="success">
                                        <th>Reasons</th>
                                        <th>Today<br/>(<?= $latest_date;?>)</th>
                                        <th>To Month<br/>(<?= $latest_month; ?>)</th>
                                        <th>To Year<br/>(<?= $latest_year; ?>)</th>
                                    </tr>

                                    <tr>

                                        <td><?php
                                            $rea_count = count($tybdloss);

                                            foreach ($bd_reason as $bd):
                                                echo $bd. '<br/>';
                                            endforeach;
                                            ?>
                                        </td>
                                        <td>
                                            <?php foreach ($bd_d as $bd):

                                                echo number_format($bd[0][0]['bd_d'], 2) . '%<br/>';

                                            endforeach;

                                            $today_count = count($bd_d);
                                            for($today_count;$today_count<$rea_count;$today_count++)
                                            {

                                                 echo number_format(0,2).'%<br/>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php  foreach ($bd_m as $bd):

                                                echo number_format($bd[0][0]['bd_m'], 2) . '%<br/>';

                                            endforeach;
                                            $month_count = count($bd_m);

                                            for($month_count;$month_count<$rea_count;$month_count++)
                                            {
                                                echo number_format(0,2).'%<br/>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php foreach ($bd_y as $bd):

                                                echo number_format($bd[0][0]['bd_y'], 2) . '%<br/>';

                                            endforeach;
                                            $year_count = count($bd_y);
                                            for($year_count;$year_count<$rea_count;$year_count++)
                                            {

                                                 echo number_format(0,2).'%<br/>';


                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="margin:0px;padding:0px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Loss Hour Reasons %</div>
                        <div class="panel-body">
                            <div class="container-fluid">
                                <table class="table" style="font-size: 14px;">
                                    <tr class="success">
                                        <th>Reasons</th>
                                        <th>Today <br/>(<?= $latest_date;?>)</th>
                                        <th>To Month <br/>(<?= $latest_month;?>)</th>
                                        <th>To Year <br/>(<?= $latest_year;?>)</th>

                                    </tr>
                                    <tr>
                                        <td>
                                            <?php $rea_loss = count ($tylhloss);?>
                                            <?php foreach ($reasons as $r):

                                                echo $r . '<br/>';

                                            endforeach;
                                            ?>
                                        </td>
                                        <td>
                                            <?php foreach ($tdlhloss as $bd):

                                                echo number_format($bd[0][0]['tdlhloss'], 2) . '%<br/>';

                                            endforeach;
                                            $today_loss = count ($tdlhloss);
                                            for($today_loss;$today_loss<$rea_loss;$today_loss++)
                                            {
                                                echo number_format(0,2).'%<br/>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php  foreach ($tmlhloss as $bd):

                                                echo number_format($bd[0][0]['tmlhloss'], 2) . '%<br/>';

                                            endforeach;
                                            $month_loss = count ($tmlhloss);
                                            for($month_loss;$month_loss<$rea_loss;$month_loss++)
                                            {
                                                echo number_format(0,2).'%<br/>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php foreach ($tylhloss as $bd):

                                                echo number_format($bd[0][0]['tylhloss'], 2) . '%<br/>';

                                            endforeach;
                                            $year_loss = count ($tylhloss);
                                            for($year_loss;$year<$rea_loss;$year_loss++)
                                            {
                                                echo number_format(0,2).'%<br/>';
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="clearfix"></div>
            <br>
            <div class="col-md-12" style="margin:0px;padding:2px;">
                <div class="panel panel-primary">
                    <div class="panel-heading">Loss Hour Calculations</div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <table class="table table-bordered table-hover">

                            <tr class="success">
                                    <th>Category</th>
                                    <th>Today (<?=$latest_date;?>)</th>
                                    <th>To Month (<?=$latest_month;?>)</th>
                                    <th>To Year (<?=$latest_year;?>)</th>
                                </tr>
                                <tr>
                                    <td><strong>Break Down</strong></td>
                                    <td><?php if($breakdownToDay!='')echo $breakdownToDay; else echo 0; ?></td>
                                    <td><?php if($breakdownToMonth!='')echo $breakdownToMonth; else echo 0; ?></td>
                                    <td><?php if($breakdownToYear!='')echo $breakdownToYear; else echo 0; ?></td>

                                </tr>
                                <tr>
                                    <td><strong>Loss Hour</strong></td>
                                    <td><?php if($losshourToDay!='')echo $losshourToDay; else echo 0; ?></td>
                                    <td><?php if($losshourToMonth!='')echo $losshourToMonth; else echo 0; ?></td>
                                    <td><?php if($losshourToYear!='')echo $losshourToYear; else echo 0; ?></td>

                                </tr>
                                <tr>
                                    <td><strong>Worked Hour</strong></td>
                                    <td><?php if($workedHourToDay!='')echo $workedHourToDay; else echo 0; ?></td>
                                    <td><?php if($workedHourToMonth!='')echo $workedHourToMonth; else echo 0; ?></td>
                                    <td><?php if($workedHourToYear!='')echo $workedHourToYear; else echo 0; ?></td>

                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12" style="margin:0px;padding:2px;">
                <div class="panel panel-primary">
                    <div class="panel-heading">Output</div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <table class="table table-bordered table-hover">
                                <tr class="success">
                                    <th></th>
                                    <th>Today <br>(<?= $latest_date;?>)</th>
                                    <th>To Month <br>(<?= $latest_month;?>)</th>
                                    <th>To Year <br>(<?= $latest_year;?>)</th>
                                </tr>
                                <tr>
                                    <td><strong>Per Hour Output</strong></td>
                                    <!-- output/(24 * # of days worked) -->
                                    <?php
                                    //TODO::add currentdate
                                    ?>
                                    <td><?php echo number_format($net_d/24,2);?></td>
                                    <td><?php echo number_format($net_m/(24*$operated_in_month[0][0]['operated_in_month']),2);?></td>
                                    <td><?php echo number_format($net_y/(24*$operated_in_year[0][0]['operated_in_year']),2);?></td>


                                </tr>

                                <!--Per work hour output: for average working hour-->
                                <?php /*
                                
                                $avg_today = $working_today[0][0]['today_sec']/24/24;
                                $avg_today = (24 - $avg_today);

                                $avg_month = $working_month[0][0]['month_sec']/24/24;
                                $avg_month = (24*$month1[0][0]['month'] - $avg_month);

                                $avg_year = $working_year[0][0]['year_sec']/24/24;
                                $avg_year = (24*$year1[0][0]['year'] - $avg_year);
                                //echo $avg_today;*/
                                ?>

                                <tr>

                                    <td><strong>Per Work Hour Output</strong></td>
                                    <!-- output/(avg working hour * # of days worked) -->
                                    <td><?php echo number_format($net_d/$avg_wh_d,2)?></td>
                                    <td><?php echo number_format($net_m/($avg_wh_m*$operated_in_month[0][0]['operated_in_month']),2);?></td>
                                    <td><?php echo number_format($net_y/($avg_wh_y*$operated_in_year[0][0]['operated_in_year']),2);?></td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-12" style="margin: 0px;padding: 0px;">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Dimensions
                    </div>
                    <div class="panel-body">
                        <div class="row">
                        <div class="col-md-2">
                            <table class="table">

                                <tr class="success">
                                <th>Dimension<br</th>
                                <?php
                                    //print_r($dimyear);

                                    foreach ($dim_target as $dm):
                                        echo "<tr>";
                                            echo "<td>";
                                                echo $dm['dimension_target']['dimension'];
                                            echo "</td>";
                                    endforeach;
                                ?>

                                </tr>
                            </table>
                        </div>

                        <div class="col-md-2">
                            <table class="table">


                                <tr class="success">
                                <th>Type</th>
                                <?php
                                    //print_r($dimyear);

                                    foreach ($dim_target as $dm):
                                        echo "<tr>";
                                            echo "<td>";
                                                echo $dm['dimension_target']['type'];
                                            echo "</td>";
                                    endforeach;
                                ?>

                                </tr>
                            </table>
                        </div>

                        <div class="col-md-2">
                            <table class="table">


                                <tr class="success">
                                <th>Brand</th>

                                <?php
                                    //print_r($dimyear);

                                    foreach ($dim_target as $dm):
                                        echo "<tr>";
                                            echo "<td>";
                                                echo $dm['dimension_target']['brand'];
                                            echo "</td>";
                                    endforeach;
                                ?>

                                </tr>
                            </table>
                        </div>

                        <div class="col-md-2">
                            <table class="table">
                                <tr class="success">
                                <th>Output (Wt per M)</th>
                                <?php

                                foreach ($output_m as $dd):
                                    //print'<pre>';print_r($dd);print'</pre>';
                                    echo "<tr>";
                                        echo '<td>';
                                            echo number_format($dd[0][0]['output'],2);
                                        echo "</td>";
                                endforeach;
                                ?>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-2">
                        <!--    <table class="table">
                                <tr class="success">
                                <th>Target</th>
                                <?php
                                foreach ($dim_target as $dm):
                                    //print'<pre>';print_r($dy);print'</pre>';
                                    echo "<tr>";
                                        echo '<td>';
                                            echo number_format($dm['dimension_target']['target'],2);
                                        echo "</td>";
                                endforeach;
                                ?>
                                </tr>
                            </table>
                        </div>



                        <div class="col-md-2">
                           <table class="table" style="background-color:#f2dede">
                                <tr class="success">
                                <th>Difference</th>
                                <script>
                                    $(document).ready(function(){
                                     <?php for($i=0; $i<count($dim_target); $i++):?>
                                        var varDimensionTarget = parseInt($("#diff<?=$i;?>").html());
                                        if(varDimensionTarget>-3 && varDimensionTarget<3)
                                        {
                                            $("#diff<?=$i;?>").removeClass('danger').addClass('success');
                                        }
                                     <?php endfor;?>
                                    });
                                </script>
                                <?php
                                // echo'<pre>';print_r($dim_target);
                                // echo'<pre>';print_r($output_m);die;
                                $c = count($dim_target);

                                for($i=0;$i<$c;$i++){

                                echo "<tr>";
                                    echo '<td id="diff'.$i.'">';
                                        echo number_format(($output_m[$i][0][0]['output']-$dim_target[$i]['dimension_target']['target'])*100/$dim_target[$i]['dimension_target']['target'],2)."%";
                                    echo "</td>";
                                }
                                ?>
                                </tr>
                            </table>
                        </div>
                        
                    </div>

                      
                    </div>
                </div>
            </div>

                
 -->

               <table class="table">
                                <tr class="success">
                                <th>Target</th>
                                <?php
                                foreach ($dim_target as $dm):
                                    //print'<pre>';print_r($dy);print'</pre>';
                                    echo "<tr>";
                                        echo '<td>';
                                            echo number_format($dm['dimension_target']['target'],2);
                                        echo "</td>";
                                endforeach;
                                ?>
                                </tr>
                            </table>
                        </div>



                        <div class="col-md-2">
                           <table class="table" style="background-color:#f2dede">
                                <tr class="success">
                                <th>Difference</th>
                                <script>
                                    $(document).ready(function(){
                                     <?php for($i=0; $i<count($dim_target); $i++):?>
                                        var varDimensionTarget = parseInt($("#diff<?=$i;?>").html());
                                        if(varDimensionTarget>-3 && varDimensionTarget<3)
                                        {
                                            $("#diff<?=$i;?>").removeClass('danger').addClass('success');
                                        }
                                     <?php endfor;?>
                                    });
                                </script>
                                <?php
                                // echo'<pre>';print_r($dim_target);
                                // echo'<pre>';print_r($output_m);die;
                                $c = count($dim_target);
                                for($i=0;$i<$c;$i++){
                                echo "<tr>";
                                    echo '<td id="diff'.$i.'">';
                                        echo number_format(($output_m[$i][0][0]['output']-$dim_target[$i]['dimension_target']['target'])*100/$dim_target[$i]['dimension_target']['target'],2)."%";
                                    echo "</td>";
                                }
                                ?>

    <?php } ?>


        <!--end of the  calender department-->

        <!--start of the printing department-->
        <?php if (AuthComponent::user('id') and AuthComponent::user('role') == 'printing'){ ?>
        <h1>Welcome to Printing Department</h1>

        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        </ol>

        <!--Number of days operated-->
         <?php
            switch ($latestmonth) {
                case "01":
                    $monthname = "Baishak";
                    break;
                case "02":
                    $monthname = "Jestha";
                    break;
                case "03":
                    $monthname = "Ashad";
                    break;
                case "04":
                    $monthname = "Shrawan";
                    break;
                case "05":
                    $monthname = "Bhadra";
                    break;
                case "06":
                    $monthname = "Ashoj";
                    break;
                case "07":
                    $monthname = "Kartik";
                    break;
                case "08":
                    $monthname = "Mangsir";
                    break;
                case "09":
                    $monthname = "Poush";
                    break;
                case "10":
                    $monthname = "Magh";
                    break;
                case "11":
                    $monthname = "Falgun";
                    break;
                case "12":
                    $monthname = "Chaitra";
                    break;
            }
        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Number of Days Operated
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                </tr>
                                <tr>
                                    <td>In this Month (<?php echo $monthname; ?>)</td>
                                    <td align="right">

                                        <?php echo $operated_print_month; ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td>In this Year (<?php echo $current_print_year; ?>)</td>
                                    <td align="right">
                                        <?php echo $operated_print_year;?>
                                    </td>

                                </tr>

                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <!--Printing I/O Analysis-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Input Output Analysis</div>
                        <div class="panel-body">
                            <div class="container-fluid">

                                <table class="table table-condensed table-bordered">
                                    <thead>
                                    <tr  class="success">
                                        <th>
                                        </th>
                                        <th>Today <br/>(<?= $current_print_day;?>)</th>
                                        <th>To Month <br/>(<?= $current_print_month;?>)</th>
                                        <th>To Year <br/>(<?= $current_print_year;?>)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr style="text-align: " class="active">
                                        <td style="text-align: left">Total Input</td>
                                        <td><?php echo number_format($total_input_td, 2); ?></td>
                                        <td><?php echo number_format($total_input_tm, 2); ?></td>
                                        <td><?php echo number_format($total_input_ty, 2); ?></td>
                                    </tr>
                                    <tr style="text-align: " class="success">
                                        <td style="text-align: left"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="text-align: " class="active">
                                        <td style="text-align: left">Total Output</td>
                                        <td><?php echo number_format($total_putput_td, 2); ?></td>
                                        <td><?php echo number_format($total_output_tm, 2); ?></td>
                                        <td><?php echo number_format($total_output_ty, 2); ?></td>
                                    </tr>
                                    <tr style="text-align: " class="active">
                                        <td style="text-align: left">Total Printed Scrap</td>
                                        <td><?php echo number_format($all_pscrap_day, 2); ?></td>
                                        <td><?php echo number_format($all_pscrap_month, 2); ?></td>
                                        <td><?php echo number_format($all_pscrap_year, 2); ?></td>
                                    </tr>
                                    <tr style="text-align: " class="active">
                                        <td style="text-align: left">Total Unprinted Scrap</td>
                                        <td><?php echo number_format($all_unpscrap_day, 2); ?></td>
                                        <td><?php echo number_format($all_unpscrap_month, 2); ?></td>
                                        <td><?php echo number_format($all_unpscrap_year, 2); ?></td>
                                    </tr>



                                    <tr style="text-align: " class="active">
                                        <th style="text-align: left">Total</th>
                                        <th><?php echo number_format($total_putput_td+$all_pscrap_day+$all_unpscrap_day, 2); ?></th>
                                        <th><?php echo number_format($total_output_tm+$all_pscrap_month+$all_unpscrap_month, 2); ?></th>
                                        <th><?php echo number_format($total_output_ty+$all_pscrap_year+$all_unpscrap_year, 2); ?></th>
                                    </tr>

                                   <tr style="text-align: " class="success">
                                        <td style="text-align: left"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr style="text-align: " class="active">
                                        <td style="text-align: left"> Printed Scrap % </td>
                                        <td><?php echo number_format($all_pscrap_day*100/$total_input_td, 2)." %"; ?></td>
                                        <td><?php echo number_format($all_pscrap_month*100/$total_input_tm, 2)." %"; ?></td>
                                        <td><?php echo number_format($all_pscrap_year*100/$total_input_ty, 2)." %"; ?></td>
                                    </tr>
                                    <tr style="text-align: " class="active">
                                        <td style="text-align: left"> Unprinted Scrap %</td>
                                        <td><?php echo number_format($all_unpscrap_day*100/$total_input_td, 2)." %"; ?></td>
                                        <td><?php echo number_format($all_unpscrap_month*100/$total_input_tm, 2)." %"; ?></td>
                                        <td><?php echo number_format($all_unpscrap_year*100/$total_input_ty, 2)." %"; ?></td>
                                    </tr>

                                    <tr style="text-align: " class="success">
                                        <td style="text-align: left"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>


                                    <tr  class="active">
                                        <td>
                                            Output Input Ratio
                                        </td>
                                        <td style="text-align: ;">
                                            <?php
                                            //$date=date('01-m-Y');
                                            //echo $date;
                                            //print_r($output);
                                            foreach ($output as $col):
                                                foreach ($tdinput as $in):
                                                    echo number_format($col['0']['output'] / $in['0']['tdinput'], 2);
                                                endforeach;
                                            endforeach;
                                            ?>
                                        </td>
                                        <td style="text-align: ;">
                                            <?php
                                            //$date=date('01-m-Y');
                                            //echo $date;
                                            //print_r($omonthly);
                                            foreach ($omonthly as $col):
                                                foreach ($tminput as $in):
                                                    echo number_format($col['0']['output'] / $in['0']['tminput'], 2);
                                                endforeach;
                                            endforeach
                                            ?>
                                        </td>
                                        <td style="text-align: ;">
                                            <?php
                                            foreach ($oyearly as $col):
                                                foreach ($tyinput as $in):
                                                    echo number_format($col['0']['output'] / $in['0']['tyinput'], 2);
                                                endforeach;
                                            endforeach;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr class="active">
                                        <td>
                                            Number of Color Made
                                        </td>
                                        <td style="text-align: ;">
                                            <?php
                                            //$date=date('01-m-Y');
                                            //echo $date;
                                            //print_r($color);
                                            foreach ($color as $col):
                                                echo number_format($col['0']['total']);
                                            endforeach;

                                            ?>
                                        </td>
                                        <td style="text-align: ;">
                                            <?php
                                            //$date=date('01-m-Y');
                                            //echo $operated_print_month;die;
                                            //print_r($color);

                                            foreach ($monthly1 as $col):
                                                echo number_format($col['0']['total'] / $operated_print_month);
                                            endforeach;

                                            ?>
                                        </td>
                                        <td style="text-align: ;">
                                            <?php
                                            //$date=date('01-m-Y');
                                            //echo $date;
                                            //print_r($color);
                                            foreach ($yearly1 as $col):
                                                //echo'<pre>';print_r($col);die;
                                                echo number_format($col['0']['total'] / $operated_print_year);
                                            endforeach;

                                            ?>
                                        </td>
                                    </tr>

                                    <tr  class="active">
                                        <td>Per Hour Output</td>
                                        <!-- output/(24 * # of days worked) -->
                                        <?php
                                        //TODO::add currentdate
                                        ?>
                                        <td><?php echo number_format($print_output_day,2)?></td>
                                        <td><?php echo number_format($print_output_month,2);?></td>
                                        <td><?php echo number_format($print_output_year,2);?></td>
                                    </tr>

                                    <tr class="active">

                                        <td>Per Work Hour Output</td>
                                        <!-- output/(avg working hour * # of days worked) -->
                                        <td><?php echo number_format($total_output_day/$avg_wh_d,2)?></td>
                                        <td><?php echo number_format($total_output_month/($avg_wh_m*$operated_print_month),2);?></td>
                                        <td><?php echo number_format($total_output_year/($avg_wh_y*$operated_print_year),2);?></td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Input Output Ratio</div>

                            <div class="panel-body">

                               <!--  <table class="table table-condensed table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Dimension</th>
                                        <th style="text-align: ;">Input</th>
                                        <th style="text-align: ;">Output</th>
                                        <th style="text-align: ;">Ratio</th>
                                        <th>Target</th>
                                        <th>Difference</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <script>
                                        $(document).ready(function(){
                                            <?php foreach($target_print as $tpp):?>
                                            var valueTarget = parseInt($('.dimensionTarget-<?=$tpp[0]['print_dimension_target']['id'];?>').html());
                                            if(valueTarget<3 && valueTarget>-3)
                                            {
                                                $('.dimensionTarget-<?=$tpp[0]['print_dimension_target']['id'];?>').addClass('success');
                                            }
                                            <?php endforeach;?>
                                        });
                                    </script>
                                    <?php
                                    //echo'<pre>';print_r($target_print);die;
                                    foreach ($calenderratio as $loss) {
                                        echo '<tr>';
                                            echo '<td>' . $loss['printing_shiftreport']['dimension'] . '</td>';
                                            echo '<td style="text-align: ;">'. number_format($loss['0']['input'], 2) . '</td>';
                                            echo '<td style="text-align: ;">'. number_format($loss['0']['output'], 2) . '</td>';
                                            echo '<td style="text-align: ;">'. number_format($loss['0']['cratio'], 2) . '</td>';

                                        foreach($target_print as $tp){
                                            //echo $loss['printing_shiftreport']['dimension'];die;
                                            //echo $tp[0]['print_dimension_target']['dimension'];die;
                                            if($loss['printing_shiftreport']['dimension']==$tp[0]['print_dimension_target']['dimension'])
                                            {
                                                echo '<td style="text-align: ;">' . number_format($tp[0]['print_dimension_target']['target'], 2) . '</td>';
                                                $diff = ($loss['0']['cratio']-$tp[0]['print_dimension_target']['target'])*100/$tp[0]['print_dimension_target']['target'];
                                                //echo $diff;die;
                                                echo '<td class="dimensionTarget-'.$tp[0]['print_dimension_target']['id'].'" style="text-align: ;">' . number_format($diff, 2) . '%</td>';

                                            }
                                        }

                                        //echo '<td style="text-align: right;">' . number_format($loss['0']['target'], 2) . '</td>';

                                        echo '</tr>';

                                    }
                                    ?>
                                    </tbody>
                                </table> -->
                                <table class="table table-condensed table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Dimension</th>
                                        <th style="text-align: ;">Input</th>
                                        <th style="text-align: ;">Output</th>
                                        <th style="text-align: ;">Ratio</th>
                                        <th>Target</th>
                                        <th>Difference</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <script>
                                        $(document).ready(function(){
                                            <?php foreach($target_print as $tpp):?>
                                            var valueTarget=0.0;
                                            var valueTarget = parseFloat($('.dimensionTarget-<?=$tpp[0]['print_dimension_target']['id'];?>').html());
                                            //console.log('yo = '+valueTarget)
                                            if(valueTarget>=0)
                                            {
                                                $('.dimensionTarget-<?=$tpp[0]['print_dimension_target']['id'];?>').addClass('success');
                                            }
                                            else
                                            {
                                                $('.dimensionTarget-<?=$tpp[0]['print_dimension_target']['id'];?>').addClass('danger');
                                            }
                                            <?php endforeach;?>
                                        });
                                    </script>
                                    <?php
                                    //echo'<pre>';print_r($target_print);die;
                                    foreach ($calenderratio as $loss) {
                                        echo '<tr>';
                                            echo '<td>' . $loss['printing_shiftreport']['dimension'] . '</td>';
                                            echo '<td style="text-align: ;">'. number_format($loss['0']['input'], 2) . '</td>';
                                            echo '<td style="text-align: ;">'. number_format($loss['0']['output'], 2) . '</td>';
                                            echo '<td style="text-align: ;">'. number_format($loss['0']['cratio'], 2) . '</td>';
                                        foreach($target_print as $tp){
                                            //echo $loss['printing_shiftreport']['dimension'];die;
                                            //echo $tp[0]['print_dimension_target']['dimension'];die;
                                            if($loss['printing_shiftreport']['dimension']==$tp[0]['print_dimension_target']['dimension'])
                                            {
                                                echo '<td style="text-align: ;">' . number_format($tp[0]['print_dimension_target']['target'], 2) . '</td>';
                                                // $diff = ($loss['0']['cratio']-$tp[0]['print_dimension_target']['target'])*100/$tp[0]['print_dimension_target']['target'];
                                                $diff = number_format($loss['0']['cratio'],2)-number_format($tp[0]['print_dimension_target']['target'],2);
                                                //echo $diff;die;
                                                echo '<td class="dimensionTarget-'.$tp[0]['print_dimension_target']['id'].'" style="text-align: ;">' . number_format($diff, 2) . '%</td>';

                                            }
                                        }

                                        //echo '<td style="text-align: right;">' . number_format($loss['0']['target'], 2) . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                    <div class="col-md-12" style="margin:0px;padding:0px;">
                        <div class="panel panel-primary">
                            <!--Printing Breakdown-->
                            <div class="panel-heading">BreakDown Reasons %</div>
                            <div class="panel-body">
                                <div class="container-fluid">
                                    <table class="table">
                                        <tr class="success">
                                            <th>Reasons</th>
                                            <th>Today <br/>(<?= $current_print_day;?>)</th>
                                            <th>To Month <br/>(<?= $current_print_month;?>)</th>
                                            <th>To Year <br/>(<?= $current_print_year;?>)</th>
                                        </tr>

                                        <tr>

                                            <td><?php
                                                $rea_count = count($bd_reason);

                                                foreach ($bd_reason as $bd):
                                                    echo $bd. '<br/>';
                                                endforeach;
                                                ?>
                                            </td>
                                            <td>
                                                <?php foreach ($bd_d as $bd):

                                                    echo number_format($bd[0][0]['bd_d'], 2) . '%<br/>';

                                                endforeach;

                                                $today_count = count($bd_d);
                                                for($today_count;$today_count<$rea_count;$today_count++)
                                                {

                                                     echo number_format(0,2).'%<br/>';
                                                }
                                                ?>
                                            </td>
                                            <td>

                                                <?php

                                                foreach ($bd_m as $bd):
                                                    //print_r($bd);die;
                                                    echo number_format($bd[0][0]['bd_m'], 2) . '%<br/>';

                                                endforeach;
                                                $month_count = count($bd_m);

                                                for($month_count;$month_count<$rea_count;$month_count++)
                                                {
                                                    echo number_format(0,2).'%<br/>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php foreach ($bd_y as $bd):

                                                    echo number_format($bd[0][0]['bd_y'], 2) . '%<br/>';

                                                endforeach;
                                                $year_count = count($bd_y);
                                                for($year_count;$year_count<$rea_count;$year_count++)
                                                {

                                                     echo number_format(0,2).'%<br/>';


                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        <!--Printing Loss Hour Reasons-->
            <div class="row">
                <div class="col-md-12" style="margin:0px;padding:0px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Loss Hour Reasons %</div>
                        <div class="panel-body">
                            <div class="container-fluid">
                                <table class="table" style="font-size: 14px;">
                                    <tr class="success">
                                        <th>Reasons</th>
                                        <th>Today <br/>(<?= $current_print_day;?>)</th>
                                        <th>To Month <br/>(<?= $current_print_month;?>)</th>
                                        <th>To Year <br/>(<?= $current_print_year;?>)</th>

                                    </tr>
                                    <tr>
                                        <td>
                                            <?php $rea_loss = count ($tylhloss);?>
                                            <?php foreach ($reasons as $r):

                                                echo $r . '<br/>';

                                            endforeach;
                                            ?>
                                        </td>
                                        <td>
                                            <?php foreach ($tdlhloss as $bd):

                                                echo number_format($bd[0][0]['tdlhloss'], 2) . '%<br/>';

                                            endforeach;
                                            $today_loss = count ($tdlhloss);
                                            for($today_loss;$today_loss<$rea_loss;$today_loss++)
                                            {
                                                echo number_format(0,2).'%<br/>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php  foreach ($tmlhloss as $bd):

                                                echo number_format($bd[0][0]['tmlhloss'], 2) . '%<br/>';

                                            endforeach;
                                            $month_loss = count ($tmlhloss);
                                            for($month_loss;$month_loss<$rea_loss;$month_loss++)
                                            {
                                                echo number_format(0,2).'%<br/>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php foreach ($tylhloss as $bd):

                                                echo number_format($bd[0][0]['tylhloss'], 2) . '%<br/>';

                                            endforeach;
                                            $year_loss = count ($tylhloss);
                                            for($year_loss;$year<$rea_loss;$year_loss++)
                                            {
                                                echo number_format(0,2).'%<br/>';
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--End: Printing Loss Hour Reasons-->



        <!--Printing: Loss Hour Calculations-->
            <div class="row">
                <div class="col-md-12" style="margin:0px;padding:2px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Loss Hour Calculations</div>
                        <div class="panel-body">
                            <div class="container-fluid">
                                <table class="table table-bordered table-hover">

                                <tr class="success">
                                        <th>Category</th>
                                        <th>Today <br/>(<?= $current_print_day;?>)</th>
                                        <th>To Month <br/>(<?= $current_print_month;?>)</th>
                                        <th>To Year <br/>(<?= $current_print_year;?>)</th>
                                    </tr>
                                    <tr>
                                        <td><strong>Break Down</strong></td>

                                        <td><?php echo $breakdownToDay; ?></td>
                                        <td><?php if($breakdownToMonth!='')echo $breakdownToMonth; else echo 0; ?></td>
                                        <td><?php if($breakdownToYear!='')echo $breakdownToYear; else echo 0; ?></td>

                                    </tr>
                                    <tr>
                                        <td><strong>Loss Hour</strong></td>
                                        <td><?php if($losshourToDay!='')echo $losshourToDay; else echo 0; ?></td>
                                        <td><?php if($losshourToMonth!='')echo $losshourToMonth; else echo 0; ?></td>
                                        <td><?php if($losshourToYear!='')echo $losshourToYear; else echo 0; ?></td>

                                    </tr>
                                    <tr>
                                        <td><strong>Worked Hour</strong></td>
                                        <td><?php if($workedHourToDay!='')echo $workedHourToDay; else echo 0; ?></td>
                                        <td><?php if($workedHourToMonth!='')echo $workedHourToMonth; else echo 0; ?></td>
                                        <td><?php if($workedHourToYear!='')echo $workedHourToYear; else echo 0; ?></td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End of Printing: Loss Hour Calculations-->
            </div>



        <!-- printed and unprinted reasons -->

            <?php
            function check_percentage($reason, $printingShiftreport)
            {
                $totalPrintingReason = 0;
                foreach($printingShiftreport as $p){
                    if($p['printing_shiftreport']['printed_scrap_reason']==$reason)
                    {
                        $totalPrintingReason += $p['printing_shiftreport']['printed_scrap'];
                    }
                    for($i=1; $i<=5; $i++) {
                        if ($p['printing_shiftreport']['printed_reason_'.$i] == $reason) {
                            $totalPrintingReason += $p['printing_shiftreport']['quantity_'.$i];
                        }
                    }
                }
                return $totalPrintingReason;
            }
            function check_percentageUnprinted($reason, $printingShiftreport)
            {
                $totalPrintingReason = 0;
                foreach($printingShiftreport as $p){
                    if($p['printing_shiftreport']['unprinted_scrap_reason']==$reason)
                    {
                        $totalPrintingReason += $p['printing_shiftreport']['unprinted_scrap'];
                    }
                    for($i=1; $i<=5; $i++) {
                        if ($p['printing_shiftreport']['unprinted_reason_'.$i] == $reason) {
                            $totalPrintingReason += $p['printing_shiftreport']['quantity'.$i];
                        }
                    }
                }
                return $totalPrintingReason;
            }
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Printed Shift Report Reasons Percentage</div>
                        <div class="panel-body">

                            <table class="table table-bordered">
                            <tr class="success">
                                <th>Reasons</th>
                                <th>Today (<?=$current_print_day;?>)</th>
                                <th>To Month (<?=$current_print_month;?>)</th>
                                <th>To Year (<?=$current_print_year;?>)</th>
                            </tr>

                            <?php
                            $totalToDay = 0;
                            $totalToMonth=0;
                            $totalToYear = 0;
                            foreach($printedReason as $p):
                                $totalToDay += check_percentage($p['laminating_reason']['reason'], $printingShiftreportToDay);
                                $totalToMonth += check_percentage($p['laminating_reason']['reason'], $printingShiftreportToMonth);
                                $totalToYear += check_percentage($p['laminating_reason']['reason'], $printingShiftreportToYear);
                            endforeach;
                            ?>

                            <?php
                            //echo'<pre>';print_r($totalToYear);die;

                            foreach($printedReason as $p):
                            ?>


                            <!-- <tr>
                            
                                <td><?=$p['laminating_reason']['reason'];?></td>
                                <td><?=number_format((check_percentage($p['laminating_reason']['reason'], $printingShiftreportToDay)),2).'';?></td>
                                <td><?=number_format((check_percentage($p['laminating_reason']['reason'], $printingShiftreportToMonth)),2).'';?></td>
                                <td><?=number_format((check_percentage($p['laminating_reason']['reason'], $printingShiftreportToYear)),2).'';?></td>
                            </tr>  -->


                            <tr>

                                <td><?=$p['laminating_reason']['reason'];?></td>
                                <td><?=number_format((check_percentage($p['laminating_reason']['reason'], $printingShiftreportToDay)*100/($totalToDay?$totalToDay:1)),2).'%';?></td>
                                <td><?=number_format((check_percentage($p['laminating_reason']['reason'], $printingShiftreportToMonth)*100/($totalToMonth?$totalToMonth:1)),2).'%';?></td>
                                <td><?=number_format((check_percentage($p['laminating_reason']['reason'], $printingShiftreportToYear)*100/($totalToYear?$totalToYear:1)),2).'%';?></td>
                            </tr>
                            <?php endforeach;?>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Unprinted Shift Report Reasons Percentage</div>
                        <div class="panel-body">

                            <table class="table table-bordered">
                            <!-- <tr>
                                <th>Reasons</th>
                                <th>Today (<?=$lastDate;?>)</th>
                                <th>To Month (<?=substr($lastDate, 0, 7);?>)</th>
                                <th>To Year (<?=substr($lastDate, 0, 4);?>)</th>
                            </tr> -->
                            <tr class="success">
                                <th>Reasons</th>
                                <th>Today (<?=$current_print_day;?>)</th>
                                <th>To Month (<?=$current_print_month;?>)</th>
                                <th>To Year (<?=$current_print_year;?>)</th>
                            </tr>

                            <?php
                            $totalToDay = 0;
                            $totalToMonth=0;
                            $totalToYear = 0;
                            foreach($unprintedReason as $p):
                                $totalToDay += check_percentageUnprinted($p['laminating_reason']['reason'], $printingShiftreportToDay);
                                $totalToMonth += check_percentageUnprinted($p['laminating_reason']['reason'], $printingShiftreportToMonth);
                                $totalToYear += check_percentageUnprinted($p['laminating_reason']['reason'], $printingShiftreportToYear);
                            endforeach;
                            ?>

                            <?php foreach($unprintedReason as $p):?>
                            <tr>
                                <td><?=$p['laminating_reason']['reason'];?></td>
                                <td><?=number_format((check_percentageUnprinted($p['laminating_reason']['reason'], $printingShiftreportToDay)*100/($totalToDay?$totalToDay:1)),2).'%';?></td>
                                <td><?=number_format((check_percentageUnprinted($p['laminating_reason']['reason'], $printingShiftreportToMonth)*100/($totalToMonth?$totalToMonth:1)),2).'%';?></td>
                                <td><?=number_format((check_percentageUnprinted($p['laminating_reason']['reason'], $printingShiftreportToYear)*100/($totalToYear?$totalToYear:1)),2).'%';?></td>
                            </tr>

                            <!-- <tr>
                                <td><?=$p['laminating_reason']['reason'];?></td>
                                <td><?=number_format((check_percentageUnprinted($p['laminating_reason']['reason'], $printingShiftreportToDay)),2).'';?></td>
                                <td><?=number_format((check_percentageUnprinted($p['laminating_reason']['reason'], $printingShiftreportToMonth)),2).'';?></td>
                                <td><?=number_format((check_percentageUnprinted($p['laminating_reason']['reason'], $printingShiftreportToYear)),2).'';?></td>
                            </tr> -->
                            <?php endforeach;?>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
                <!-- end printed and unprinted reasons -->

            <div class="row">
                <div class="col-sm-6" style="margin:0px;padding: 2px;padding-left:20px">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Monthly Printing Consumption Report
                        </div>
                        <div class="panel-body">
                             <?php
                                echo '<td>';
                                echo $this->Form->input('Month', array('type' => 'select', 'options' => array('01' => 'Baisakh', '02' => 'Jestha', '03' => 'Ashad', '04' => 'Shrawan', '05' => 'Bhadra', '06' => 'Ashoj', '07' => 'Kartik', '08' => 'Mangsir', '09' => 'Poush', '10' => 'Margh', '11' => 'falgun', '12' => 'Chaitra'), 'class' => 'month form-control', 'onchange' => 'generate_print(this);'));
                                echo '</td>';
                                ?>
                                <br/>

                                <script>
                                    function updateLink3(that){
                                        var month = $('#Month').val();
                                        if(month){
                                            var url = $(that).attr('href');
                                            if(url.indexOf('?Month='))
                                            {
                                                url = url.split('?Month=')[0];
                                            }
                                            url+='?Month='+month;
                                            $(that).attr('href',url);
                                            return true;
                                        }
                                        return false;
                                    }
                                </script>

                                <?php
                                    echo $this->Html->link('Download CSV file', array('controller' => 'pages', 'action' => 'exportprint'), array('class' => 'btn btn-success csv', 'onclick'=>'return updateLink3(this);'));
                                ?>
                                <div class="consumption"></div>
                        </div>

                    </div>
            </div>

        </div>



<?php } ?>
<!--End of the printing department-->
<!--Laminating department-->
<?php if (AuthComponent::user('id') and AuthComponent::user('role') == 'laminating') { ?>
    <h1>Welcome to Laminating Department</h1>

    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
    </ol>

    <div class="container-fluid">

        <!-- Productions Shiftreport -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"> Productions Shiftreport </div>
                    <div class="panel-body">
                        <table class="table table-hover table-bordered">
                            <tr class="success">
                                <td>Base</td>
                                <td>ToDay <?=$productionShifrReport['lastDate'];?></td>
                                <td>ToMonth <?=substr($productionShifrReport['lastDate'],0,7);?></td>
                                <td>ToYear <?=substr($productionShifrReport['lastDate'],0,4);?></td>
                            </tr>
                            <tr>
                                <td>Total MT</td>
                               <td><?=$productionShifrReport['toDay']['base_mt'];?></td>
                               <td><?=$productionShifrReport['toMonth']['base_mt'];?></td>
                               <td><?=$productionShifrReport['toYear']['base_mt'];?></td>
                            </tr>
                            <tr>
                                <td>Total UT</td>
                                <td><?=$productionShifrReport['toDay']['base_ut'];?></td>
                                <td><?=$productionShifrReport['toMonth']['base_ut'];?></td>
                                <td><?=$productionShifrReport['toYear']['base_ut'];?></td>
                            </tr>
                            <tr>
                                <td>Total CT</td>
                                <td><?=$productionShifrReport['toDay']['ct'];?></td>
                                <td><?=$productionShifrReport['toMonth']['ct'];?></td>
                                <td><?=$productionShifrReport['toYear']['ct'];?></td>
                            </tr>
                            <tr>
                                <td>Total CT KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Total PF</td>
                                <td><?=$productionShifrReport['toDay']['print_film'];?></td>
                                <td><?=$productionShifrReport['toMonth']['print_film'];?></td>
                                <td><?=$productionShifrReport['toYear']['print_film'];?></td>
                            </tr>
                            <tr>
                                <td>Total Output</td>
                                <td><?=$productionShifrReport['toDay']['output'];?></td>
                                <td><?=$productionShifrReport['toMonth']['output'];?></td>
                                <td><?=$productionShifrReport['toYear']['output'];?></td>
                            </tr>
                            <tr>
                                <td>Perhour Output</td>
                                <td><?=number_format($productionShifrReport['toDay']['perhourOutput'],2);?></td>
                                <td><?=number_format($productionShifrReport['toMonth']['perhourOutput'],2);?></td>
                                <td><?=number_format($productionShifrReport['toYear']['perhourOutput'],2);?></td>
                            </tr>
                            <tr>
                                <td>Perhour Working Hour Output</td>
                                <td><?=number_format($productionShifrReport['toDay']['perHourOutputWorked'],2);?></td>
                                <td><?=number_format($productionShifrReport['toMonth']['perHourOutputWorked'],2);?></td>
                                <td><?=number_format($productionShifrReport['toYear']['perHourOutputWorked'],2);?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Productions Shiftreport -->
        <div class="row">

            <!-- Breakdown/Loss Hour Calculation -->
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Breakdown/Loss Hour Calculation
                    </div>
                    <div class="panel-body">
                        <?php
                        $tdl;
                        $tdb;
                        $tml;
                        $tmb;
                        $tyl;
                        $tyb;
                        ?>
                        <table class="table table-bordered table-hover" style="margin:0px auto;">
                            <tr>
                                <th>Type</th>
                                <th style="text-align: right;">Today</th>
                                <th style="text-align: right;">To Month</th>
                                <th style="text-align: right;">To Year</th>
                            <tr>

                            <tr>
                                <td> Output Per Total Hours</td>
                                <td style="text-align: right;">
                                    <?php foreach ($todaycalenderop as $trw):
//                  echo $todayworkinghour.'='.$trw[0]['output'];
                                        echo number_format($trw[0]['output'] / 24, 2);
                                    endforeach;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php foreach ($tomonthcalenderop as $trw):

                                        echo number_format($trw[0]['output'] / (24 * 30), 2);
                                    endforeach;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php foreach ($toyrcalenderop as $trw):

                                        echo number_format($trw[0]['output'] / (24 * 30 * 12), 2);
                                    endforeach;
                                    ?>
                                </td>
                            </tr>

                            <tr>/<!--Lamination-->
                                <td> Number of Color Made</td>
                                <td style="text-align: right;">
                                    <?php foreach ($tdcolorcount as $trw):
//                  echo $todayworkinghour.'='.$trw[0]['output'];
                                        echo number_format($trw[0]['tdcolorcount'], 2);
                                    endforeach;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php foreach ($tmcolorcount as $trw):

                                        echo number_format($trw[0]['tmcolorcount'] / $_daysinmonth, 2);
                                    endforeach;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php foreach ($tycolorcount as $trw):

                                        echo number_format($trw[0]['tycolorcount'] / $_daysinyear, 2);
                                    endforeach;
                                    ?>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <!-- end Breakdown/Loss Hour Calculation -->

            <!-- Scrap %-->
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Scrap %</div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <table class="table">
                                <tr class="success">
                                    <th>Base</th>
                                    <th style="text-align: right;">To Day</th>
                                    <th style="text-align: right;">To Month</th>
                                    <th style="text-align: right;">To Year</th>
                                </tr>
                                <tr>
                                    <td>Base UT</td>
                                    <td style="text-align: right;">
                                        <?php foreach ($tdmtlr_percent as $per):
                                            echo number_format($per['0']['base_ut'], 2);
                                        endforeach;
                                        ?>

                                    </td>
                                    <td style="text-align: right;">
                                        <?php foreach ($tmmtlr_percent as $per):
                                            echo number_format($per['0']['base_ut'], 2);
                                        endforeach;
                                        ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php foreach ($tymtlr_percent as $per):
                                            echo number_format($per['0']['base_ut'], 2);
                                        endforeach;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Base MT
                                    </td>
                                    <td style="text-align: right;"><?php foreach ($tdmtlr_percent as $per):
                                            echo number_format($per['0']['base_mt'], 2);
                                        endforeach;
                                        ?></td>
                                    <td style="text-align: right;"><?php foreach ($tmmtlr_percent as $per):
                                            echo number_format($per['0']['base_mt'], 2);
                                        endforeach;
                                        ?></td>
                                    <td style="text-align: right;"><?php foreach ($tymtlr_percent as $per):
                                            echo number_format($per['0']['base_mt'], 2);
                                        endforeach;
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Base OT
                                    </td>
                                    <td style="text-align: right;"><?php foreach ($tdmtlr_percent as $per):
                                            echo number_format($per['0']['base_ot'], 2);
                                        endforeach;
                                        ?></td>
                                    <td style="text-align: right;"><?php foreach ($tmmtlr_percent as $per):
                                            echo number_format($per['0']['base_ot'], 2);
                                        endforeach;
                                        ?></td>
                                    <td style="text-align: right;"><?php foreach ($tymtlr_percent as $per):
                                            echo number_format($per['0']['base_ot'], 2);
                                        endforeach;
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        CT


                                    </td>
                                    <td style="text-align: right;"><?php foreach ($tdmtlr_percent as $per):
                                            echo number_format($per['0']['CT'], 2);
                                        endforeach;
                                        ?></td>
                                    <td style="text-align: right;"><?php foreach ($tmmtlr_percent as $per):
                                            echo number_format($per['0']['CT'], 2);
                                        endforeach;
                                        ?></td>
                                    <td style="text-align: right;"><?php foreach ($tymtlr_percent as $per):
                                            echo number_format($per['0']['CT'], 2);
                                        endforeach;
                                        ?></td>
                                </tr>

                                <tr>
                                    <td>
                                        Print Film


                                    </td>
                                    <td style="text-align: right;"><?php foreach ($tdmtlr_percent as $per):
                                            echo number_format($per['0']['print_film'], 2);
                                        endforeach;
                                        ?></td>
                                    <td style="text-align: right;"><?php foreach ($tmmtlr_percent as $per):
                                            echo number_format($per['0']['print_film'], 2);
                                        endforeach;
                                        ?></td>
                                    <td style="text-align: right;"><?php foreach ($tymtlr_percent as $per):
                                            echo number_format($per['0']['print_film'], 2);
                                        endforeach;
                                        ?></td>
                                </tr>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end Scrap % -->
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <!-- Scrap % with Brand -->
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Scrap % with Brand</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <table class="table">
                            <tr class="success">
                                <th>Brand</th>
                                <th style="text-align: right;">Today</th>

                            </tr>

                            <?php
                            foreach ($tdprint_percent as $tdp):
                                echo '<tr>';
                                echo '<td>' . $tdp['production_shiftreport']['brand'] . '</td><td style="text-align: right;">' . number_format($tdp['0']['print_film'], 2) . '</td>';
                                echo '</tr>';
                            endforeach;
                            ?>

                        </table>
                        <table class="table">
                            <tr class="success">
                                <th>Brand</th>
                                <th style="text-align: right;">To Month</th>

                            </tr>

                            <?php
                            foreach ($tmprint_percent as $tdp):
                                echo '<tr>';
                                echo '<td>' . $tdp['production_shiftreport']['brand'] . '</td><td style="text-align: right;">' . number_format($tdp['0']['print_film'], 2) . '</td>';
                                echo '</tr>';
                            endforeach;
                            ?>

                        </table>

                        <table class="table">
                            <tr class="success">
                                <th>Brand</th>
                                <th style="text-align: right;">To Year</th>
                            </tr>
                            <?php
                            foreach ($typrint_percent as $tdp):
                                echo '<tr>';
                                echo '<td>' . $tdp['production_shiftreport']['brand'] . '</td><td style="text-align: right;">' . number_format($tdp['0']['print_film'], 2) . '</td>';
                                echo '</tr>';
                            endforeach;
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Scrap % with Brand -->
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">BreakDown Reasons %</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <table class="table">
                            <tr class="success">
                                <th>Reasons</th>
                                <th style="text-align: right;">Today</th>
                                <th style="text-align: right;">To Month</th>
                                <th style="text-align: right;">To Year</th>
                            </tr>
                            <tr>
                                <td>
                                    <?php foreach ($tybdloss as $bd):
                                        echo $bd['time_loss']['reasons'] . '<br/>';
                                    endforeach;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php foreach ($tdbdloss as $bd):
                                        echo number_format($bd['0']['tdbdloss'], 2) . '%<br/>';
                                    endforeach;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php foreach ($tmbdloss as $bd):
                                        echo number_format($bd['0']['tmbdloss'], 2) . '%<br/>';
                                    endforeach;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php foreach ($tybdloss as $bd):
                                        echo number_format($bd['0']['tybdloss'], 2) . '%<br/>';
                                    endforeach;
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Loss Hour Reasons %</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <table class="table">
                            <tr class="success">
                                <th>Reasons</th>
                                <th style="text-align: right;">Today</th>
                                <th style="text-align: right;">To Month</th>
                                <th style="text-align: right;">To Year</th>
                            </tr>
                            <tr>
                                <td>
                                    <?php foreach ($tylhloss as $bd):
                                        echo $bd['time_loss']['reasons'] . '<br/>';
                                    endforeach;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php foreach ($tdlhloss as $bd):
                                        echo number_format($bd['0']['tdlhloss'], 2) . '%<br/>';
                                    endforeach;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php foreach ($tmlhloss as $bd):
                                        echo number_format($bd['0']['tmlhloss'], 2) . '%<br/>';
                                    endforeach;
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php foreach ($tylhloss as $bd):
                                        echo number_format($bd['0']['tylhloss'], 2) . '%<br/>';
                                    endforeach;
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="margin:0px;padding:2px;">
            <div class="panel panel-primary">
                <div class="panel-heading">Loss Hour Calculations</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <table class="table table-bordered table-hover">
                            <tr class="success">
                                <th>Category</th>
                                <th>Today</th>
                                <th>To Month</th>
                                <th>To Year</th>
                            </tr>
                            <tr>
                                <td><strong>Break Down</strong></td>
                                <td><?= $breakdown_today; ?></td>
                                <td><?= $breakdown_tomnoth; ?></td>
                                <td><?= $breakdown_toyear; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Loss Hour</strong></td>
                                <td><?= $losshour_today; ?></td>
                                <td><?= $losshour_tomonth; ?></td>
                                <td><?= $losshour_toyear; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Worked Hour</strong></td>
                                <td><?= $workhour_d; ?></td>
                                <td><?= $workhour_m; ?></td>
                                <td><?= $workhour_y; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!--End of the laminating department code-->

</div>
</div><!-- /.row -->

