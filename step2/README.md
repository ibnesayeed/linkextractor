# Link Extractor: Step 2

A basic page scraping script that prints out all the hyper references and anchor texts of the given web page.

## Changes from the previous step

* Paths are normalized to full URLs
* Reporting both links and anchor texts
* Usable as a module in other scripts

## Try it out

```
$ docker image build -t linkextractor:step2 .
$ docker container run -it --rm linkextractor:step2 http://example.com/
$ docker container run -it --rm linkextractor:step2 http://odu.edu/
```
