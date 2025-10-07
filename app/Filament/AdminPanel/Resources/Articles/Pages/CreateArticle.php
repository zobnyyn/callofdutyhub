<?php

namespace App\Filament\AdminPanel\Resources\Articles\Pages;

use App\Filament\AdminPanel\Resources\Articles\ArticleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;
}
