## 上传 Upload

```php
$handle = Helper::upload($_FILES['image_field']);
if ($handle->uploaded) {
    $handle->file_new_name_body = 'image_resized';
    $handle->image_resize = true;
    $handle->image_x = 100;
    $handle->image_ratio_y = true;
    $handle->process(dirname(__DIR__) . '/data/temp/image');
    if ($handle->processed) {
        $handle->clean();
    } else {
        $this->fail($handle->error);
    }
}
文档 https://github.com/verot/class.upload.php
```
