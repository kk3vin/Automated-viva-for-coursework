<?php
require_once(__DIR__ . '/../../config.php');
global $USER;
$PAGE->set_url(new moodle_url('/local/aot/testRead.php'));
$context = context_system::instance();
$PAGE->set_context( $context );
require_login();

$fs = get_file_storage();

$files = $fs->get_area_files($context->id, 'local_filemanager', 'attachment');
echo '<p>List of files:</p>';
echo '<ul>';
foreach ($files as $file) {
    $out = $file->get_filename();
    if ($file->is_directory()) {
        $out = $file->get_filepath();
    } else {
        echo $file->get_content();
        $fileurl = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(),
            $file->get_itemid(), $file->get_filepath(), $file->get_filename());
        $out = html_writer::link($fileurl, $out);
    }
    echo html_writer::tag('li', $out);
}
echo '</ul>';

//if ($file) {
//    send_stored_file($file, 86400,0, true);
//} else {
//    // file doesn't exist - do something
//    echo 'failed';
//}


