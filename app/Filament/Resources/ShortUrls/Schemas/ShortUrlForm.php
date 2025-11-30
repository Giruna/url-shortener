<?php

namespace App\Filament\Resources\ShortUrls\Schemas;

use App\Services\UrlShortenerService;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ShortUrlForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required()
                    ->maxLength(UrlShortenerService::CODE_LENGTH)
                    ->unique(ignoreRecord: true),
                Textarea::make('long_url')
                    ->required()
                    ->rule('url')
                    ->columnSpanFull(),
            ]);
    }
}
