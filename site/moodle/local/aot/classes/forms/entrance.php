<?php

require_once("$CFG->libdir/formslib.php");

class entrance_form extends moodleform {

    function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!
        $mform->addElement('advcheckbox', 'confirm',
            get_string('confirm', 'local_aot'),
            null, array('group' => 1), array(0, 1));

        $mform->addElement('hidden', 'courseid');
        $mform->setType('courseid', PARAM_INT);

        $this->add_action_buttons(false);
    }

    function validation($data, $files)
    {
        $errors = array();

        if($data['confirm']==0){
            $errors['confirm'] = 'Before starting the oral exam, you must agree to the above agreement!';
        }
        return $errors;
    }
}