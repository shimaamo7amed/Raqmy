<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use App\Models\Courses\CoursesCoursesM;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Categories\CategoriesCategoriesM;
use App\Filament\Resources\CoursesResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CoursesResource\RelationManagers;

class CoursesResource extends Resource
{
    protected static ?string $model = CoursesCoursesM::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = "Courses";
    protected static ?string $modelLabel = "Courses";
    static public function GenerateNewCode()
    {
        $code = Str::random(5);
        if (CoursesCoursesM::where('code', $code)->exists()) {
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
                             Forms\Components\Textarea::make('desc.en')
                            ->label('Descrebtion(English)')
                            ->required(),
                        Forms\Components\Textarea::make('desc.ar')
                            ->label('Descrebtion (Arabic)')
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->label('Price')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('discount')
                            ->label('Discount'),
                        Forms\Components\TextInput::make('goals.en')
                            ->label('Goals (English)')
                            ->required(),
                        Forms\Components\TextInput::make('goals.ar')
                            ->label('Goals (Arabic)')
                            ->required(),
                        Forms\Components\TextInput::make('users.en')
                            ->label('Students (English)')
                            ->required(),
                        Forms\Components\TextInput::make('users.ar')
                            ->label('Students (Arabic)')
                            ->required(),
                        Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                            'paid' => 'Paid',
                            'free' => 'Free',
                        ]),
                        Select::make('delivary_method')
                            ->label('Delivary Method')
                            ->required()
                            ->options([
                            'live' => 'Live',
                            'recorded' => 'Recorded',
                        ]),
                        Select::make('category_id')
                            ->label('Category')
                            ->required()
                            ->relationship('category', 'name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->name['en'] ?? ''),

                        Select::make('subcategory_id')
                            ->label('Sub Category')
                            ->required()
                            ->relationship('subcategory', 'name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->name['en'] ?? ''),

                        Select::make('instructors_id')
                            ->label('Instructor')
                            ->required()
                            ->relationship('instructor', 'name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->name['en'] ?? ''),

                        FileUpload::make('image')
                            ->required()
                            ->label("Image")
                            ->disk('public')
                            ->directory('CoursesImage'),
                        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name.en')
                ->label('Name (English)'),
                TextColumn::make('desc.en')
                ->label('Descrebtion(English)'),
                TextColumn::make('price')
                ->label('Price'),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourses::route('/create'),
            'view' => Pages\ViewCourses::route('/{record}'),
            'edit' => Pages\EditCourses::route('/{record}/edit'),
        ];
    }
}
