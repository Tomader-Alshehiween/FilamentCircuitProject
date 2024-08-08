<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AADocumentationWidget extends Widget
{
    protected static string $view = 'filament.widgets.a-a-documentation-widget';

    public string|int|array $columnSpan = 'full';
}
