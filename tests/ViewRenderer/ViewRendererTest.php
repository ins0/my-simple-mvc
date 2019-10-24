<?php
declare(strict_types=1);

use App\ViewRenderer\ViewRenderer;
use PHPUnit\Framework\TestCase;

final class ViewHelperTest extends TestCase
{
    function testRenderViewModelWillNotLeakOutput() {
        ob_start();
        ViewRenderer::renderTemplate("../../tests/mocks/ViewMock", [
            'bar' => 'bar',
        ]);
        $output = ob_get_contents();
        ob_end_clean();

        $this->assertEmpty($output);
    }

    function testRenderViewModel() {
        $viewOutput = ViewRenderer::renderTemplate("../../tests/mocks/ViewMock", [
            'bar' => 'bar',
        ]);

        $expectedViewModel = "foo bar";
        $this->assertEquals($expectedViewModel, $viewOutput);
    }

    function testRenderViewModelWithLayout() {
        $viewOutput = ViewRenderer::renderTemplate("../../tests/mocks/ViewMock", [
            'bar' => 'bar',
        ], "../../tests/mocks/LayoutMock");

        $expectedViewModel = "foo bar baz";
        $this->assertEquals($expectedViewModel, $viewOutput);
    }
}
