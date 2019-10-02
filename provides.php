<?php

return array(
    'listings' => array(
        'insight_idr' => array('view' => 'insight_idr_listing', 'i18n' => 'insight_idr.title'),
    ),
    'widgets' => array(
        'idr_agent_version' => array('view' => 'insight_idr_agent_version_widget'),
        'idr_agent_status' => array('view' => 'insight_idr_agent_status_widget'),
        'idr_collectors' => array('view' => 'insight_idr_collectors_widget'),
    ),
    'reports' => array(
        'insight_idr' => array('view' => 'insight_idr_report', 'i18n' => 'insight_idr.insight_idr_report')
    ),
    'detail_widgets' => array(
        'ard' => ['view' => 'insight_idr_detail_widget']
    ),
);
