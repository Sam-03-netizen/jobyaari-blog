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
    <div class="max-w-4xl mx-auto py-10">

        <h1 class="text-3xl font-bold mb-6">
            Create Blog
        </h1>


        <form action="{{ route('blogs.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-4 bg-white p-6 rounded shadow">

            @csrf

            <div>
                <label class="block mb-1">Title</label>

                <input type="text"
       name="title"
       value="{{ old('title') }}"
       class="w-full rounded p-2"
       style="
       border:1px solid {{ $errors->has('title') ? '#ef4444' : '#ccc' }};
       ">
            </div>

            <div>
                <label class="block mb-1">
                    Short Description
                </label>

                <textarea name="short_description"
          class="w-full rounded p-2"
          style="
          border:1px solid {{ $errors->has('short_description') ? '#ef4444' : '#ccc' }};
          ">{{ old('short_description') }}</textarea>
            </div>

            <div>
                <label class="block mb-1">
                    Content
                </label>

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

            <div>
                <label class="block mb-1">
                    Category
                </label>

                <select name="category_id"
        class="w-full rounded p-2"
        style="
        border:1px solid {{ $errors->has('category_id') ? '#ef4444' : '#ccc' }};
        ">

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div>
                <label class="block mb-1">
                    Blog Image
                </label>

                <input type="file"
       name="image"
       class="w-full rounded p-2"
       style="
       border:1px solid {{ $errors->has('image') ? '#ef4444' : '#ccc' }};
       ">
            </div>

            <button type="submit"
            style="background:black;
                color:white;
                padding:10px 20px;
                border-radius:5px;
                margin-top:20px;">
        Create Blog
    </button>

        </form>
    </div>
</x-app-layout>