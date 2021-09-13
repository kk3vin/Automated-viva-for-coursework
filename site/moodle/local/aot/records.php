<?php
require_once(__DIR__ . '/../../config.php');

global $DB;
use local_aot\audiourl;
require_admin();
$PAGE->set_url('/local/aot/records.php');
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('title', 'local_aot'));
$PAGE->set_heading("All available records");
//$videos = $DB->get_records('files', array('component'=>'local_aot'), '', 'contextid,itemid');
$courseid = optional_param('courseid', null, PARAM_INT);
$context = context_course::instance($courseid);
$PAGE->set_context($context);
$contextid=$context->id;

$file_area = 'course'.$courseid;
$fs = get_file_storage();
$audio_files = $fs->get_area_files($contextid, 'local_aot', $file_area);
$availabledata = [];
foreach ($audio_files as $file) {
    if($file->is_directory() == false) {
        $obj = new stdClass();
        $fileurl = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(),
            $file->get_itemid(), $file->get_filepath(), $file->get_filename());
        $obj->url = (string)$fileurl;
        $username = explode('.', $file->get_filename())[0];
        $userid = array_values($DB->get_records('user', ['username'=>$username], '', 'id'))[0]->id;
//        $obj->student_name = $username;

        //------
        $firstname = array_values($DB->get_records('user', ['username'=>$username], '', 'firstname'))[0]->firstname;
        $lastname = array_values($DB->get_records('user', ['username'=>$username], '', 'lastname'))[0]->lastname;
        $name = $firstname . ' ' . $lastname;
        $obj->student_name = $name;
        //---------

        $obj->authentication = 'Cheat';
        array_push($availabledata, $obj);
        $authentication_record = $DB->get_record('viva_authentication', ['student_id'=>$userid, 'course_id'=>$courseid], 'cheat');
        if($authentication_record){
            $obj->authentication = $authentication_record->cheat;
        }else {
            $correct_file_name = $username.'_'.$courseid.'.jpg';
            $all_item = array_values($DB->get_records('files', ['filename' => $correct_file_name, 'component' => 'local_aot'], '', 'itemid'));
            foreach ($all_item as $item) {
                $item_id = $item->itemid;
                $files = $fs->get_area_files($contextid, 'local_aot', 'profile_img', $item_id);
                foreach ($files as $file) {
                    if ($file->is_directory() == false) {
                        $fileurl = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(),
                            $file->get_itemid(), $file->get_filepath(), $file->get_filename());
                    }
                }
                $unknow_pics_url = (string)$fileurl;
                $known_pics_url = $CFG->wwwroot . '/user/pix.php' . '/' . $userid . '/f1.jpg';
                $command_script = '/Users/wenkaizhang/opt/anaconda3/bin/python3 ./facial_authentication.py ' . $known_pics_url . ' ' . $unknow_pics_url;
                $command = escapeshellcmd($command_script);
                $output = shell_exec($command);
                if (strlen($output) == 5) {
                    $obj->authentication = 'In person';
                }
            }
            $current_authtication = $obj->authentication;
            $record_to_insert = new stdClass();
            $record_to_insert->student_id = $userid;
            $record_to_insert->cheat = $current_authtication;
            $record_to_insert->course_id = $courseid;
            $DB->insert_record('viva_authentication', $record_to_insert, false);
        }
    }
}

//$snapshot_files = $fs->get_area_files($contextid, 'local_aot', 'profile_img');
//foreach ($snapshot_files as $file) {
//    if($file->is_directory() == false) {
//        $obj = new stdClass();
//        $fileurl = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(),
//            $file->get_itemid(), $file->get_filepath(), $file->get_filename());
//        $obj->url = (string)$fileurl;
//        $obj->student_name = explode('.', $file->get_filename())[0];
//        array_push($availableurl, $obj);
//
//    }
//}


echo $OUTPUT->header();
$templatecontext = (object)[
    'files'=>array_values($availabledata),
    'manageurl'=>new moodle_url('/local/aot/manage.php'),
    'courseid' => $courseid,
];
echo $OUTPUT->render_from_template('local_aot/records', $templatecontext);
echo $OUTPUT->footer();