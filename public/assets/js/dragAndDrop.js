document.addEventListener('DOMContentLoaded', () => {

    const dropArea = document.querySelector('#drop-area');
    const fileInput = document.querySelector('#file-input');

    dropArea.addEventListener('drop', handleDrop)
    dropArea.addEventListener('dragover',handleDragOver)
    dropArea.addEventListener('dragleave',handleDragLeave)

    function handleDrop(event){
        event.preventDefault();
        const {currentTarget, dataTransfer} = event;

        if(dataTransfer.types.includes('Files')){
            currentTarget.classList.remove('drag-files');
            const {files} = dataTransfer;
            fileInput.files = files;
            fileInput.dispatchEvent(new Event('change'));
        }
    }

    function handleDragOver(event){
        event.preventDefault();
        const {currentTarget, dataTransfer} = event;
        if(dataTransfer.types.includes('Files')){
            currentTarget.classList.add('drag-files');
        }
    }

    function handleDragLeave(event){
        event.preventDefault();
        const {currentTarget} = event;
        currentTarget.classList.remove('drag-files');
    }

});


