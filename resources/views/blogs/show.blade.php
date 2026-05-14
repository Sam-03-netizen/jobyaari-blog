<x-app-layout>

    <div style="
        max-width:1200px;
        margin:auto;
        padding:40px;
        display:grid;
        grid-template-columns:2fr 1fr;
        gap:40px;
    ">

        {{-- MAIN BLOG --}}
        <div>

            <img src="{{ asset('storage/' . $blog->image_path) }}"
                 style="
                 width:100%;
                 height:450px;
                 object-fit:cover;
                 border-radius:10px;
                 margin-bottom:30px;
                 ">

            <h1 style="
                font-size:40px;
                font-weight:bold;
                margin-bottom:15px;
            ">
                {{ $blog->title }}
            </h1>

            <p style="
                color:gray;
                margin-bottom:10px;
            ">
                Category:
                {{ $blog->category->name }}
            </p>

            <p style="
                color:gray;
                margin-bottom:30px;
            ">
                Published:
                {{ $blog->created_at->format('d M Y') }}
            </p>

            <div style="
                font-size:18px;
                line-height:1.8;
                color:#333;
            ">
                {!! $blog->content !!}
            </div>

        </div>

        {{-- SIDEBAR --}}
        <div>

            <h2 style="
                font-size:28px;
                font-weight:bold;
                margin-bottom:20px;
            ">
                Recent Blogs
            </h2>

            @foreach($recentBlogs as $recent)

                <a href="{{ route('blogs.show', $recent->id) }}"
                   style="
                   display:block;
                   text-decoration:none;
                   color:black;
                   margin-bottom:20px;
                   border:1px solid #ddd;
                   border-radius:10px;
                   overflow:hidden;
                   background:white;
                   ">

                    <img src="{{ asset('storage/' . $recent->image_path) }}"
                         style="
                         width:100%;
                         height:180px;
                         object-fit:cover;
                         ">

                    <div style="padding:15px;">

                        <h3 style="
                            font-size:20px;
                            font-weight:bold;
                            margin-bottom:10px;
                        ">
                            {{ $recent->title }}
                        </h3>

                        <p style="
                            color:gray;
                            font-size:14px;
                        ">
                            {{ $recent->created_at->format('d M Y') }}
                        </p>

                    </div>

                </a>

            @endforeach

        </div>

    </div>

</x-app-layout>