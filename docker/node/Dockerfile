FROM node:alpine

WORKDIR /var/www/thefinchmeister

COPY package.json ./
COPY yarn.lock ./
COPY webpack.config.js ./
COPY assets assets/

RUN yarn install

RUN mkdir -p web/build
CMD yarn run encore dev