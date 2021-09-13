<?php
require_once(__DIR__ . '/../../config.php');
require_once ($CFG->dirroot . '/local/aot/classes/forms/setting.php');
global $DB;

$PAGE->set_url(new moodle_url('/local/aot/setting.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('title', 'local_aot'));

$questionid = optional_param('questionid', null, PARAM_INT);
$courseid = optional_param('courseid', null, PARAM_INT);
$returnurl = new moodle_url('/local/aot/manage.php', array('courseid' => $courseid));

$mform = new setting();
$formdata = array('courseid'=>$courseid);
$mform->set_data($formdata);
if($DB->get_record('viva_setting', array('course_id'=>$courseid))){
    $mform->set_data($DB->get_record('viva_setting', array('course_id'=>$courseid)));
}
if ($mform->is_cancelled()) {
    redirect($returnurl);
}else if ($fromform = $mform->get_data()) {
    if ($fromform->id) {
        $object = new stdClass();
        $object->time_limitation = $fromform->time_limitation;
        $object->course_id = $courseid;
        $object->id = $fromform->id;
        $DB->update_record('viva_setting', $object);
        redirect($returnurl);
    }

    $record_to_insert = new stdClass();
    $record_to_insert->time_limitation = $fromform->time_limitation;
    $record_to_insert->course_id = $courseid;
    $DB->insert_record('viva_setting', $record_to_insert, false);
    redirect($returnurl);
}


echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();