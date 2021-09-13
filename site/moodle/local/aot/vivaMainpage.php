<?php
require_once(__DIR__ . '/../../config.php');
global $DB, $USER;

$PAGE->set_url(new moodle_url('/local/aot/vivaMainpage.php'));
$PAGE->set_title(get_string('title', 'local_aot'));
$PAGE->requires->js_call_amd('local_aot/retrieveQuestion');
$PAGE->requires->js_call_amd('local_aot/recordAudio');
$PAGE->requires->js_call_amd('local_aot/snapshot');

//$context = \context_system::instance();
$courseid = optional_param('courseid', null, PARAM_INT);
$context = context_course::instance($courseid);
$PAGE->set_context($context);
$userid = $USER->id;
$username=$USER->username;
$filearea = 'course' . $courseid;
$draftcontextid = context_user::instance($USER->id)->id;
$realcontextid = $context->id;
$record_to_insert = new stdClass();
$record_to_insert->student_id = $userid;
$record_to_insert->num_attempt = 1;
$record_to_insert->course_id = $courseid;
$DB->insert_record('viva_attempt', $record_to_insert, false);
$time_limitation = $DB->get_record('viva_setting', array('course_id'=>$courseid))->time_limitation;
echo $OUTPUT->header();
$templatecontext = (object)[
    'courseid' => $courseid,
    'userid'=>$userid,'filearea'=>$filearea, 'draftcontextid'=>$draftcontextid,
    'realcontextid'=>$realcontextid,'username'=>$username,
    'courseurl'=>new moodle_url('/course/view.php'),
    'time_limitation'=>$time_limitation,
];

echo $OUTPUT->render_from_template('local_aot/vivaMainpage', $templatecontext);
echo $OUTPUT->footer();
