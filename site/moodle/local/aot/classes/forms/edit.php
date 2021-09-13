<?php

require_once("$CFG->libdir/formslib.php");

class edit extends moodleform {

    function definition() {

        $mform = $this->_form; // Don't forget the underscore!
        $mform->addElement('text', 'question', 'Question', 'maxlength="100" size="25" ');
        $mform->setType('question', PARAM_NOTAGS);
        // Set default value by using a passed parameter
        $mform->setDefault('question','Please enter question...');


        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('hidden', 'courseid');
        $mform->setType('courseid', PARAM_INT);

        $this->add_action_buttons();
    }
}