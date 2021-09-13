<?php
namespace local_aot;
use stdClass;
use dml_exception;
class manager {


    public function create_question(string $question_text, int $courseid): bool
    {
        global $DB;
        $record_to_insert = new stdClass();
        $record_to_insert->question = $question_text;
        $record_to_insert->course_id = $courseid;
        try {
            return $DB->insert_record('viva_questions', $record_to_insert, false);
        } catch (dml_exception $e) {
            return false;
        }
    }

    public function get_question(int $questionid)
    {
        global $DB;
        return $DB->get_record('viva_questions', array('id' => $questionid));
    }

    public function get_questions(int $courseid){
        global $DB;
        return $DB->get_records('viva_questions', array('course_id'=>$courseid));
    }


    public function update_question(int $questionid, string $question_text, int $courseid): bool
    {
        global $DB;
        $object = new stdClass();
        $object->question = $question_text;
        $object->course_id = $courseid;
        $object->id = $questionid;
        return $DB->update_record('viva_questions', $object);
    }


    public function delete_question($questionid)
    {
        global $DB;
        $deletedQuestion = $DB->delete_records('viva_questions', ['id' => $questionid]);
        if ($deletedQuestion == false) {
            return false;
        }
        return true;
    }
}