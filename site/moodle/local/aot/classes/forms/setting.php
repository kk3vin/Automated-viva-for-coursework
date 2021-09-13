<?php

require_once("$CFG->libdir/formslib.php");

class setting extends moodleform {

    function definition() {

        $mform = $this->_form; // Don't forget the underscore!
        $mform->addElement('text', 'time_limitation', 'Time Limitation (minute)', 'maxlength="2" size="25" ');
        $mform->setType('time_limitation', PARAM_INT);
        // Set default value by using a passed parameter
        $mform->setDefault('time_limitation','Please the time limitation...');


        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('hidden', 'courseid');
        $mform->setType('courseid', PARAM_INT);


        $this->add_action_buttons();
    }
}