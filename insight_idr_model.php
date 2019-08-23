<?php

use CFPropertyList\CFPropertyList;

class Insight_idr_model extends \Model
{
    public function __construct($serial = '')
    {
        parent::__construct('id', 'insight_idr'); //primary key, table name
        $this->rs['id'] = '';
        $this->rs['serial_number'] = $serial; //$this->rt['serial_number'] = 'VARCHAR(255) UNIQUE';
        $this->rs['client_id'] = '';
        $this->rs['sorted_collectors_list'] = '';
        $this->rs['agent_version'] = '';
        $this->rs['agent_status'] = '';

        // Add indexes
        $this->idx[] = array('serial_number');
        $this->idx[] = array('client_id');
        $this->idx[] = array('sorted_collectors_list');
        $this->idx[] = array('agent_version');
        $this->idx[] = array('agent_status');

        // Schema version, increment when creating a db migration
        $this->schema_version = 1;

        if ($serial) {
            $this->retrieve_record($serial);
        }

        $this->serial = $serial;
    }

    // ------------------------------------------------------------------------

    /**
     * Process data sent by postflight
     *
     * @param string data
     *
     **/
    public function process($data)
    {
        $parser = new CFPropertyList();
        $parser->parse($data);

        $plist = $parser->toArray();
        foreach (array('client_id', 'sorted_collectors_list', 'agent_version', 'agent_status') as $item) {
            if (isset($plist[$item])) {
                $this->$item = $plist[$item];
            } else {
                $this->$item = '';
            }
        }
        $this->save();
    }

    public function get_agent_status_stats()
    {
        $sql = "SELECT COUNT(CASE WHEN agent_status = 'RUNNING' THEN 1 END) AS agent_running,
                        COUNT(CASE WHEN agent_status != 'RUNNING' THEN 1 END) AS agent_not_running
                        FROM insight_idr
                        LEFT JOIN reportdata USING (serial_number)
                        ".get_machine_group_filter();
        return current($this->query($sql));
    }

    public function get_collector_list_stats()
    {
        // TODO - this function will return the count of how many times each collector is configured to a device
    }

}
