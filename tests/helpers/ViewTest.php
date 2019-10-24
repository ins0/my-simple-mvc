<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ViewHelperTest extends TestCase
{
    function testRenderViewModelWillNotLeakOutput() {
        ob_start();
        view("../../tests/mocks/ViewMock", [
            'bar' => 'bar',
        ]);
        $output = ob_get_contents();
        ob_end_clean();

        $this->assertEmpty($output);
    }

    function testRenderViewModel() {
        $viewOutput = view("../../tests/mocks/ViewMock", [
            'bar' => 'bar',
        ]);

        $expectedViewModel = "foo bar";
        $this->assertEquals($expectedViewModel, $viewOutput);
    }
}
