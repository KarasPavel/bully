<?php $__env->startSection('content'); ?>

    <div class="sector-size">
        <div class="masonary-grids">
            <div class="col-md-12">
                <div class="widget-area">
                    <h2 class="widget-title"><strong>Create</strong> Sector</h2>
                    <div class="range-slider">
                        <p>Select number of columns</p><input type="text" id="range_cols" value=""/>
                        <p>Select number of rows</p> <input type="text" id="range_rows" value=""/>
                    </div>
                </div>
                <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
                <form method="post" action="<?php echo e(action('SectorController@create')); ?>">

                    <div class="table" id="table">
                        <table>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" id="hallId" name="hallId" value="<?php echo e($hall->id); ?>">
                    <p>Select color of sector</p><input type="color" id="color" name="color" value="#ed2a0f" style="margin-bottom: 20px">
                    <div class="form-group">
                        <input type="text" class="form-control" id="sectorName" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="sectorPrice"  name="sectorPrice" placeholder="Enter price" required>
                    </div>
                    <button id="createSector" type="button" class="btn btn-primary">CREATE SECTOR</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        var placeData = [];
        var column = 1, row = 1;
        var hallId = $('#hallId').val();
        var char = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

        function makeTable(cols, rows) {

            var hall = $('#table > table > tbody');

            if(cols){
                column = cols;
            }

            if(rows){
                row = rows;
            }
            for (var i = 1; i <= column; i++) {
                var hallRows = $('<tr></tr>').appendTo(hall);
                for (var j = 1; j <= row; j++) {
                    $('<td></td>').text((i + "row" ) + " " + (j +"place")).appendTo(hallRows);
                    placeData.push((i + "row" ) + " " + (j +"place"));
                }
            }
        }


        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#createSector').on('click', function () {

                $.post("<?php echo e(asset('/create-sector')); ?>", {placeData: placeData, column: column, row: row, name: $('#sectorName').val(), price: $('#sectorPrice').val(), hallId: hallId, color: $('#color').val() }, function (response) {
                    console.log(response);
                    if (response == 'true') {
                        window.location.href = "/admin/cinema-management/hall/sector"
                    }
                });
            });

            $("#range_rows").ionRangeSlider({
                min: 1,
                max: 100,
                step: 1,
                onChange: function (val) {
                    $('#table > table > tbody').empty();
                    placeData.length=0;
                    makeTable(val.fromNumber, null);
                }
            });

            $('#range_cols').ionRangeSlider({
                values:char,
                onChange: function (val) {
                    $('#table > table > tbody').empty();
                    placeData.length=0;
                    makeTable(null, val.fromNumber);
                }
            });

            makeTable(1, 1);


            $("#color").on('change',function () {
                $("td").css({border: '2px solid ' + $("#color").val()});
            });



        });
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>