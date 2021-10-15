FROM nginx:1.17.2-alpine

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY /app/public /app/public

RUN chown -R nginx:nginx /app/public

VOLUME ["/app/public"]

EXPOSE 8080

USER nginx

CMD ["nginx", "-g", "daemon off;"]

WORKDIR /app/public