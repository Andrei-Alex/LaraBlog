import Quill from 'quill';
import 'quill/dist/quill.snow.css';

document.addEventListener('DOMContentLoaded', function() {
    const quillEditor = document.querySelector('#quill-editor');
    const hiddenInput = document.querySelector('#hiddenContent');

    const quill = new Quill(quillEditor, {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                ['code-block']
            ]
        }
    });

    const oldContent = hiddenInput.value;
    if (oldContent) {
        quill.root.innerHTML = oldContent;
    }

    quill.on('text-change', function() {
        hiddenInput.value = quill.root.innerHTML;
    });

    const form = document.getElementById('PostForm');
    if (form) {
        form.addEventListener('submit', function() {
            hiddenInput.value = quill.root.innerHTML;
        });
    }
});
