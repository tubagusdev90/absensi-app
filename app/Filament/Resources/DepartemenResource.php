<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartemenResource\Pages;
use App\Filament\Resources\DepartemenResource\RelationManagers;
use App\Models\Departemen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartemenResource extends Resource
{
    protected static ?string $model = Departemen::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Departemen';
    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_departemen')
                ->required()
                ->label('Nama Departemen')
                ->maxLength(40),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama_departemen')->label('Nama Departemen')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat'),
            ])
            ->filters([
                Tables\Filters\Filter::make('nama_departemen')
                    ->form([
                        Forms\Components\TextInput::make('nama_departemen')
                            ->label('Nama Departemen'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['nama_departemen'], function ($query, $nama) {
                                $query->where('nama_departemen', 'like', "%{$nama}%");
                            });
                    }),
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
            'index' => Pages\ListDepartemens::route('/'),
            // 'create' => Pages\CreateDepartemen::route('/create'),
            // 'edit' => Pages\EditDepartemen::route('/{record}/edit'),
        ];
    }
}
