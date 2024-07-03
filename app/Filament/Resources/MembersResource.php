<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MembersResource\Pages;
use App\Filament\Resources\MembersResource\RelationManagers;
use App\Models\Members;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MembersResource extends Resource
{
    protected static ?string $model = Members::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

     protected static ?string $navigationLabel ='Chama Members';

     protected static ?string $navigationGroup ='Member Management';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('chama_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('role')
                    ->required()
                     ->options(array('Treasurer' => 'Treasurer', 'Member' => 'Member','Admin' => 'Administrator')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('chama_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
 public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Section::make('Members Info')
            ->schema([
            TextEntry::make('chama_id')->label('Chama Id'),
             TextEntry::make('name')->label('Name'),
              TextEntry::make('email')->label('Email'),
              TextEntry::make('phone')->label('Phone'),
              TextEntry::make('role')->label('Role'),

                ])->columns('2')

        ]);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMembers::route('/create'),
            'edit' => Pages\EditMembers::route('/{record}/edit'),
        ];
    }
}
