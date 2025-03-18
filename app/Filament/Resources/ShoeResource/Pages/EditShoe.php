<?php

namespace App\Filament\Resources\ShoeResource\Pages;

use App\Filament\Resources\ShoeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShoe extends EditRecord
{
    protected static string $resource = ShoeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $shoe = $this->record;

        // Refresh untuk memastikan relasi terbaru
        $shoe->refresh();

        // Ambil foto pertama dan set sebagai thumbnail
        $firstPhoto = $shoe->photos()->first();

        if ($firstPhoto) {
            $shoe->update(['thumbnail' => $firstPhoto->photo]);
        }
    }
}