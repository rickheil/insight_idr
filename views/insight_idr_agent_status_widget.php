<div class="col-lg-4 col-md-6">
    <div class="panel panel-default" id="insight-idr-agent-status-widget">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-barcode"></i>
                    <span data-i18n="insight_idr.agent_status"></span>
                    <list-link data-url="/show/listing/insight_idr/insight_idr"></list-link>
                </h3>
            </div>
        <div class="panel-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appReady appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/insight_idr/get_agent_status_stats', function( data ) {

        // Show no clients span
        $('#insight_idr-nodata').removeClass('hide');

        if(data.error){
            //alert(data.error);
            return;
        }

        var panel = $('#insight-idr-agent-status-widget div.panel-body'),
            baseUrl = appUrl + '/show/listing/insight_idr/insight_idr';
        panel.empty();

        // Set statuses
        if(data.agent_not_running){
            panel.append(' <a href="'+baseUrl+'#agent_not_running" class="btn btn-danger"><span class="bigger-150">'+data.agent_not_running+'</span><br>'+i18n.t('insight_idr.not_running')+'</a>');
        }
        if(data.agent_running){
            panel.append(' <a href="'+baseUrl+'#agent_running" class="btn btn-success"><span class="bigger-150">'+data.agent_running+'</span><br>'+i18n.t('insight_idr.running')+'</a>');
        }
    });
});
</script>
