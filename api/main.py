#!/usr/bin/env python

from flask import Flask
from flask import request
from redis import Redis
import json
from linkextractor import extract_links

app = Flask(__name__)
redis = Redis(host="redis", port=6379)

@app.route("/")
def index():
    return "Usage: http://<hostname>[:<prt>]/api/<url>"

@app.route("/api/<path:url>")
def api(url):
    qs = request.query_string.decode("utf-8")
    if qs != "":
        url += "?" + qs

    jsonlinks = redis.get(url)
    if not jsonlinks:
        links = extract_links(url)
        jsonlinks = json.dumps(links, indent=2)
        redis.set(url, jsonlinks)

    response = app.response_class(
        status=200,
        mimetype="application/json",
        response=jsonlinks
    )

    return response

app.run(host="0.0.0.0")
