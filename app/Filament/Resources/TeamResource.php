<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Teams';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('departemen_id')
                ->relationship('departemen', 'nama_departemen')
                ->label('Departemen')
                ->native(false)
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\TextInput::make('nama_team')
                ->label('Nama Team')
                ->required()
                ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('departemen.nama_departemen')->label('Departemen')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nama_team')->label('Team')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Dibuat'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('departemen_id')
                    ->relationship('departemen', 'nama_departemen')
                    ->label('Departemen'),
            ])
            ->actions([
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
            'index' => Pages\ListTeams::route('/'),
            // 'create' => Pages\CreateTeam::route('/create'),
            // 'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
