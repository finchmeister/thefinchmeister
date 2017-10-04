FROM node:alpine

WORKDIR /var/www/thefinchmeister

ENV NODE_ENV=development

COPY package.json ./
COPY yarn.lock ./
COPY webpack.config.js ./
COPY assets assets/

RUN mkdir -p web/build
# TODO is this the best way?
CMD yarn install && yarn run encore dev --watch