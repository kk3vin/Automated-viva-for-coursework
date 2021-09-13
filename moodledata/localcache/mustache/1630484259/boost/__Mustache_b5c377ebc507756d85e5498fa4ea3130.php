<?php

class __Mustache_b5c377ebc507756d85e5498fa4ea3130 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div class="list-group">
';
        // 'blocks' section
        $value = $context->find('blocks');
        $buffer .= $this->section1005a69d5837fea6789dad3985dfaf0a($context, $indent, $value);
        // 'blocks' inverted section
        $value = $context->find('blocks');
        if (empty($value)) {
            
            $buffer .= $indent . '    <div class="alert alert-primary" role="alert">
';
            $buffer .= $indent . '        ';
            // 'str' section
            $value = $context->find('str');
            $buffer .= $this->section44db6c94ef832981ffc6c0018fb779a0($context, $indent, $value);
            $buffer .= '
';
            $buffer .= $indent . '    </div>
';
        }
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function section1005a69d5837fea6789dad3985dfaf0a(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <a href="{{url}}&amp;bui_addblock={{name}}" class="list-group-item list-group-item-action">{{title}}</a>
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
                
                $buffer .= $indent . '    <a href="';
                $value = $this->resolveValue($context->find('url'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '&amp;bui_addblock=';
                $value = $this->resolveValue($context->find('name'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" class="list-group-item list-group-item-action">';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section44db6c94ef832981ffc6c0018fb779a0(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' noblockstoaddhere ';
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
                
                $buffer .= ' noblockstoaddhere ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
