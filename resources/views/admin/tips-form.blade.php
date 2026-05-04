@extends('layouts.app')

@section('title', $tip ? 'Edit Eco Tip' : 'Add Eco Tip')

@section('content')
<div class="page-header">
    <h1>{{ $tip ? 'Edit Eco Tip' : 'Add Eco Tip' }}</h1>
</div>

<div class="row justify-content-center">
<div class="col-lg-7">
<div class="eco-card">
    <form method="POST" action="{{ $tip ? route('admin.tips.update', $tip) : route('admin.tips.store') }}">
        @csrf
        @if($tip) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $tip?->title) }}" placeholder="e.g. Maintain Steady Speed">
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror"
                placeholder="Detailed eco tip description...">{{ old('description', $tip?->description) }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-select @error('category') is-invalid @enderror">
                @foreach(['driving'=>'🚗 Driving Habits','maintenance'=>'🔧 Maintenance','fuel'=>'⛽ Fuel & Energy'] as $val => $label)
                <option value="{{ $val }}" {{ old('category', $tip?->category) === $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Image URL <span style="color:var(--eco-muted);">(optional)</span></label>
            <input type="url" name="image_url" class="form-control @error('image_url') is-invalid @enderror"
                value="{{ old('image_url', $tip?->image_url) }}" placeholder="https://...">
            @error('image_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                    {{ old('is_active', $tip ? $tip->is_active : true) ? 'checked' : '' }}
                    style="background:rgba(255,255,255,.05); border-color:rgba(255,255,255,.2);">
                <label class="form-check-label" for="is_active" style="color:var(--eco-muted);">
                    Active (visible to users)
                </label>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn-eco btn">{{ $tip ? 'Save Changes' : 'Create Tip' }}</button>
            <a href="{{ route('admin.tips') }}" class="btn" style="background:rgba(255,255,255,.06); color:var(--eco-text); border-radius:10px;">Cancel</a>
        </div>
    </form>
</div>
</div>
</div>
@endsection
