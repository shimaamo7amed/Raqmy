<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Courses\CoursesModuleItemsM;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CousreModulesItemResource\Pages;
use App\Filament\Resources\CousreModulesItemResource\RelationManagers;

class CousreModulesItemResource extends Resource
{
    protected static ?string $model = CoursesModuleItemsM::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?string $navigationGroup = "Courses";
    protected static ?string $modelLabel = "CourseModuleItems";
    static public function GenerateNewCode()
    {
        $code = Str::random(5);
        if (CoursesModuleItemsM::where('code', $code)->exists()) {
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
                Textarea::make('content.en')
                ->label('Content (English)')
                ->required(),
                Textarea::make('content.ar')
                ->label('Content (Arabic)')
                ->required(),
                Select::make('module_id')
                ->label('Module')
                ->required()
                ->relationship('module', 'title')
                ->getOptionLabelFromRecordUsing(fn ($record) => $record->title['en'] ?? ''),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('content.en')
                ->label('content  (English)'),
                TextColumn::make('content.ar')
                ->label('content (Arabic)')
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
            'index' => Pages\ListCousreModulesItems::route('/'),
            'create' => Pages\CreateCousreModulesItem::route('/create'),
            'view' => Pages\ViewCousreModulesItem::route('/{record}'),
            'edit' => Pages\EditCousreModulesItem::route('/{record}/edit'),
        ];
    }
}
