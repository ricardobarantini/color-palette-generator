<?php

namespace ColorPaletteGenerator\Support;

class ExtractData
{
    /**
     * @param $filePath
     * @return array
     */
    public function json($filePath): array
    {
        $contents = $this->safeFileGetContents($filePath);
        $data = (array) json_decode($contents, true);
        return array_unique($data);
    }

    private function safeFileGetContents($filePath): string
    {
        set_error_handler(function ($errno, $errstr) {
            throw new \RuntimeException($errstr, $errno);
        });

        try {
            $contents = file_get_contents($filePath);
            restore_error_handler();
            return $contents;
        } catch (\RuntimeException $e) {
            restore_error_handler();
            throw $e;
        }
    }
}
