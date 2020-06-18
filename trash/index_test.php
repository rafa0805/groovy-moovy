<?php

require('./insta.php');

// echo('<pre>');
// var_dump($instagram);
// echo('</pre>');
// exit;

?>

<!DOCTYPE html>
<html lang='ja'>
<head>
    <title>Testing Insta API</title>
    <link rel='stylesheet' href='./styles.css'>
</head>
<body>
    <?php if(is_array($instagram->data)): ?>
        <div class="instagram-container">
        <?php
        foreach($instagram->data as $post):
        $caption = $post->caption;
        //   $caption = mb_convert_encoding($caption, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $caption = preg_replace('/\n/', '<br>', $caption);
        ?>
        <div class="instagram-item">
            <a class="instagram-card" href="<?php echo $post->permalink; ?>" target="_blank" rel="noopener noreferrer">
            <img class="instagram-card__img" src="<?php if($post->media_type=='VIDEO'){ echo $post->thumbnail_url; }else{ echo $post->media_url; } ?>" alt="<?php echo $caption; ?>">
            <!-- <div class="instagram-card__badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="instagram-icon"><path d="M352 56h-1c-39.7 0-74.8 21-95 52-20.2-31-55.3-52-95-52h-1c-61.9.6-112 50.9-112 113 0 37 16.2 89.5 47.8 132.7C156 384 256 456 256 456s100-72 160.2-154.3C447.8 258.5 464 206 464 169c0-62.1-50.1-112.4-112-113z"/></svg>
                <div style="margin-right: 8px;"><?php echo $post->like_count; ?></div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="instagram-icon"><path d="M256 64C141.1 64 48 139.2 48 232c0 64.9 45.6 121.2 112.3 149.2-5.2 25.8-21 47-33.5 60.5-2.3 2.5.2 6.5 3.6 6.3 11.5-.8 32.9-4.4 51-12.7 21.5-9.9 40.3-30.1 46.3-36.9 9.3 1 18.8 1.6 28.5 1.6 114.9 0 208-75.2 208-168C464 139.2 370.9 64 256 64z"/></svg>
                <div><?php echo $post->comments_count; ?></div>
            </div> -->
            <?php if($post->caption): ?>
            <div class="instagram-card__comment"><?php echo $post->caption; ?></div>
            <?php endif; ?>
            </a>
        </div>
        <?php endforeach; ?>
        </div>
        <?php endif; ?>

</body>
</html>

