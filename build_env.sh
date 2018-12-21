#!/bin/bash
if [[ -f /secrets ]];then
	source /secrets
fi

build_env_file(){
  ENV_FILE=$1
  if [ ! -f "$ENV_FILE" ]; then
    touch "$ENV_FILE"
  fi

  {
    echo "APP_NAME=${APP_NAME:-pct}";
    echo "APP_ENV=${APP_ENV:-local}";
    echo "APP_KEY=${APP_KEY:-base64:pcAbMV0M223aA2DYECtmuqVldZZm8LY2minsPcHpzgU=}";
    echo "APP_DEBUG=${APP_DEBUG:-true}";
    echo "APP_LOG=${APP_LOG:-single}";
    echo "APP_LOG_LEVEL=${APP_LOG_LEVEL:-debug}";
    echo "APP_URL=${APP_URL:-http://pct.local.adoreme.com}";
    echo "";
    echo "DB_CONNECTION=${DB_CONNECTION:-mysql}";
    echo "DB_HOST=${DB_HOST:-mysql}";
    echo "DB_PORT=${DB_PORT:-3306}";
    echo "DB_DATABASE=${DB_DATABASE:-homestead}";
    echo "DB_USERNAME=${DB_USERNAME:-homestead}";
    echo "DB_PASSWORD=${DB_PASSWORD:-secret}";
    echo "";
    echo "CACHE_DRIVER=${CACHE_DRIVER:-file}";
    echo "SESSION_DRIVER=${SESSION_DRIVER:-file}";
    echo "QUEUE_DRIVER=${QUEUE_DRIVER:-sync}";
    echo "";
    echo "MAIL_DRIVER=${MAIL_DRIVER:-mailgun}";
    echo "MAIL_HOST=${MAIL_HOST:-smtp.mailgun.org}";
    echo "MAIL_PORT=${MAIL_PORT:-25}";
    echo "MAIL_USERNAME=${MAIL_USERNAME:-test@pct.adoreme.com}";
    echo "MAIL_PASSWORD=${MAIL_PASSWORD:-test}";
    echo "MAIL_ENCRYPTION=${MAIL_ENCRYPTION:-null}";
    echo "ERROR_EMAIL_ADDRESSES=${ERROR_EMAIL_ADDRESSES:-andrei@adoreme.com}";
    echo "MAILGUN_DOMAIN=${MAILGUN_DOMAIN:-pct.adoreme.com}";
    echo "MAILGUN_SECRET=${MAILGUN_SECRET:-test}";
    echo "API_THROTTLE=${API_THROTTLE:-1000,1}";
    echo "MAGENTO_URL=${MAGENTO_URL:-http://www.dev.adoreme.com/index.php/publish_product/index}";
    echo "MAGENTO_ACCESSORIES_URL=${MAGENTO_ACCESSORIES_URL:-http://www.dev.adoreme.com/index.php/publish_product/index/accessory}";
    echo "MAGENTO_ADD_SIZES_URL=${MAGENTO_ADD_SIZES_URL:-http://www.dev.adoreme.com/index.php/publish_product/index/add_sizes}";
    echo "MAX_EXPORT_DELAY=${MAX_EXPORT_DELAY:-5}";
    echo "DOWNLOAD_KEY=${DOWNLOAD_KEY:-test}";
    echo "IMAGE_DRIVER=${IMAGE_DRIVER:-imagick}";
    echo "DB_HOST_MAGENTO=${DB_HOST_MAGENTO:-127.0.0.1}";
    echo "DB_DATABASE_MAGENTO=${DB_DATABASE_MAGENTO:-magento}";
    echo "DB_USERNAME_MAGENTO=${DB_USERNAME_MAGENTO:-adoreme}";
    echo "DB_PASSWORD_MAGENTO=${DB_PASSWORD_MAGENTO:-test}";
    echo "DB_PORT_MAGENTO=${DB_PORT_MAGENTO:-3306}";
    echo "";
    echo "BEANSTALKD_HOST=${BEANSTALKD_HOST:-beanstalkd}";
    echo "BEANSTALKD_PORT=${BEANSTALKD_PORT:-11300}";
    echo "";
    echo "OAUTH_SERVER=${OAUTH_SERVER:-http://pass15.qa.adoreme.com}";
    echo "";
    echo "WEBHOOK_MSPR_PRODUCT_URL=${WEBHOOK_MSPR_PRODUCT_URL:-http://product.dev.adoreme.com/v1/products}";
    echo "WEBHOOK_MSPR_PRODUCT_CHUNK_SIZE=${WEBHOOK_MSPR_PRODUCT_CHUNK_SIZE:-100}";
    echo "WEBHOOK_MSPR_PRODUCT_RETRIES=${WEBHOOK_MSPR_PRODUCT_RETRIES:-1}";
    echo "WEBHOOK_MSBOM_BOM_URL=${WEBHOOK_MSBOM_BOM_URL:-http://ms-bom.local.adoreme.com/api/v1/bills_of_materials}";
    echo "WEBHOOK_MSBOM_COLOR_CHART_URL=${WEBHOOK_MSBOM_COLOR_CHART_URL:-http://ms-bom.local.adoreme.com/api/v1/color_charts}";
    echo "WEBHOOK_MAGENTO_CHUNK_SIZE=${WEBHOOK_MAGENTO_CHUNK_SIZE:-100}";
    echo "WEBHOOK_MAGENTO_RETRIES=${WEBHOOK_MAGENTO_RETRIES:-1}";
    echo "";
    echo "RABBITMQ_DEFAULT_CONNECTION_HOSTNAME=${RABBITMQ_DEFAULT_CONNECTION_HOSTNAME:-rabbitmq}";
    echo "RABBITMQ_DEFAULT_CONNECTION_PORT=${RABBITMQ_DEFAULT_CONNECTION_PORT:-5672}";
    echo "RABBITMQ_DEFAULT_CONNECTION_USERNAME=${RABBITMQ_DEFAULT_CONNECTION_USERNAME:-guest}";
    echo "RABBITMQ_DEFAULT_CONNECTION_PASSWORD=${RABBITMQ_DEFAULT_CONNECTION_PASSWORD:-guest}";
    echo "RABBITMQ_DEFAULT_CONNECTION_VHOST=${RABBITMQ_DEFAULT_CONNECTION_VHOST:-/}";
    echo "";
    echo "MS_VENDORS_URL=http://ms-vendors.local-swarm.adoreme.com}";

    echo "";
    echo -n "";
  } > "${ENV_FILE}";

  if [ ${APP_ENV:-local} = "local" ]; then
    {
        if [[ -f ./.env.docker.local ]];then
            source ./.env.docker.local
        fi

        echo -n "";
        echo "DOCKER_SERVICES=${DOCKER_SERVICES:-all}";
        echo "DOCKER_MYSQL_PORT=${DOCKER_MYSQL_PORT:-33061}";
        echo "DOCKER_MONGODB_PORT=${DOCKER_MONGODB_PORT:-27017}";
        echo "DOCKER_REDIS_PORT=${DOCKER_REDIS_PORT:-6379}";
        echo -n "";
    } >> "${ENV_FILE}";
  fi

  chown www-data:www-data "${ENV_FILE}" || true
  chmod 640 "${ENV_FILE}" || true
}
