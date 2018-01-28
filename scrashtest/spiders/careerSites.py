# -*- coding: utf-8 -*-
import scrapy
from scrapy.linkextractors import LinkExtractor

from scrapy_splash import SplashRequest
from scrashtest.CompanyItem import CompanyItem


class CareerSpider(scrapy.Spider):
    name = "careerSites"
    careerfound = None;
    company = None;

    def __init__(self, id='', url='', domain='', *args, **kwargs):
        super(CareerSpider, self).__init__(*args, **kwargs)
        self.start_urls = [url];
        self.allowed_domains = [domain];
        self.company = CompanyItem();
        self.company['start_url'] = url;
        self.company['id'] = id;
        self.company['careerSites'] = [];

    # http_user = 'splash-user'
    # http_pass = 'splash-password'

    def parse(self, response):
        le = LinkExtractor()
        links = le.extract_links(response);
        for link in links:
            if self.prof_career(link.url, link.text):
                self.company['careerSites'].append(link.url);
                self.careerfound = True
        if not self.careerfound:
            for link in links:
                if not self.prof_shop(link.url, link.text):
                    yield SplashRequest(
                        link.url,
                        self.parse,
                        endpoint='render.json',
                        args={
                            'har': 1,
                            'html': 1,
                        }
                    )
                if (self.careerfound):
                    break
        else:
            yield self.company

    def prof_career(self, url, text):
        buzzwords = ["karriere", "Karriere", "Jobs", "jobs", "career", "mitarbeiter", "Mitarbeiter", "stellenmarkt"]
        for word in buzzwords:
            if not (url.find(word) == -1 and text.find(word) == -1):
                if not url in self.company['careerSites']:
                    return True
        return None

    def prof_shop(self, url, text):
        buzzwords = ["shop", "Artikel", "category", "Produkte", "la-cantina"]
        for word in buzzwords:
            if not (url.find(word) == -1 and text.find(word) == -1):
                return True
        return None

    def print(self, response):
        print(response);
        info = "PARSED ";
        if hasattr(response, 'real_url'):
            info = info + "real_url: " + response.real_url;
        if hasattr(response, 'url'):
            info = info + "url: " + response.url;
        print(info);
        if hasattr(response, 'css'):
            print(response.css("title").extract())
        if hasattr(response, 'data'):
            print(response.data["har"]["log"]["pages"])
        if hasattr(response, 'headers'):
            print(response.headers.get('Content-Type'))
