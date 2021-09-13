<?php
$functions = array(

    'local_aot_get_question' => array(
        'classname'     => 'local_aot_external',
        'methodname'    => 'get_question',
        'classpath'     => 'local/aot/externallib.php',
        'description'   => 'Get the next question for oral exam.',
        'type'          => 'write',
        'ajax'          =>true,
        'capabilities'  => '',
    ),

    'local_aot_upload_video' => array(
        'classname'     => 'local_aot_external',
        'methodname'    => 'upload_video',
        'classpath'     => 'local/aot/externallib.php',
        'description'   => 'Upload video into local file system.',
        'type'          => 'write',
        'ajax'          => true,
        'capabilities'  => '',
    ),

    'local_aot_delete_question' => array(
        'classname'     => 'local_aot_external',
        'methodname'    => 'delete_question',
        'classpath'     => 'local/aot/externallib.php',
        'description'   => 'Delete the question',
        'type'          => 'write',
        'ajax'          =>true,
        'capabilities'  => '',
    ),

    'local_aot_upload_snapshot' => array(
        'classname'     => 'local_aot_external',
        'methodname'    => 'upload_snapshot',
        'classpath'     => 'local/aot/externallib.php',
        'description'   => 'Upload snapshot',
        'type'          => 'write',
        'ajax'          =>true,
        'capabilities'  => '',
    ),

);