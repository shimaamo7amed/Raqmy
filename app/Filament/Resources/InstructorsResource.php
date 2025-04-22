<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Instructors;
use Filament\Resources\Resource;
use App\Models\Users\UsersUsersM;
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
    protected static ?string $model = UsersUsersM::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getModelLabel(): string
    {
        return __('filament/forms/FormsInstructors.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/forms/FormsInstructors.plural_label');
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
        ->whereHas('role', function ($query) {
            $query->where('name', 'instructor');
        });
    }
    public static function form(Form $form): Form
    {
        return $form
                ->schema([
                    Section::make('Instructors')
                    ->schema([
                        Grid::make(2)->schema([
                        TextInput::make('name_en')
                        ->label(__('filament/forms/FormsInstructors.name_en'))
                        ->required(),
                        TextInput::make('name_ar')
                        ->label(__('filament/forms/FormsInstructors.name_ar'))
                        ->required(),
                        Textarea::make('desc.en')
                            ->label(__('filament/forms/FormsInstructors.desc_en'))
                            ->required(),
                        Textarea::make('desc.ar')
                            ->label(__('filament/forms/FormsInstructors.desc_ar'))
                            ->required(),
                        TextInput::make('email')
                        ->label(__('filament/forms/FormsInstructors.email'))
                        ->required()
                        ->readonly(),
                        TextInput::make('phone')
                        ->label(__('filament/forms/FormsInstructors.phone'))
                        ->required()
                        ->readonly(),
                        TextInput::make('experince')
                            ->label(__('filament/forms/FormsInstructors.experince'))
                            ->required(),
                        TextInput::make('facebook')
                            ->label(__('filament/forms/FormsInstructors.facebook')),
                        TextInput::make('linkedIn')
                            ->label(__('filament/forms/FormsInstructors.linkedIn')),
                        TextInput::make('website')
                            ->label(__('filament/forms/FormsInstructors.website')),
                            FileUpload::make('image')
                            ->required()
                            ->label(__('filament/forms/FormsInstructors.image'))
                            ->disk('public')
                            ->imageEditor()
                            ->imageEditorMode(2)
                            ->downloadable()
                            ->directory('InstructorImages'),
                        FileUpload::make('cv')
                            ->label(__('filament/forms/FormsInstructors.cv'))
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
                TextColumn::make('name_en')->label(__('filament/forms/FormsInstructors.name_en')),
                TextColumn::make('email')->label(__('filament/forms/FormsInstructors.email')),
                TextColumn::make('phone')->label(__('filament/forms/FormsInstructors.phone')),
                TextColumn::make('experince')->label(__('filament/forms/FormsInstructors.experince')),
                ImageColumn::make("image")->label(__('filament/forms/FormsInstructors.image')),
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
            'index' => Pages\ListInstructors::route('/'),
            // 'create' => Pages\CreateInstructors::route('/create'),
            'view' => Pages\ViewInstructors::route('/{record}'),
            'edit' => Pages\EditInstructors::route('/{record}/edit'),
        ];
    }
}