# Pantone Converter Bundle

Wraps the [Pantone Converter](https://github.com/matatirosolutions/pantone-converter) to provide a Twig function to display a colour swatch

## Installation
Require the bundle with composer

````bash
composer require matatirosoln/pantone-converter-bundle
````
Enable the bundle, for Flex

````php
// in config/bundles.php
return [
	// ...
	MSDev\PantoneConverterBundle\PantoneConverterBundle::class => ['all' => true],
];
````
Or for Symfony 3.4
````php
// in app/AppKernel.php
public function registerBundles() {
	$bundles = [
		// ...
		new MSDev\PantoneConverterBundle\PantoneConverterBundle(),
	];
	// ...
}
````

## Usage

### Basic usage
In a Twig template use `pantone_swatch` passing the required colour as the parameter e.g.
````
{{ pantone_swatch('100 C') }} 
````
will render the following HTML
```html
<span class="pantone-swatch" style="background-color:#F6EB61;"></span>
```
You'll then want to apply styling to the `pantone-swatch` class to display at an appropriate size for your implementation, e.g.
```css
.pantone-swatch {
    display: inline-block;
    width: 50px;
    height: 50px;
}
```

### Adding content
You can also pass an optional second parameter which will be embedded into the span (this can include HTML), e.g. 
````
{{ pantone_swatch('100 C', 'This is yellow') }} 
````
will render the following HTML
```html
<span class="pantone-swatch" style="background-color:#F6EB61;">This is yellow</span>
```

### Error case
If you request a non-existent colour, the swatch will render with a white background, e.g. 
````
{{ pantone_swatch('Foo C', 'This colour is missing') }} 
````
will render the following HTML
```html
<span class="pantone-swatch" style="background-color:#FFFFFF;">This colour is missing</span>
```

## License
Copyright &copy; 2020, Matatiro Solutions. Licensed under the [MIT License](LICENSE.md).

## Note
 - PANTONE&reg; is a registered trademark of [Pantone Inc](https://www.pantone.com/).