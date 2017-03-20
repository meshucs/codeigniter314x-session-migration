<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_BN_update extends CI_Migration

{

    public function up()

    {

        $schema = array(

            // add sessions handling

            'sessions' => array(
                'fields' => array(
                    'id' => array('type' => 'VARCHAR', 'constraint' => 128, 'null' => FALSE, 'auto_increment' => FALSE),
                    'ip_address' => array('type' => 'VARCHAR', 'constraint' => 45, 'null' => FALSE),
                    'timestamp' => array('type' => 'INT', 'constraint' => 10, 'null' => FALSE, 'unsigned' => FALSE, 'default' => 0),
                    'data' => array('type' => 'BLOB', 'null' => FALSE)
                ),
                'keys' => ['ip_address' => TRUE, 'id' => TRUE]
            ),
        );

        foreach ($schema as $s => $i) {
            $this->dbforge->add_field($i['fields']);


            if (count($i['keys']) > 0) {
                foreach ($i['keys'] as $f => $k) {
                    $this->dbforge->add_key($f, isset($k) && $k == TRUE
                        ? TRUE : FALSE);
                }
            }

            $this->dbforge->create_table($s, TRUE);
        }

        return true;

    }

    public function down() {

        $this->dbforge->drop_table('sessions', TRUE);
    }
    
}