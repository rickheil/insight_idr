<?php $this->view('partials/head', array(
        "scripts" => array(
                "clients/client_list.js"
        )
)); ?>

<div class="container">

        <div class="row">

                <?php $widget->view($this, 'idr_agent_version'); ?>
                <?php $widget->view($this, 'idr_agent_status'); ?>


        </div> <!-- /row -->
        <div class="row">

                <?php $widget->view($this, 'idr_collectors'); ?>

        </div> <!-- /row -->

</div>  <!-- /container -->

<script src="<?php echo conf('subdirectory'); ?>assets/js/munkireport.autoupdate.js"></script>

<?php $this->view('partials/foot'); ?>
