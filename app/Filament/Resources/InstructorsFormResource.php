<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\InstructorsForm;
use App\Mail\InstructorAccepted;
use Filament\Resources\Resource;
use App\Models\Users\UsersUsersM;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Forms\FormsInstructorsM;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Instructors\InstructorsInstructorsM;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InstructorsFormResource\Pages;
use App\Filament\Resources\InstructorsFormResource\RelationManagers;


class InstructorsFormResource extends Resource
{
  protected static ?string $model = FormsInstructorsM::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-arrow-down';
    public static function getNavigationGroup(): ?string
    {
        return __('filament/forms/FormsInstructors.group');
    }

    public static function getModelLabel(): string
    {
        return __('filament/forms/FormsInstructors.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/forms/FormsInstructors.plural');
    }
 static public function GenerateNewCode()
    {
        $code = \Illuminate\Support\Str::random(5);
        if (InstructorsInstructorsM::where('code', $code)->exists()) {
            return Self::GenerateNewCode();
        } else {
            return $code;
        }
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name_en')
                ->label(__('filament/forms/FormsInstructors.name_en')),
                TextInput::make('name_ar')
                ->label(__('filament/forms/FormsInstructors.name_ar')),
                TextInput::make('email')
                ->label(__('filament/forms/FormsInstructors.email')),
                TextInput::make('phone')
                ->label(__('filament/forms/FormsInstructors.phone')),
                TextInput::make('experince')
                ->label(__('filament/forms/FormsInstructors.experince')),
                TextInput::make('linkedIn')
                ->label(__('filament/forms/FormsInstructors.linkedIn')),
                TextInput::make('facebook')
                ->label(__('filament/forms/FormsInstructors.facebook')),
                TextInput::make('message')
                ->label(__('filament/forms/FormsInstructors.message')),
                FileUpload::make('cv')
                ->label(__('filament/forms/FormsInstructors.cv'))
                ->visibility('public')
                ->downloadable()
                ->openable()
                ->preserveFilenames(),
                FileUpload::make('image')
                ->required()
                            ->label(__('filament/forms/FormsInstructors.image'))
                            ->disk('public')
                            ->imageEditor()
                            ->imageEditorMode(2)
                            ->downloadable()
                            ->directory('InstructorImages'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name_en')
                ->label(__('filament/forms/FormsInstructors.name_en')),
                TextColumn::make('email')->label(__('filament/forms/FormsInstructors.email')),
                TextColumn::make('phone')->label(__('filament/forms/FormsInstructors.phone')),
                TextColumn::make('experince')->label(__('filament/forms/FormsInstructors.experince')),
                TextColumn::make('message')->label(__('filament/forms/FormsInstructors.message')),
                ImageColumn::make("image")->label(__('filament/forms/FormsInstructors.image')),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Action::make('accept')
                ->label(__('filament/forms/FormsInstructors.accept'))
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation()
                ->action(function ($record) {
                    $password = Str::random(8);
                    UsersUsersM::create([
                        'code' => self::GenerateNewCode(),
                        'name_en' => $record->name_en,
                        'name_ar' => $record->name_ar,
                        'email' => $record->email,
                        'phone' => $record->phone,
                        'experince' => $record->experince,
                        'linkedIn' => $record->linkedIn,
                        'facebook' => $record->facebook,
                        'cv' => $record->cv,
                        'image' => $record->image,
                        'password' => Hash::make($password),
                        'role_id' =>2,
                    ]);
                    $record->save();
                Mail::to($record->email)->send(new InstructorAccepted($password, $record->name_en, $record->email));
                }),
                Action::make('reject')
                ->label(__('filament/forms/FormsInstructors.reject'))
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function ($record) {
                $record->delete();
             }),

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
            'index' => Pages\ListInstructorsForms::route('/'),
            // 'create' => Pages\CreateInstructorsForm::route('/create'),
            'view' => Pages\ViewInstructorsForm::route('/{record}'),
            // 'edit' => Pages\EditInstructorsForm::route('/{record}/edit'),
        ];
    }
}