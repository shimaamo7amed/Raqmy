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
    protected static ?string $navigationGroup = "Forms";
    protected static ?string $modelLabel = "InstructorsForm";
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
                ->label('English Name'),
                TextInput::make('name_ar')
                ->label('Arabic Name'),
                TextInput::make('email')
                ->label('Email'),
                TextInput::make('phone')
                ->label('Phone'),
                TextInput::make('experince')
                ->label('Experince'),
                TextInput::make('linkedIn')
                ->label('LinkedIn'),
                TextInput::make('message')
                ->label('Message'),
                FileUpload::make('cv')
                ->label("CV")
                ->visibility('public')
                ->downloadable()
                ->openable()
                ->preserveFilenames()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name_en')
                ->label(' Name'),
                TextColumn::make('email')
                ->label('Email'),
                TextColumn::make('phone')
                ->label('Phone'),
                TextColumn::make('experince')
                ->label('Experince'),
                TextColumn::make('message')
                ->label('Message'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                  Action::make('accept')
                ->label('Accept')
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation()
                ->action(function ($record) {
                    $password = Str::random(8);
                    InstructorsInstructorsM::create([
                        'code' => self::GenerateNewCode(),
                        'name_en' => $record->name_en,
                        'name_ar' => $record->name_ar,
                        'email' => $record->email,
                        'phone' => $record->phone,
                        'experince' => $record->experince,
                        'linkedIn' => $record->linkedIn,
                        'cv' => $record->cv,
                        'password' => Hash::make($password),
                    ]);
                    $record->delete(); 
                Mail::to($record->email)->send(new InstructorAccepted($password, $record->name_en, $record->email));
                }),
                Action::make('reject')
                ->label('Reject')
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
