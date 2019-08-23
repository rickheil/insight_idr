#!/usr/bin/python

import json
import plistlib
import os
import subprocess
import sys

def get_agent_version():
    '''Shells out to the agent to determine current version installed.'''
    cmd = ['/opt/rapid7/ir_agent/components/insight_agent/insight_agent', '-v']
    proc = subprocess.Popen(cmd, shell=False, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    (output, error) = proc.communicate()

    result = output.splitlines()
    for line in result:
        if "Semantic" in line:
            return line[18:]


def get_common_json():
    '''Retrieves the common json to pass back to MR'''
    return json.load(open("/opt/rapid7/ir_agent/components/bootstrap/common/bootstrap.cfg"))


def get_component_states():
    '''Retrieves component states json to pass back to MR'''
    return json.load(open("/opt/rapid7/ir_agent/components/bootstrap/common/components.cfg"))


def list_collectors(common_json):
    collectors = ""
    for item in common_json['SortedCollectorsList']:
        collectors = collectors + item['Collector'] + " "
    return collectors.rstrip()


def main():
    '''Gets data and assembles a plist for upload'''
    # Create cache dir if it does not exist
    cachedir = '%s/cache' % os.path.dirname(os.path.realpath(__file__))
    if not os.path.exists(cachedir):
        os.makedirs(cachedir)

    # Skip on manual munki check
    if len(sys.argv) > 1:
        if sys.argv[1] == 'manualcheck':
            print "Manual check: skipping"
            exit(0)

    common_json = get_common_json()
    component_states = get_component_states()

    result = {}
    result.update({'client_id': common_json['Client-ID']})
    result.update({'sorted_collectors_list': list_collectors(common_json)})
    result.update({'agent_version': get_agent_version()})
    result.update({'agent_status': component_states['Component-States']['insight_agent']})

    # Write results of checks to cache file
    output_plist = os.path.join(cachedir, "insight_idr.plist")
    plistlib.writePlist(result, output_plist)


if __name__ == "__main__":
    main()
