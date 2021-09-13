<?php
require_once(__DIR__ . '/../../config.php');
require_once ($CFG->dirroot . '/local/aot/classes/forms/edit.php');
use local_aot\manager;
global $DB;

$PAGE->set_url(new moodle_url('/local/aot/edit.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('title', 'local_aot'));

$questionid = optional_param('questionid', null, PARAM_INT);
$courseid = optional_param('courseid', null, PARAM_INT);
$returnurl = new moodle_url('/local/aot/manage.php', array('courseid' => $courseid));

$mform = new edit();
$formdata = array('courseid'=>$courseid);
$mform->set_data($formdata);

if ($mform->is_cancelled()) {
    redirect($returnurl);

} else if ($fromform = $mform->get_data()) {
    $manager = new manager();

    if ($fromform->id) {
        $manager->update_question($fromform->id, $fromform->question, $fromform->courseid);
        redirect($returnurl);
    }

    $manager->create_question($fromform->question, $fromform->courseid);

    redirect($returnurl);
}

if ($questionid) {
    global $DB;
    $manager = new manager();
    $question = $manager->get_question($questionid);
    if (!$question) {
        throw new invalid_parameter_exception('Message not found');
    }
    $mform->set_data($question);
}

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();