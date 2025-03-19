<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Categories\CategoriesCategoriesM;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoriesResource\Pages;
use App\Filament\Resources\CategoriesResource\RelationManagers;

class CategoriesResource extends Resource
{
    protected static ?string $model =CategoriesCategoriesM::class;
     protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup = "Categories";
    protected static ?string $modelLabel = "Course-Categories";
    static public function GenerateNewCode()
    {
        $code = \Illuminate\Support\Str::random(5);
        if (CategoriesCategoriesM::where('code', $code)->exists()) {
            return Self::GenerateNewCode();
        } else {
            return $code;
        }
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\Hidden::make('code')
                        ->default(fn () => self::GenerateNewCode()),
                        Forms\Components\TextInput::make('name.en')
                        ->label('Name (English)')
                        ->required(),
                        Forms\Components\TextInput::make('name.ar')
                        ->label('Name (Arabic)')
                        ->required(),
                        FileUpload::make('image')
                        ->required()
                        ->label("Image")
                        ->disk('public')
                        ->directory('CategoryImage'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('name.en')
                ->label('Name'),
                ImageColumn::make("image"),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategories::route('/create'),
            'view' => Pages\ViewCategories::route('/{record}'),
            'edit' => Pages\EditCategories::route('/{record}/edit'),
        ];
    }
}
