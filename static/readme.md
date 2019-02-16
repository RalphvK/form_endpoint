# Installation instructions

Clone this repository:

```
git clone https://github.com/RalphvK/bootsass.git your-project
```

Remove remote "origin". Alternatively, you can remove the git folder completely and reinitialise git.

```git remote rm origin```


Run NPM install:

```npm install```

If Gulp-CLI is not yet installed on the system, run:

```npm install gulp-cli -g```

Run gulp to watch for changes by running the ```gulp``` command in the project root:

```gulp```

You are ready to go to work!

# Javascript files

The combined javascript file ```js/scripts.min.js``` is compiled from the index in the ```js/index.json``` file. By default it looks like this:

```json
{
    "includes": [
        "./js/partials/**/*.js"
    ]
}
```

You can run the build using the following Gulp task:

```gulp concat_js```

Watch for changes using the following Gulp task:

```gulp watch```

Running ```gulp``` will run this task by default.

Include the javascript file with the script tag:

```html
<!-- concatenated javascript -->
<script src="js/scripts.min.js"></script>
```

# Snippets

Included in the project are a few snippets for VS Code. My aim is to expand this collection further in the future.

### CSS/SCSS

```cfg``` - The $cgf map short-cut snippet is included for quickly referencing the standard $cfg file-specific config map in scss. The $cfg map is my own personal convention, and not a globally accepted practice. It outputs the following line:

```scss
map-get($cfg, 'your-property')
```

```map-get``` - Alternative for the default map-get snippet. The default snippet uses named arguments, whereas this alternative uses anonymous arguments. Most of the time, named arguments are preferred, but in the case of map-get it is often desirable to reduce visual clutter, while map-get only has two arguments of which it is immediately clear what their respective purpose is.

```scss
map-get($yourmap, 'your-property')
```

```top:left:bottom:left:``` - Since there is no short-hand for absolute positioning, this snippet is included to easily add all sides. It outputs:

```scss
top: 0;
right: 0;
bottom: 0;
left: 0;
```