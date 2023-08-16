<?php 
    $image = imagecreatetruecolor(200, 50);     

    //set line color and number of lines in background
    $set_linecolor = imagecolorallocate($image, 101, 62, 8);
    $no_of_lines = rand(3,6);

    //image background
    $set_bgcolor = imagecolorallocate($image, 255, 212, 178);  
    imagefilledrectangle($image,0,0,200,50,$set_bgcolor);

    // draw lines in background
    for($i=0; $i<$no_of_lines; $i++)
    {
        imageline($image,0,rand()%50,250,rand()%50,$set_linecolor);
    }

    $set_pixel = imagecolorallocate($image, 0,0,255);
    for($i=0;$i<500;$i++)
    {
        imagesetpixel($image,rand()%200,rand()%50,$set_pixel);
    } 

    // Set captcha letters
    $range = '0123456789ABCDEFGHJKLMNPQRSTUVWXZabcdefghijkmnopqrstwxyz&#$?:/*-=+';
    $length = strlen($range);
    $captcha = $range[rand(0, $length-1)];
    $word = '';
    $text_color = imagecolorallocate($image, 0,0,0);
    $cap_length = 7; // No. of character in image
    for ($i = 0; $i< $cap_length; $i++)
    {
        $captcha = $range[rand(0, $length-1)];
        imagestring($image, 15,  5+($i*30), 20, $captcha, $text_color);
        $word.= $captcha;
    }

    // store the captcha letters in session
    $_SESSION['captcha_word'] = $word;
    imagepng($image, "captcha.png");

?>