FROM nginxinc/nginx-unprivileged:alpine AS base

RUN rm /etc/nginx/nginx.conf
RUN rm /etc/nginx/conf.d/default.conf

FROM base AS final
COPY ./docker/php-proxy/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/php-proxy/conf.d/ /etc/nginx/conf.d/
