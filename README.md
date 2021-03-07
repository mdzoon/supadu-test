# supadu-test

## Project setup

### Prerequisites:

A fresh site with installed WordPress v5.6.2.

Twenty Twenty-One theme.

### Installation:

Download repository files (supadu-test).

Unzip files to the ‘themes’ folder in the WordPress directory.

Activate the ‘supadu-test’ theme.

Create the ‘Books’ page from admin dashboard or with WP_CLI and publish it.

### Notes:

I used the cURL functions to fetch the data. In a real-life project, it should be replaced with a more robust solution, placed outside the ‘page-books.php’ file ( e.g separate plugin ).

I refrained from using the SASS preprocessor. For simplicity, I tapped on the out-of-the-box Twenty Twenty-One theme styling and its variables.

I also did not install any additional dependencies or libraries. I tried to keep the environmental settings agnostic, using the functionality offered by default WordPress installation.

The page will fail on IE11> browser. I purposely used CSS variables and ES6 JavaScript syntax sacrificing older browser support to code clarity and flexibility.
