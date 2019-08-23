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
                <th data-i18n="idr.client_id" data-colname='insight_idr.client_id'
                <th data-i18n="idr.agent_version" data-colname='insight_idr.agent_version'></th>
                <th data-i18n="idr.agent_status" data-colname='insight_idr.agent_status'></th>
                <th data-i18n="idr.collector_list" data-colname='insight_idr.sorted_collectors_list'></th>
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
