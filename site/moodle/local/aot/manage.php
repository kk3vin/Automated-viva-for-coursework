<?php
require_once(__DIR__ . '/../../config.php');

global $DB;

require_admin();
$PAGE->set_url('/local/aot/manage.php');
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('title', 'local_aot'));
$PAGE->set_heading("Set the oral exam questions");
$courseid = optional_param('courseid', null, PARAM_INT);
$PAGE->requires->js_call_amd('local_aot/deleteQuestion');

$question = $DB->get_records('viva_questions', array('course_id'=>$courseid), 'id');


echo $OUTPUT->header();
$templatecontext = (object)[
    'questions' => array_values($question),
    'editurl' => new moodle_url('/local/aot/edit.php'),
    'settingurl'=>new moodle_url('/local/aot/setting.php'),
    'courseid' => $courseid,
    'courseurl'=>new moodle_url('/course/view.php'),
    'viewrecordurl'=> new moodle_url('/local/aot/records.php'),
];

echo $OUTPUT->render_from_template('local_aot/manage', $templatecontext);

echo $OUTPUT->footer();