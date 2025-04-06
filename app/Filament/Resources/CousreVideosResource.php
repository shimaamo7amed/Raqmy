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
use App\Models\Courses\CoursesVideosM;
use App\Models\Courses\CoursesModuleItemsM;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CousreVideosResource\Pages;
use App\Filament\Resources\CousreVideosResource\RelationManagers;

class CousreVideosResource extends Resource
{
    protected static ?string $model = CoursesVideosM::class;
    protected static ?string $navigationIcon = 'heroicon-o-cloud-arrow-up';
    protected static ?string $navigationGroup = "Courses";
    protected static ?string $modelLabel = "CourseVideos";
    static public function GenerateNewCode()
    {
        $code = Str::random(5);
        if (CoursesVideosM::where('code', $code)->exists()) {
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
                FileUpload::make('video')
                ->label('Upload Video')
                ->disk('public')  // Specify disk (you can use 'public' or others)
                ->directory('videos')  // Specify the directory inside storage
                ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mkv']) // Limit file types to videos
                ->maxSize(10240) // Set max size in KB (10MB in this case)
                // ->multiple()
                ->columnSpan(1),  // Optional, to adjust the layout
           Select::make('course_id')
                ->label('Course')
                ->required()
                ->relationship('course', 'name')
                ->getOptionLabelFromRecordUsing(fn ($record) => $record->name['en'] ?? '')
                ->reactive(),
            Select::make('module_item_id')
                ->label('Module Item')
                ->required()
                ->options(function (callable $get) {
                    $courseId = $get('course_id');
                    if (!$courseId) {
                        return [];
                    }
                    return CoursesModuleItemsM::whereHas('module', function ($query) use ($courseId) {
                        $query->where('course_id', $courseId);
                    })->get()->pluck('content.en', 'id');
                }),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('moduleItem.content.en')
                ->label('Time'),
                TextColumn::make('video')
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
            'index' => Pages\ListCousreVideos::route('/'),
            'create' => Pages\CreateCousreVideos::route('/create'),
            'view' => Pages\ViewCousreVideos::route('/{record}'),
            'edit' => Pages\EditCousreVideos::route('/{record}/edit'),
        ];
    }
}
