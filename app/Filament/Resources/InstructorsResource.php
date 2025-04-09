<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Instructors;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
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
                    Section::make('Instructors')
                    ->schema([
                        Grid::make(2)->schema([
                        TextInput::make('name_en')
                        ->label('Name (English)')
                        ->required(),
                        TextInput::make('name_ar')
                        ->label('Name (Arabic)')
                        ->required(),
                        Textarea::make('desc.en')
                            ->label('Description (English)')
                            ->required(),
                        Textarea::make('desc.ar')
                            ->label('Description (Arabic)')
                            ->required(),
                        TextInput::make('email')
                        ->label('Instructor Email')
                        ->required(),
                        TextInput::make('phone')
                        ->label('Instructor Phone')
                        ->required(),
                        TextInput::make('experince')
                            ->label('Instructor Experince')
                            ->required(),
                        TextInput::make('facebook')
                            ->label('facebook'),
                        TextInput::make('linkedIn')
                            ->label('linkedIn'),
                        TextInput::make('website')
                            ->label('Website'),
                            FileUpload::make('image')
                            ->required()
                            ->label("Image")
                            ->disk('public')
                            ->imageEditor()
                            ->imageEditorMode(2)
                            ->downloadable()
                            ->directory('InstructorImages'),
                        FileUpload::make('cv')
                            ->label("CV")
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->preserveFilenames()
                    ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name_en'),
                TextColumn::make('email'),
                TextColumn::make('phone'),
                TextColumn::make('experince'),
                ImageColumn::make("image"),
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
