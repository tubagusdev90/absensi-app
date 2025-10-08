<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Team;
use Filament\Tables;
use Filament\Forms\Get;
use App\Models\Karyawan;
use Filament\Forms\Form;
use App\Models\Departemen;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KaryawanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KaryawanResource\RelationManagers;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Karyawan';
    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\TextInput::make('nama_karyawan')
                    ->label('Nama Karyawan')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\Select::make('jabatan')
                    ->label('Jabatan')
                    ->options([
                        'Team Member'         => 'Team Member',
                        'Group Leader'        => 'Group Leader',
                        'Section Leader'      => 'Section Leader',
                        'Supervisor'          => 'Supervisor',
                        'Assistant Manager'   => 'Assistant Manager',
                        'Team Manager'        => 'Team Manager',
                        'Deputi Manager'      => 'Deputi Manager',
                        'Departement Manager' => 'Departement Manager',
                        'Presiden Director'   => 'Presiden Director',
                    ])
                    ->native(false)     // dropdown bergaya select2
                    ->searchable()      // bisa ketik untuk cari
                    ->preload()         // load opsi di awal
                    ->required(),

                Forms\Components\Select::make('departemen_selector')
                    ->label('Departemen')
                    ->options(fn () => Departemen::query()->orderBy('nama_departemen')->pluck('nama_departemen', 'id'))
                    ->live()            // v3: ->live() (atau ->reactive())
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('team_id')
                    ->label('Team')
                    ->options(function (Get $get) {
                        $depId = $get('departemen_selector');
                        if (!$depId) return [];
                        return Team::where('departemen_id', $depId)->orderBy('nama_team')->pluck('nama_team', 'id');
                        })
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->required(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_karyawan')->label('Nama Karyawan')->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('jabatan')
                    ->badge()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('team.nama_team')->label('Team')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('departemen.nama_departemen')->label('Departemen'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('team_id')->label('Team')
                    ->relationship('team', 'nama_team'),
                Tables\Filters\SelectFilter::make('departemen_id')->label('Departemen')
                    ->options(Departemen::orderBy('nama_departemen')->pluck('nama_departemen', 'id')->toArray())
                    ->query(function ($query, $data) {
                        if (!empty($data['value'])) {
                            $query->whereHas('team', fn($q) => $q->where('departemen_id', $data['value']));
                        }
                    }),   
                Tables\Filters\SelectFilter::make('jabatan')
                    ->label('Jabatan')
                    ->options([
                        'Team Member'         => 'Team Member',
                        'Group Leader'        => 'Group Leader',
                        'Section Leader'      => 'Section Leader',
                        'Supervisor'          => 'Supervisor',
                        'Assistant Manager'   => 'Assistant Manager',
                        'Team Manager'        => 'Team Manager',
                        'Deputi Manager'      => 'Deputi Manager',
                        'Departement Manager' => 'Departement Manager',
                        'Presiden Director'   => 'Presiden Director',
                    ]),
        
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
            'index' => Pages\ListKaryawans::route('/'),
            // 'create' => Pages\CreateKaryawan::route('/create'),
            // 'edit' => Pages\EditKaryawan::route('/{record}/edit'),
        ];
    }
}
