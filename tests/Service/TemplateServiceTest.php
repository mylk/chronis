<?php

use PHPUnit\Framework\TestCase;
use Chronis\Service\TemplateService;

class TemplateServiceTest extends TestCase
{
    private static $template = null;

    public static function setUpBeforeClass() : void
    {
        self::$template = new TemplateService();
    }

    public function testRenderReturnsStringWithoutPlaceholdersWhenEmptyData(): void
    {
        $output = self::$template->render("cron", []);
        $expected = "# : \n \n\n";
        $this->assertEquals($expected, $output);
    }

    public function testRenderReturnsStringWithoutPlaceholderWhenValueIsNull(): void
    {
        $output = self::$template->render("cron", [
            "%name" => "foo",
            "%description" => null,
            "%expression" => "* * * * *",
            "%command" => "baz"
        ]);
        $expected = "# foo: \n* * * * * baz\n\n";

        $this->assertEquals($expected, $output);
    }

    public function testRenderReturnsStringWithReplacedStringsWhenDataExist(): void
    {
        $output = self::$template->render("cron", [
            "%name" => "foo",
            "%description" => "bar",
            "%expression" => "* * * * *",
            "%command" => "baz"
        ]);
        $expected = "# foo: bar\n* * * * * baz\n\n";

        $this->assertEquals($expected, $output);
    }
}
