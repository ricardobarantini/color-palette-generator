<?php

declare(strict_types=1);

namespace ColorPaletteGenerator\Contracts;

interface ColorPaletteGenerator
{
    public function setFilePath(string $filePath): self;

    public function getFilePath(): string;

    public function setInputFormat(string $inputFormat): self;

    public function setOutputPath(string $outputPath): self;

    public function getOutputPath(): string;
}
