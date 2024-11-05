<?php

namespace App\Filament\Resources\SitioResource\Pages;

use App\Filament\Resources\SitioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSitios extends ListRecords
{
    protected static string $resource = SitioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
