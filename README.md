# A Laravel Nova Tooltip package

This [Nova](https://nova.laravel.com) tool lets you:
  - Add a tooltip to your field in  (Table Header, Field in form, and Field in detail)
  - Add a tooltip to your menu item 
 
 ## Requirements
  - `php: >=8.0`
  - `laravel/nova: ^4.0`
  
	> 	   Note: This package dose't work with nova 3

## Features
- Support HTML in the tooltip function custom design in the tooltip
- Support localization.
- Support Fields.
- Support Menu Items.
- 1 line of code able you to add a tooltip


## Screenshot

![](https://raw.githubusercontent.com/badinansoft/nova-tooltip/master/docs/tooltip-menu.png)


## Installation

You can install the nova tool in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
	composer require badinansoft/nova-tooltip
```

## Usage

 - ### Field

Just need add this method to field ``` tooltip() ```
```php
	Text::make(__('Domain'), 'domain')  
		 ->tooltip(__('Domain For Company <br /> <small class="text-primary-500">ex: https://badinanshipping.com</small>'))
```

 - ### Menu Item
 
Just need add this method to menu item ``` tooltip() ```
```php
	MenuItem::resource(ArrivedToTurkishOfficeOrder::class)  
			 ->tooltip(__('Arrived Orders <br> <small>That mean the orders that <br> arrived to <b>turkish office</b></small>'))  
			 ->name(__('AO')),
```


## Credits

- [Shahab Zebari](https://github.com/shahabzebare)
- [All Contributors](../../contributors)
 

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
