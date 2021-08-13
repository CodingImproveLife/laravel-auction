if (document.querySelector('#lot-description')) {
    document.addEventListener("DOMContentLoaded", () => {
        ClassicEditor
            .create(document.querySelector('#lot-description'), {
                toolbar: ['bold', 'italic', 'heading', 'link', 'numberedList', 'bulletedList', 'insertTable', 'undo', 'redo'],
                heading: {
                    options: [
                        {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                        {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                        {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'},
                        {model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4'}
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });
    });
}
