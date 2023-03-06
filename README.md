# Link Extractor: Step 6

A web application to extract links and anchor texts from a given web page and analyze link statistics.

## Changes from the previous step

* The API service written in Python is replaced with a similar Ruby implementation
* The `API_ENDPOINT` is updated to point to the new Ruby API service
* Newly added link extraction log is persisted using volumes

## Try it out

```
$ docker-compose up --build
```

Open http://localhost/?url=http%3A%2F%2Fodu.edu%2F in a web browser.

Press `Ctrl + C` to terminate the service.
