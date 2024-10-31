<p class="subtitle">Archivos Subidos: </p>
<?php if (count($folderFiles) > 0 && is_iterable($folderFiles)) : ?>
    <?php foreach ($folderFiles as $file) : ?>
    <div class="uploaded-item" data-file="<?php echo htmlspecialchars($file); ?>">

        <a href='<?php echo $folderPath . '/' . $file ?>' download class="btn-download">
            <img src="/assets/images/file.svg" alt="file">
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