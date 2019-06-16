<?php

namespace Chronis\Service;

use Chronis\Exception\TemplateNotFoundException;

class TemplateService
{
    public function render(string $name, array $data): string
    {
        $path = sprintf("%s/../../templates/%s.tpl", __DIR__, $name);
        if (!file_exists($path)) {
            throw new TemplateNotFoundException(sprintf("Template named \"%s\" was not found.", $name));
        }

        $content = file_get_contents($path);

        $output = str_replace(array_keys($data), array_values($data), $content);
        // remove placeholders that had no match with array keys of $data
        $output = preg_replace("/%(\w+)/", "", $output);

        return $output;
    }
}
