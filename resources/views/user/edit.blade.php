@extends('admin.admin_meta')

@section('content')

<style>
    /* Dashboard-style card */
    .dashboard-card {
        background: #13131f;
        border: 1px solid #252538;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        padding: 1.5rem;
        color: #e8e8f0;
    }

    .dashboard-card h3 {
        font-family: 'Syne', sans-serif;
        color: #fff;
        margin-bottom: 1rem;
    }

    .form-label {
        font-weight: 600;
        color: #fff;
    }

    .form-control {
        background: #1a1a2a;
        border: 1px solid #252538;
        color: #fff;
        border-radius: 8px;
    }

    .form-control:focus {
        border-color: #6c63ff;
        box-shadow: 0 0 5px rgba(108,99,255,0.3);
        background: #1a1a2a;
        color: #fff;
    }

    .btn-primary {
        background: #6c63ff;
        border: none;
        font-weight: 600;
        border-radius: 8px;
    }
    .btn-primary:hover {
        background: #a78bfa;
    }

    .btn-secondary {
        border-radius: 8px;
    }

    .edit-header a.btn-light {
        background: #252538;
        color: #fff;
        border-radius: 8px;
        border: 1px solid #252538;
        padding: 0.35rem 0.8rem;
    }
    .edit-header a.btn-light:hover {
        background: #6c63ff;
        color: #fff;
    }

    .edit-header {
        margin-bottom: 1rem;
    }

</style>

<div class="container mt-5">

    <div class="dashboard-card">

        <!-- Header -->
        <div class="edit-header d-flex justify-content-between align-items-center">
            <h3>Edit User</h3>

            <a href="{{ route('list') }}" class="btn btn-light btn-sm">
                ← Back
            </a>
        </div>

        <!-- Edit Form -->
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="first_name"
                           value="{{ old('first_name', $user->first_name) }}"
                           class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                           value="{{ old('email', $user->email) }}"
                           class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone"
                           value="{{ old('phone', $user->phone) }}"
                           class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role_id" class="form-control">
                        <option value="">-- Select Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('list') }}" class="btn btn-secondary">Cancel</a>
            </div>

        </form>

    </div>
</div>

@endsection