<?php
require_once(__DIR__ . '/../../config.php');
require_once ($CFG->dirroot . '/local/aot/classes/forms/entrance.php');
global $DB,$USER;
$PAGE->set_url(new moodle_url('/local/aot/entrance.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('title', 'local_aot'));
$courseid = optional_param('courseid', null, PARAM_INT);
$mainpageurl = new moodle_url('/local/aot/vivaMainpage.php', array('courseid' => $courseid));
$reloadurl = new moodle_url('/course/view.php', array('id' => $courseid));
$userid=$USER->id;
$num_attempt_obj = $DB->get_record('viva_attempt', ['student_id'=>$userid, 'course_id'=>$courseid], 'num_attempt');
if($num_attempt_obj){
    $num_attempt = $num_attempt_obj->num_attempt;
}else{
    $num_attempt=0;
}
//$messages = $DB->get_records('local_message', null, 'id');
$mform = new entrance_form();
$formdata = array('courseid'=>$courseid);
$mform->set_data($formdata);

$templatecontext = (object)[

];

$data = $mform->get_data();
if($data->confirm){
    if($num_attempt==0) {
        redirect($mainpageurl);
    }else{
        redirect($reloadurl, 'You have already done this oral exam!', 0, \core\output\notification::NOTIFY_ERROR);
    }
}

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_aot/entrance', $templatecontext);

$mform->display();

echo $OUTPUT->footer();