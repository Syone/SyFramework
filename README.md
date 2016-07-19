SyFramework is a PHP framework for fast development of web applications.
It allows you to build your application as a tree of simpler components and each of them can be considered as small web-micro application which can be embedded into another application or even into another component.

# Programmer's Reference Guide

[![Join the chat at https://gitter.im/Syone/SyFramework](https://badges.gitter.im/Syone/SyFramework.svg)](https://gitter.im/Syone/SyFramework?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

## Getting started

### Requirements

A web server supporting PHP 5.3.0 or higher.

### Installation

1. Download SyFramework here.
2. Unpack the downloaded package into a directory on your web server.

### Quick start

To use SyFramework classes you just need to include the sy.inc.php file.

```php
<?php
require '/path/to/your/syframework/directory/sy.inc.php';

use Sy\Component\Html\Page;

$page = new Page();
$page->setTitle('Page example');
$page->setBody('Hello world!');
echo $page;
```

This script will generate the following output:

```html
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Page example</title>
</head>
<body>
Hello world!
</body>
</html>
```

[Try it yourself!](http://syframework.alwaysdata.net/sypage)

### Install with Composer

You can also install with Composer: https://packagist.org/packages/sy/framework And include the Composer autoload file instead of sy.inc.php

## Sy Package Content

* Sy - SyFramework root package. See global class diagram.
  * Component - The concept of component in SyFramework is the most important to understand.
    * WebComponent - Component with some web properties like css/js management and translation feature.
  * Db - Simple database access layer based on PDO.
  * Debug - Debug tools like logs and time recording.
  * Template - SyFramework template engine system.
  * Translate - SyFramework translation system.
  * Object - SyFramework root class.

### Basic HTML Component

* Page
  * Create a HTML page
  * Set doctype
  * Set headers
  * CSS and JS
  * Set body
  * Web Debug Toolbar
* Form
  * Create a form
  * Set form attributes
  * Set form options
  * Add form elements
  * Check if a form is valid
  * Validator function
  * Form design
  * Render a form
* Table
  * Add rows and cells
  * Set attributes for the table tag
  * Add caption tag
  * Add thead, tbody or tfoot tags
  * Add col or colgroup tags
  * Utilities methods
* DataTable
  * Add rows
  * Auto heading
  * Data formatting
* Panel
* Element
* Navigation

[See more here](https://bitbucket.org/syone/syframework/wiki/Home)

## The MIT License (MIT)

Copyright &copy; 2011–2016 [Syone](https://github.com/Syone) & [Contributors](https://github.com/Syone/SyFramework/graphs/contributors)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
