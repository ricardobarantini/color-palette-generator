<?php

declare(strict_types=1);

namespace ColorPaletteGenerator;

use ColorPaletteGenerator\Contracts\ColorPaletteGenerator as ColorPaletteGeneratorInterface;
use ColorPaletteGenerator\Support\ExtractData;

final class ColorPaletteGenerator implements ColorPaletteGeneratorInterface
{
    protected string $filePath;
    protected string $inputFormat;
    protected string $outputPath;

    public function __construct()
    {
        //
    }

    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function setInputFormat(string $inputFormat): self
    {
        $this->inputFormat = $inputFormat;
        return $this;
    }

    public function setOutputPath(string $outputPath): self
    {
        $this->outputPath = $outputPath;
        return $this;
    }

    public function getOutputPath(): string
    {
        return $this->outputPath;
    }

    public function generate(): array
    {
        $extractData = new ExtractData();

        $data = match ($this->inputFormat) {
            "json" => $extractData->json($this->filePath)
        };

        $template = (new BuildPage())->setColors($data)->build($data);

        file_put_contents($this->getOutputPath(), $template);

        return [
            "qty_colors" => count($data),
            "output_path" => $this->getOutputPath(),
        ];
    }
}
