<?php

namespace App\Filament\Resources\ShoeResource\Pages;

use App\Filament\Resources\ShoeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateShoe extends CreateRecord
{
    protected static string $resource = ShoeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Form tidak lagi memiliki field thumbnail
        // Kita akan set thumbnail setelah record dibuat dan photos ditambahkan

        return $data;
    }

    protected function afterCreate(): void
    {
        $shoe = $this->record;

        // Tunggu sebentar untuk memastikan relasi photos sudah tersimpan
        // Ini penting karena relasi photos dapat disimpan setelah record utama
        $shoe->refresh();

        // Ambil foto pertama dan set sebagai thumbnail
        $firstPhoto = $shoe->photos()->first();

        if ($firstPhoto) {
            $shoe->update(['thumbnail' => $firstPhoto->photo]);
        }
    }
}