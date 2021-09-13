<?php
defined('MOODLE_INTERNAL') || die();

use local_aot\manager;
require_once("$CFG->libdir/externallib.php");
require_once($CFG->dirroot . '/files/externallib.php');
require_once(__DIR__ . '/../../config.php');

class local_aot_external extends external_api{
    public static function get_question_parameters() {
        return new external_function_parameters(
            ['courseid' => new external_value(PARAM_INT, 'id of course')],
        );
    }

    public static function get_question_returns() {
        return new external_multiple_structure(
            new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'ID'),
                'question'=> new external_value(PARAM_TEXT, 'the content of question'),
                'course_id'=>new external_value(PARAM_INT, 'course_id'),
            )
        ));
    }

    public static function get_question($courseid):array
    {
        $params = self::validate_parameters(self::get_question_parameters(), array('courseid'=>$courseid));

        $manager = new manager();

        return $manager->get_questions($courseid);

    }


    public static function upload_video_parameters() {
        return new external_function_parameters(
            ['videofile' => new external_value(PARAM_RAW, 'recorded video file'),
                'userid'=>new external_value(PARAM_INT, 'user id'),
                'fileareaname'=>new external_value(PARAM_TEXT, 'file area name'),
                'draftcontextid'=>new external_value(PARAM_INT, 'draft context id'),
                'realcontextid'=>new external_value(PARAM_INT, 'real context id'),
                'courseid'=>new external_value(PARAM_INT, 'course id'),
                'filename'=>new external_value(PARAM_TEXT, 'file name')],
        );
    }

    public static function upload_video_returns() {
        return new external_value(PARAM_BOOL, 'True if the video was successfully uploaded.');
    }


    public static function upload_video($videofile, $userid, $fileareaname, $draftcontextid, $realcontextid,$courseid, $fileName):string
    {
        $params = self::validate_parameters(self::upload_video_parameters(), array('videofile'=>$videofile, 'userid'=>$userid,
            'fileareaname'=>$fileareaname, 'draftcontextid'=>$draftcontextid, 'realcontextid'=>$realcontextid,'courseid'=>$courseid, 'filename'=>$fileName));
        $draftitemid = file_get_unused_draft_itemid();
        $draft_context_id =$draftcontextid;
        $real_context_id = $realcontextid;
        $component = "user";
        $filearea = "draft";
        $itemid = $draftitemid;
        $filepath = "/";
        $filename = $fileName;
        $filecontent=$videofile;
        $contextlevel = 'user';
        $instanceid = $userid;
        $fileinfo = core_files_external::upload($draft_context_id, $component, $filearea, $itemid, $filepath, $filename, $filecontent,
            $contextlevel, $instanceid);
        file_save_draft_area_files($itemid, $real_context_id, 'local_aot', $fileareaname, $userid);

        return true;

    }


    public static function delete_question_parameters() {
        return new external_function_parameters(
            ['questionid' => new external_value(PARAM_INT, 'id of question')],
        );
    }

    public static function delete_question($questionid): string {
        $params = self::validate_parameters(self::delete_question_parameters(), array('questionid'=>$questionid));

        $manager = new manager();
        return $manager->delete_question($questionid);
    }

    public static function delete_question_returns() {
        return new external_value(PARAM_BOOL, 'True if the question was successfully deleted.');
    }

    public static function upload_snapshot_parameters() {
        return new external_function_parameters(
                ['imgfile' => new external_value(PARAM_RAW, 'image file'),
                'userid'=>new external_value(PARAM_INT, 'user id'),
                'fileareaname'=>new external_value(PARAM_TEXT, 'file area name'),
                'draftcontextid'=>new external_value(PARAM_INT, 'draft context id'),
                'realcontextid'=>new external_value(PARAM_INT, 'real context id'),
                'courseid'=>new external_value(PARAM_INT, 'course id'),
                'filename'=>new external_value(PARAM_TEXT, 'file name')],
        );
    }

    public static function upload_snapshot($imgfile, $userid, $fileareaname, $draftcontextid, $realcontextid,$courseid, $fileName): string {
        $params = self::validate_parameters(self::upload_snapshot_parameters(), array('imgfile'=>$imgfile, 'userid'=>$userid,
            'fileareaname'=>$fileareaname, 'draftcontextid'=>$draftcontextid, 'realcontextid'=>$realcontextid,
            'courseid'=>$courseid, 'filename'=>$fileName));

            $draftitemid = file_get_unused_draft_itemid();
            $itemid = file_get_unused_draft_itemid();
            $draft_context_id =$draftcontextid;
            $real_context_id = $realcontextid;
            $component = "user";
            $filearea = "draft";
            $filepath = "/";
            $filename = $fileName;
            $filecontent=$imgfile;
            $contextlevel = 'user';
            $instanceid = $userid;
            $fileinfo = core_files_external::upload($draft_context_id, $component, $filearea, $draftitemid, $filepath, $filename, $filecontent,
                $contextlevel, $instanceid);
            file_save_draft_area_files($draftitemid, $real_context_id, 'local_aot', $fileareaname, $itemid);

            return true;

    }

    public static function upload_snapshot_returns() {
        return new external_value(PARAM_BOOL, 'True if the image was successfully uploaded.');
    }

}
