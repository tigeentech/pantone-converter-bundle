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

### Error case
If you request a non-existent colour, the swatch will render with a white background, e.g. 
````
{{ pantone_swatch('Foo C', 'This colour is missing') }} 
````
will render the following HTML
```html
<span class="pantone-swatch" style="background-color:#FFFFFF;">This colour is missing</span>
```


### Options
You can also pass an optional object as the second parameter with three possible values.

#### Content
Add content to the span (this can include HTML), e.g. 
````
{{ pantone_swatch('100 C', {'content': 'This is yellow'}) }} 
````
will render the following HTML
```html
<span class="pantone-swatch" style="background-color:#F6EB61;">This is yellow</span>
```

#### Border
Add a border of the specified colour to the swatch. This can be either an HTML named colour, or a hex colour, e.g.
````
{{ pantone_swatch('100 C', {'border': '#FF0000'}) }} 
````
will render the following HTML
```html
<span class="pantone-swatch" style="background-color:#F6EB61;border-color:#FF0000"></span>
```
You'll need to set the other border parameters in your css, e.g.
```css
.pantone-swatch {
    /*...*/
    border-width: 1px;
    border-style: solid;
}
```

#### Border when white
Add a border of the specified colour to the swatch but only if it is white. This may happen if the swatch is deliberately set to be white, or when an invalid colour is passed. This can be either an HTML named colour, or a hex colour, e.g.
````
{{ pantone_swatch('100 C', {'borderWhite': '#FF0000'}) }} 
````
will render the following HTML
```html
<span class="pantone-swatch" style="background-color:#F6EB61;"></span>
```
because `100 C` is a valid colour, while
 ````
 {{ pantone_swatch('Unknown Colour', {'borderWhite': '#FF0000'}) }} 
 ````
 will render the following HTML
 ```html
 <span class="pantone-swatch" style="background-color:#F6EB61;border-color:#FF0000"></span>
 ```
As for a standard border you'll also need to set the other border parameters in your css.


## License
Copyright &copy; 2020, Matatiro Solutions. Licensed under the [MIT License](LICENSE.md).

## Note
 - PANTONE&reg; is a registered trademark of [Pantone Inc](https://www.pantone.com/).