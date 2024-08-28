<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Monolog\Handler\FirePHPHandler;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('borrow_date')->maxDate(now())->required(),
                Forms\Components\DatePicker::make('return_date')->required(),
                Forms\Components\Select::make('members_id')
                ->relationship('members', 'name')
                ->searchable()
                ->preload()
                ->required(),
                Forms\Components\Select::make('books_id')
                ->relationship('books', 'title')
                ->searchable()
                ->preload()
                ->required(),
                Forms\Components\Select::make('status')->options([
                    false => 'borrowed',
                    true => 'returned'
                ])->required(),
                Forms\Components\Select::make('penalties_id')
                ->relationship('penalties', 'issue')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('issue')->maxLength(255)->required(),
                    Forms\Components\TextInput::make('payment')->numeric()->prefix('Rp')->required()
                ])
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('members.name')->searchable(),
                Tables\Columns\TextColumn::make('books.title')->searchable(),
                Tables\Columns\TextColumn::make('borrow_date'),
                Tables\Columns\TextColumn::make('return_date'),
                Tables\Columns\IconColumn::make('status')->label('Status')->boolean(),
                Tables\Columns\TextColumn::make('penalties.issue')->label('issue')->searchable(),
                Tables\Columns\TextColumn::make('penalties.payment')->label('payment')->searchable()
            ])
            ->filters([
                //
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
