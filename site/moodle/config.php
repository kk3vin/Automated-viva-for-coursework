<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'moodle';
$CFG->dbuser    = 'moodleuser';
$CFG->dbpass    = 'yourpassword';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => '8889',
  'dbsocket' => '/Applications/MAMP/tmp/mysql/mysql.sock',
  'dbcollation' => 'utf8mb4_unicode_ci',
);
$CFG->cachejs = false; // NOT FOR PRODUCTION SERVERS!
// Force a debugging mode regardless the settings in the site administration
@error_reporting(E_ALL | E_STRICT); // NOT FOR PRODUCTION SERVERS!
$CFG->debug = (E_ALL | E_STRICT);   // === DEBUG_DEVELOPER - NOT FOR PRODUCTION SERVERS!

$CFG->wwwroot   = 'http://localhost:8888/moodle';
$CFG->dataroot  = '/Users/wenkaizhang/new moodle project/moodledata';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

require_once(__DIR__ . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
