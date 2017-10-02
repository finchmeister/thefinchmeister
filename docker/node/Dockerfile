FROM node:alpine

COPY package.json ./
COPY package.lock ./

RUN npm install

RUN yarn run encore dev