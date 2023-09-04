## 图像处理 Image

```php
// 创建实例
$intervention = ImageHelper::intervention(['driver' => 'gd']);
$image = $intervention->canvas(400, 300, '#000000');
$image->text('Hello, world!', 200, 150, function ($font) {
	$font->size(60);
	$font->color('#FFFFFF');
	$font->align('center');
	$font->valign('middle');
});
$path = __DIR__ . '/output.jpg';
$image->save($path);
文档 https://image.intervention.io/v2/
```
