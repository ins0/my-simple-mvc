<?php

namespace App\ViewRenderer;

use Exception;

final class ViewRenderer {

    static $viewRootDir = __DIR__ . '/../../resources/';

    private static function render(string $file, array $args = []) {
        if (!file_exists($file)) {
            throw new Exception(
                sprintf("template file [%s] does not exist", $file)
            );
        }

        extract($args);
        ob_start();
        require $file;
        return ob_get_clean();
    }

    static function renderTemplate(string $template, array $model = [], $layout = ""): string {

        $templateContents = self::render(self::$viewRootDir . 'views/' . $template . '.php', $model);
        if (!$layout) {
            return $templateContents;
        }

        $layoutContents = self::render(self::$viewRootDir . 'layout/' . $layout . '.php', array_merge(
            $model,
            [
                'default_content' => $templateContents,
            ]
        ));

        return $layoutContents;
    }
}
