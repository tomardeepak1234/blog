@extends('admin.admin_meta')

@section('content')

<style>
    .dashboard-card {
        background: #13131f;
        border: 1px solid #252538;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        padding: 1.5rem;
        color: #e8e8f0;
    }

    .dashboard-card h4 {
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

    .btn-success {
        background: #6c63ff;
        border: none;
        font-weight: 600;
        border-radius: 8px;
    }
    .btn-success:hover { background: #a78bfa; }

    .btn-secondary { border-radius: 8px; }

    .current-image img {
        border-radius: 8px;
        margin-top: 0.5rem;
    }

    /* ── Styled Dropdown ── */
    .status-select {
        appearance: none;
        -webkit-appearance: none;
        background-color: #1a1a2a;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236c63ff' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 2.5rem;
        border: 1px solid #252538;
        color: #fff;
        border-radius: 8px;
        cursor: pointer;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .status-select:focus {
        border-color: #6c63ff;
        box-shadow: 0 0 5px rgba(108,99,255,0.3);
        outline: none;
    }

    .status-select option {
        background: #1a1a2a;
        color: #fff;
        padding: 8px;
    }
</style>

<div class="container mt-5">
    <div class="dashboard-card">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Edit Post</h4>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
        </div>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title"
                       value="{{ old('title', $post->title) }}"
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="5"
                          class="form-control" required>{{ old('description', $post->description) }}</textarea>
            </div>

            <div class="mb-3 current-image">
                <label class="form-label">Current Image</label><br>
                @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" width="150">
                @else
                    <p class="text-secondary">No image uploaded</p>
                @endif
            </div>

            {{-- Change Image — apna alag div ── --}}
            <div class="mb-3">
                <label class="form-label">Change Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            {{-- Status Dropdown — bilkul alag div ── --}}
            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="is_published" class="form-control status-select">
                    <option value="1" {{ old('is_published', $post->is_published ?? 1) == 1 ? 'selected' : '' }}>
                        ✅ Published
                    </option>
                    <option value="0" {{ old('is_published', $post->is_published ?? 1) == 0 ? 'selected' : '' }}>
                        🚫 Unpublished
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-success">Update Post</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>

    </div>
</div>

@endsection
