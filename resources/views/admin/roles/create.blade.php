<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-header-title">
            {{ __('Create Role') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard-section">
        <div class="admin-dashboard-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <form action="{{ route('admin.roles.store') }}" method="POST" class="admin-form-vertical">
                        @csrf
                        
                        {{-- Role Name --}}
                        <div class="admin-form-group">
                            <label for="name" class="admin-form-label">Role Name</label>
                            <input type="text" id="name" name="name" class="admin-form-input" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="admin-form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-form-label">Permissions</label>
                            <div class="admin-table-container">
                                <table class="admin-table permission-matrix-table">
                                    <thead class="admin-table-thead">
                                        <tr>
                                            <th class="admin-table-th">Feature</th>
                                            <th class="admin-table-th text-center">View</th>
                                            <th class="admin-table-th text-center">Create</th>
                                            <th class="admin-table-th text-center">Edit</th>
                                            <th class="admin-table-th text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody class="admin-table-tbody">
                                        @foreach ($permissions as $feature => $permissionGroup)
                                            <tr>
                                                <td class="admin-table-td">{{ ucfirst($feature) }}</td>
                                                @php
                                                    $actions = ['view', 'create', 'edit', 'delete'];
                                                    $featurePermissions = $permissionGroup->pluck('name');
                                                @endphp
                                                @foreach ($actions as $action)
                                                    <td class="admin-table-td text-center">
                                                        @if($featurePermissions->contains("$feature-$action"))
                                                            <input type="checkbox" name="permissions[]" value="{{ "$feature-$action" }}" class="admin-form-checkbox">
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @error('permissions')
                                <p class="admin-form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="admin-button-base admin-button-purple">
                                Save Role
                            </button>
                            <a href="{{ route('admin.roles.index') }}" class="admin-button-base admin-button-gray">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
