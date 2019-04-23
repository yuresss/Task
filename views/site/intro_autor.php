<tr>
    <h2><?=$autor->name?></h2>
    <p> <?=$autor->biography?></p>
        <?php
        foreach ($autor->getBooks()->all() as $book) { ?>
        <ul>
            <div class="body-content">
                <li><b><?=$book->name?></b></li>
                <p><?=$book->description?></p>
            </div>
        </ul>
        <?php } ?>
</tr>
