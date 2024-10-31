document.addEventListener("DOMContentLoaded", () => {
    const fileInput = document.querySelector("#file-input");
    const status = document.querySelector("#status");

    // Get the folder name from the URL
    const folderName = window.location.pathname.split('/').pop() || 'a1';

    // Initial fetch to populate file list
    fetchData(folderName);

    fileInput.addEventListener("change", function(){
        uploadFiles(this.files);
    });

    function uploadFiles(files = []) {
        if(files.length === 0) return;

        for (const file of files) {
            const formData = new FormData();
            formData.append("files[]", file);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", window.location.href);

            // Find file container by data attribute
            const fileContainer = document.querySelector(`.uploaded-item[data-file="${file.name}"]`);
            if (fileContainer) {
                const progressBar = document.createElement("div");
                progressBar.classList.add("progress-bar");
                fileContainer.appendChild(progressBar);

                xhr.upload.onprogress = function(event) {
                    if (event.lengthComputable) {
                        const percentComplete = (event.loaded / event.total) * 100;
                        progressBar.style.width = percentComplete + "%";
                    }
                };
            }

            xhr.onload = function() {
                if(xhr.status == 200) {
                    status.innerHTML = 'Archivos subidos exitosamente';
                    fetchData(folderName);
                } else {
                    status.innerHTML = 'Error al subir archivos';
                }
            };

            xhr.onerror = function() {
                status.innerHTML = 'Error de conexión con el servidor';
            };

            xhr.send(formData);
        }
    }
    
    /* function uploadFiles(files = []) {
    
        if(files.length==0) return;
    
        const formData = new FormData();
        for(const element of files) {
            formData.append("files[]", element);
        }
    
        let xhr = new XMLHttpRequest();
        xhr.open("POST", window.location.href);
        
        xhr.onload = function() {
            if(xhr.status == 200) {
                status.innerHTML = 'Archivos subidos exitosamente';
                console.log("Respuesta del servidor:", xhr.responseText);
                fetchData(folderName);
            } else {
                status.innerHTML = 'Error al subir archivos';
                console.error("Error en la respuesta del servidor:", xhr.responseText);
            }
        }
    
        xhr.onerror = function() {
            status.innerHTML = 'Error de conexión con el servidor';
            console.error("Error de red o de conexión.");
        };
    
        xhr.send(formData);
    } */

    function fetchData(folderName) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', './fetchFolderContent.php?folderName=' + encodeURIComponent(folderName), true);
        xhr.onload = () => {
            if (xhr.status === 200) {
                document.getElementById('file-container').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
    
});
