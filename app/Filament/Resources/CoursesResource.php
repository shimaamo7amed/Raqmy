<?php
namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use App\Models\Users\UsersUsersM;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use App\Models\Courses\CoursesCoursesM;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
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
    public static function getNavigationGroup(): ?string
    {
        return __('filament/courses/courses.group');
    }

    public static function getModelLabel(): string
    {
        return __('filament/courses/courses.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/courses/courses.plural');
    }


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
                Hidden::make('code')
                    ->default(fn() => self::GenerateNewCode()),
                TextInput::make('name.en')
                    ->label(__('filament/courses/courses.name') . ' (English)')
                    ->required(),
                TextInput::make('name.ar')
                    ->label(__('filament/courses/courses.name') . ' (Arabic)')
                    ->required(),
                Textarea::make('desc.en')
                    ->label(__('filament/courses/courses.description') . ' (English)')
                    ->required(),
                Textarea::make('desc.ar')
                    ->label(__('filament/courses/courses.description') . ' (Arabic)')
                    ->required(),
                TextInput::make('notes.en')
                    ->label(__('filament/courses/courses.notes') . ' (English)')
                    ->required(),
                TextInput::make('notes.ar')
                    ->label(__('filament/courses/courses.notes') . ' (Arabic)')
                    ->required(),
                TextInput::make('price')
                    ->label(__('filament/courses/courses.price'))
                    ->numeric()
                    ->required()
                    ->suffix('EGP')
                    ->live(),
                TextInput::make('discount')
                    ->numeric()
                    ->default(0)
                    ->label(__('filament/courses/courses.discount'))
                    ->suffix('%'),
                Select::make('status')
                    ->label(__('filament/courses/courses.status'))
                    ->required()
                    ->options([
                        'paid' => 'Paid',
                        'free' => 'Free',
                    ]),
                Select::make('delivary_method')
                    ->label(__('filament/courses/courses.delivery_method'))
                    ->required()
                    ->options([
                        'live' => 'Live',
                        'recorded' => 'Recorded',
                    ]),
                Select::make('category_id')
                    ->label(__('filament/courses/courses.category'))
                    ->required()
                    ->relationship('category', 'name')
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->name['en'] ?? '')
                    ->reactive(),
                Select::make('subcategory_id')
                    ->label(__('filament/courses/courses.subcategory'))
                    ->required()
                    ->options(function (callable $get) {
                        $categoryId = $get('category_id');
                        if (!$categoryId) {
                            return [];
                        }
                        $category = CategoriesCategoriesM::with('subCategories')->find($categoryId);
                        return $category?->subCategories
                            ->pluck('name.en', 'id')
                            ->toArray();
                    })
                    ->reactive()
                    ->disabled(fn(callable $get) => !$get('category_id')),

                Select::make('instructors_id')
                    ->label(__('filament/courses/courses.instructor'))
                    ->options(function () {
                        return UsersUsersM::whereHas('role', function ($q) {
                            $q->where('id', '2');
                        })->pluck('name_en', 'id');
                    })
                    ->searchable()
                    ->required(),
                FileUpload::make('image')
                    ->required()
                    ->label(__('filament/courses/courses.image'))
                    ->disk('public')
                    ->directory('CoursesImage'),
                FileUpload::make('main_video')
                    ->label(__('filament/courses/courses.video'))
                    ->disk('public')
                    ->directory('videos')
                    ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mkv'])
                    ->maxSize(10240)
                    ->columnSpan(1),
                TextInput::make("video_time")
                    ->label(__('filament/courses/courses.video_time')),
                Repeater::make('goals')
                    ->label(__('filament/courses/courses.goals'))
                    ->schema([
                        TextInput::make('en')
                            ->label(__('filament/courses/courses.goals') . ' (English)')
                            ->required(),
                        TextInput::make('ar')
                            ->label(__('filament/courses/courses.goals') . ' (Arabic)')
                            ->required(),
                    ])
                    ->columns(2)
                    ->minItems(1)
                    ->addActionLabel('Add New Goal'),
                Repeater::make('users')
                    ->label(__('filament/courses/courses.users'))
                    ->schema([
                        TextInput::make('en')
                            ->label(__('filament/courses/courses.users') . ' (English)')
                            ->required(),
                        TextInput::make('ar')
                            ->label(__('filament/courses/courses.users') . ' (Arabic)')
                            ->required(),
                    ])
                    ->columns(2)
                    ->minItems(1)
                    ->addActionLabel('Add New User'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name.en')
                    ->label(__('filament/courses/courses.name')),
                TextColumn::make('instructor.name_en')
                    ->label(__('filament/courses/courses.instructor')),
                TextColumn::make('price')
                    ->label(__('filament/courses/courses.price'))
                    ->sortable()
                    ->money('EGP'),
                TextColumn::make('discounted_price')
                    ->label(__('filament/courses/courses.discounted_price'))
                    ->money('EGP')
                    ->sortable(),
                TextColumn::make('category.name.en')
                    ->label(__('filament/courses/courses.category')),
                TextColumn::make('subcategory.name.en')
                    ->label(__('filament/courses/courses.subcategory')),
                TextColumn::make('status')
                    ->label(__('filament/courses/courses.status'))
                    ->formatStateUsing(fn ($state) => $state === 'paid' ? 'Paid' : 'Free'),
                TextColumn::make('delivary_method')
                    ->label(__('filament/courses/courses.delivery_method'))
                    ->formatStateUsing(fn ($state) => $state === 'live' ? 'Live' : 'Recorded'),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourses::route('/create'),
            'view' => Pages\ViewCourses::route('/{record}'),
            'edit' => Pages\EditCourses::route('/{record}/edit'),
        ];
    }
}
