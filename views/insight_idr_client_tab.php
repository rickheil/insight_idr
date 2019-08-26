<h2 data-i18n="insight_idr.title"></h2>

<div id="insight-idr-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>

<div id="insight-idr-view" class="row hide">
    <div class="col-md-5">
        <table class="table table-striped">
        <tr>
			<th data-i18n="insight_idr.client_id" class="insight-idr-client-id"></th>
			<td id="insight-idr-client-id"</td>
		</tr>
		<tr>
			<th data-i18n="insight_idr.agent_version" class="insight-idr-agent-version"></th>
			<td id="insight-idr-agent-version"</td>
		</tr>
		<tr>
			<th data-i18n="insight_idr.agent_status" class="insight-idr-agent-status"></th>
			<td id="insight-idr-agent-status"</td>
		</tr>
	    <tr>
            <th data-i18n="insight_idr.collector_list" class="insight-idr-collector-list"></th>
            <td id="insight-idr-collector-list"</td>
        </tr>
		</table>
	</div>
</div>
<script>
$(document).on('appReady', function(e, lang) {
    // Get data
    $.getJSON( appUrl + '/module/insight_idr/get_idr_data' + serialNumber, function( data ) {
            // Hide loading msg
            $('#insight-idr-msg').text('');
            $('#insight-idr-view').removeClass('hide');

			// Add data
			$('#insight-idr-client-id').text(data.client_id);
			$('#insight-idr-agent-version').text(data.agent_version);
			$('#insight-idr-agent-status').text(data.agent_status);
			$('#insight-idr-collector-list').text(data.sorted_collectors_list.replace(/ /g, ", "));

	});
});
</script>
