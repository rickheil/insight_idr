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

    /**
     * Get stats on agent versions
     *
     * @author rickheil
     **/
    public function get_agent_version_stats()
    {
        if(! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authenticated')));
            return;
        }
        
        $agent_version_stats = new Insight_idr_model();
        $sql = "SELECT count(1) as count, agent_version
                FROM insight_idr
                LEFT JOIN reportdata USING (serial_number)
                ".get_machine_group_filter()."
                GROUP BY agent_version
                ORDER BY agent_version DESC";

        $out = [];
        foreach ($agent_version_stats->query($sql) as $obj) {
            $obj->agent_version = $obj->agent_version ? $obj->agent_version : '0';
            $out[] = array('label' => $obj->agent_version, 'count' => intval($obj->count));
        }

        $obj = new View();
        $obj->view('json', array('msg' => $out));
    }
}
