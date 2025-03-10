<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\InstructorsForm;
use Filament\Resources\Resource;
use App\Models\Forms\FormsInstructorsM;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InstructorsFormResource\Pages;
use App\Filament\Resources\InstructorsFormResource\RelationManagers;

class InstructorsFormResource extends Resource
{
  protected static ?string $model = FormsInstructorsM::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-arrow-down';
    protected static ?string $navigationGroup = "Forms";
    protected static ?string $modelLabel = "InstructorsForm";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Name'),
                TextInput::make('email')
                ->label('Email'),
                TextInput::make('phone')
                ->label('Phone'),
                TextInput::make('linkedIn')
                ->label('LinkedIn'),
                TextInput::make('message')
                ->label('Message'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')
                ->label('Name'),
                Tables\Columns\TextColumn::make('email')
                ->label('Email'),
                Tables\Columns\TextColumn::make('phone')
                ->label('Phone'),
                Tables\Columns\TextColumn::make('linkedIn')
                ->label('LinkedIn'),
                Tables\Columns\TextColumn::make('message')
                ->label('Message'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListInstructorsForms::route('/'),
            // 'create' => Pages\CreateInstructorsForm::route('/create'),
            'view' => Pages\ViewInstructorsForm::route('/{record}'),
            // 'edit' => Pages\EditInstructorsForm::route('/{record}/edit'),
        ];
    }
}
