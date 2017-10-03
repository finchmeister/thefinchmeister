FROM node:alpine

WORKDIR /var/www/thefinchmeister

COPY package.json ./
COPY yarn.lock ./

RUN yarn install

COPY webpack.config.js ./
#RUN yarn run encore dev