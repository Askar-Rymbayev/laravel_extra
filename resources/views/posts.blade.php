<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/vendor/bootstrap-5.3.0/css/bootstrap.css">

    <title>Posts</title>
</head>
<body>

<div class="container">

    <h1>Posts</h1>

    <?php foreach ($posts as $post): ?>
        <article>
            <h1><a href="/post/<?= $post->slug ?>"><?= $post->title ?></a></h1>
            <div><?= $post->descr ?></div>
        </article>
    <?php endforeach; ?>
</div>
</body>
</html>
