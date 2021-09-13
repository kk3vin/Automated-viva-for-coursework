<?php

class __Mustache_a267807c6cf3d0afaa95ebb1a39f8977 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '
';
        $buffer .= $indent . '<head>
';
        $buffer .= $indent . '    <title>Automated VIVA for Coursework</title>
';
        $buffer .= $indent . '</head>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!--    <div class="card mt-2 mb-2">-->
';
        $buffer .= $indent . '<!--        <div class="card-body">-->
';
        $buffer .= $indent . '<!--            <audio controls>-->
';
        $buffer .= $indent . '<!--                <source src=';
        $value = $this->resolveValue($context->find('url'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= ' type="audio/mp3">-->
';
        $buffer .= $indent . '<!--            </audio>-->
';
        $buffer .= $indent . '<!--            <p>';
        $value = $this->resolveValue($context->find('student_name'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '</p>-->
';
        $buffer .= $indent . '<!--        </div>-->
';
        $buffer .= $indent . '<!--    </div>-->
';
        $buffer .= $indent . '<style>
';
        $buffer .= $indent . '    table, th, td {
';
        $buffer .= $indent . '        border: 1px solid black;
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '    td {
';
        $buffer .= $indent . '        text-align: center;
';
        $buffer .= $indent . '        padding: 15px;
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '</style>
';
        $buffer .= $indent . '<table style="width:100%">
';
        $buffer .= $indent . '    <tr>
';
        $buffer .= $indent . '        <th>Record Audio</th>
';
        $buffer .= $indent . '        <th>Student Name</th>
';
        $buffer .= $indent . '        <th>Authentication</th>
';
        $buffer .= $indent . '    </tr>
';
        // 'files' section
        $value = $context->find('files');
        $buffer .= $this->sectionA7ad0666727396d3843d47493b623443($context, $indent, $value);
        $buffer .= $indent . '</table>
';
        $buffer .= $indent . '<hr>
';
        $buffer .= $indent . '<input type="button" class="btn btn-primary" value="Cancel" onclick="location.href=\'';
        $value = $this->resolveValue($context->find('manageurl'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '?courseid=';
        $value = $this->resolveValue($context->find('courseid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '\'">
';
        $buffer .= $indent . '
';

        return $buffer;
    }

    private function sectionA7ad0666727396d3843d47493b623443(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <tr>
        <td><audio controls><source src={{url}}></audio></td>
        <td>{{student_name}}</td>
        <td>{{authentication}}</td>
    </tr>
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
                
                $buffer .= $indent . '    <tr>
';
                $buffer .= $indent . '        <td><audio controls><source src=';
                $value = $this->resolveValue($context->find('url'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '></audio></td>
';
                $buffer .= $indent . '        <td>';
                $value = $this->resolveValue($context->find('student_name'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</td>
';
                $buffer .= $indent . '        <td>';
                $value = $this->resolveValue($context->find('authentication'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</td>
';
                $buffer .= $indent . '    </tr>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
