@extends('layouts.app')

@section('content')

<div class="w-50 m-auto">
    {{-- Errori validazioen --}}
    @if ( $errors -> any() )
    {{-- Se sono presenti errori backend --}}
    <div class="alert alert-danger">

        <ul>
            @foreach ($errors -> all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>

    </div>
    @endif
</div>

<form class="w-25 m-auto" action="{{ route('admin.posts.update', $post->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title"
            value="{{ old('title', $post->title) }}">
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content" placeholder="Content" cols="50" rows="5">{{ old('content', $post->content) }}</textarea>
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <div>
            <select name="category_id" id="category">

                <option value="">Nessuna categoria</option>

                @foreach ($categories as $category)

                <option @if ( old('category_id', $post->category_id) == $category->id ) selected @endif
                    value="{{ $category->id}}">{{$category->name}}
                </option>

                @endforeach

            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="text" class="form-control" id="image" name="image" placeholder="Url image"
            value="{{ old('image', $post->image) }}">
    </div>

    <div class="form-group">

        @foreach ($platforms as $platform)
        <div class="form-check form-check-inline">
            <input 
            class="form-check-input" 
            type="checkbox" 
            id="checkbox-{{$platform->name}}" 
            name="platforms[]"
            value="{{ $platform->id }}" 
            @if( in_array( $platform->id, old('platforms', $posts_platform_id) ) ) checked @endif
            >
            <label class="form-check-label" for="checkbox-{{$platform->name}}">{{ $platform->name }}</label>
        </div>
        @endforeach

    </div>

    <div class="form-group">
        <label for="firm">Firm</label>
        <input type="text" class="form-control" id="firm" name="firm" placeholder="Firm"
            value="{{ old('firm', $post->firm) }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>
@endsection
