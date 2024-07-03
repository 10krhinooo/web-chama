<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContributionsResource\Pages;
use App\Filament\Resources\ContributionsResource\RelationManagers;
use App\Models\Contributions;
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

class ContributionsResource extends Resource
{
    protected static ?string $model = Contributions::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup ='Finance Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('members_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('Donation_amount')
                    ->required()
                    ->numeric(),
                 Forms\Components\Select::make('currency')

                    ->required()
                    ->options(array('Ksh' => 'Ksh', 'Euro' => 'Euro','USD' => 'USD')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('members_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Donation_amount')
                    ->numeric()
                    ->sortable(),
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
            Section::make('Contribution Info')
            ->schema([
            TextEntry::make('members_id'),

              TextEntry::make('Donation_amount')->label('Amount deposited'),

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
            'index' => Pages\ListContributions::route('/'),
            'create' => Pages\CreateContributions::route('/create'),
            'edit' => Pages\EditContributions::route('/{record}/edit'),
        ];
    }
}
