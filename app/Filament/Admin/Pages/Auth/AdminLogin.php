<?php // PASTIKAN INI BARIS PERTAMA, KOLOM PERTAMA

namespace App\Filament\Admin\Pages\Auth;

use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\Support\Htmlable;
// Illuminate\Contracts\View\View as ViewContract; // Tidak diperlukan jika tidak ada method render kustom

class AdminLogin extends BaseLogin
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label(false)
                    ->email()
                    ->autocomplete()
                    ->autofocus()
                    ->placeholder('Masukkan E-mail')
                    ->extraAttributes([
                        'class' => '!text-black placeholder:!text-gray-600',
                    ]),
                TextInput::make('password')
                    ->label(false)
                    ->password()
                    ->placeholder('Masukkan Password')
                    ->autocomplete('current-password')
                    ->extraAttributes([
                        'class' => '!text-black placeholder:!text-gray-600',
                    ]),
            ])
            ->statePath('data');
    }

    public function getView(): string
    {
        // Pastikan ini sesuai dengan lokasi dan nama file Blade Anda
        return 'filament.admin.pages.auth.admin-login';
    }

    public function getTitle(): string | Htmlable
    {
        // Ganti judul sesuai keinginan Anda jika perlu
        return 'Login Admin';
    }

    public function getHeading(): string | Htmlable
    {
        // Anda bisa mengganti ini juga jika perlu
        return 'Login';
    }
}
