<?php

namespace ColorPaletteGenerator;

class BuildPage
{
    protected array $colors;

    public function setColors($colors): self
    {
        $this->colors = $colors;
        return $this;
    }

    protected function getColors(): array
    {
        return $this->colors;
    }

    protected function buildPalette(): string
    {
        $stubColor = file_get_contents(__DIR__."/../stubs/Color.html.stub");

        $palette = "";

        foreach ($this->getColors() as $key => $value) {
            $var = [
              '{{ color }}' => $value,
            ];

            $palette .= str_replace(array_keys($var), array_values($var), $stubColor);
        }

        return $palette;
    }

    public function build(): string
    {
        $template = file_get_contents(__DIR__."/../stubs/ColorPalette.html.stub");

        $var = [
          '{{ colors }}' => $this->buildPalette()
        ];

        return str_replace(array_keys($var), array_values($var), $template);
    }
}
