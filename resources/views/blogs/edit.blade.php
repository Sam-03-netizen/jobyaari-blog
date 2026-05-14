<x-app-layout>
    @if ($errors->any())

    <div style="
        max-width:1000px;
        margin:30px auto 0 auto;
        background:#fee2e2;
        color:#991b1b;
        padding:20px;
        border-radius:10px;
        border:1px solid #fca5a5;
    ">

        <h3 style="
            font-size:18px;
            font-weight:bold;
            margin-bottom:10px;
        ">
            Please fix these errors:
        </h3>

        <ul style="padding-left:20px;">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

    <div style="
        max-width:1000px;
        margin:auto;
        padding:40px;
    ">

        <h1 style="
            font-size:32px;
            font-weight:bold;
            margin-bottom:30px;
        ">
            Edit Blog
        </h1>
        @if ($errors->any())

    <div style="
        background:#fee2e2;
        color:#991b1b;
        padding:15px;
        border-radius:8px;
        margin-bottom:20px;
    ">

        <ul style="margin:0; padding-left:20px;">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

        <form action="{{ route('blogs.update', $blog->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div style="margin-bottom:20px;">

                <label>Title</label>

                <input type="text"
       name="title"
       value="{{ old('title', $blog->title) }}"
       style="
       width:100%;
       padding:10px;
       border:1px solid {{ $errors->has('title') ? '#ef4444' : '#ccc' }};
       border-radius:5px;
       ">

            </div>

            <div style="margin-bottom:20px;">

                <label>Short Description</label>

                <textarea name="short_description"
          style="
          width:100%;
          padding:10px;
          border:1px solid {{ $errors->has('short_description') ? '#ef4444' : '#ccc' }};
          border-radius:5px;
          ">{{ old('short_description', $blog->short_description) }}</textarea>

            </div>

            <div style="margin-bottom:20px;">

                <label>Content</label>

                <textarea
                    name="content"
                    id="content"
                    rows="10"
                    style="
width:100%;
padding:10px;
border:1px solid {{ $errors->has('content') ? '#ef4444' : '#ccc' }};
border-radius:5px;
"
                >{{ old('content', $blog->content ?? '') }}</textarea>

            </div>

            <div style="margin-bottom:20px;">

                <label>Category</label>

                <select name="category_id"
        style="
        width:100%;
        padding:10px;
        border:1px solid {{ $errors->has('category_id') ? '#ef4444' : '#ccc' }};
        border-radius:5px;
        ">

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                            {{ $blog->category_id == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div style="margin-bottom:20px;">

                <label>New Image (optional)</label>

               <input type="file"
       name="image"
       style="
       border:1px solid {{ $errors->has('image') ? '#ef4444' : '#ccc' }};
       padding:10px;
       border-radius:5px;
       width:100%;
       ">

            </div>

            <button type="submit"
                    style="
                    background:black;
                    color:white;
                    padding:10px 20px;
                    border:none;
                    border-radius:5px;
                    cursor:pointer;
                    ">
                Update Blog
            </button>

        </form>

    </div>
</x-app-layout>