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
    protected static ?string $navigationGroup = "Forms";
    protected static ?string $modelLabel = "Website-FAQ";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('question.en')
                    ->label('Question (English)')
                    ->required(),
                TextInput::make('question.ar')
                    ->label('Question (Arabic)')
                    ->required(),
                Textarea::make('answer.en')
                    ->label('Answer (English)')
                    ->required(),
                Textarea::make('answer.ar')
                    ->label('Answer (Arabic)')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('question.en'),
                TextColum::make('question.ar'),
                TextColumn::make('answer.en'),
                TextColumn::make('answer.ar'),
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
