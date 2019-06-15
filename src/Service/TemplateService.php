<?php

namespace Chronis\Service;

class TemplateService
{
    public function render($template, $data)
    {
        $templateContent = file_get_contents(sprintf("%s/../../templates/%s.tpl", __DIR__, $template));

        return str_replace(array_keys($data), array_values($data), $templateContent);
    }
}
