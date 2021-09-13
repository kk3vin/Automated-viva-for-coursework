<?php

class __Mustache_054150ba23b484711dff4cc627e4a253 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<h1>List of questions</h1>
';
        // 'questions' section
        $value = $context->find('questions');
        $buffer .= $this->section9141603117bf83038c84a290af160e4f($context, $indent, $value);
        $buffer .= $indent . '<hr>
';
        $buffer .= $indent . '<input type="button" class="btn btn-primary" value="View available submission" onclick="location.href=\'';
        $value = $this->resolveValue($context->find('viewrecordurl'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '?courseid=';
        $value = $this->resolveValue($context->find('courseid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '\'">
';
        $buffer .= $indent . '<input type="button" class="btn btn-primary" value="Oral exam setting" onclick="location.href=\'';
        $value = $this->resolveValue($context->find('settingurl'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '?courseid=';
        $value = $this->resolveValue($context->find('courseid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '\'">
';
        $buffer .= $indent . '<input type="button" class="btn btn-primary" value="Create question" onclick="location.href=\'';
        $value = $this->resolveValue($context->find('editurl'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '?courseid=';
        $value = $this->resolveValue($context->find('courseid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '\'">
';
        $buffer .= $indent . '<input type="button" class="btn btn-primary" value="Cancel" onclick="location.href=\'';
        $value = $this->resolveValue($context->find('courseurl'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '?id=';
        $value = $this->resolveValue($context->find('courseid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '\'">
';

        return $buffer;
    }

    private function section9141603117bf83038c84a290af160e4f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div class="card mt-2 mb-2">
        <div class="card-body">
            <p>{{question}}</p>
            <input type="button" class="btn edit_question btn-primary" value="Edit question" onclick="location.href=\'{{editurl}}?questionid={{id}}&courseid={{courseid}}\'">
            <input type="button" class="question{{id}} btn btn-danger question_delete_button" value="Delete question">
        </div>
    </div>
';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    <div class="card mt-2 mb-2">
';
                $buffer .= $indent . '        <div class="card-body">
';
                $buffer .= $indent . '            <p>';
                $value = $this->resolveValue($context->find('question'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</p>
';
                $buffer .= $indent . '            <input type="button" class="btn edit_question btn-primary" value="Edit question" onclick="location.href=\'';
                $value = $this->resolveValue($context->find('editurl'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '?questionid=';
                $value = $this->resolveValue($context->find('id'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '&courseid=';
                $value = $this->resolveValue($context->find('courseid'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '\'">
';
                $buffer .= $indent . '            <input type="button" class="question';
                $value = $this->resolveValue($context->find('id'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= ' btn btn-danger question_delete_button" value="Delete question">
';
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
