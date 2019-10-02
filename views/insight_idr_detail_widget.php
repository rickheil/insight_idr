<div class="col-lg-4">
    <h4><i class="fa fa-barcode"></i><span data-i18n="insight_idr.title"></span></h4>
    <table id="insight_idr-data" class="table"></table>
</div>

<script>

$(document).on('appReady', function(){
    $.getJSON( appUrl + '/module/insight_idr/get_idr_data/' + serialNumber, function ( data ) {
        $.each(data, function(index, item) {
            if(/^text[\d]$/.test(index)) {
                $('#insight_idr-data')
                    .append($('<tr>')
                    .append($('<th>')
                    .text(index.replace("text","IDR "+i18n.t("text")+" "))
                    .append($('<td>')
                    .text(item))))
            });
        });
    });

</script>
