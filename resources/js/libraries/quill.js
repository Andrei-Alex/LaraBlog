import Quill from 'quill';
import 'quill/dist/quill.snow.css';

document.addEventListener('DOMContentLoaded', function() {
    var quill = new Quill('#quill-editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                ['image', 'code-block']
            ]
        }
    });

    quill.on('text-change', function() {
        document.querySelector('#quill-content').value = quill.root.innerHTML;
    });
});

quill.getModule('toolbar').addHandler('image', () => {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.click();

    input.onchange = () => {
        const file = input.files[0];
        const url = '/path/to/uploaded/image.jpg';
        const range = quill.getSelection();
        quill.insertEmbed(range.index, 'image', url);
    };
});


