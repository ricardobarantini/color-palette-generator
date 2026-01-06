<?php

namespace ColorPaletteGenerator\Support;

class ConvertColor
{
    public function hexToRgb(string $hexColor): string
    {
        $hexColor = str_replace('#', '', $hexColor);
    }
}
