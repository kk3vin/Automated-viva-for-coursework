<?php
class block_viva_manage extends block_base {
    public function init() {
        $this->title = get_string('viva_manage', 'block_viva_manage');
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }
        $courseid = $this->page->course->id;

        $url = new \moodle_url('/local/aot/manage.php', ['courseid' => $courseid]);

        $this->content         =  new stdClass;
        $this->content->footer = html_writer::div(
            html_writer::link($url, get_string('set', 'block_viva_manage')),
            'gotovivamanage'
        );
        return $this->content;
    }
}