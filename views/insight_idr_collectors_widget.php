<div class="col-lg-4 col-md-6">
        <div class="panel panel-default" id="idr-collectors-widget">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-barcode"></i>
                    <span data-i18n="insight_idr.collectors"></span>
                    <list-link data-url="/module/insight_idr/insight_idr"></list-link>
                </h3>
            </div>
        <div class="list-group scroll-box"></div>
        </div> <!--panel-->
</div><!--col-->

<script>

$(document).on('appUpdate', function(e, lang) {
	$.getJSON( appUrl + '/module/insight_idr/get_collector_stats', function( data ) {
        var box = $('#idr-collectors-widget div.scroll-box').empty();
		if(data.length){
			$.each(data, function(i,d){
				var badge = '<span class="badge pull-right">'+d.count+'</span>',
                    url = appUrl+'/module/insight_idr/insight_idr,
					display_name = d.display_name || d.name;
				box.append('<a href="'+url+'" class="list-group-item">'+display_name+' '+d.version+badge+'</a>');
			});
		}
		else{
			box.append('<span class="list-group-item">'+i18n.t('insight_idr.no_collectors')+'</span>');
		}
	});
});
</script>
