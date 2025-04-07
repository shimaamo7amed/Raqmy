<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Categories\CategoriesCategoriesM;
use App\Models\Categories\CategoriesSubCategoriesM;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SubCategoriesResource\Pages;
use App\Filament\Resources\SubCategoriesResource\RelationManagers;

// dd(CategoriesCategoriesM::query()->pluck('name', 'id')->toArray());
class SubCategoriesResource extends Resource
{
    protected static ?string $model = CategoriesSubCategoriesM::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';
    protected static ?string $navigationGroup = "Categories";
    protected static ?string $modelLabel = "Sub-Categories";

      static public function GenerateNewCode()
    {
        $code = \Illuminate\Support\Str::random(5);
        if (CategoriesSubCategoriesM::where('code', $code)->exists()) {
            return Self::GenerateNewCode();
        } else {
            return $code;
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                        Hidden::make('code')
                        ->default(fn () => self::GenerateNewCode()),
                        TextInput::make('name.en')
                            ->label('Name (English)')
                            ->required(),
                        TextInput::make('name.ar')
                            ->label('Name (Arabic)')
                            ->required(),
                        Select::make('category_id')
                            ->label('category')
                            ->required()
                            ->relationship('category', 'name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->name['en'] ?? ''),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('code'),
                TextColumn::make('name.en')
                ->label('SubCategory Name'),
                TextColumn::make('category.name.en')
                ->label('Category Name'),
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
            'index' => Pages\ListSubCategories::route('/'),
            'create' => Pages\CreateSubCategories::route('/create'),
            'view' => Pages\ViewSubCategories::route('/{record}'),
            'edit' => Pages\EditSubCategories::route('/{record}/edit'),
        ];
    }
}
