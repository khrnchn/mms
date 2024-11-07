<?php

namespace App\Livewire;

use Filament\Actions\Action;
use Livewire\Component;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class LoginShortcut extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;
    public function goToHome()
    {
        return Action::make('home')
            ->icon('heroicon-o-arrow-left')
            ->label('Back to Home')
            ->color('info')
            ->keyBindings(['command+h', 'ctrl+h'])
            ->extraAttributes([])
            ->url('/');
    }
    public function render()
    {
        return <<<'HTML'
        <div>
            {{ $this->goToHome }}
        </div>
        HTML;
    }
}
