<?php

/**
 * CredentialViewModel
 *
 * Supplies form state, route action/method, and CredentialTypeEnum options
 * to the Admin Credential create/edit form view.
 */

declare(strict_types=1);

namespace App\ViewModels;

use App\Enums\CredentialTypeEnum;
use App\Models\Credential;
use Spatie\ViewModels\ViewModel;

class CredentialViewModel extends ViewModel
{
    public Credential $credential;

    public function __construct(?Credential $credential = null)
    {
        $this->credential = $credential ?? new Credential([
            'is_active' => true,
        ]);
    }

    public function action(): string
    {
        return $this->credential->exists
            ? route('admin.credential.update', ['credential' => $this->credential->id])
            : route('admin.credential.store');
    }

    public function method(): string
    {
        return $this->credential->exists ? 'PUT' : 'POST';
    }

    /**
     * @return array<string, string>
     */
    public function credentialTypes(): array
    {
        return CredentialTypeEnum::options();
    }
}
