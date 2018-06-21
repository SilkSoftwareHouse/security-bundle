This bundle requires **Symfony 3** or **Symfony 4**.

### Bundle installation

Add the bundle to you project dependencies:
```bash
composer require silksh/security-bundle
```

**Symfony 3**. Enable the bundle:
```php
// app/AppKernel.php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            // ...
            new SilkSH\SecurityBundle\SilkshSecurityBundle(),
        );
    }
}
```

**Symfony 4**. It's automatic, but if Symfony did not do it for you, enable the bundle manually in `bundles.php`:
```php
// config/bundles.php
return [
    // ...
    SilkSH\SecurityBundle\SilkshSecurityBundle::class => ['all' => true],
]
```

### Validators

The bundle provides some Validators in the namespace `SilkSH\SecurityBundle\Validator\Constraints`. 

- `FileName` validates filenames. Possible properties:
  - `maxFilenameLength`, default: 100.
  - `maxFilenameLengthMessage`: custom length error message. You can use `{{ max_length }}` inside.
  - `allowedExtensions`, default: "pdf", "txt", "doc", "docx", "ppt", "pptx", "jpg", "jpeg", "png"
  - `allowedExtensionsMessage`, custom error message about wrong extension. You can use `{{ extension }}` and `{{ extensions }}` inside.

  Example:
  ```php
    use SilkSH\SecurityBundle\Validator\Constraints as SecurityAssert;

    ...

    /**
     * @Vich\UploadableField(mapping="uploads", fileNameProperty="filename")
     * @SecurityAssert\FileName(
     *     maxFilenameLength=8,
     *     maxFilenameLengthMessage="Maximal file length is {{ max_length }} characters",
     *     allowedExtensions={"zip","bz2"},
     *     allowedExtensionsMessage="Extension '{{ extension }}' is not allowed. Allowed extensions: {{ extensions }}"
     * )
     */
    private $file;

  ```

- `Name` allows only international alphanumeric and some special characters (A-z 0-9 - + _ . , @ " '). Possible properties:
  - `message`: custom error message. You can use `{{ allowed_signs }}` inside.

- `HTMLPurifier` allows only whitelisted HTML tags and attributes. It uses [HTML Purifier](http://htmlpurifier.org/) library.  Possible properties:
  - `message`: custom error message.

- `TagWhitelist`: simple and buggy HTML tag validator that uses `DOMDocument`. Using `HTMLPurifier` instead is recommended. Possible properties:
  - `allowedTags`, default: "html", "head", "meta", "title", "style", "body", "table", "tr", "th", "td", "h1", "h2", "h3", "h4", "h5", "h6", "p", "a", "img", "br", "span", "small". 
  - `allowedTagsMessage`, custom error message for non valid tags. You can use `{{ allowed_tags }}` inside.
  - `allowedAttributes`, default: "width", "align", "cellspacing", "cellpadding", "class", "style", "href", "http-equiv", "name", "alt", "border", "content", "bgcolor", "type", "target", "src".
  - `allowedAttributesMessage`, custom error message for non valid attributes. You can use `{{ allowed_attributes }}` inside.

### Twig extension

The bundle provides `purify` filter for Twig.
It uses [HTML Purifier](http://htmlpurifier.org/) to remove all unsafe tags (like `<script>`) and attributes (like `onclick`) from HTML code.

Let's say we have some HTML code in the variable `value` and we want to render it unescaped,
so that the user sees formatted output. Usage:  
```twig
{{ value|purify|raw }}
```
