@forelse($blogs as $blog)
    <div style="
        border:1px solid #ddd;
        border-radius:10px;
        overflow:hidden;
        background:white;
    ">

        <img src="{{ asset('storage/' . $blog->image_path) }}"
                style="
                width:100%;
                height:220px;
                object-fit:cover;
                ">

        <div style="padding:20px;">

            <h2 style="
                font-size:24px;
                font-weight:bold;
                margin-bottom:10px;
            ">
                {{ $blog->title }}
            </h2>

            <p style="
                color:#555;
                margin-bottom:10px;
            ">
                {{ $blog->short_description }}
            </p>

            <p style="
                font-size:14px;
                color:gray;
                margin-bottom:15px;
            ">
                Category:
                {{ $blog->category->name }}
            </p>

            <a href="{{ route('blogs.show', $blog->id) }}"
   style="
   display:inline-block;
   margin-bottom:15px;
   background:black;
   color:white;
   padding:10px 18px;
   border-radius:5px;
   text-decoration:none;
   ">
   Read More
</a>

            <div style="
                display:flex;
                gap:10px;
            ">

                <a href="{{ route('blogs.edit', $blog->id) }}"
                style="
                background:orange;
                color:white;
                padding:8px 15px;
                border-radius:5px;
                text-decoration:none;
                ">
                Edit
                </a>

                <form action="{{ route('blogs.destroy', $blog->id) }}"
      method="POST"
      onsubmit="return confirm('Are you sure you want to delete this blog?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            style="
                            background:red;
                            color:white;
                            padding:8px 15px;
                            border:none;
                            border-radius:5px;
                            cursor:pointer;
                            ">
                        Delete
                    </button>

                </form>

            </div>

        </div>

    </div>

@empty

    <div style="
        grid-column:1/-1;
        background:white;
        padding:60px 20px;
        border-radius:12px;
        text-align:center;
        border:1px solid #e5e7eb;
    ">

        <div style="
            font-size:60px;
            margin-bottom:10px;
        ">
            📭
        </div>

        <h2 style="
            font-size:36px;
            font-weight:bold;
            margin-bottom:10px;
            color:#111827;
        ">
            No Blogs Found
        </h2>

        <p style="
            color:#6b7280;
            font-size:18px;
        ">
            Try searching something else or change category.
        </p>

    </div>

@endforelse