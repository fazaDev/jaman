<?php

namespace App\Filament\Backoffice\Resources\Users\Pages;

use App\Filament\Backoffice\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
