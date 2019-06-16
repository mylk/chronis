<?php

namespace Chronis\Service;

class TemplateService
{
    public function render($template, $data)
    {
        $templateContent = file_get_contents(sprintf("%s/../../templates/%s.tpl", __DIR__, $template));

        $output = str_replace(array_keys($data), array_values($data), $templateContent);

        // remove placeholders that had no match with array keys of $data
        $output = preg_replace("/%(\w+)/", "", $output);

        return $output;
    }
}
