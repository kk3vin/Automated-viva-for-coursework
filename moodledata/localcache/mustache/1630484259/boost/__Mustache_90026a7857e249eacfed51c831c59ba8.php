<?php

class __Mustache_90026a7857e249eacfed51c831c59ba8 extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . '<style>
';
        $buffer .= $indent . '    #vivaProcess {
';
        $buffer .= $indent . '        width: 100%;
';
        $buffer .= $indent . '        background-color: #ddd;
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    #timeBar {
';
        $buffer .= $indent . '        width: 0%;
';
        $buffer .= $indent . '        height: 15px;
';
        $buffer .= $indent . '        background-color: #04AA6D;
';
        $buffer .= $indent . '        text-align: center;
';
        $buffer .= $indent . '        line-height: 30px;
';
        $buffer .= $indent . '        color: white;
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '</style>
';
        $buffer .= $indent . '<div id="vivaProcess">
';
        $buffer .= $indent . '    <div id="timeBar"></div>
';
        $buffer .= $indent . '</div>
';
        $buffer .= $indent . '<div class="question_block">
';
        $buffer .= $indent . '<!--    <p class="record_status" style="text-align: center;">Get ready of oral exam</p>-->
';
        $buffer .= $indent . '<!--    <hr>-->
';
        $buffer .= $indent . '    <article class="question" style="border:1px solid white;height:100px;margin:0 auto;background-color:white;">
';
        $buffer .= $indent . '        <p class="question_to_display" style="text-align: center;font-size: xx-large"></p>
';
        $buffer .= $indent . '    </article>
';
        $buffer .= $indent . '    <hr>
';
        $buffer .= $indent . '<!--    <article class="camera" style="border:1px solid white;width:300px;height:300px;margin:0 auto;background-color:white;">-->
';
        $buffer .= $indent . '        <section class="experiment" style="width:250px; height:200px;border:1px solid gray; margin:20px auto;">
';
        $buffer .= $indent . '            <div id="videos-container" class = \'videos-container-class\' style="width:250px; height:200px;">
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <canvas hidden class="snapshot_canvas" width="250px" height="200px"></canvas>
';
        $buffer .= $indent . '        </section>
';
        $buffer .= $indent . '<!--    </article>-->
';
        $buffer .= $indent . '</div>
';
        $buffer .= $indent . '<hr>
';
        $buffer .= $indent . '<!--<input type="button" class="go_previous previous_question_button pre_button_';
        $value = $this->resolveValue($context->find('courseid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= ' btn btn-primary" value="Previous Question">-->
';
        $buffer .= $indent . '<input type="button" class="record_button start_recording_userid_';
        $value = $this->resolveValue($context->find('userid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= ' btn btn-warning" value="Start Recording">
';
        $buffer .= $indent . '<input type="button" class="go_next next_question_button next_button_';
        $value = $this->resolveValue($context->find('courseid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= ' btn btn-primary" value="Next Question">
';
        $buffer .= $indent . '<input type="button" class="end_button save_record_userid_';
        $value = $this->resolveValue($context->find('userid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= ' save_record_filearea_';
        $value = $this->resolveValue($context->find('filearea'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '
';
        $buffer .= $indent . 'save_record_draftcontextid_';
        $value = $this->resolveValue($context->find('draftcontextid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= ' save_record_realcontextid_';
        $value = $this->resolveValue($context->find('realcontextid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '
';
        $buffer .= $indent . 'save_record_username_';
        $value = $this->resolveValue($context->find('username'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= ' save_record_courseurl_';
        $value = $this->resolveValue($context->find('courseurl'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '?id=';
        $value = $this->resolveValue($context->find('courseid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= ' save_record_timeLimitation_';
        $value = $this->resolveValue($context->find('time_limitation'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '
';
        $buffer .= $indent . 'btn btn-danger" value="Finish the oral exam">
';
        $buffer .= $indent . '<!--<input type="button" class="take_photo_btn btn btn-warning" value="Take photo">-->
';
        $buffer .= $indent . '<!--<img src="http://localhost:8888/moodle/user/pix.php/2/f1.jpg">-->
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '
';

        return $buffer;
    }
}
