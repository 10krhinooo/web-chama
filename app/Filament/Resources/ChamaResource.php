<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChamaResource\Pages;
use App\Filament\Resources\ChamaResource\RelationManagers;
use App\Models\Chama;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;

class ChamaResource extends Resource
{
    protected static ?string $model = Chama::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

     protected static ?string $navigationGroup ='System Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextArea::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('Number_of_members')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('Chama_type')
                    ->required()
                    ->options(array('merry-go-round' => 'Merry-go-round', 'loans' => 'Loans','savings' => 'Savings')),
                Forms\Components\Select::make('currency')

                    ->required()
                    ->options(array('Ksh' => 'Ksh', 'Euro' => 'Euro','USD' => 'USD')),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Number_of_members')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Chama_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency')
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
            Section::make('Chama Info')
            ->schema([
            TextEntry::make('name'),
             TextEntry::make('description'),
              TextEntry::make('Number_of_members')->label('Number of Members'),
               TextEntry::make('Chama_type')->label('Chama Type'),
                TextEntry::make('currency'),])->columns('2')

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
            'index' => Pages\ListChamas::route('/'),
            'create' => Pages\CreateChama::route('/create'),
            'edit' => Pages\EditChama::route('/{record}/edit'),
        ];
    }
}
