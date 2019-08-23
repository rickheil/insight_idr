<div class="col-md-6">

    <div class="panel panel-default" id="insight-idr-agent-version-widget">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-barcode"></i>
            <span data-i18n="insight_idr.agent_version"></span>
            <list-link data-url="/show/listing/insight_idr/insight_idr"></list-link>
            </h3>
        </div>
    <div class="panel body">
        <svg style="width:100%"></svg>
    </div>
    </div>
</div>

<script>
$(document).on('appReady', function(e, lang) {
    var conf = {
        url: appUrl + '/module/insight_idr/get_agent_version_stats',
        widget: 'insight-idr-agent-version-widget',
        elementClickCallback: function(e){
            var label = mr.integerToVersion(e.data.label);
            window.location.href = appUrl + '/show/listing/insight_idr/insight_idr#' + label;
        },
        labelModifier: function(label){
            return mr.integerToVersion(label)
        }
    };
    mr.addGraph(conf);
});
</script>
