FROM nginx:alpine

# Copy config
COPY default.conf /etc/nginx/conf.d/default.conf

# Clean cache (nếu cần)
RUN rm -f /etc/nginx/conf.d/default.conf.default
