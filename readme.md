# Simple API project using SOLID design with PHP and Postgresql.

This project was developed with the intention of being consumed by some server software like nginx.

To access the route, you need to add query_params to `$uri` in the form: /index.php?`uri=$uri`&$query_params, for example: `/users/1?a=2` => `/index.php?uri=/users/1&a=2`