## 表单 Form

```php
$action = '/save.php';
$method = 'POST';

$input = FormHelper::input('goods_name', '商品名称')->required();
$textarea = FormHelper::textarea('goods_info', '商品简介');
$switch = FormHelper::switches('is_open', '是否开启')->activeText('开启')->inactiveText('关闭');

// 创建表单
$form = FormHelper::createForm($action)->setMethod($method);

// 添加组件
$form->setRule([$input, $textarea]);
$form->append($switch);

// 生成代码
$formHtml = $form->view();
$this->assertStringContainsString('element-ui', $formHtml);

文档 http://php.form-create.com/docs/2.0/README
```
