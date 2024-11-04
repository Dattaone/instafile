<p class="subtitle">Archivos Subidos: </p>
<div class="file-list">
<?php if (count($folderFiles) > 0 && is_iterable($folderFiles)) : ?>
    <?php foreach ($folderFiles as $file) : ?>
    <div class="uploaded-item" data-file="<?php echo htmlspecialchars($file); ?>">

        <a href='<?php echo $folderPath . '/' . $file ?>' download class="btn-download">
            <img class="image-file" alt="file" src=<?php
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $image = match($extension){
                'pdf'               => '/assets/images/pdf-document.svg',
                'ppt'               => '/assets/images/ppt-document.svg',
                'txt'               => '/assets/images/txt-document.svg',
                'zip'               => '/assets/images/zip-document.svg',
                'doc', 'docx'       => '/assets/images/word-document.svg',
                'xls', 'xlsx'       => '/assets/images/excel-document.svg',
                'jpg','jpeg','png'  => '/assets/images/image-document.svg',
                default             => '/assets/images/file-document.svg',
            };
            echo $image;
            ?> >
            <?php echo htmlspecialchars($file); ?>
        </a>
        <button type="submit" class="btn-delete" onclick="deleteFile('<?php echo htmlspecialchars($file) ?>')">
            <img src="/assets/images/delete.svg" alt="delete">
        </button>
    </div>
    
    <?php endforeach; ?>
<?php else : ?>
    <h3>No se han subido archivos.</h3>
<?php endif; ?>
</div>