<?php

namespace App\Filament\Resources;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Forms\FormsFAQM;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FAQResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FAQResource\RelationManagers;

class FAQResource extends Resource
{
    protected static ?string $model = FormsFAQM::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    public static function getNavigationGroup(): ?string
    {
        return __('filament/forms/FormFAQ.group');
    }

    public static function getModelLabel(): string
    {
        return __('filament/forms/FormFAQ.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/forms/FormFAQ.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('question.en')
                ->label(__('filament/forms/FormFAQ.question') . ' (English)')
                ->required(),
                TextInput::make('question.ar')
                ->label(__('filament/forms/FormFAQ.question') . ' (Arabic)')
                ->required(),
                Textarea::make('answer.en')
                ->label(__('filament/forms/FormFAQ.answer') . ' (English)')
                    ->required(),
                Textarea::make('answer.ar')
                ->label(__('filament/forms/FormFAQ.answer') . ' (Arabic)')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('question.en')->label(__('filament/forms/FormFAQ.question') . ' (English)'),
                TextColumn::make('question.ar')->label(__('filament/forms/FormFAQ.question') . ' (Arabic)'),
                TextColumn::make('answer.en')->label(__('filament/forms/FormFAQ.answer') . ' (English)'),
                TextColumn::make('answer.ar')->label(__('filament/forms/FormFAQ.answer') . ' (Arabic)'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListFAQS::route('/'),
            'create' => Pages\CreateFAQ::route('/create'),
            'edit' => Pages\EditFAQ::route('/{record}/edit'),
        ];
    }
}