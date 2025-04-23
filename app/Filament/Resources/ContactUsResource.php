<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\Forms\FormsContactUSM;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ContactUsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ContactUsResource\RelationManagers;

class ContactUsResource extends Resource
{
    protected static ?string $model = FormsContactUSM::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone-arrow-down-left';
      public static function getNavigationGroup(): ?string
    {
        return __('filament/forms/FormsInstructors.group');
    }

    public static function getModelLabel(): string
    {
        return __('filament/forms/ContactUs.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/forms/ContactUs.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('fullName')
                ->label(__('filament/forms/ContactUS.fullName'))
                ->required(),
                TextInput::make('email')
                ->label(__('filament/forms/ContactUs.email'))
                ->required(),
                TextInput::make('phone')
                ->label(__('filament/forms/ContactUs.phone'))
                ->required(),
                TextInput::make('message')
                ->label(__('filament/forms/ContactUs.message'))
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    TextColumn::make('name'),
                    TextColumn::make('email'),
                    TextColumn::make('phone'),
                    TextColumn::make('message'),
                    TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactUs::route('/'),
            'create' => Pages\CreateContactUs::route('/create'),
            'view' => Pages\ViewContactUs::route('/{record}'),
            'edit' => Pages\EditContactUs::route('/{record}/edit'),
        ];
    }
}