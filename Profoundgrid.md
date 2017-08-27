Profound Grid
==================

A responsive grid system for fixed and fluid layouts. Built in SCSS/Compass.

### Requirements

Sass >= 3.2.5 


### Basic Usage

This repo is a mirror of http://www.profoundgrid.com and should be understood as one big example. The grid is just one file: /sass/grid/_grid.scss

```sass
// //////////////////////
// CONFIG
// //////////////////////

@import 'grid/grid';

$total_width: 100%;
$container_margin: 3.85%;
$gutter_width: 3.85%;
$max_width: 1233px;

.somecontainer{
	@include container();
}

.somecolumn{
	@include column(9);
}

.somesidebar{
	@include column(3);
	@include push(9);
}
```

### License: [WTFPL](http://en.wikipedia.org/wiki/WTFPL)
```
           DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
                   Version 2, December 2004

Copyright (C) 2013 Profound Creative Studio, LLC <mail@weareprofound.com>
Everyone is permitted to copy and distribute verbatim or modified
copies of this license document, and changing it is allowed as long
as the name is changed.

           DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
  TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION

 0. You just DO WHAT THE FUCK YOU WANT TO.
```

### Credits/Inspiration:
 * [Semantic Grid](http://www.semantic.gs) Semantic Grid
 * [Susy](http://susy.oddbird.net) Amazing Fluid Grids
 * [Negative Grid](http://chrisplaneta.com/freebies/negativegrid-fluid-css-grid-by-chris-planeta/) Negative Margins

### Profound Creative Studio
 * http://www.profoundgrid.com
 * http://www.weareprofound.com 