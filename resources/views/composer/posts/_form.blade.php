<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-6">

    @csrf

    @if($method != 'POST')
        @method($method)
    @endif

    <div>
        <label class="block font-semibold mb-2">Title</label>

        <input
            type="text"
            name="title"
            value="{{ old('title', $post->title ?? '') }}"
            class="w-full border rounded-lg p-3"
            required>
    </div>

    <div>
        <label class="block font-semibold mb-2">Category</label>

        <select
            name="category_id"
            class="w-full border rounded-lg p-3"
            required>

            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    @selected(old('category_id', $post->category_id ?? '') == $category->id)>

                    {{ $category->name }}

                </option>

            @endforeach

        </select>
    </div>

    <div>
        <label class="block font-semibold mb-2">Excerpt</label>

        <textarea
            name="excerpt"
            rows="3"
            class="w-full border rounded-lg p-3">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    </div>

    <div>
        <label class="block font-semibold mb-2">Content</label>

        <textarea
            id="editor"
            name="content"
            rows="12"
            class="w-full border rounded-lg p-3">{{ old('content', $post->content ?? '') }}</textarea>
    </div>

    <div>
        <label class="block font-semibold mb-2">Featured Image</label>

        <input
            id="image"
            type="file"
            name="featured_image"
            class="w-full border rounded-lg p-3">

        <img
            id="preview"
            class="hidden mt-4 rounded-lg w-64 border">

        @isset($post)
            @if($post->featured_image)
                <img
                    src="{{ asset('storage/'.$post->featured_image) }}"
                    class="mt-4 rounded-lg w-64 border">
            @endif
        @endisset
    </div>

    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

        Save Draft

    </button>

</form>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>

let editor;

ClassicEditor
.create(document.querySelector('#editor'))
.then(newEditor => {

    editor = newEditor;

    document.querySelector('form').addEventListener('submit', function(e){

        document.querySelector('#editor').value = editor.getData();

        if(editor.getData().trim() === ''){
            e.preventDefault();
            alert('Content is required.');
        }

    });

})
.catch(error => console.error(error));

document.getElementById('image').addEventListener('change', function(e){

    if(!e.target.files.length) return;

    const reader = new FileReader();

    reader.onload = function(event){

        const img = document.getElementById('preview');

        img.src = event.target.result;

        img.classList.remove('hidden');

    };

    reader.readAsDataURL(e.target.files[0]);

});

</script>