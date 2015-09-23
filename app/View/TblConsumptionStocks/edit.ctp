<div class="container">
    <div class="row">
        <?=$this->Html->link('List items', array('action' => 'index'),['class'=>'btn btn-primary pull-right']);?>
        <br><br>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Concumption Stocks Add
                </div>
                <div class="panel-footer">
                    <table class="table">
                        <form action="" method="post">
                        <tr>
                            <td>Nepalidate</td>
                            <td><input id="nepali-calendar" required="required" class="form-control nepali-calendar" type="text" value="<?=$consumption[0]['tbl_consumption_stock']['nepalidate']?$consumption[0]['tbl_consumption_stock']['nepalidate']:0;?>" name="nepalidate"></td>
                        </tr>
                            <tr>
                                <td>Shift</td>
                                <td>
                                    <select required="required" class="form-control" name="shift">
                                        <option value="">Please select</option>
                                        <option <?=$consumption[0]['tbl_consumption_stock']['shift']=='A'?'selected':'';?> value="A">A</option>
                                        <option <?=$consumption[0]['tbl_consumption_stock']['shift']=='B'?'selected':'';?> value="B">B</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Brand</td>
                                <td>
                                    <select required="required" class="form-control brand" name="brand" id="brand">
                                        <option value="">Please select</option>
                                        <?php foreach($brand as $b):?>
                                            <option <?=$consumption[0]['tbl_consumption_stock']['brand']==$b?'selected':'';?> value="<?=$b;?>"><?=$b;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Quality</td>
                                <td>
                                    <select required="required" class="form-control brand" name="quality" id="quality">
                                        <?php foreach($arrQuality as $quality):?>
                                        <option value="<?=$quality?>"><?=$quality?></option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Dimension</td>
                                <td>
                                    <select required="required" class="form-control brand" name="dimension" id="dimension">
                                        <?php foreach($arrDimension as $dimension):?>
                                        <option value="<?=$dimension;?>"><?=$dimension;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Color</td>
                                <td>
                                    <select required="required" class="form-control brand" name="color" id="color">
                                        <?php foreach($arrColor as $color):?>
                                        <option value="<?=$color;?>"><?=$color;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                            </tr>
                        <?php
                        //materials field
                        /*echo '<pre>';
                        print_r($materials);*/
                        $materialsVal = json_decode($consumption[0]['tbl_consumption_stock']['materials']);
                        ?>
                        <?php foreach ($materials as $key => $m): ?>
                            <tr>
                                <td><?= $m['mixing_materials']['name']; ?></td>
                                <td>
                                    <?php
                                    if(property_exists($materialsVal, $m['mixing_materials']['id']))
                                    {
                                        $materialValue = $materialsVal->$m['mixing_materials']['id'];
                                    }else{
                                        $materialValue = 0;
                                    }
                                    ?>
                                    <input class="form-control" type="text" name="materials[<?=$m['mixing_materials']['id']; ?>]" value="<?=$materialValue;?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="Submit" class="btn btn-primary pull-right"></td>
                        </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var value = ''
        $('.nepali-calendar').nepaliDatePicker();
        // Trigger On change/Selected event

        $.onChangeDatepicker_Ravindra = function (selectedDate) {
            value = $("#nepali-calendar").val();
            $('.nepalidatepicker').val(value);
        }
        //brandchange
        $('#brand').on('change',function(){
            brandchange();
        });
        //quality change
        $('#quality').on('change', function(){
            qualitychange();
        });
        //dimension change
        $('#dimension').on('change', function(){
            dimensionchange();
        });
    });
    function brandchange() {
        var strUser = $('#brand').val();
        var dataString = 'id=' + strUser;
        $.ajax
        ({
            type: "POST",
            url: "/newpolychem/TblConsumptionStocks/t",
            data: dataString,
            cache: false,
            success: function (html) {
                $("#quality").html(html);
            }
        });
    }

    function qualitychange()
    {
        var brand = $('#brand').val();
        var quality = $('#quality').val();
        var dataString = 'brand='+brand+'&quality='+quality;
        $.ajax({
            type:"POST",
            url:'/newpolychem/TblConsumptionStocks/qualityChange',
            data:dataString,
            cache:false,
            success:function(html){
                $('#dimension').html(html);
            }
        })
    }
    function dimensionchange()
    {
        var brand = $('#brand').val();
        var quality = $('#quality').val();
        var dimension = $('#dimension').val();
        var dataString = 'brand='+brand+'&quality='+quality+'&dimension='+dimension;
        $.ajax({
            type:"POST",
            url:'/newpolychem/TblConsumptionStocks/dimensionChange',
            data:dataString,
            cache:false,
            success:function(html){
                $('#color').html(html);
            }
        })
    }
</script>
