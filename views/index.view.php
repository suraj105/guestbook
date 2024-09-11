<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="./styles/lib/montserrat/webfonts/Montserrat.css" />
    <link rel="stylesheet" type="text/css" href="./styles/main.css" />
    <title>Gästebuch</title>
</head>
<body>
    <div class="container">
        <h1 class="guestbook-heading">GuestBook</h1>
        <form method="POST" action="submit.php">
            <?php if(isset($errorMessage)): ?>
                <p><?php echo e($errorMessage); ?></p>
            <?php endif; ?>
            <label class="guestbook-entry-label" for="name">Name:</label>
            <input 
                required="required"
                class="guestbook-entry-input"
                type="text"
                id="name"
                name="name" />

            <label class="guestbook-entry-label" for="title">Titel:</label>
            <input 
                required="required"
                class="guestbook-entry-input" 
                type="text" 
                id="title"
                name="title" />

            <label class="guestbook-entry-label" for="content">Content:</label>
            <textarea 
                required="required"
                rows="4"
                class="guestbook-entry-input" 
                type="text" 
                id="content" 
                name="content"></textarea>

            <div class="guestbook-form-buttons">
                <input class="button" type="reset" value="Zurücksetzen">
                <input class="button" type="submit" value="Absenden">
            </div>
        </form>

        <hr class="guestbook-separator" />

        <?php foreach($entries AS $entry): ?>
            <?php
                $paragraphs = explode("\n", $entry['content']);
                $filteredParagraphs = [];
                foreach ($paragraphs AS $paragraph) {
                    $paragraph = trim($paragraph);
                    if (strlen($paragraph) > 0) {
                        $filteredParagraphs[] = $paragraph;
                    }
                }
            ?>
            <div class="guestbook-entry">
                <div class="guestbook-entry-header">
                    <h3 class="guestbook-entry-title">
                        <?php echo e($entry['title']); ?>
                    </h3>
                    <span class="guestbook-entry-author">
                        <?php echo e($entry['name']); ?>
                    </span>
                </div>
                <div class="guestbook-entry-content">
                    <?php foreach($filteredParagraphs AS $p): ?>
                        <p><?php echo e($p); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <?php
            $numPages = ceil($countTotal / $perPage);

        ?>
        <?php if ($numPages > 1): ?>
            <ul class="guestbook-pagination">
                <?php for($x = 1; $x <= $numPages; $x++): ?>
                    <li class="guestbook-pagination-li">
                        <a 
                            class="guestbook-pagination-a<?php if($x === $currentPage): ?> guestbook-pagination-active<?php endif; ?>" 
                            href="index.php?<?php echo http_build_query(['page' => $x]); ?>">
                            
                            <?php echo e($x); ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        <?php endif; ?>

        <hr class="guestbook-separator" />

        <footer class="guestbook-footer">
            <p>Implementiert im PHP-Kurs</p>
        </footer>

    </div>
</body>
</html>