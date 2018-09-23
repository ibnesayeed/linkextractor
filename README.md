# Link Extractor: Step 1

A basic page scraping script that prints out all the hyper references of the given web page.

## Changes from the previous step

* Adds a `Dockerfile` to fix various issues describe in the previous step

## Try it out

```
$ docker image build -t linkextractor:step1 .
$ docker container run -it --rm linkextractor:step1 http://example.com/
$ docker container run -it --rm linkextractor:step1 http://odu.edu/
```
