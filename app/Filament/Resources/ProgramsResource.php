<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use App\Models\Courses\CoursesCoursesM;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Programs\ProgramsProgramsM;
use App\Filament\Resources\ProgramsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProgramsResource\RelationManagers;

class ProgramsResource extends Resource
{
    protected static ?string $model =ProgramsProgramsM::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-arrow-down';
      protected static ?string $modelLabel = "Programs";
      static public function GenerateNewCode()
    {
        $code = \Illuminate\Support\Str::random(5);
        if (ProgramsProgramsM::where('code', $code)->exists()) {
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
                ->label('Title (English)')
                ->required(),
                TextInput::make('title.ar')
                ->label('Title (Arabic)')
                ->required(),
                Textarea::make('desc.en')
                ->label('Descrebtion(English)')
                ->required(),
                Textarea::make('desc.ar')
                ->label('Descrebtion (Arabic)')
                ->required(),
                TextInput::make('total_price')
                ->label('Price')
                ->numeric()
                ->required()
                ->suffix('EGP')
                ->live(),
                TextInput::make('discount')
                ->numeric()
                ->default(0)
                ->suffix('%'),
                TextInput::make('courses_hour')
                ->label('Course hour')
                ->required(),
                TextInput::make('courses_number')
                ->label('Course Numbers')
                ->required(),
                Repeater::make('goals')
                ->label('Course Goals')
                    ->schema([
                        TextInput::make('en')
                        ->label('Goal (English)')
                        ->required(),
                        TextInput::make('ar')
                        ->label('Goal (Arabic)')
                        ->required(),
                        ])
                        ->columns(2)
                        ->minItems(1)
                        ->addActionLabel('Add New Goal'),
                Repeater::make('career_path')
                ->label('Course Career Path')
                    ->schema([
                        TextInput::make('en')
                        ->label('CareerPath (English)')
                        ->required(),
                        TextInput::make('ar')
                        ->label('CareerPath (Arabic)')
                        ->required(),
                        ])
                        ->columns(2)
                        ->minItems(1)
                        ->addActionLabel('Add New Career Path'),
                FileUpload::make('courses_image')
                ->required()
                ->label("Image")
                ->disk('public')
                ->directory('ProgramsImage'),
                FileUpload::make('courses_video')
                ->label('Upload Video')
                ->disk('public')  // Specify disk (you can use 'public' or others)
                ->directory('Programsvideos')  // Specify the directory inside storage
                ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mkv']) // Limit file types to videos
                ->maxSize(10240)
                ->columnSpan(1),
                Select::make('course_id')
                ->required()
                ->label("courses")
                ->multiple()
                ->searchable()
                ->relationship('courses', 'name')
                ->options(CoursesCoursesM::all()->pluck('name.en', 'id')),




            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title.en')
                ->label('Name (English)'),
                TextColumn::make('total_price')
                ->label('Price')
                  ->money('EGP')
                ->sortable(),
                TextColumn::make('price_after')
                ->label('Price After')
                  ->money('EGP')
                ->sortable(),
                TextColumn::make('courses_video')
                ->label('Video')
                ->formatStateUsing(function ($state) {
                return '<video width="320" height="240" controls>
                <source src="'.asset('storage/'.$state).'" type="video/mp4">
                </video>';
                })
                ->html(),
                
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreatePrograms::route('/create'),
            'view' => Pages\ViewPrograms::route('/{record}'),
            'edit' => Pages\EditPrograms::route('/{record}/edit'),
        ];
    }
}
