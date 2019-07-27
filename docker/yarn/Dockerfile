FROM node:10-alpine

MAINTAINER "Yuto Kawamoto" <y.kawamoto@go-hd.jp>

WORKDIR /tmp

RUN apk update && \
    npm install -g yarn

RUN mkdir -p /data
VOLUME ["/data"]
WORKDIR /data

ENTRYPOINT ["yarn"]
