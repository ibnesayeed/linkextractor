# Link Extractor: Step 4

A web application to extract links and anchor texts from a given web page and analyze link statistics.

## Changes from the previous step

* The link extractor JSON API service (written in Python) is moved in a separate folder
* A web front-end application is written in PHP that talks to the JSON API
* The PHP application is mounted inside the official `php:7-apache` Docker image for easier modification during the development
* The web application is accessible at `http://<hostname>[:<prt>]/?url=<url-encoded-url>`
* An environment variable `API_ENDPOINT` is used inside the PHP application to configure it to talk to the JSON API server
* A `docker-compose.yml` file is written to build various components and glue them together

## Try it out

```
$ docker-compose up --build
```

Open http://localhost/?url=http%3A%2F%2Fodu.edu%2F in a web browser.

Press `Ctrl + C` to terminate the service.
