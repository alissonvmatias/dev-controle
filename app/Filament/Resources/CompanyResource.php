<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\RawJs;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $modelLabel = "Empresa";
    protected static ?string $pluralModelLabel = "Empresas";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('social_reason')
                    ->label('Razão Social')
                    ->maxLength(255),
                Forms\Components\TextInput::make('cnpj_cpf')
                ->label('CNPJ ou CPF')
                ->mask(RawJs::make(<<<'JS'
                $input.length > 14 ? '99.999.999/9999-99' : '999.999.999-99'
            JS))
            ->rule('cpf_ou_cnpj')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mail')
                    ->label('E-mail')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                ->label('Telefone')
                ->mask(RawJs::make(<<<'JS'
                $input.length >= 14 ? '(99)99999-9999' : '(99)9999-9999'
            JS))
        
                    ->tel()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_reason')
                    ->label('Razão Social')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cnpj_cpf')
                    ->label('Cnpj ou CPF')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mail')
                    ->label('E-mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefone')
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
