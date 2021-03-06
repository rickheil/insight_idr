<?php $this->view('partials/head'); ?>

<div class="container">

  <div class="row">

    <div class="col-lg-12">

          <h3><span data-i18n="insight_idr.title"></span> <span id="total-count" class='label label-primary'>…</span></h3>

          <table class="table table-striped table-condensed table-bordered">
            <thead>
              <tr>
                <th data-i18n="listing.computername" data-colname='machine.computer_name'></th>
                <th data-i18n="serial" data-colname='reportdata.serial_number'></th>
                <th data-i18n="username" data-colname='reportdata.long_username'></th>
                <th data-i18n="insight_idr.client_id" data-colname='insight_idr.client_id'></th>
                <th data-i18n="insight_idr.agent_version" data-colname='insight_idr.agent_version'></th>
                <th data-i18n="insight_idr.agent_status" data-colname='insight_idr.agent_status'></th>
                <th data-i18n="insight_idr.collector_list" data-colname='insight_idr.sorted_collectors_list'></th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-i18n="listing.loading" colspan="14" class="dataTables_empty"></td>
                </tr>
            </tbody>
          </table>
    </div> <!-- /span 12 -->
  </div> <!-- /row -->
</div>  <!-- /container -->

<script type="text/javascript">
	$(document).on('appUpdate', function(e){
		var oTable = $('.table').DataTable();
		oTable.ajax.reload();
		return;
	});
	$(document).on('appReady', function(e, lang) {
        // Get modifiers from data attribute
        var mySort = [], // Initial sort
            hideThese = [], // Hidden columns
            col = 0, // Column counter
            runtypes = [], // Array for runtype column
            columnDefs = [{ visible: false, targets: hideThese }]; //Column Definitions
        $('.table th').map(function(){
            columnDefs.push({name: $(this).data('colname'), targets: col, render: $.fn.dataTable.render.text()});
            if($(this).data('sort')){
              mySort.push([col, $(this).data('sort')])
            }
            if($(this).data('hide')){
              hideThese.push(col);
            }
            col++
        });
	    oTable = $('.table').dataTable( {
            ajax: {
                url: appUrl + '/datatables/data',
                type: "POST",
                data: function( d ){
                  d.mrColNotEmpty = "insight_idr.id"
                }
			},
            dom: mr.dt.buttonDom,
            buttons: mr.dt.buttons,
            order: mySort,
            columnDefs: columnDefs,
		    createdRow: function( nRow, aData, iDataIndex ) {
	        	// Update name in first column to link
	        	var name=$('td:eq(0)', nRow).html();
	        	if(name == ''){name = "No Name"};
	        	var sn=$('td:eq(1)', nRow).html();
	        	var link = mr.getClientDetailLink(name, sn);
	        	$('td:eq(0)', nRow).html(link);
                
            var agent_status = $('td:eq(5)', nRow).html();
            $('td:eq(5)', nRow).html(function(){
                if( agent_status == 'NOT RUNNING'){
                    return '<span class="label label-warning">'+i18n.t('insight_idr.not_running')+'</span>';
								} else if( agent_status == 'RUNNING'){
										return '<span class="label label-success">'+i18n.t('insight_idr.running')+'</span>';
								}
            });
	        }
    });
  });
</script>

<?php $this->view('partials/foot'); ?>
