@props(['name', 'id', 'value' => ''])

<div class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700">Content</label>
    <textarea
        name="{{ $name }}"
        id="{{ $id }}"
        class="w-full border-gray-300 rounded-lg px-4 py-2"
    >{!! $value !!}</textarea>
</div>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/eo5n8jjvdpzwedpx79h1x7jkjtnba0yliktms2n5nv79utd6/tinymce/8/tinymce.min.js"></script>

<script>
    tinymce.init({
        selector: '#{{ $id }}',
        plugins: 'code table lists link image autoresize',
        toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code | table',
        height: 400,
    });
</script>
@endpush
