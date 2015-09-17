<script>

    $(document).ready(function () {
        var value = ''
        $('.nepali-calendar').nepaliDatePicker();
        // Trigger On change/Selected event
        $.onChangeDatepicker_Ravindra = function (selectedDate) {
            value = $("#nepali-calendar").val();
            $('.nepalidatepicker').val(value);
        }

    });
</script>


<script type="text/javascript">

    var itsclicked = true;
    function test() {
        var x = document.getElementsByClassName('shift');
        for (i = 0; i < x.length; i++) {
            var e = document.getElementById("shift");
            var strUser = e.options[e.selectedIndex].text;
            x[i].value = strUser;
        }
    }

    function qwt() {
        var x = document.getElementsByClassName('quality');
        for (i = 0; i < x.length; i++) {
            var e = document.getElementById("quality");
            var strUser = e.options[e.selectedIndex].text;
            x[i].value = strUser;
        }
        var y = document.getElementsByClassName('brand');
        for (i = 0; i < y.length; i++) {
            var z = document.getElementById("brand");
            var strUsr = z.options[z.selectedIndex].text;
            y[i].value = strUsr;
        }
        var dataString = 'id=' + strUser + '&type=' + strUsr;
        $.ajax
        ({
            type: "POST",
            url: "/polychem/ConsumptionStocks/dimension",
            data: dataString,
            cache: false,
            success: function (html) {
                $(".dimension").html(html);
            }
        });

        $.ajax
        ({
            type: "POST",
            url: "/polychem/ConsumptionStocks/color",
            data: dataString,
            cache: false,
            success: function (html) {
                $(".color").html(html);
            }
        });

    }

    function dim() {
        var x = document.getElementsByClassName('dimension');
        for (i = 0; i < x.length; i++) {
            var e = document.getElementById("dimension");
            var strUser = e.options[e.selectedIndex].text;
            x[i].value = strUser;
            /*code to populate color*/


            /*end of the code*/
        }
        var qt = document.getElementById("quality");
        var q = qt.options[qt.selectedIndex].text;
        var dim = document.getElementById("dimension");
        var dmn = dim.options[dim.selectedIndex].text;

        color(q, dmn);
    }

    function color(a, b) {
        var select;
        if (a == "Base MT" && b == "0.30 x 1950") {


            var x = document.getElementById("color");
            var option = document.createElement("option");
            option.text = "Black";
            x.add(option);
        }
        else if (a == "Base UT" && b == "0.30 x 1950") {
            var x = document.getElementById("color");
            var option = document.createElement("option");
            option.text = "Pink";
            x.add(option);
        }
        else {

        }
    }

    function colorchange() {
        var x = document.getElementsByClassName('color');
        for (i = 0; i < x.length; i++) {
            var e = document.getElementById("color");
            var strUser = e.options[e.selectedIndex].text;
            x[i].value = strUser;


        }
    }


    function brandchange() {
        var x = document.getElementsByClassName('brand');
        //console.log(x.length);
        for (i = 0; i < x.length; i++) {
            var e = document.getElementById("brand");
            var strUser = e.options[e.selectedIndex].text;
            x[i].value = strUser;
        }
        var dataString = 'id=' + strUser;
        $.ajax
        ({
            type: "POST",
            url: "/polychem/ConsumptionStocks/t",
            data: dataString,
            cache: false,
            success: function (html) {
                $(".quality").html(html);
            }
        });


    }
    $(document).on("change", ".qty1", function () {
        var sum = 0;
        $(".qty1").each(function () {
            sum += +$(this).val();
        });
        $(".total").val(sum);
        $('.nepalidatepicker').val($('.nepali-calendar').val());
        //alert($('.nepali-calendar').val());

    });
</script>
<script>
    $(document).ready(function () {
        brandchange();
        var a = "<?php
	$v=AuthComponent::user('role');	echo $v?>";
        var us = "<?php
	$s=AuthComponent::user('username');	echo $s?>";
        $('#department').val(a);
        $('#user').val(us);
        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        $('#datetime').val(dt);
        var dn = dt.getHours();
        if (dn > 12) {
            $('#shift').val("B");

        }
        else {
            $('#shift').val("A");
        }
    });
</script>

<div class="panel panel-primary">
    <div class="panel-heading"><strong>
            <center>Consumption</center>
        </strong></div>
    <div class="panel-body">
        <?php
        $type = $this->Session->read("type");
        $d;
        $date = date('d-m-Y');
        $d = $nepdate['year'] . '-' . $nepdate['month'] . '-' . $nepdate['date'];
        //echo $this->Form->input('nepalidate',array('value'=>$d,'id'=>'nepali-calendar','class'=>'nepali-calendar','onchange'=>'rest();'));
        echo $this->Form->input('nepalidate', array('id' => 'nepali-calendar', 'class' => 'input input-sm nepali-calendar', 'required', 'value' => ''));
        //echo $this->Form->input('date',array('value'=>$date,'id'=>'datepicker','class'=>'datepicker','onchange'=>'rest();'));
        echo $this->Form->input('shift', array('options' => array('null' => 'Null', 'A' => 'A', 'B' => 'B'), 'required' => 'required', 'id' => 'shift', 'class' => 'input input-sm shift', 'onchange' => 'test()'));
        echo $this->Form->input('brand', array('id' => 'brand', 'class' => 'input input-sm brand', 'options' => array('Please Select' => 'Please Select', $brand), 'onchange' => 'brandchange()', 'values' => 'please select'));
        echo $this->Form->input('quality_id', array('class' => 'input input-sm quality', 'id' => 'quality', 'onchange' => 'qwt()', 'options' => array('null' => 'select')));
        echo $this->Form->input('dimension', array('options' => array('select' => 'select dimension', '0.30 x 1950' => '0.30 x 1950', '0.45 x 1950' => '0.45 x 1950', '0.46 x 2150' => '0.46 x 2150'
        , '0.50 x 2150' => '0.50 x 2150', '0.56 x 2150' => '0.56 x 2150', '0.60 x 2150' => '0.60 x 2150', '0.62 x 2150' => '0.62 x 2150'
        , '0.68 x 2150' => '0.68 x 2150', '0.65 x 2150' => '0.65 x 2150', '0.07 x 1950' => '0.07 x 1950', '0.07 x 2150' => '0.07 x 2150', '0.10 x 2150' => '0.10 x 2150', '0.13 x 2150' => '0.13 x 2150', '0.20 x 2150' => '0.20 x 2150'
        ), 'class' => 'input input-sm dimension', 'id' => 'dimension', 'onchange' => 'dim()'));
        echo $this->Form->input('color', array('class' => 'input input-sm color', 'id' => 'color', 'options' => array('select' => 'select color'), 'onchange' => 'colorchange()'));
        ?>
        <?php echo $this->Form->create(null, array(
            'url' => array('controller' => 'ConsumptionStocks', 'action' => 'add'),
            'class' => 'form-horizontal',
            'inputDefaults' => array(
                'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                'div' => array('class' => 'control-group'),
                'label' => array('class' => ' col-sm-2 control-label'),
                'between' => '<div class="col-xs-10">',
                'after' => '</div>',
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
            )));//('ConsumptionStock',array('onsubmit' => 'return itsclicked;'));
        ?>
        <fieldset>

            <!--Generating unique random numbers-->


            <!--End: Generating unique random numbers-->


            <?php
            $date = date('d-m-Y');
            $i = 1;
            echo '<table class="table">';
            echo '<td>Material</td>';
            $mixingraws1 = array_reverse($mixingraws1, true);
            foreach ($mixingraws1 as $material):
//print'<pre>';print_r($material);print'</pre>';die;

                echo '<tr>';

                echo '<td class="success">';
                echo $this->Form->input('Consumption.' . $i . '.shift', array('class' => 'input input-sm shift', 'id' => 'shift', 'type' => 'hidden', 'value' => 'A'));
                echo '</td>';

                echo $this->Form->input('Consumption.' . $i . '.brand', array('class' => 'input input-sm brand', 'type' => 'hidden'));
                echo '</td>';


                echo '<td class="success">';
                echo $this->Form->input('Consumption.' . $i . '.date', array('value' => $date, 'type' => 'hidden', 'class' => 'input input-sm date', 'id' => 'datepicker'));

                echo '</td>';
                echo '<td class="success">';
                echo $this->Form->input('Consumption.' . $i . '.nepalidate', array('value' => $d, 'type' => 'hidden', 'class' => 'input input-sm nepalidatepicker', 'id' => 'nepalidatepicker'));

                echo '</td>';

                echo '<td class="success">';
                echo $this->Form->input('Consumption.' . $i . '.quality_id', array('type' => 'hidden', 'class' => 'input input-sm quality'));

                echo '</td>';


                echo '<td class="success">';
                echo $this->Form->input('Consumption.' . $i . '.dimension', array('type' => 'hidden', 'class' => 'input input-sm dimension'));

                echo '</td>';

                echo '<td class="success">';
                echo $this->Form->input('Consumption.' . $i . '.color', array('class' => 'input input-sm color', 'type' => 'hidden'));
                echo '</td>';

                echo '<td class="success">';
                echo $this->Form->input('Consumption.' . $i . '.material_id', array('value' => $material['MixingMaterial']['name'], 'type' => 'text', 'readonly' => 'readonly', 'label' => false));
                echo '</td>';

                echo '<td class="success">';
                echo $this->Form->input('Consumption.' . $i . '.m_id', array('value' => $material['MixingMaterial']['id'], 'type' => 'hidden', 'readonly' => 'readonly', 'label' => false));
                echo '</td>';

                echo '<td class="success">';
                echo $this->Form->input('Consumption.' . $i . '.uid', array('value' => $rand, 'type' => 'hidden', 'readonly' => 'readonly', 'label' => false));
                echo '</td>';

                echo '<td class="success">';
                echo $this->Form->input('Consumption.' . $i . '.quantity', array('value' => '0', 'label' => false, 'class' => 'input input-sm qty1', 'tabindex' => $i));
                echo '</td>';


                echo '<td class="success">';
                echo $this->Form->input('Consumption.' . $i . '.department_id', array('value' => 'mixing', 'type' => 'hidden'));
                echo '</td>';
                echo '<td class="success">';
                echo '<td class="success">';
                echo $this->Form->input('Consumption.' . $i . '.total', array('type' => 'hidden', 'class' => 'input input-sm total', 'value' => '0'));
                echo '</td>';
                echo '<td class="success">';

                echo '</td>';

                echo '</tr>';
                $i = $i + 1;
            endforeach;
            echo '</table>';

            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Consumption Stocks'), array('action' => 'index/sort:consumption_id/direction:asc')); ?></li>
    </ul>
</div>
