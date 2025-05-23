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
use App\Models\Courses\CoursesModulesM;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CousreModulesResource\Pages;
use App\Filament\Resources\CousreModulesResource\RelationManagers;

class CousreModulesResource extends Resource
{
    protected static ?string $model =CoursesModulesM::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';
    public static function getNavigationGroup(): ?string
    {
        return __('filament/courses/CoursesModules.group');
    }

    public static function getModelLabel(): string
    {
        return __('filament/courses/CoursesModules.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/courses/CoursesModules.plural');
    }
    static public function GenerateNewCode()
    {
        $code = Str::random(5);
        if (CoursesModulesM::where('code', $code)->exists()) {
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
                TextInput::make('title.en')
                ->label(__('filament/courses/CoursesModules.title') . ' (English)')
                ->required(),
                TextInput::make('title.ar')
                ->label(__('filament/courses/CoursesModules.title') . ' (Arabic)')
                ->required(),
                Select::make('course_id')
                ->label(__('filament/courses/CoursesModules.course'))
                ->required()
                ->relationship('course', 'name')
                ->getOptionLabelFromRecordUsing(fn ($record) => $record->name['en'] ?? ''),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('title.en')->label(__('filament/courses/CoursesModules.title') . ' (English)'),
                TextColumn::make('course.name.en')->label(__('filament/courses/CoursesModules.course') . ' (English)'),
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
            'index' => Pages\ListCousreModules::route('/'),
            'create' => Pages\CreateCousreModules::route('/create'),
            'view' => Pages\ViewCousreModules::route('/{record}'),
            'edit' => Pages\EditCousreModules::route('/{record}/edit'),
        ];
    }
}