import Quill from 'quill';
import 'quill/dist/quill.snow.css';
import hljs from 'highlight.js';
import 'highlight.js/styles/default.css';

hljs.configure({
    useBR: false,
    languages: ['javascript', 'php', 'python']
});
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

    function highlightCode() {
        quillEditor.querySelectorAll('pre code').forEach((block) => {
            hljs.highlightBlock(block);
        });
    }

    quill.on('text-change', function() {
        hiddenInput.value = quill.root.innerHTML;
        highlightCode();
    });

    highlightCode();


    const form = document.getElementById('PostForm');
    if (form) {
        form.addEventListener('submit', function() {
            hiddenInput.value = quill.root.innerHTML;
        });
    }
});
