<?php

namespace App\Filament\Resources;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Forms\FormsFAQM;
use Filament\Resources\Resource;
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
               Forms\Components\TextInput::make('question.en')
                            ->label('Question (English)')
                            ->required(),
                        Forms\Components\TextInput::make('question.ar')
                            ->label('Question (Arabic)')
                            ->required(),
                        Forms\Components\Textarea::make('answer.en')
                            ->label('Answer (English)')
                            ->required(),
                        Forms\Components\Textarea::make('answer.ar')
                            ->label('Answer (Arabic)')
                            ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                    Tables\Columns\TextColumn::make('question.en')
                    ->label('Question (English)'),
                Tables\Columns\TextColumn::make('question.ar')
                    ->label('Question (Arabic)'),
                    Tables\Columns\TextColumn::make('answer.en')
                    ->label('Answer (English)'),
                Tables\Columns\TextColumn::make('answer.ar')
                    ->label('Answer (Arabic)'),
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
