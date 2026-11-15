@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Contact Message Details'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Contact Messages'), 'link' => route('admin.message.index')],
        ['text' => \App\Helpers\TranslationHelper::translate('Details')],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Messages'), 'link' => route('admin.message.index')]">
    </x-bread-crumb>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card mb-7">
                    <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $message->subject ?: \App\Helpers\TranslationHelper::translate('Contact Message Details') }}</h4>
                        <span class="badge badge-light-{{ $message->status?->color() ?? 'primary' }}">
                            {{ $message->status?->label() ?? '-' }}
                        </span>
                    </div>
                    <div class="card-body py-6">
                        <div class="row g-5">
                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Name') }}:</strong>
                                <p class="mt-1">{{ $message->name }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Email') }}:</strong>
                                <p class="mt-1" dir="ltr">{{ $message->email }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Phone') }}:</strong>
                                <p class="mt-1" dir="ltr">{{ $message->phone ?: '-' }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Type') }}:</strong>
                                <p class="mt-1">{{ $message->type?->label() ?? '-' }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Project Budget') }}:</strong>
                                <p class="mt-1">{{ $message->budget_range ?: '-' }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Received At') }}:</strong>
                                <p class="mt-1">{{ $message->created_at?->format('Y-m-d H:i') ?? '-' }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Read At') }}:</strong>
                                <p class="mt-1">{{ $message->read_at?->format('Y-m-d H:i') ?? '-' }}</p>
                            </div>
                            <div class="col-md-12">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Message') }}:</strong>
                                <div class="p-4 bg-light rounded mt-2">
                                    {{ $message->message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (auth()->guard('admin')->user()?->can('messages.edit', 'admin'))
                    <div class="card">
                        <div class="card-header border-0 pt-6">
                            <h4 class="mb-0">{{ \App\Helpers\TranslationHelper::translate('Update Status & Admin Notes') }}</h4>
                        </div>
                        <div class="card-body py-6">
                            <form action="{{ route('admin.message.update', $message->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row g-6 mb-6">
                                    <div class="col-md-4">
                                        <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Status') }} *</label>
                                        @php($currentStatus = old('status', $message->status?->value))
                                        <select class="form-select form-select-solid" name="status" required>
                                            @foreach ($messageStatuses as $statusValue => $statusLabel)
                                                <option value="{{ $statusValue }}" @selected($currentStatus === $statusValue)>{{ $statusLabel }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="col-md-8">
                                        <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Admin Notes') }}</label>
                                        <textarea class="form-control form-control-solid" name="admin_notes" rows="3">{{ old('admin_notes', $message->admin_notes) }}</textarea>
                                        @error('admin_notes')
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary px-8">
                                        {{ \App\Helpers\TranslationHelper::translate('Save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
