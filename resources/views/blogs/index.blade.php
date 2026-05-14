<x-app-layout>

    <div style="max-width:1200px;
                margin:auto;
                padding:40px;">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        ">

            <h1 style="font-size:32px;
                       font-weight:bold;">
                All Blogs
            </h1>

            <a href="{{ route('blogs.create') }}"
               style="
               background:black;
               color:white;
               padding:10px 20px;
               border-radius:5px;
               text-decoration:none;
               ">
               Create Blog
            </a>

        </div>

        @if(session('success'))

    <div style="
        background:#dcfce7;
        color:#166534;
        padding:16px 20px;
        margin-bottom:25px;
        border-radius:10px;
        border:1px solid #86efac;
        font-size:16px;
        font-weight:500;
        display:flex;
        align-items:center;
        gap:10px;
        box-shadow:0 2px 8px rgba(0,0,0,0.05);
    ">

        ✅ {{ session('success') }}

    </div>

@endif


        {{-- CATEGORY FILTER --}}
        <div style="margin-bottom:20px;">

    <input type="text"
           id="searchInput"
           placeholder="Search blogs..."
           style="
           padding:10px 15px;
           border:1px solid #ccc;
           border-radius:5px;
           width:300px;
           font-size:16px;
           ">

</div>
        <div style="margin-bottom:20px;">

            <select id="categoryFilter"
                        style="
                        padding:10px 40px 10px 15px;
                        border:1px solid #ccc;
                        border-radius:5px;
                        min-width:220px;
                        font-size:16px;
                        ">

                <option value="">
                    All Categories
                </option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>

 <div id="loading"
     style="
     display:none;
     margin:20px 0;
     text-align:center;
     ">

    <div style="
        width:45px;
        height:45px;
        border:5px solid #ddd;
        border-top:5px solid black;
        border-radius:50%;
        margin:auto;
        animation:spin 1s linear infinite;
    ">
    </div>

    <p style="
        margin-top:10px;
        color:gray;
        font-size:15px;
    ">
        Loading blogs...
    </p>

</div>
        {{-- BLOGS CONTAINER --}}
        <div id="blogs-container"
             style="
             display:grid;
             grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
             gap:20px;
             ">

            @include('blogs.partials.blogs')

        </div>
        <div style="margin-top:30px;">
    {{ $blogs->links() }}
</div>

    </div>


    {{-- AJAX SCRIPT --}}
    <script>

document.getElementById('categoryFilter')
.addEventListener('change', function () {

    let categoryId = this.value;

    document.getElementById('loading').style.display = 'block';

    fetch(`/blogs/filter?category_id=${categoryId}`)

        .then(response => response.text())

        .then(data => {

            document.getElementById('blogs-container')
            .innerHTML = data;

            document.getElementById('loading').style.display = 'none';

        });

});
document.getElementById('searchInput')
.addEventListener('keyup', function () {

    let search = this.value;

    document.getElementById('loading').style.display = 'block';

    fetch(`/blogs/search?search=${search}`)

        .then(response => response.text())

        .then(data => {

            document.getElementById('blogs-container')
            .innerHTML = data;

            document.getElementById('loading').style.display = 'none';

        });

});

    </script>
    <style>

@keyframes spin {

    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }

}

</style>
<footer style="
    margin-top:60px;
    padding:30px 20px;
    background:#111827;
    color:white;
    text-align:center;
    border-radius:12px 12px 0 0;
">

    <h3 style="
        font-size:22px;
        font-weight:bold;
        margin-bottom:10px;
    ">
        JobYaari Blog System
    </h3>

    <p style="
        color:#d1d5db;
        margin-bottom:15px;
    ">
        Built with Laravel, AJAX, MySQL & ❤️
    </p>

    <p style="
        font-size:14px;
        color:#9ca3af;
    ">
        © {{ date('Y') }} All Rights Reserved
    </p>

</footer>

</x-app-layout>