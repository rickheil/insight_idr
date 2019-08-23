<?php
/**
 * Insight IDR module class
 *
 * @package munkireport
 * @author rickheil
 **/

class Insight_idr_controller extends Module_controller
{

    /*** Protect methods with auth! ****/
    public function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }

    /**
     * Default method
     *
     * @author rickheil
     **/
    public function index()
    {
        echo "You've loaded the insight_idr module!";
    }

    /**
     * Get data for specific serial number
     *
     * @param string $serial serial number
     **/
    public function get_idr_data($serial = '')
    {
        $out = array();
        if (! $this->authorized()) {
            $out['error'] = 'Not authorized';
        } else {
            $prm = new Insight_idr_model;
            foreach ($prm->retrieve_records($serial) as $insight_idr) {
                $out[] = $insight_idr->rs;
            }
        }

        $obj = new View();
        $obj->view('json', array('msg' => $out));
    }

    /**
     * Get stats on agent status (running or not)
     *
     * @author rickheil
     **/
    public function get_agent_status_stats()
    {
        $obj = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }

        $agent_status_stats = new Insight_idr_model;
        $obj->view('json', array('msg' => $agent_status_stats->get_agent_status_stats()));
    }
}
