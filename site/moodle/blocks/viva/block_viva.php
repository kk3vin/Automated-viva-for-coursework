<?php
class block_viva extends block_base {
    public function init() {
        $this->title = get_string('viva', 'block_viva');
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }
        $courseid = $this->page->course->id;

        $url = new \moodle_url('/local/aot/entrance.php', ['courseid' => $courseid]);

        $this->content         =  new stdClass;
        $this->content->text   = 'Take the oral exam!';
        $this->content->footer = html_writer::div(
            html_writer::link($url, get_string('start', 'block_viva')),
            'gotoviva'
        );
        return $this->content;
    }
}

