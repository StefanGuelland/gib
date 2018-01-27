# -*- coding: utf-8 -*-

import os
import getpass

BOT_NAME = 'Careercrawler'

SPIDER_MODULES = ['scrashtest.spiders']
NEWSPIDER_MODULE = 'scrashtest.spiders'

# Crawl responsibly by identifying yourself (and your website) on the user-agent
USER_AGENT = 'w-hs (klaus.thiel@w-hs.de)'

# Obey robots.txt rules
ROBOTSTXT_OBEY = True


DOWNLOADER_MIDDLEWARES = {
    # Engine side
    'scrapy_splash.SplashCookiesMiddleware': 723,
    'scrapy_splash.SplashMiddleware': 725,
    'scrapy.downloadermiddlewares.httpcompression.HttpCompressionMiddleware': 810,
    # Downloader side
}

SPIDER_MIDDLEWARES = {
    'scrapy_splash.SplashDeduplicateArgsMiddleware': 100,
}


if os.environ.get('APP_ENV') == 'docker':
    print("Running inside Docker container!")
    SPLASH_URL = 'http://splash:8050/'
else:
    if getpass.getuser() == 'sguelland':
        SPLASH_URL = 'http://localhost:8050/'
    else:
        SPLASH_URL = 'http://192.168.99.100:8050/'

    # SPLASH_URL = 'http://192.168.59.103:8050/'
DUPEFILTER_CLASS = 'scrapy_splash.SplashAwareDupeFilter'
HTTPCACHE_STORAGE = 'scrapy_splash.SplashAwareFSCacheStorage'

ITEM_PIPELINES = {
    'scrashtest.Pipelines.DefaultValuesPipeline': 100,
    'scrashtest.Pipelines.DBPipeline': 200,
}
DEPTH_LIMIT = 3
DOWNLOAD_DELAY = 5.0

if getpass.getuser() == 'sguelland':
    DATABASE_IP = 'localhost:3307'
else:
    DATABASE_IP = 'db'
DATABASE_USER = 'root'
DATABASE_PASSWORD = 'root'
DATABASE_NAME = 'firmendb'

TELNETCONSOLE_ENABLED = False
