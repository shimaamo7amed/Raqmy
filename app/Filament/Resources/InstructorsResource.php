<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Instructors;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Instructors\InstructorsInstructorsM;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InstructorsResource\Pages;
use App\Filament\Resources\InstructorsResource\RelationManagers;

class InstructorsResource extends Resource
{
    protected static ?string $model = InstructorsInstructorsM::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $modelLabel = "Instructors";
    static public function GenerateNewCode()
    {
        $code = \Illuminate\Support\Str::random(5);
        if (InstructorsInstructorsM::where('code', $code)->exists()) {
            return Self::GenerateNewCode();
        } else {
            return $code;
        }
    }
    protected static function beforeCreate($record): void
    {
    $record->code = self::GenerateNewCode();
    }
  
    public static function form(Form $form): Form
    {
        return $form
                ->schema([
                Forms\Components\Section::make('Instructors')
                    ->schema([
                        Forms\Components\Hidden::make('code')
                        ->default(fn () => self::GenerateNewCode()),
                        Forms\Components\TextInput::make('name.en')
                            ->label('Name (English)')
                            ->required(),
                        Forms\Components\TextInput::make('name.ar')
                            ->label('Name (Arabic)')
                            ->required(),
                        Forms\Components\Textarea::make('desc.en')
                            ->label('Description (English)')
                            ->required(),
                        Forms\Components\Textarea::make('desc.ar')
                            ->label('Description (Arabic)')
                            ->required(),
                        Forms\Components\TextInput::make('facebook')
                            ->label('facebook'),
                        Forms\Components\TextInput::make('linkedIn')
                            ->label('linkedIn'),
                            FileUpload::make('image')
                            ->required()
                            ->label("Image")
                            ->disk('public')
                            ->imageEditor()
                            ->imageEditorMode(2)
                            ->downloadable()
                            ->directory('InstructorImages'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('code'),
                ImageColumn::make("image"),
                    Tables\Columns\TextColumn::make('name.en')
                    ->label('Name (English)'),
                Tables\Columns\TextColumn::make('name.ar')
                    ->label('Name (Arabic)'),
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
            'index' => Pages\ListInstructors::route('/'),
            'create' => Pages\CreateInstructors::route('/create'),
            'view' => Pages\ViewInstructors::route('/{record}'),
            'edit' => Pages\EditInstructors::route('/{record}/edit'),
        ];
    }
}
