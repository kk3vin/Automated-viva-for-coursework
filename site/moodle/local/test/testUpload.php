<?php
require_once(__DIR__ . '/../../config.php');


global $USER;
require_once($CFG->dirroot . '/files/externallib.php');
$imagepath = 'msr-2021-07-27T15-37-06-230Z.mp4';
$img_file = file_get_contents($imagepath);
$context = context_user::instance($USER->id);
$contextid = $context->id;
$component = "user";
$filearea = "draft";
$itemid = 20;
$filepath = "/";
$filename = "testname.mp4";
$filecontent = base64_encode($img_file);
$contextlevel = null;
$instanceid = null;
$fileinfo = core_files_external::upload($contextid, $component, $filearea, $itemid, $filepath, $filename, $filecontent,
    'user', $USER->id);

$fs = get_file_storage();
$files = $fs->get_area_files($context->id, 'local_test', 'test');

echo '<p>List of files:</p>';
echo '<ul>';
foreach ($files as $file) {
    $out = $file->get_filename();
    if ($file->is_directory()) {
        $out = $file->get_filepath();
    } else {
        $fileurl = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(),
            $file->get_itemid(), $file->get_filepath(), $file->get_filename());
        $out = html_writer::link($fileurl, $out);
    }
    echo html_writer::tag('li', $out);
}
echo '</ul>';