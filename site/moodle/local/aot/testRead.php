<?php
require_once(__DIR__ . '/../../config.php');
global $DB;

$PAGE->set_url(new moodle_url('/local/aot/testRead.php'));
$fs = get_file_storage();
$files = $fs->get_area_files(247, 'local_aot', 'profile_img', 198720219);


//$test = $DB->get_records('files', array('component'=>'local_aot'), '', 'contextid,itemid');
echo '<p>List of files:</p>';
echo '<ul>';
foreach ($files as $file) {
    $out = $file->get_filename();
    if ($file->is_directory()) {
        $out = $file->get_filepath();
    } else {
            $fileurl = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(),
                $file->get_itemid(), $file->get_filepath(), $file->get_filename());
            echo $fileurl;
            $out = html_writer::link($fileurl, $out);

    }
    echo html_writer::tag('li', $out);
}
//$t = array_values($test);
//var_dump($test);
echo '</ul>';