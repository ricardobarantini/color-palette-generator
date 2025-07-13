<?php

namespace ColorPaletteGenerator;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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

    public function build(): string
    {
        $loader = new FilesystemLoader(__DIR__."/../views");
        $twig = new Environment($loader);

        return $twig->render('base.html.twig', [
            "colors" => $this->getColors(),
        ]);
    }
}
