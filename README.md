# ImageResize
PocketMine-MP virion that resize image size

## Installation
[Download Zip](https://github.com/Melodylan/ImageResize/archive/refs/heads/main.zip)

## Usage

The image converter tool has the ability to resize images. <br>
Supported image formats are ```png```, ```jpg```, and ```gif```.

Called the class to resize the image
```php
use skh6075\lib\imageresize\ImageResize;
```

Get the image path and called the converter.
```php
$converter = ImageResize::converter(string $imagePath);
```

After writing down the size to be adjusted and the path to save the adjusted image, <br>
call the resizing method.
```php
$converter->resizing(string $destPath, int $width, int $height);
```

This is a method to check the image adjustment result for developers.
```php
use skh6075\lib\imageresize\convert\utils\ImageResizeResult;

switch($converter){
    case ImageResizeResult::SUCCESS():
        echo "Image resizing success";
        break;
    case ImageResizeResult::FAILURE():
        echo "Image resizing failure";
        break;
    case ImageResizeResult::NONE():
        echo "Prepare for image resizing";
        break;
}
```